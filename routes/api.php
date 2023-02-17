<?php

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
        Route::get('/', 'GenreController@index');
        Route::post('/', 'GenreController@store');
        Route::get('/{genre:slug}', 'GenreController@show');
        Route::put('/{genre:slug}', 'GenreController@update');
        Route::delete('/{genre:slug}', 'GenreController@destroy');
    });

    // group add Album CRUD routes,use model binding to get Album instance by slug
    Route::group(['prefix' => 'albums'], function () {
        Route::get('/', 'AlbumController@index');
        Route::post('/', 'AlbumController@store');
        Route::get('/{album:slug}', 'AlbumController@show');
        Route::put('/{album:slug}', 'AlbumController@update');
        Route::delete('/{album:slug}', 'AlbumController@destroy');
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
