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

Route::group(
    [
        'prefix' => 'api',
        'namespace' => 'Api'
    ], function() {
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

Route::group(
    [
        'prefix'    => 'admin',
        'namespace' => 'Admin',
        'before'    => ['auth', 'admin']
    ], function() {
    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'HomeController@showDashboard']);
    Route::resource('documents', 'DocumentsController', ['except' => ['edit']]);
    Route::resource('customers', 'CustomersController', ['except' => ['edit']]);
    Route::resource('document-types', 'DocumentTypesController', ['except' => ['edit']]);
    Route::resource('industries', 'IndustriesController', ['except' => ['edit']]);
    Route::resource('competitors', 'CompetitorsController', ['except' => ['edit']]);
    Route::resource('markets', 'MarketsController', ['except' => ['edit']]);
    Route::resource('operating-regions', 'OperatingRegionsController', ['except' => ['edit']]);
    Route::resource('planview-regions', 'PlanviewRegionsController', ['except' => ['edit']]);
    Route::resource('planview-subregions', 'PlanviewSubRegionsController', ['except' => ['edit']]);
    Route::resource('users', 'UsersController', ['except' => ['edit']]);
    Route::resource('roles', 'RolesController', ['except' => ['edit']]);
    Route::resource('permissions', 'PermissionsController', ['except' => ['edit']]);

    // Route model binding
    Route::model('users', 'User');
    Route::model('roles', 'Role');
    Route::model('permissions', 'Permission');
    Route::model('competitors', 'Competitor');
    Route::model('document-types', 'DocumentType');
    Route::model('industries', 'Industry');
    Route::model('markets', 'Market');
    Route::model('operating-regions', 'OperatingRegion');
    Route::model('planview-regions', 'PlanviewRegion');
    Route::model('planview-subregions', 'PlanviewSubRegion');
    Route::model('customers', 'Customer');
    Route::model('documents', 'Document');
});

Route::group(['prefix' => 'auth'], function ()
{
    // Get Requests
    Route::get('login', ['as' => 'auth.login', 'uses' => 'UsersController@login']);
    Route::get('confirm/{code}', ['as' => 'auth.confirm', 'uses' => 'UsersController@confirm']);
    Route::get('forgot_password', ['as' => 'auth.forgotPassword', 'uses' => 'UsersController@forgotPassword']);
    Route::get('reset_password/{token}', ['as' => 'auth.resetPassword', 'uses' => 'UsersController@resetPassword']);
    Route::get('logout', ['as' => 'auth.logout', 'uses' => 'UsersController@logout']);

    // Form Posts
    Route::group(['before' => 'csrf'], function ()
    {
        Route::post('login', ['as' => 'auth.doLogin', 'uses' => 'UsersController@doLogin']);
        Route::post('forgot_password', ['as' => 'auth.doForgotPassword', 'uses' => 'UsersController@doForgotPassword']);
        Route::post('reset_password', ['as' => 'auth.doResetPassword', 'uses' => 'UsersController@doResetPassword']);
    });
});
