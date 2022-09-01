<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});






Auth::routes();

Route::middleware("auth")
  ->namespace("Admin") 
  ->name("admin.") 
  ->prefix("admin")
  ->group(function () {
    Route::get('/', 'HomeController@index')->name('index');    
    Route::resource("posts", "PostController");
    Route::resource("users" , "UserController");
  });


  Route::get('/public', function () {
    return view('public');
})->name('public');

Route::get("{any?}", function () {
  return view("public");
})->where("any", ".*");
