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

Route::group(['prefix' => 'api'], function() {
    Route::resource('documents', 'DocumentsApiController', ['only' => ['index', 'show']]);
    Route::resource('customers', 'CustomersApiController', ['only' => ['index', 'show']]);
    Route::resource('document-types', 'DocumentTypesApiController', ['only' => ['index', 'show']]);
    Route::resource('industries', 'IndustriesApiController', ['only' => ['index', 'show']]);
    Route::resource('competitors', 'CompetitorsApiController', ['only' => ['index', 'show']]);
    Route::resource('markets', 'MarketsApiController', ['only' => ['index', 'show']]);
    Route::resource('operating-regions', 'OperatingRegionsApiController', ['only' => ['index', 'show']]);
    Route::resource('planview-regions', 'PlanviewRegionsApiController', ['only' => ['index', 'show']]);
    Route::resource('planview-subregions', 'PlanviewSubRegionsApiController', ['only' => ['index', 'show']]);
});
