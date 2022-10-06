<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            "email" => "required|string|email",
            "message" => "required|string|min:10",
            "attachment" => "nullable|file"
        ]);

        $contact = Contact::create([
            "email" => $data["email"],
            "message" => $data["message"],
            "attachment" => Storage::put("/contacts", $data["attachment"])
        ]);

        return response()->json($contact);
    }
}
