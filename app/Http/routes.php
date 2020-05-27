<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/user/show', 'UserController@show');
Route::post('/user/register', 'UserController@register');

Route::post('/user/login','UserController@login');

Route::post('/user/pay','UserController@pay');
