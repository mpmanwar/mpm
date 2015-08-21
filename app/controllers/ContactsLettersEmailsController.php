<?php
class ContactsLettersEmailsController extends BaseController {
	
	public function index($step_id)
	{
		$data = array();
		$org_data 		= array();
		$data['title'] 		= 'Contacts Letters & Emails';
		$data['step_id'] 	= $step_id;
		$data['heading'] 	= "CONTACTS, LETTERS & EMAILS";
		$session 		= Session::get('admin_details');
		$user_id 		= $session['id'];
		$groupUserId 	= $session['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}
		$org_count 		= 0;
		$ind_count 		= 0;
		$staff_count 	= 0;
		$other_count 	= 0;

		$org_details = Client::getAllOrgClientDetails();
		if(isset($org_details) && count($org_details) >0){
			foreach ($org_details as $key => $client_row) {
				$org_details[$key]['contact_name'] 	= $this->getContactNameDropdown($client_row);
				$org_details[$key]['notes']			= ContactsNote::getNotes($client_row['client_id'], 'org');

				$org_count++;
			}
			$data['org_details'] = $org_details;
		}

		$ind_details = Client::getAllIndClientDetails();
		if(isset($ind_details) && count($ind_details) >0){
			foreach ($ind_details as $key => $client_row) {
				$ind_details[$key]['notes']	= ContactsNote::getNotes($client_row['client_id'], 'ind');

				$ind_count++;
			}
			$data['ind_details'] = $ind_details;
		}

		

		$data['steps'] = ContactsStep::getAllSteps($org_count, $ind_count, $staff_count, $other_count);

		//print_r($data['org_details']);die;
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

	public function save_contacts_group()
	{
		$session = Session::get('admin_details');
		$user_id = $session['id'];
		$groupUserId = $session['group_users'];

		$data['user_id']  		= $user_id;
		$data['title'] 			= strtoupper(Input::get("group_name"));
		$data['short_code'] 	= strtolower(str_replace(" ", "_", $data['title']));
		$data['status']  		= "S";
		$data['step_type']  	= "new";
		$data['parent_step_id'] = Input::get("step_id");

		$last_id = ContactsStep::insertGetId($data);
		echo $last_id;exit;
	}

    

}
