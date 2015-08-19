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
				$client_data[$key]['client_id'] 		= $client_row['client_id'];
				if(isset($client_row['client_type']) && $client_row['client_type'] == "org"){
					$client_data[$key]['client_name'] 	= $client_row['business_name'];
					$client_data[$key]['contact_type'] 	= "Business";
					$client_data[$key]['client_url'] 	= "/client/edit-org-client/".$client_row['client_id']."/".base64_encode('org_client');
					$client_data[$key]['email'] 		= isset($client_row['corres_cont_email'])?$client_row['corres_cont_email']:"";
					$client_data[$key]['telephone'] 	= isset($client_row['corres_cont_telephone'])?$client_row['corres_cont_telephone']:"";
					$client_data[$key]['mobile'] 		= isset($client_row['corres_cont_mobile'])?$client_row['corres_cont_mobile']:"";
					$client_data[$key]['corres_address']= isset($client_row['corres_address'])?$client_row['corres_address']:"";
					$client_data[$key]['contact_name'] 	= $this->getContactNameDropdown($client_row);
					$client_data[$key]['notes']			= ContactsNote::getNotes($client_row['client_id'], 'Business');
				}else if(isset($client_row['client_type']) && $client_row['client_type'] == "ind"){
					$client_data[$key]['client_name'] 	= $client_row['client_name'];
					$client_data[$key]['contact_type'] 	= "Individual";
					$client_data[$key]['client_url'] 	= "/client/edit-ind-client/".$client_row['client_id']."/".base64_encode('ind_client');
					$client_data[$key]['email'] 		= isset($client_row['serv_email'])?$client_row['serv_email']:"";
					$client_data[$key]['telephone'] 	= isset($client_row['serv_telephone'])?$client_row['serv_telephone']:"";
					$client_data[$key]['mobile'] 		= isset($client_row['serv_mobile'])?$client_row['serv_mobile']:"";
					$client_data[$key]['corres_address']= isset($client_row['address'])?$client_row['address']:"";
					$client_data[$key]['notes']			= ContactsNote::getNotes($client_row['client_id'], 'Individual');
				}
				
			}
		}
		$data['client_details'] = $client_data;

		//print_r($data['client_details']);die;
		return View::make('contacts_letters.index', $data);
	}

	public function getContactNameDropdown($details)
	{
		$data = array();
		if(isset($details) && count($details) >0)
		{
			$i = 0;
			if(isset($details['trad_cont_name']) && $details['trad_cont_name'] != ""){
				$data[$i]['name'] = $details['trad_cont_name'];
				$i++;
			}
			if(isset($details['reg_cont_name']) && $details['reg_cont_name']!= ""){
				$data[$i]['name'] = $details['reg_cont_name'];
				$i++;
			}
			if(isset($details['corres_cont_name']) && $details['corres_cont_name']!= ""){
				$data[$i]['name'] = $details['corres_cont_name'];
				$i++;
			}
			if(isset($details['banker_cont_name']) && $details['banker_cont_name']!= ""){
				$data[$i]['name'] = $details['banker_cont_name'];
				$i++;
			}
			if(isset($details['oldacc_cont_name']) && $details['oldacc_cont_name']!= ""){
				$data[$i]['name'] = $details['oldacc_cont_name'];
				$i++;
			}
			if(isset($details['auditors_cont_name']) && $details['auditors_cont_name']!= ""){
				$data[$i]['name'] = $details['auditors_cont_name'];
				$i++;
			}
			if(isset($details['solicitors_cont_name']) && $details['solicitors_cont_name']!= ""){
				$data[$i]['name'] = $details['solicitors_cont_name'];
				$i++;
			}

			$rel_data = Common::get_relationship_client($details['client_id']);
			if(isset($rel_data) && count($rel_data) >0 ){
				foreach ($rel_data as $key => $value) {
					$data[$i]['name'] = $value['name'];
					$i++;
				}
			}
		}

		return $data;
	}

	public function show_contacts_notes()
    {
        $data = array();
        $session        = Session::get('admin_details');
        $user_id        = $session['id'];
        $groupUserId    = $session['group_users'];

        $client_id  	= Input::get("client_id");
        $contact_type   = Input::get("contact_type");

        $notes = ContactsNote::whereIn("user_id", $groupUserId)->where("client_id", "=", $client_id)->where("contact_type", "=", $contact_type)->first();

        if(isset($notes) && count($notes) >0){
            $data['notes'] = $notes['notes'];
        }
        echo json_encode($data);
    }

    public function save_contacts_notes()
    {
        $data = array();
        $session        = Session::get('admin_details');
        $user_id        = $session['id'];
        $groupUserId    = $session['group_users'];

        $contact_type   = Input::get("contact_type");
		$client_id  	= Input::get("client_id");

        $notes 		= ContactsNote::whereIn("user_id", $groupUserId)->where("client_id", "=", $client_id)->where("contact_type", "=", $contact_type)->first(); 
        $data['notes'] = Input::get("notes");
		if(isset($notes) && count($notes) >0){
            ContactsNote::where("notes_id", "=", $notes['notes_id'])->update($data);
            $last_id = $notes['notes_id'];
        }else{
            $data['client_id']  	= $client_id;
            $data['contact_type']  	= $contact_type;
            $data['user_id']    	= $user_id;
            $last_id = ContactsNote::insertGetId($data);
        }

        echo $last_id;exit;
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
