<?php

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/articles/{article}', 'ArticleController@show')->name('articles.show');

// TODO: Delete this after the demo.
Route::get('/protected', function () {
    return 'secret';
})->middleware('can:create_article');

Route::get('/chats', function () {
    return view('chats.index');
})->name('chats.index');
Route::post('/getChats', function () {
    return UserResource::collection(User::where('id', '!=', auth()->id())->get());
});
Route::post('/session/create', 'SessionController@create');

// Sending the message.
Route::post('/send/{session}', 'ChatController@send');
Route::post('/session/{session}/chats', 'ChatController@chats');