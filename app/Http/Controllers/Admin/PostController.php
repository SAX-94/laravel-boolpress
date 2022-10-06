<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Mail\NewPostMail;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Ritorna un elemento cercandolo per il suo slug.
     * Se non viene trovato, viene lanciato un errore 404
     */
    private function findBySlug($slug)
    {
        $post = Post::where("slug", $slug)->withTrashed()->first();

        if (!$post) {
            abort(404);
        }

        return $post;
    }

    private function generateSlug($text)
    {
        $toReturn = null;
        $counter = 0;

        do {
            // generiamo uno slug partendo dal titolo
            $slug = Str::slug($text);

            // se il counter é maggiore di 0, concateno il suo valore allo slug
            if ($counter > 0) {
                $slug .= "-" . $counter;
            }

            // controllo a db se esiste già uno slug uguale
            $slug_esiste = Post::where("slug", $slug)->first();

            if ($slug_esiste) {
                // se esiste, incremento il contatore per il ciclo successivo
                $counter++;
            } else {
                // Altrimenti salvo lo slug nei dati del nuovo post
                $toReturn = $slug;
            }
        } while ($slug_esiste);

        return $toReturn;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::orderBy("created_at", "desc")->get();
        $user = Auth::user();

        if ($user->role === "admin") {
            $posts = Post::orderBy("created_at", "desc")->paginate(5);
        } else {
            // $posts = Post::where("user_id", $user->id)->orderBy("created_at", "desc")->get();
            $posts = $user->posts;
        }

        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.posts.create", compact("categories", "tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validare i dati ricevuti
        $validatedData = $request->validate([
            "title" => "required|min:10",
            "content" => "required|min:10",
            "category_id" => "nullable|exists:categories,id",
            "tags" => "nullable|exists:tags,id",
            "cover_img" => "required|image",
        ]);

        // Salvare a db i dati
        $post = new Post();
        $post->fill($validatedData);
        $post->user_id = Auth::user()->id;

        // Salvo il file sul mio server
        // ritorna il link interno a dove si trova il file
        $coverImg = Storage::put("/post_covers", $validatedData["cover_img"]);
        // $coverImg = $validatedData["cover_img"]->store("/post_covers");

        // salvo dentro i dati di questo post il link al file appena caricato
        $post->cover_img = $coverImg;

        $post->slug = $this->generateSlug($post->title);

        $post->save();

        // Nel caso dello store, PRIMA di associare i tag, devo salvare il post creato
        // in modo da permettere al DB di generare un ID per il post.
        // Questo id è essenziale per fare l'associazione nella tabella ponte
        if (key_exists("tags", $validatedData)) {
            $post->tags()->attach($validatedData["tags"]);
        }

        Mail::to($post->user->email)->send(new NewPostMail($post));

        // redirect su una pagina desiderata - di solito show
        return redirect()->route("admin.posts.show", $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = $this->findBySlug($slug);

        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = $this->findBySlug($slug);
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.posts.edit", compact("post", "categories", "tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {

        $validatedData = $request->validate([
            "title" => "required|min:10",
            "content" => "required|min:10",
            "category_id" => "nullable|exists:categories,id",
            "tags" => "nullable|exists:tags,id",
            "cover_img" => "nullable|image"
        ]);

        $post = $this->findBySlug($slug);

        // cover_img non è obbligatorio, di conseguenza dobbiamo controllare 
        // se ci è stato inviato dall'utente
        if (key_exists("cover_img", $validatedData)) {
            // se il post ha già un immagine,
            // PRIMA di caricare quella nuova, cancello quella vecchia
            if ($post->cover_img) {
                Storage::delete($post->cover_img);
            }

            // Salvo il file sul mio server
            // ritorna il link interno a dove si trova il file
            $coverImg = Storage::put("/post_covers", $validatedData["cover_img"]);
            // $coverImg = $validatedData["cover_img"]->store("/post_covers");

            // salvo dentro i dati di questo post il link al file appena caricato
            $post->cover_img = $coverImg;
        }

        if ($validatedData["title"] !== $post->title) {
            // genero un nuovo slug
            $post->slug = $this->generateSlug($validatedData["title"]);
        }

        // toglie dalla tabella ponte TUTTE le relazione del $post
        // $post->tags()->detach();

        /*
            - se l'utente mi invia dei tag, devo associarli al post corrente
            - se non mi invia i tag, devo rimuovere tutte le associazioni esistenti per il post corrente
        */
        if (key_exists("tags", $validatedData)) {
            // Aggiunge nella tabella ponte una riga per ogni tag da associare
            // $post->tags()->attach($validatedData["tags"]);
            $post->tags()->sync($validatedData["tags"]);
        } else {
            $post->tags()->sync([]);
        }

        $post->update($validatedData);

        return redirect()->route("admin.posts.show", $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $slug)
    {
        $forceDelete = $request->query->has("force-delete");

        $post = $this->findBySlug($slug);

        // Se l'elemento è già cancellato in "soft delete", lo vado ad eliminare definitivamente
        if ($post->trashed() || $forceDelete) {
            // Annulliamo tutte le eventuali relazioni attive, 
            // che altrimenti ci impedirebbero di cancellare il post
            $post->tags()->detach();

            $post->forceDelete();
        } else {
            $post->delete();
        }

        return redirect()->route("admin.posts.index");
    }
}
