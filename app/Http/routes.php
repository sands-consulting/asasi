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

Route::auth();
Route::get('confirmation/{token}', 'Auth\AuthController@confirmation');

Route::get('/', [
	'uses' 	=> 'HomeController@index',
	'as' 	=> 'home.index'
]);
Route::get('admin', [
	'uses'	=> 'Admin\DashboardController@index',
	'as'	=> 'admin'
]);
