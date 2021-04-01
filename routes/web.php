<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home','HomeController@index')->name('home');

//Map routing
Route::get('/sites/map','MapsController@sitesMap')->middleware('role:super.admin.engineer.backoffice');
Route::get('/alerts/map','MapsController@alertsMap')->middleware('role:super.admin.engineer.backoffice');

// Users routing
Route::get('/users','UsersController@index')->middleware('role:super.admin.engineer.backoffice');
//Route::post('/users','UsersController@store')->middleware('role:super.admin');
//Route::get('/users/create','UsersController@create')->middleware('role:super');
Route::get('/users/{user}','UsersController@show')->middleware('role:super.admin.engineer.backoffice');
Route::get('/users/{user}/edit','UsersController@edit')->middleware('role:super.admin.engineer.backoffice');
Route::put('/users/{user}','UsersController@update')->middleware('role:super.admin');
Route::delete('/users/{user}/delete','UsersController@destroy')->middleware('role:super.admin');
// Alerts routing
Route::get('/alerts','AlertsController@index')->middleware('role:super.admin.engineer.backoffice');
Route::post('/alerts','AlertsController@store')->middleware('role:super.admin.engineer.backoffice');
Route::get('/alerts/create','AlertsController@create')->middleware('role:super.admin.engineer.backoffice');
Route::get('/alerts/{alert}','AlertsController@show')->middleware('role:super.admin.engineer.backoffice');
Route::get('/alerts/{alert}/edit','AlertsController@edit')->middleware('role:super.admin.engineer.backoffice');
Route::put('/alerts/{alert}','AlertsController@update')->middleware('role:super.admin.engineer.backoffice');
Route::put('/alerts/{alert}/complete','AlertsController@complete')->middleware('role:super.admin.engineer.backoffice');
Route::delete('/alerts/{alert}/delete','AlertsController@destroy')->middleware('role:super.admin');
//Sites Routing
Route::get('/sites','SitesController@index')->middleware('role:super.admin.engineer.backoffice');
Route::post('/sites','SitesController@store')->middleware('role:super.admin');
Route::get('/sites/create','SitesController@create')->middleware('role:super.admin');
Route::get('/sites/{site}','SitesController@show')->middleware('role:super.admin.engineer.backoffice');
Route::get('/sites/{site}/edit','SitesController@edit')->middleware('role:super.admin');
Route::put('/sites/{site}','SitesController@update')->middleware('role:super.admin');
Route::delete('/sites/{site}/delete','SitesController@destroy')->middleware('role:super');
//Locations Routing
Route::get('/locations','LocationsController@index')->middleware('role:super.admin.engineer.backoffice');
Route::post('/locations','LocationsController@store')->middleware('role:super.admin');
Route::get('/locations/create','LocationsController@create')->middleware('role:super.admin');
Route::get('/locations/{location}','LocationsController@show')->middleware('role:super.admin.engineer.backoffice');
Route::get('/locations/{location}/edit','LocationsController@edit')->middleware('role:super.admin');
Route::put('/locations/{location}','LocationsController@update')->middleware('role:super.admin');
Route::delete('/locations/{location}/delete','LocationsController@destroy')->middleware('role:super');
//Companies Routing
Route::get('/companies','CompaniesController@index')->middleware('role:super.admin.engineer.backoffice');
Route::post('/companies','CompaniesController@store')->middleware('role:super.admin');
Route::get('/companies/create','CompaniesController@create')->middleware('role:super.admin');
Route::get('/companies/{company}','CompaniesController@show')->middleware('role:super.admin.engineer.backoffice');
Route::get('/companies/{company}/edit','CompaniesController@edit')->middleware('role:super.admin');
Route::put('/companies/{company}','CompaniesController@update')->middleware('role:super.admin');
Route::delete('/companies/{company}/delete','CompaniesController@destroy')->middleware('role:super');
//Devices Routing
Route::get('/devices','DevicesController@index')->middleware('role:super.admin.engineer.backoffice');
Route::post('/devices','DevicesController@store')->middleware('role:super.admin');
Route::get('/devices/create','DevicesController@create')->middleware('role:super.admin');
Route::get('/devices/{device}','DevicesController@show')->middleware('role:super.admin.engineer.backoffice');
Route::get('/devices/{device}/edit','DevicesController@edit')->middleware('role:super.admin');
Route::put('/devices/{device}','DevicesController@update')->middleware('role:super.admin');
Route::delete('/devices/{device}/delete','DevicesController@destroy')->middleware('role:super');