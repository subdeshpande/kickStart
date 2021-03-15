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
Route::get('import_characters', 'import_characters@index');
Route::get('update_characters', 'update_characters@update');
Route::get('characters_jedi', 'characters_jedi@index');
Route::get('mammal_homeworlds', 'mammal_homeworlds@index');
Route::post('create_character', 'create_character@create');
Route::get('show', 'create_character@show');