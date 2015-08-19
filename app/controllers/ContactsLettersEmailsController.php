<?php
class ContactsLettersEmailsController extends BaseController {
	
	public function index()
	{
		$client_data = array();
		$data['title'] = 'Contacts Letters & Emails';
		//$data['previous_page'] = '<a href="/jobs-dashboard">Jobs</a>';
		$data['heading'] = "CONTACTS, LETTERS & EMAILS";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		$client_details = Client::getAllClientDetails();
		if(isset($client_details) && count($client_details) >0)
		{
			foreach ($client_details as $key => $client_row) {
				$client_data[$key]['client_id'] = $client_row['client_id'];
				if(isset($client_row['client_type']) && $client_row['client_type'] == "ind"){
					$client_data[$key]['client_name'] = $client_row['client_name'];
					$client_data[$key]['contact_type'] = "Business";
					$client_data[$key]['client_url'] = "/client/edit-org-client/".$client_row['client_id']."/".base64_encode('org_client');
				}else if(isset($client_row['client_type']) && $client_row['client_type'] == "org"){
					$client_data[$key]['client_name'] = $client_row['business_name'];
					$client_data[$key]['contact_type'] = "Individual";
					$client_data[$key]['client_url'] = "/client/edit-ind-client/".$client_row['client_id']."/".base64_encode('ind_client');
				}
				
			}
		}
		$data['client_details'] = $client_data;

		//print_r($data['client_details']);die;
		return View::make('contacts_letters.index', $data);
	}

	public function send_letteremail()
	{
		$data['title'] = 'Emails/Letters';
		$data['previous_page'] = '<a href="/contacts-letters-emails">Contacts Letters & Emails</a>';
		$data['heading'] = "EMAILS/LETTERS";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}


		return View::make('contacts_letters.send_letteremail', $data);
	}

    

}
