<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SongController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/genres', [GenreController::class, 'index']);
Route::get('/genres/all', [GenreController::class, 'all']);
Route::get('/albums', [AlbumController::class, 'index']);
Route::get('/albums/all', [AlbumController::class, 'all']);
Route::get('/songs', [SongController::class, 'index']);
Route::get('/songs/all', [SongController::class, 'all']);
Route::get("/songs/genre/{genre:slug}", [SongController::class, 'getSongsByGenre']);
Route::get("/songs/album/{album:slug}", [SongController::class, 'getSongsByAlbum']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/home', [HomeController::class, 'index']);

    // group add Genre CRUD routes,use model binding to get Genre instance by slug
    Route::group(['prefix' => 'genres'], function () {
        Route::post('/', [GenreController::class, 'store']);
        Route::get('/{genre:slug}', [GenreController::class, 'show']);
        Route::delete('/{genre:slug}', [GenreController::class, 'destroy']);

    });

    // group add AlbumResource CRUD routes,use model binding to get AlbumResource instance by slug
    Route::group(['prefix' => 'albums'], function () {
        Route::post('/', [AlbumController::class, 'store']);
        Route::get('/{album:slug}', [AlbumController::class, 'show']);
        Route::put('/{album}', [AlbumController::class, 'update']);
        Route::delete('/{album:slug}', [AlbumController::class, 'destroy']);
    });

    // group add Song CRUD routes,use model binding to get Song instance by slug
    Route::group(['prefix' => 'songs'], function () {

        Route::post('/', [SongController::class, 'store']);
        Route::get('/{song:slug}', [SongController::class, 'show']);
        Route::put('/{song}', [SongController::class, 'update']);
        Route::delete('/{song:slug}', [SongController::class, 'destroy']);
    });


});


require __DIR__ . '/auth.php';
