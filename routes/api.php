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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Movie API
Route::get('movies', 'App\Http\Controllers\MoviesController@index')->name('get-request');
Route::get('movies/{movie_id}', 'App\Http\Controllers\MoviesController@show')->name('get-request-by-id');
Route::post('movies', 'App\Http\Controllers\MoviesController@store')->name('post-request');
Route::put('movies/{movie}', 'App\Http\Controllers\MoviesController@update')->name('put-request');
Route::delete('movies/{movie}', 'App\Http\Controllers\MoviesController@delete')->name('delete-request');
