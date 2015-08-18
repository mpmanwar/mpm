<?php
class ContactsLettersEmailsController extends BaseController {
	
	public function index(){
		$data['title'] = 'Contacts Letters & Emails';
		//$data['previous_page'] = '<a href="/jobs-dashboard">Jobs</a>';
		$data['heading'] = "CONTACTS, LETTERS & EMAILS";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		
		return View::make('contacts_letters.index', $data);
	}

    

}
