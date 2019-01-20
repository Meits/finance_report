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

Route::post('/auth/register','Auth\RegisterController@register');
Route::post('/auth/login','Auth\LoginController@login');
Route::middleware('auth:api')->get('/auth/user','Auth\LoginController@user');
Route::get('/auth/refresh','Auth\LoginController@refresh');

Route::middleware('auth:api')->get('/categories','Api\CategoriesController@index');
