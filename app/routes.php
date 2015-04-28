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

/*Route::get('/', function()
{
	return View::make('hello');
});*/


Route::get('/', 'HomeController@dashboard');
Route::get('/hello', 'HomeController@hello');
Route::get('/db_connect', 'HomeController@db_connect');
Route::get('/practice_details', 'PracticeDetailsController@index');
Route::post('/insertPracticeDetails', 'PracticeDetailsController@insertPracticeDetails');
Route::post('/ajaxSearchByCity', 'PracticeDetailsController@ajaxSearchByCity');
Route::post('/ajaxSearchGetState', 'PracticeDetailsController@ajaxSearchGetState');
Route::get('/user_list', 'UserController@user_list');
Route::get('/add_user', 'UserController@add_user');
Route::post('/user_process', 'UserController@user_process');
