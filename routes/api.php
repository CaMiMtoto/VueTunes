<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\GenreController;
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

Route::group(['middleware' => ['auth:sanctum']], function () {

    // group add Genre CRUD routes,use model binding to get Genre instance by slug
    Route::group(['prefix' => 'genres'], function () {
        Route::get('/', [GenreController::class, 'index']);
        Route::post('/', [GenreController::class, 'store']);
        Route::get('/{genre:slug}', [GenreController::class, 'show']);
        Route::delete('/{genre:slug}', [GenreController::class, 'destroy']);

    });

    // group add AlbumResource CRUD routes,use model binding to get AlbumResource instance by slug
    Route::group(['prefix' => 'albums'], function () {
        Route::get('/', [AlbumController::class, 'index']);
        Route::post('/', [AlbumController::class, 'store']);
        Route::get('/{album:slug}', [AlbumController::class, 'show']);
        Route::put('/{album}', [AlbumController::class, 'update']);
        Route::delete('/{album:slug}', [AlbumController::class, 'destroy']);
    });

    // group add Song CRUD routes,use model binding to get Song instance by slug
    Route::group(['prefix' => 'songs'], function () {
        Route::get('/', 'SongController@index');
        Route::post('/', 'SongController@store');
        Route::get('/{song:slug}', 'SongController@show');
        Route::put('/{song:slug}', 'SongController@update');
        Route::delete('/{song:slug}', 'SongController@destroy');
    });


});


require __DIR__ . '/auth.php';
