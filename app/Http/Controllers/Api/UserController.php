<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show($id)
    {
        $authUser = Auth::user();

        $visibleColumns = [];

        if ($authUser && $authUser->role === "admin") {
            $visibleColumns[] = "*";
        } else {
            // se non sono admin, vedo solo queste colonne
            $visibleColumns[] = "name";
            $visibleColumns[] = "id";
        }

        $user = User::select(...$visibleColumns)->findOrFail($id);

        return response()->json($user);
    }
}
