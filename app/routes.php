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

### Routes for Dashboard related URL's start ###
Route::get('/dashboard', 'HomeController@dashboard');
Route::get('/db_connect', 'HomeController@db_connect');
Route::any('organisation-clients', array('as' => 'organisation-clients', 'uses' => 'HomeController@organisation_clients' ));
Route::any('individual-clients', array('as' => 'individual-clients', 'uses' => 'HomeController@individual_clients' ));
Route::any('/individual/add-client', array("as"=>"add_individual_client", "uses"=>'HomeController@add_individual_client'));
Route::post('/individual/insert-client-details', array("as"=>"insert_individual_client", "uses"=>'HomeController@insert_individual_client'));
Route::any('/individual/get-office-address', array("as"=>"get_office_address", "uses"=>'HomeController@get_office_address'));
Route::any('/individual/save-relationship', array("as"=>"save_relationship", "uses"=>'HomeController@save_relationship'));
Route::any('/individual/save-userdefined-field', array("as"=>"save_userdefined_field", "uses"=>'HomeController@save_userdefined_field'));
Route::any('/individual/show-new-tables', array("as"=>"show_new_table", "uses"=>'HomeController@show_new_table'));
Route::any('/individual/search-individual-client', array("as"=>"search_individual_client", "uses"=>'HomeController@search_individual_client'));


Route::any('/organisation/add-client', array("as"=>"add_organisation_client", "uses"=>'HomeController@add_organisation_client'));
Route::any('/organisation/save-services', array("as"=>"save_services", "uses"=>'HomeController@save_services'));

Route::any('/organisation/insert-client-details', array("as"=>"insert_organisation_client", "uses"=>'HomeController@insert_organisation_client'));

Route::any('/search/search-client', array("as"=>"search_client", "uses"=>'HomeController@search_client'));
Route::any('/search/search-all-client', array("as"=>"search_all_client", "uses"=>'HomeController@search_all_client'));
### Routes for Dashboard related URL's end ###

### Routes for practice details related URL's start ###
Route::get('/practice-details', 'PracticeDetailsController@index');
Route::post('/insertPracticeDetails', 'PracticeDetailsController@insertPracticeDetails');
Route::post('/ajaxSearchByCity', 'PracticeDetailsController@ajaxSearchByCity');
Route::post('/ajaxSearchGetState', 'PracticeDetailsController@ajaxSearchGetState');
Route::get('/php_info', 'PracticeDetailsController@php_info');
Route::any('/downloadExel', array("as"=>"download/downloadExel", "uses"=>'PracticeDetailsController@downloadExel'));
Route::any('/download/downloadPdf', array("as"=>"downloadPdf", "uses"=>'PracticeDetailsController@downloadPdf'));
Route::any('/practice/delete-practice-logo', array("as"=>"delete_practice_logo", "uses"=>'PracticeDetailsController@delete_practice_logo'));
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
Route::any('/download/downloadExcel', array("as"=>"user/download_excel", "uses"=>'UserController@download_excel'));
Route::any('/user/create-password/{id}', array("as"=>"create_user_password", "uses"=>'UserController@create_user_password'));
Route::any('/create-password-process', array("as"=>"create_new_password", "uses"=>'UserController@create_new_password'));
Route::any('/update-status', array("as"=>"update_status", "uses"=>'UserController@update_status'));
### Routes for user related URL's end ###


### Routes for Email Settings related URL's start ###
Route::any('/email-settings', array("as"=>"email_settings/index", "uses"=>'EmailSettingsController@index'));
Route::any('/template/edit_template', array("as"=>"show_edit_template", "uses"=>'EmailSettingsController@show_edit_template'));
Route::any('/template/get_template', array("as"=>"get_template", "uses"=>'EmailSettingsController@get_template'));
Route::any('/template/add_template', array("as"=>"add_email_template", "uses"=>'EmailSettingsController@add_email_template'));
Route::any('/template/delete-email-template', array("as"=>"delete_email_template", "uses"=>'EmailSettingsController@delete_email_template'));
Route::any('/template/delete-attach-file', array("as"=>"delete_attach_file", "uses"=>'EmailSettingsController@delete_attach_file'));
Route::any('/template/edit-email-template', array("as"=>"edit_email_template", "uses"=>'EmailSettingsController@edit_email_template'));
Route::any('/template/get-edit-template-type', array("as"=>"get_edit_template_type", "uses"=>'EmailSettingsController@get_edit_template_type'));
### Routes for Email Settings related URL's end ###

### Routes for Settings related URL's start ###
Route::any('/settings-dashboard', array('as' => 'settings-dashboard', 'uses' => 'SettingsController@index' ));
### Routes for Settings related URL's end ###


### Routes for registration URL's start ###
Route::get('/admin-signup', 'AdminController@signup');
Route::post('/signup-process', 'AdminController@signup_process');
Route::get('/', 'AdminController@login');
Route::post('/login-process', 'AdminController@login_process');
Route::get('/admin-logout', 'AdminController@logout');
Route::get('/forgot-password', 'AdminController@forgot_password');
Route::post('/password-send', 'AdminController@password_send');
Route::get('/admin-profile', 'AdminController@adminprofile');
Route::get('/change-password', 'AdminController@change_password');
Route::post('/new-pass', 'AdminController@new_pass');
Route::get('/profile-edit', 'AdminController@profile_edit');
Route::post('/profile-update', 'AdminController@profile_update');
Route::any('/admin/activation/{id}', array("as"=>"activation", "uses"=>'AdminController@activation'));

### Routes for Client URL's start ###
Route::any('/individual/get-country-code', array("as"=>"get_country_code", "uses"=>'ClientController@get_country_code'));
Route::any('/individual/delete-user-field', array("as"=>"delete_user_field", "uses"=>'ClientController@delete_user_field'));
Route::any('/delete-individual-clients', array("as"=>"delete_individual_client", "uses"=>'ClientController@delete_individual_client'));
Route::any('/client/search-tax-address', array("as"=>"search_tax_address", "uses"=>'ClientController@search_tax_address'));
Route::any('/client/add-business-type', array("as"=>"add_business_type", "uses"=>'ClientController@add_business_type'));
Route::any('/client/delete-org-name', array("as"=>"delete_org_name", "uses"=>'ClientController@delete_org_name'));
Route::any('/client/add-vat-scheme', array("as"=>"add_vat_scheme", "uses"=>'ClientController@add_vat_scheme'));
Route::any('/client/delete-vat-scheme', array("as"=>"delete_vat_scheme", "uses"=>'ClientController@delete_vat_scheme'));
Route::any('/client/get-oldcont-address', array("as"=>"get_oldcont_address", "uses"=>'ClientController@get_oldcont_address'));
Route::any('/client/add-services', array("as"=>"add_services", "uses"=>'ClientController@add_services'));
Route::any('/client/delete-services', array("as"=>"delete_services", "uses"=>'ClientController@delete_services'));
Route::any('/client/insert-section', array("as"=>"insert_section", "uses"=>'ClientController@insert_section'));
Route::any('/client/delete-section', array("as"=>"delete_section", "uses"=>'ClientController@delete_section'));
Route::any('/client/get-subsection', array("as"=>"get_subsection", "uses"=>'ClientController@get_subsection'));
Route::any('/client/edit-org-client/{id}', array("as"=>"edit_org_client", "uses"=>'ClientController@edit_org_client'));
Route::any('/client/edit-ind-client/{id}', array("as"=>"edit_ind_client", "uses"=>'ClientController@edit_ind_client'));
Route::any('/client/save-client', array("as"=>"save_client", "uses"=>'ClientController@save_client'));
Route::any('/client/archive-client', array("as"=>"archive_client", "uses"=>'ClientController@archive_client'));
Route::any('/client/show-archive-client', array("as"=>"show_archive_client", "uses"=>'ClientController@show_archive_client'));
Route::any('/client/edit-relation-type', array("as"=>"edit_relation_type", "uses"=>'ClientController@edit_relation_type'));
Route::any('/client/delete-relationship', array("as"=>"delete_relationship", "uses"=>'ClientController@delete_relationship'));
Route::any('/client/save-database-relationship', array("as"=>"save_database_relationship", "uses"=>'ClientController@save_database_relationship'));
### Routes for Client URL's end ###



## Company House Data Start ##
Route::any('/chdata/index', array("as"=>"index", "uses"=>'ChdataController@index'));
## Company House Data End ##

