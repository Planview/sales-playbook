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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/playbook', function () {
    return View::make('playbook');
});

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function() {
    Route::resource('documents', 'DocumentsController', ['only' => ['index', 'show']]);
    Route::resource('customers', 'CustomersController', ['only' => ['index', 'show']]);
    Route::resource('document-types', 'DocumentTypesController', ['only' => ['index', 'show']]);
    Route::resource('industries', 'IndustriesController', ['only' => ['index', 'show']]);
    Route::resource('competitors', 'CompetitorsController', ['only' => ['index', 'show']]);
    Route::resource('markets', 'MarketsController', ['only' => ['index', 'show']]);
    Route::resource('operating-regions', 'OperatingRegionsController', ['only' => ['index', 'show']]);
    Route::resource('planview-regions', 'PlanviewRegionsController', ['only' => ['index', 'show']]);
    Route::resource('planview-subregions', 'PlanviewSubRegionsController', ['only' => ['index', 'show']]);
});
//

// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');
