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

Route::group(
	[
		'prefix' => LaravelLocalization::setLocale(),
		'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
	],
	function()
	{
	Route::get('/', function () {
		return view('welcome');
	});

	Route::get('/login', function () {
		return view('auth.login');
	});

	Route::get('/register', function () {
		return view('auth.register');
	});

		Route::get('auth/login', [
			'as' => 'profile', 'uses' => 'UserController@showProfile'
		]);

// Authentication routes...
		Route::get('auth/login', 'Auth\AuthController@getLogin');
		Route::post('auth/login', 'Auth\AuthController@postLogin');
		Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
		Route::get('auth/register', 'Auth\AuthController@getRegister');
		Route::post('auth/register', 'Auth\AuthController@postRegister');
});

Route::get('/admin', function () {
	return view('sb-admin.home');
});

Route::get('admin/charts', function()
{
	return View::make('sb-admin.mcharts');
});

Route::get('admin/tables', function()
{
	return View::make('sb-admin.table');
});


Route::get('admin/forms', function()
{
	return View::make('sb-admin.form');
});

Route::get('admin/grid', function()
{
	return View::make('sb-admin.grid');
});

Route::get('admin/buttons', function()
{
	return View::make('sb-admin.buttons');
});


Route::get('admin/icons', function()
{
	return View::make('sb-admin.icons');
});

Route::get('admin/panels', function()
{
	return View::make('sb-admin.panel');
});

Route::get('admin/typography', function()
{
	return View::make('sb-admin.typography');
});

Route::get('admin/notifications', function()
{
	return View::make('sb-admin.notifications');
});

Route::get('admin/blank', function()
{
	return View::make('sb-admin.blank');
});

Route::get('admin/login', function()
{
	return View::make('sb-admin.login');
});

Route::get('admin/documentation', function()
{
	return View::make('sb-admin.documentation');
});