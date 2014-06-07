<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/user_login', 'UserController@login');
Route::get('/user_register', 'UserController@register');


Route::group(array('before'	=>	'auth'), function()
{
	Route::get('/role_get', 'RoleController@getRoles');
	Route::get('/role_create', 'RoleController@createRole');
	Route::get('/role_choose', 'RoleController@chooseRole');

	Route::get('/planet_get', 'PlanetController@get');

	Route::get('/building_get', 'BuildingController@get');
});