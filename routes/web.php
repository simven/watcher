<?php

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

use App\Genre;
use App\Http\Resources\GenreResource;
use App\Http\Resources\SerieResource;
use App\Serie;

Auth::routes();

Route::get('/', 'AccueilController@index')->name('accueil');

Route::resource('comments', 'CommentController');
Route::resource('series', 'SerieController');
Route::resource('accueil', 'HomeController');
Route::resource('episodes', 'EpisodeController');
Route::resource('users', 'UserController');
Route::resource('genres', 'GenreController');
