<?php

namespace App\Http\Controllers\Admin;

use App\User;

use App\Http\Controllers\Controller;
use App\UserDetail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $details = UserDetail::all();
        $users = User::all();
        return view("admin.users.index", compact("details" , "users"));


    }

   
}
