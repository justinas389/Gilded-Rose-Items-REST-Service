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

// List items
Route::get('items', 'ItemController@index');

// List single item
Route::get('item{id}', 'ItemController@show');

// Create new item
Route::post('article', 'ItemController@store');

// Update item
Route::put('items', 'ItemController@store');

// Delete item
Route::delete('items', 'ItemController@destroy');
