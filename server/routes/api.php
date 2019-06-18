<?php

use Illuminate\Http\Request;

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

Route::get('status/{id?}', function(){
    return response()->json([
        'message' => 'You have successfully updated a photo!'
    ]);
});

Route::post('register', 'AuthenticationController@register');
Route::post('login', 'AuthenticationController@login');

Route::get('songs/{id?}', 'SongsController@index');
Route::get('song/{id}', 'SongsController@show');
Route::put('songs/{id}', 'SongsController@update');
Route::post('songs', 'SongsController@store');


//Route::get('bookmarks/song/{songId?}/user/{userId?}', 'BookmarkController@index');
Route::get('bookmarks/{songId?}/{userId?}', 'BookmarkController@index');
Route::post('bookmarks', 'BookmarkController@store');
Route::post('unbookmark', 'BookmarkController@unbookmark');

Route::get('userbookmarks/{userId}', 'BookmarkController@userbookmarks');
//Route::delete('bookmarks/{id}', 'BookmarkController@destroy');
//Route::delete('bookmarks/{songId}/{userId}', 'BookmarkController@destroy');
