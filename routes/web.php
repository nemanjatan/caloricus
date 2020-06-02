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

// Chats
Route::get('/chats', 'ChatController@index')->name('chats.index');
Route::post('/chats/all', 'ChatController@get_all_chats')->name('chat.all');

// Sending the message.
Route::post('/send/{session}', 'ChatController@send');
Route::post('/session/{session}/chats', 'ChatController@chats');
Route::post('/session/{session}/read', 'ChatController@read');
Route::get('/session/create/{user}', 'SessionController@create')->name('session.create');

// Profiles
Route::get('/profiles', 'ProfileController@index')->name('profile.index');
Route::get('/profile/{profile}', 'ProfileController@show')->name('profile.show');