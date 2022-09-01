@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="nav mb-4">
            <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">Add a new post</a>
        </div>


        <div class="row">

            @foreach ($posts as $post)
                <div class="col-4">
                    <div class="post shadow h-100">
                        <img src="{{ asset('/storage/' . $post['image']) }}" class="img-fluid" alt="">
                        <div class="p-3 mb-3">
                            <div class="title">
                                {{ $post['title'] }}
                            </div>
                            <div class="description">
                                {{ $post['description'] }}
                            </div>
                            <div class="row">
                                <div class="col-6 author">
                                    {{ $post->user->name }}
                                </div>
                                <div class="col-6">
                                    {{ $post['created_at'] }}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-end pb-3">
                            <a class="btn btn-success mx-2" href="{{ route('admin.posts.show', $post->id) }}"><i
                                    class="fa-solid fa-eye"></i></a>
                            <a class="btn btn-primary mx-2" href="{{ route('admin.posts.edit', $post->id) }}"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mx-2"><i
                                        class="fa-solid fa-trash-can"></i></button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
