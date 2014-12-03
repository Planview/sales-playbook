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
        'prefix' => 'admin',
        'namespace' => 'Admin'
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
});
