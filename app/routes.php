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

/* =========== Outer Routes Start =============== */
Route::get('/contact', 'ContactController@index');
/* =========== Outer Routes End =============== */

/* =========== Cron Job Start =============== */
Route::get('/jobs_email_client', 'CronJobController@jobs_email_client');
/* =========== Cron Job End =============== */

### Routes for Dashboard related URL's start ###
Route::get('/', 'HomeController@index');
Route::get('/dashboard', 'HomeController@dashboard');
Route::get('/db_connect', 'HomeController@db_connect');
Route::any('/organisation-clients', array('as' => 'organisation-clients', 'uses' => 'HomeController@organisation_clients' ));

Route::any('/onboard', 'HomeController@onboard');
Route::any('/client/onboard-client', 'ClientController@onboard_client');
Route::any('/client/add-checklist', 'ClientController@add_checklist');
Route::any('/delete-checklist-type', 'ClientController@delete_checklist');
Route::any('/client/getowner', 'ClientController@getowner');
Route::any('/individual-clients', array('as' => 'individual-clients', 'uses' => 'HomeController@individual_clients' ));
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
Route::any('/user/get-relation-client/{id}', array("as"=>"get_relation_client", "uses"=>'UserController@get_relation_client'));
Route::any('/user/delete-user-client', array("as"=>"delete_user_client", "uses"=>'UserController@delete_user_client'));
Route::any('/user/update-related-company-status', array("as"=>"update_related_company_status", "uses"=>'UserController@update_related_company_status'));



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
Route::any('/client-list-allocation/{service_id}/{client_type}',  'ClientListAllocationController@index');
Route::any('/search-allocation-clients',  'ClientListAllocationController@search_allocation_clients');
Route::any('/save-bulk-allocation',  'ClientListAllocationController@save_bulk_allocation');
Route::any('/save-manual-staff',  'ClientListAllocationController@save_manual_staff');
Route::any('/allocationClientsByService',  'ClientListAllocationController@allocationClientsByService');
### Routes for Settings related URL's end ###


### Routes for registration URL's start ###
Route::get('/admin-signup', 'AdminController@signup');
Route::post('/signup-process', 'AdminController@signup_process');
Route::get('/login', 'AdminController@login');
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
Route::any('/client/get-orgoldcont-address', array("as"=>"get_orgoldcont_address", "uses"=>'ClientController@get_orgoldcont_address'));
Route::any('/client/add-services', array("as"=>"add_services", "uses"=>'ClientController@add_services'));
Route::any('/client/delete-services', array("as"=>"delete_services", "uses"=>'ClientController@delete_services'));
Route::any('/client/insert-section', array("as"=>"insert_section", "uses"=>'ClientController@insert_section'));
Route::any('/client/delete-section', array("as"=>"delete_section", "uses"=>'ClientController@delete_section'));
Route::any('/client/get-subsection', array("as"=>"get_subsection", "uses"=>'ClientController@get_subsection'));
Route::any('/client/edit-org-client/{id}/{type}', array("as"=>"edit_org_client", "uses"=>'ClientController@edit_org_client'));

Route::any('/client/edit-ind-client/{id}/{type}', array("as"=>"edit_ind_client", "uses"=>'ClientController@edit_ind_client'));


Route::any('/client/delete-client-service', array("as"=>"delete_client_services", "uses"=>'ClientController@delete_client_services'));

Route::any('/client/save-client', array("as"=>"save_client", "uses"=>'ClientController@save_client'));
Route::any('/client/archive-client', array("as"=>"archive_client", "uses"=>'ClientController@archive_client')); 
Route::any('/client/show-archive-client', array("as"=>"show_archive_client", "uses"=>'ClientController@show_archive_client'));
Route::any('/client/edit-relation-type', array("as"=>"edit_relation_type", "uses"=>'ClientController@edit_relation_type'));
Route::any('/client/delete-relationship', array("as"=>"delete_relationship", "uses"=>'ClientController@delete_relationship'));
Route::any('/client/save-database-relationship', array("as"=>"save_database_relationship", "uses"=>'ClientController@save_database_relationship'));
Route::any('/client/save-acting-relationship', array("as"=>"save_acting_relationship", "uses"=>'ClientController@save_acting_relationship'));
Route::any('/client/get-corporation-address', array("as"=>"get_corporation_address", "uses"=>'ClientController@get_corporation_address'));
Route::any('/client/acting-relationship', array("as"=>"acting_relationship", "uses"=>'ClientController@acting_relationship'));
Route::any('/client/add-to-client', array("as"=>"add_to_client", "uses"=>'ClientController@add_to_client'));
Route::any('/client/delete-acting', array("as"=>"delete_acting", "uses"=>'ClientController@delete_acting'));
Route::any('/client/save-database-acting', array("as"=>"save_database_acting", "uses"=>'ClientController@save_database_acting'));
Route::any('/client/get-name-and-type', array("as"=>"get_name_and_type", "uses"=>'ClientController@get_name_and_type'));
Route::any('/client/delete-addtolist-client', array("as"=>"delete_addtolist_client", "uses"=>'ClientController@delete_addtolist_client'));
Route::any('/client/save-officers-into-relation', array("as"=>"save_officers_into_relation", "uses"=>'ClientController@save_officers_into_relation'));
Route::any('/client/get-officers-client', array("as"=>"get_officers_client", "uses"=>'ClientController@get_officers_client'));
Route::any('/client/client-details-by-client_id/{client_id}', array("as"=>"client_details_by_client_id", "uses"=>'ClientController@client_details_by_client_id'));
Route::any('/client/delete-files', array("as"=>"delete_files", "uses"=>'ClientController@delete_files'));
Route::any('/client/upload-other-files', array("as"=>"upload_other_files", "uses"=>'ClientController@upload_other_files'));



### Routes for Client URL's end ###




## Company House Data Start ##
Route::any('/chdata/index', array("as"=>"index", "uses"=>'ChdataController@index'));
Route::any('/chdata-details/{number}', array("as"=>"chdata_details", "uses"=>'ChdataController@chdata_details'));
Route::any('/officers-details', array("as"=>"officers_details", "uses"=>'ChdataController@officers_details'));
Route::any('/import-from-ch/{back_url}', array("as"=>"import_from_ch", "uses"=>'ChdataController@import_from_ch'));
Route::any('/company-search', array("as"=>"search_company", "uses"=>'ChdataController@search_company'));
Route::any('/company-details', array("as"=>"company_details", "uses"=>'ChdataController@company_details'));
Route::any('/import-company-details/{number}', array("as"=>"import_company_details", "uses"=>'ChdataController@import_company_details'));
Route::any('/goto-edit-client', array("as"=>"goto_edit_client", "uses"=>'ChdataController@goto_edit_client'));
Route::any('/chdata/get-shareholders-client', array("as"=>"get_shareholders_client", "uses"=>'ChdataController@get_shareholders_client'));
Route::any('/chdata/bulk-company-upload-page/{url}', array("as"=>"bulk_company_upload_page", "uses"=>'ChdataController@bulk_company_upload_page'));
Route::any('/chdata/bulk-file-upload', array("as"=>"bulk_file_upload", "uses"=>'ChdataController@bulk_file_upload'));

Route::any('/xls_to_array', array("as"=>"xls_to_array", "uses"=>'ChdataController@xls_to_array'));

Route::any('/chdata/manage-tasks', array("as"=>"manage_tasks", "uses"=>'ChdataController@manage_tasks'));
Route::post('/chdata/save-edit-status', 'ChdataController@save_edit_status');
Route::post('/chdata/send-manage-task', 'ChdataController@send_manage_task');
Route::post('/chdata/delete-manage-task', 'ChdataController@delete_manage_task');
Route::post('/chdata/change-job-status', 'ChdataController@change_job_status');
Route::post('/chdata/delete-single-task', 'ChdataController@delete_single_task');
Route::post('/chdata/send-global-task', 'ChdataController@send_global_task');
## Company House Data End ##


##Invitedclient
Route::get('/client-portal', 'InvitedclientController@Invitedclient_dashboard');
Route::get('/invitedclient-details', 'InvitedclientController@my_details');
Route::post('/invitedclient/insert-client-details', array("as"=>"insert_invitedclient_client", "uses"=>'InvitedclientController@insert_invitedclient_client'));
Route::get('/invitedclient-relationship', 'InvitedclientController@relationship');
Route::post('/relationship/insert-client-relationship', array("as"=>"insert_relationship_client", "uses"=>'InvitedclientController@insert_relationship_client'));
Route::get('/search-invited-client', 'InvitedclientController@search_invited_client');
##Invitedclient


##
Route::any('/organisation/editserv-services', array("as"=>"edit_services", "uses"=>'HomeController@edit_services'));
Route::any('/organisation/delete-editservices', array("as"=>"delete_editservices",  "uses"=>'ClientController@delete_editservices'));


##

Route::any('/noticeboard', array("as"=>"notice_board", "uses"=>'NoticeboardController@notice_board'));
Route::any('/index_template', array("as"=>"index_template", "uses"=>'NoticeboardController@index_template'));
Route::get('/edit-template/{id}', 'NoticeboardController@edit_template');
Route::get('/delete-template/{id}', 'NoticeboardController@delete_template');
Route::any('/swap-board1', 'NoticeboardController@swap_board1');
Route::get('/delete-attachment/{id}', 'NoticeboardController@delete_attachment');
Route::any('/editnotice-template', array("as"=>"show_edit_noticetemplate", "uses"=>'NoticeboardController@show_edit_noticetemplate'));
Route::any('/edit-notice-template', array("as"=>"edit_notice_template", "uses"=>'NoticeboardController@edit_notice_template'));
Route::any('/insert-noticeboard', array("as"=>"insert_noticeboard", "uses"=>'NoticeboardController@insert_noticeboard'));
Route::any('/notice-template', array("as"=>"notice_template", "uses"=>'NoticeboardController@notice_template'));
Route::any('/excel-upload', array("as"=>"excel_upload", "uses"=>'NoticeboardController@excel_upload'));
Route::any('/pdf-upload', array("as"=>"pdf_upload", "uses"=>'NoticeboardController@pdf_upload'));
Route::any('/staffmanagement', array("as"=>"staff_management", "uses"=>'StaffmanagementController@staff_management'));
Route::any('/staff-management', array("as"=>"staff_management", "uses"=>'StaffmanagementController@staff_management'));
Route::any('/staff-holidays/{type}', array("as"=>"staff_holidays", "uses"=>'StaffholidaysController@staff_holidays'));
Route::any('/time-sheet-reports/{type}', array("as"=>"time_sheet_reports", "uses"=>'TimesheetController@time_sheet_reports'));
Route::any('/cpd-and-courses/{type}', array("as"=>"cpd_and_courses", "uses"=>'CpdController@cpd_and_courses'));


Route::any('/calenderview', array("as"=>"calenderview", "uses"=>'NoticeboardController@calenderview'));
Route::any('/get-calender', array("as"=>"get_calender", "uses"=>'NoticeboardController@get_calender'));

/*=============== Staff Data Start =================*/
Route::any('/staff-details', array("as"=>"staff_data", "uses"=>'StaffdataController@staff_data'));
Route::any('/staff/archive-staff', 'StaffdataController@archive_staff');
Route::any('/staff/show-archive-staff', 'StaffdataController@show_archive_staff');
/*=============== Staff Data End =================*/

/*=============== Staff Profile Start =================*/
Route::get('/staff-profile', 'StaffprofileController@dashboard');
Route::get('/my-details/{user_id}/{type}', 'StaffprofileController@my_details');
Route::any('/delete-stafffile', 'StaffprofileController@delete_stafffile');
Route::any('/add-position-type', array("as"=>"add_position_type", "uses"=>'StaffprofileController@add_position_type'));
Route::any('/delete-position-type', array("as"=>"delete_position_type", "uses"=>'StaffprofileController@delete_position_type'));
Route::any('/add-department-type', array("as"=>"add_department_type", "uses"=>'StaffprofileController@add_department_type'));
Route::any('/delete-department-type', array("as"=>"delete_department_type", "uses"=>'StaffprofileController@delete_department_type'));
Route::post('/staff/user-details-process', 'StaffprofileController@user_details_process');
Route::get('/profile/to-list', 'StaffprofileController@to_list');
Route::post('/prof-file', 'StaffprofileController@prof_file');
Route::get('/staffholidays', 'StaffprofileController@getstaffholidays');
/*=============== Staff Profile End =================*/



/*=============== Jobs Dashboard Section Start =================*/
Route::any('/jobs-dashboard', array("as"=>"dashboard", "uses"=>'JobsController@dashboard'));
Route::any('/vat-returns/{page_open}/{staff_id}', array("as"=>"index", "uses"=>'VatReturnsController@index'));
Route::any('/vatreturn/manage-tasks', array("as"=>"manage_tasks", "uses"=>'VatReturnsController@manage_tasks'));
Route::any('/ch-annual-return/{service_id}/{page_open}/{staff_id}', 'ChAnnualReturnController@index');
Route::any('/jobs/send-manage-task', 'JobsController@send_manage_task');
Route::any('/jobs/update-staff-filter', 'JobsController@update_staff_filter');
Route::any('/jobs/delete-single-task', 'JobsController@delete_single_task');
Route::post('/jobs/change-job-status', 'JobsController@change_job_status');
Route::post('/jobs/show-jobs-notes', 'JobsController@show_jobs_notes');
Route::post('/jobs/save-jobs-notes', 'JobsController@save_jobs_notes');
Route::post('/jobs/send-global-task', 'JobsController@send_global_task');
Route::post('/jobs/save-made-up-date', 'JobsController@save_made_up_date');
Route::post('/jobs/sync-jobs-clients', 'JobsController@sync_jobs_clients');
Route::post('/jobs/save-jobs-startdate', 'JobsController@save_jobs_startdate');
Route::post('/jobs/save-start-days', 'JobsController@save_start_days');
Route::post('/jobs/save-email-client-days', 'JobsController@save_email_client_days');


/*=============== Jobs Dashboard Section End =================*/

/*=============== Staff Appraisal Section Start =================*/
Route::any('/staff-appraisal', array('as'=>'index', 'uses'=>'StaffAppraisalController@index'));
/*=============== Staff Appraisal Section End =================*/

/*==================Time Sheet Start ==============*/
Route::post('/timesheet/insert-time-sheet', array("as"=>"insert-time-sheet", "uses"=>'TimesheetController@insert_time_sheet'));
Route::post('/timesheet/timesheet-templates', array("as"=>"timesheet-templates", "uses"=>'TimesheetController@timesheet_templates'));
Route::post('/timesheet/edit-time-sheet', array("as"=>"edit-time-sheet", "uses"=>'TimesheetController@edit_time_sheet'));

Route::post('/timesheet/insertclient-time-sheet', 'TimesheetController@insertclient_time_sheet');
Route::post('/timesheet/insertstaff-time-sheet', 'TimesheetController@insertstaff_time_sheet');

Route::post('/timesheet/fetcheditclient-time-sheet', 'TimesheetController@editclient_time_sheet');
Route::post('/timesheet/editclient-time-report', 'TimesheetController@editclient_time_report');


Route::post('/timesheet/fetcheditstaff-time-sheet', 'TimesheetController@fetcheditstaff_time_sheet');
Route::post('/timesheet/editstaff-time-report', 'TimesheetController@editstaff_time_report');
Route::post('/timesheet/delete-time-sheet', 'TimesheetController@delete_time_report');
Route::any('/timesheet/client-timereport', 'TimesheetController@client_timereport');
Route::any('/timesheet/staff-timereport', 'TimesheetController@staff_timereport');
Route::any('/timesheet/staffdemo', 'TimesheetController@staffdemo');

/*==================Time Sheet End ==============*/


/*==================HMRC==============*/
Route::any('/hmrc', 'HmrcController@hmrc');
Route::any('/hmrc/authorisations', 'HmrcController@authorisations');
Route::any('/hmrc/emails', 'HmrcController@emails');
Route::any('/hmrc/tool', 'HmrcController@tool');
Route::any('/hmrc/taxrates', 'HmrcController@taxrates');

Route::get('/getresponsibleperson', 'HmrcController@getresponsibleperson');

Route::get('/hmrc/technicalupdates', 'HmrcController@technicalupdates');

/*==================HMRC ==============*/
/*================== Notes Start ==============*/
Route::any('/profile-notes', array("as"=>"index", "uses"=>'NotesController@index'));

Route::any('/staffprof-notes', 'NotesController@staffprofnotes');
Route::any('/deletestaffprof-notes', 'NotesController@deletestaffprof_notes');
Route::any('/editmodestaff-notes', 'NotesController@edit_viewstaffnotes');
Route::any('/view-staffnotes', 'NotesController@view_staffnotes');
Route::any('/editstaff-notes', 'NotesController@edit_staffnotes');


Route::any('/org-notes', 'NotesController@orgnotes');
Route::any('/view-orgnotes', 'NotesController@view_orgnotes');
Route::any('/editorg-notes', 'NotesController@edit_orgnotes');
Route::any('/deleteorg-notes', 'NotesController@deleteorg_notes');
Route::any('/editmodeorg-notes', 'NotesController@editmodeorg_notes');
/*================== Notes End ==============*/

/*================== Notes Start ==============*/
Route::any('/edit-service-id', 'ClientListAllocationController@edit_service_id');
/*================== Notes End ==============*/

/*================== Contacts Letters Emails Start ==============*/
Route::any('/contacts-letters-emails/{step_id}/{address_type}', 'ContactsLettersEmailsController@index');
Route::any('/send-letters-emails', 'ContactsLettersEmailsController@send_letteremail');
Route::any('/contacts/show-contacts-notes', 'ContactsLettersEmailsController@show_contacts_notes');
Route::any('/contacts/save-contacts-notes', 'ContactsLettersEmailsController@save_contacts_notes');
Route::any('/contacts/save-contacts-group', 'ContactsLettersEmailsController@save_contacts_group');
Route::any('/contacts/insert-contact-details', 'ContactsLettersEmailsController@insert_contact_details');
Route::any('/contacts/search-address', 'ContactsLettersEmailsController@search_address');
Route::any('/contacts/save-edit-group', 'ContactsLettersEmailsController@save_edit_group');
Route::any('/contacts/copy-to-group', 'ContactsLettersEmailsController@copy_to_group');
Route::any('/contacts/delete-group', 'ContactsLettersEmailsController@delete_group');
Route::any('/contacts/delete-from-group', 'ContactsLettersEmailsController@delete_from_group');
Route::any('/contacts/show-contact-group', 'ContactsLettersEmailsController@show_contact_group');
Route::any('/contacts/get-contact-details', 'ContactsLettersEmailsController@get_contact_details');
Route::any('/contacts/delete-contact-address', 'ContactsLettersEmailsController@delete_contact_address');

/*================== Contacts Letters Emails End ==============*/

Route::any('/knowledgebase', 'KnowledgeBaseController@index');

Route::any('/knowledgebase-notesinsert', 'KnowledgeBaseController@knowledgebase_notesinsert');
Route::any('/editmodekbase-notes', 'KnowledgeBaseController@editmodekbase_notes');
Route::any('/view-article', 'KnowledgeBaseController@view_article');

Route::any('/editsave-article', 'KnowledgeBaseController@editsave_article');

Route::any('/deletearticle-notes', 'KnowledgeBaseController@delete_article');
Route::any('/deletearticlefile', 'KnowledgeBaseController@deletearticlefile');


/*Route::any('/view-orgnotes', 'NotesController@view_orgnotes');
Route::any('/editorg-notes', 'NotesController@edit_orgnotes');
Route::any('/deleteorg-notes', 'NotesController@deleteorg_notes');
Route::any('/editmodeorg-notes', 'NotesController@editmodeorg_notes');
*/

/*================== CRM Start ==============*/
Route::any('/crm/{page_open}/{owner_id}', 'CrmController@index');
Route::any('/crm/save-leads-data', 'CrmController@save_leads_data');
Route::any('/crm/add-new-source', 'CrmController@add_new_source');
Route::any('/crm/delete-source-name', 'CrmController@delete_source_name');
Route::any('/crm/get-form-dropdown', 'CrmController@get_form_dropdown');
Route::any('/crm/save-edit-status', 'CrmController@save_edit_status');
Route::any('/crm/delete-leads-details', 'CrmController@delete_leads_details');
Route::any('/crm/sendto-another-tab', 'CrmController@sendto_another_tab');
Route::any('/crm/get-client-address', 'CrmController@get_client_address');
/*================== CRM End ==============*/
