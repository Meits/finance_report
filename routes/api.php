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
Route::middleware('auth:api')->post('/categories','Api\CategoriesController@store');
Route::middleware('auth:api')->delete('/categories/{category}','Api\CategoriesController@destroy');
Route::middleware('auth:api')->post('/calc','Api\CalcController@index');
Route::middleware('auth:api')->post('/calc/store', 'Api\CalcController@store');
Route::middleware('auth:api')->post('/result', 'Api\ResultController@index');
