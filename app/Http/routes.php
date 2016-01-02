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
use App\Http\Controllers\Countries;
use Illuminate\Support\Facades\Route;

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

		Route::get('auth/facebook', 'Auth\AuthController@redirectToProviderFB');
		Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallbackFB');

		Route::get('auth/twitter', 'Auth\AuthController@redirectToProviderTW');
		Route::get('auth/twitter/callback', 'Auth\AuthController@handleProviderCallbackTW');

		Route::get('auth/google', 'Auth\AuthController@redirectToProviderG');
		Route::get('auth/google/callback', 'Auth\AuthController@handleProviderCallbackG');

		Route::get('/admin', ['as' => 'admin', 'uses' => function () {
			return view('sb-admin.home');
		}]);

		Route::get('admin/userprofile', array('as' => 'user.update', function() {
			return view('sb-admin.userprofile')
				->with(app('App\Http\Controllers\UserController')->editProfile());
		}));
		// In POST vengono passati tutti i dati del form che vengono poi girati al validator
		Route::post('admin/userprofile', 'UserController@updateDataProfile');

		Route::get('admin/settings', array('as' => 'user.updatesettings', function() {
			return view('sb-admin.settings')
				->with(app('App\Http\Controllers\UserController')->editSettings());
		}));
		// In POST vengono passati tutti i dati del form che vengono poi girati al validator
		Route::post('admin/settings', 'UserController@updateDataSettings');


		Route::get('admin/listbreeders', array('as' => 'breeders.list', function() {
			return view('sb-admin.listbreeders')
				->with([
					'list' => app('App\Http\Controllers\Breeders')->getListBreeders(),
					'dataTable' => true,
					'customjs' => [
						'resources/views/sb-admin/bower_components/datatables/media/js/jquery.dataTables.min.js',
						'resources/views/sb-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js',
						'resources/views/sb-admin/js/listbreeders.js'
					]
				]);
		}));

		// In POST vengono passati tutti i dati del form che vengono poi girati al validator
		Route::post('admin/listbreeders', 'UserController@updateDataProfile');

		Route::get('admin/areas', array('as' => 'breeders.areas', function() {
			return view('sb-admin.areas')
				->with([
					'list' => app('App\Http\Controllers\Positions')->getListOfArea(),
					'dataTable' => false,
					'customjs' => [
						'resources/views/sb-admin/bower_components/datatables-1.10/js/jquery.dataTables.min.js',
						'resources/views/sb-admin/bower_components/datatables-1.10/js/dataTables.bootstrap.min.js',
						'resources/views/sb-admin/bower_components/datatables-plugins/dataTables.buttons.min.js',
						'resources/views/sb-admin/bower_components/datatables-plugins/dataTables.select.min.js',
						'resources/views/sb-admin/bower_components/datatables-editor/js/dataTables.editor.min.js',
						'resources/views/sb-admin/js/custom.js'
					]]);
		}));

		// In POST vengono passati tutti i dati del form che vengono poi girati al validator
		Route::post('admin/areas', 'UserController@updateDataProfile');

	});

Route::post('/admin/mylocation', 'MyLocation@myLocation');

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