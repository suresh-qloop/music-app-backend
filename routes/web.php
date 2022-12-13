<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongsController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LyricsController;
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
    return view('welcome');
});

Route::post('/songs', [SongsController::class, 'allSongs']);
Route::post('/distinct-songs', [SongsController::class, 'distinctSongs']);
Route::post('/add-new-song', [SongsController::class, 'addNewSong']);
Route::post('/update-song', [SongsController::class, 'updateSong']);
Route::post('/videos', [SongsController::class, 'allVideos']);
Route::post('/randVideos', [SongsController::class, 'randomVideos']);
Route::post('/now-trending', [SongsController::class, 'nowTrendings']);
Route::post('/articles', [ArticlesController::class, 'allArticles']);
Route::post('/artists', [ArtistsController::class, 'allArtists']);
Route::post('/users', [UsersController::class, 'allUsers']);
Route::post('/lyrics-lines', [LyricsController::class, 'allLyricsLines']);
Route::post('/sign-up', [UsersController::class, 'store']);
Route::post('/sign-in', [UsersController::class, 'checkLogin']);
Route::post('/reset-password', [UsersController::class, 'resetPassword']);
Route::post('/comment-lyrics', [LyricsController::class, 'addExplanation']);