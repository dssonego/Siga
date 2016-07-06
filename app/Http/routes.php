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

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/', function () {
        return view('auth/login');
    });

    Route::resource('customers', 'CustomerController');

    //Route::post('customers/{id}/edit', ['as' => 'customers.{id}.edit', 'uses' => 'CustomerContactController@create']);
    Route::post('customers/{id}/edit','CustomerContactController@create');
    Route::delete('customers/{id}/edit','CustomerContactController@destroy');

    Route::resource('jobs', 'JobController');
    Route::post('jobs/alterjob/{id}','JobController@alterJob');

});


