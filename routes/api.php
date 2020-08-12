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

Route::group(['prefix' => 'user'], function() {
    Route::get('', ['as' => 'user.index', 'uses' => 'control\API\UserController@index']);
    Route::get('{id}', ['as' => 'user.show', 'uses' => 'control\API\UserController@show']);
    Route::post('create', ['as' => 'user.store', 'uses' => 'control\API\UserController@store']);
    Route::match(['put', 'patch'],'update/{id}', ['as' => 'user.update', 'uses' => 'control\API\UserController@update']);
    Route::delete('delete/{id}', ['as' => 'user.delete', 'uses' => 'control\API\UserController@destroy']);
});

Route::group(['prefix' => 'category'], function() {
    Route::get('', ['as' => 'user.index', 'uses' => 'control\API\CategoryController@index']);
    Route::get('{id}', ['as' => 'user.show', 'uses' => 'control\API\CategoryController@show']);
    Route::post('create', ['as' => 'user.store', 'uses' => 'control\API\CategoryController@store']);
    Route::match(['put', 'patch'], 'update/{id}', ['as' => 'user.store', 'uses' => 'control\API\CategoryController@update']);
    Route::delete('delete/{id}', ['as' => 'user.delete', 'uses' => 'control\API\CategoryController@destroy']);
});
