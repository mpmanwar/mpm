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

### Routes for practice details related URL's start ###
Route::get('/practice-details', 'PracticeDetailsController@index');
Route::post('/insertPracticeDetails', 'PracticeDetailsController@insertPracticeDetails');
Route::post('/ajaxSearchByCity', 'PracticeDetailsController@ajaxSearchByCity');
Route::post('/ajaxSearchGetState', 'PracticeDetailsController@ajaxSearchGetState');
Route::get('/php_info', 'PracticeDetailsController@php_info');
Route::any('/downloadExel', array("as"=>"download/downloadExel", "uses"=>'PracticeDetailsController@downloadExel'));
Route::any('/downloadPdf', array("as"=>"download/downloadPdf", "uses"=>'PracticeDetailsController@downloadPdf'));
### Routes for practice details related URL's end ###

### Routes for user related URL's start ###
Route::post('/user_process', 'UserController@user_process');
Route::get('/user-list', 'UserController@user_list');
Route::get('/add-user', 'UserController@add_user');
Route::get('/send_mail', 'UserController@send_mail');
Route::any('/delete-users', array("as"=>"user/delete-users", "uses"=>'UserController@delete_users'));
Route::get('/edit-user/{id}', 'UserController@edit_user');
Route::post('/save-edit', 'UserController@saveedit');
Route::get('/pdf', 'UserController@pdf');
### Routes for user related URL's end ###