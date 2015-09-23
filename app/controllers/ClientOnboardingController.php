<?php
class ClientOnboardingController extends BaseController {

	public function index() {
		$client_data 		= array();
		$data['heading'] 	= "CLIENT - ONBOARDING";
		$data['title'] 		= "Onboarding Clients List";
		$admin_s 			= Session::get('admin_details'); // session
		$user_id 			= $admin_s['id']; //session user id
		$groupUserId 		= Common::getUserIdByGroupId($admin_s['group_id']);

		if (empty($user_id)) {
			return Redirect::to('/');
		}
		
		$client_ids = Client::where("is_deleted", "=", "N")->where("is_archive", "=", "N")->where("is_onboard", "=", "Y")->where("is_relation_add", "=", "N")->whereIn("user_id", $groupUserId)->select("client_id", "created","show_archive")->orderBy("client_id", "DESC")->get();
		//echo $this->last_query();die;
		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
			foreach ($client_ids as $client_id) {
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				$client_data[$i]['client_id'] = $client_id->client_id;
				$client_data[$i]['show_archive'] 	= $client_id->show_archive;
                $client_data[$i]['created'] 	= $client_id->created;
				$appointment_name = ClientRelationship::where('client_id', '=', $client_id->client_id)->select("appointment_with")->first();
				//echo $this->last_query();//die;
				$relation_name = StepsFieldsClient::where('client_id', '=', $appointment_name['appointment_with'])->where('field_name', '=', "name")->select("field_value")->first();

				if (isset($client_details) && count($client_details) > 0) {
					$corres_address = "";
					foreach ($client_details as $client_row) {
						//get business name start
						if (!empty($relation_name['field_value'])) {
							$client_data[$i]['staff_name'] = $relation_name['field_value'];
						}

						if (isset($client_row['field_name']) && $client_row['field_name'] == "next_acc_due"){
							$client_data[$i]['deadacc_count'] = App::make('HomeController')->getDayCount($client_row->field_value);
						}
						if (isset($client_row['field_name']) && $client_row['field_name'] == "next_ret_due"){
							$client_data[$i]['deadret_count'] = App::make('HomeController')->getDayCount($client_row->field_value);
						}
						if (isset($client_row['field_name']) && $client_row['field_name'] == "acc_ref_month"){
							$client_data[$i]['ref_month'] = App::make('ChdataController')->getMonthNameShort($client_row->field_value);
						}

						if (isset($client_row['field_name']) && $client_row['field_name'] == "business_type") 
						{
							$business_type = OrganisationType::where('organisation_id', '=', $client_row->field_value)->first();
							$client_data[$i][$client_row['field_name']] = $business_type['name'];
						} else {
							$client_data[$i][$client_row['field_name']] = $client_row->field_value;
						}

						// ############### GET CORRESPONDENSE ADDRESS START ################## //
						if (isset($client_row->field_name) && $client_row->field_name == "corres_cont_addr_line1"){
							$corres_address .= $client_row->field_value.", ";
						}
						if (isset($client_row->field_name) && $client_row->field_name == "corres_cont_addr_line2"){
							$corres_address .= $client_row->field_value.", ";
						}
						if (isset($client_row->field_name) && $client_row->field_name == "corres_cont_county"){
							$corres_address .= $client_row->field_value.", ";
						}
						// ############### GET CORRESPONDENSE ADDRESS END ################## //
                        
                        
                           
       				$sql = "SELECT ((SELECT COUNT(*) FROM client_task_dates WHERE client_id = $client_id->client_id AND user_id = $user_id AND status = 'done') /(SELECT COUNT(*) FROM client_task_dates WHERE client_id = '$client_id->client_id' AND user_id = $user_id)) * 100 AS avg FROM `client_task_dates` WHERE client_id = $client_id->client_id GROUP BY client_id";
         
			        $result = DB::select(DB::raw($sql));
				        if(isset($result[0]->avg)) {
				            $client_data[$i]['avg'] = number_format($result[0]->avg,2);  
				            if(number_format($result[0]->avg)=="0.00"){
				                $client_data[$i]['avg'] = '0';
				            }
				        } else {
				            $client_data[$i]['avg'] = '0';
				        }      
        
      				}
                    //die();                    
					$client_data[$i]['corres_address'] = substr($corres_address, 0 ,-2);

					$i++;
				}

            }
		}

		$data['client_details'] 	= $client_data;
		$data['client_fields'] 		= ClientField::where("field_type", "=", "org")->get();
		$data['staff_details'] 		= User::whereIn("user_id", $groupUserId)->where("client_id","=", 0)->select("user_id", "fname", "lname")->get();
        $data['allClients'] 		= App::make('HomeController')->get_all_clients();
    	$data['old_postion_types'] 	= Checklist::whereIn("user_id", $groupUserId)->where("status", "=", "old")->orderBy("name")->get();
		$data['new_postion_types'] 	= Checklist::whereIn("user_id", $groupUserId)->where("status", "=", "new")->orderBy("name")->get();

		//$data['task_details'] = ClientTaskDate::get_task_details();

		//$data['owner_list'] = $this->get_owner_list();
		//echo "<pre>";print_r($data['owner_list']);die;

		return View::make('home.organisation.onboard', $data);
	}

	public function insert_onboarding()
    {
        $data 		= array();
        $session 	= Session::get('admin_details');
        $user_id 	= $session['id'];
        $checklist_type = Input::get('checklist_type');
        $status 	= Input::get('status');
        $owner 		= Input::get('owner');
        $cid 		= Input::get('cid'); 
       //echo $cid;die;
        //print_r($cid); die();
        foreach($checklist_type as $key=>$value){
            
            $data['user_id']	= $user_id;
            $data['client_id']	= $cid;
            $data['check_list'] = $value;
            $data['task_owner'] = $owner[$key];
            $data['status'] 	= $status[$key];
            $data['added_date'] = date('Y-m-d H:i:s');
            $data['added_time'] = time();
            $insert_id = ClientTaskDate::insertGetId($data);
        }
        
        //print_r($cid);
        return Redirect::to('/onboard');
    }

    public function get_owner_list($client_id)
    {
        $data  = array();
        $staff_details = User::getAllStaffDetails();
        $i = 0;
        foreach ($staff_details as $key => $staff) {
            $name = "";
            if (isset($staff['fname']) && $staff['fname'] != "") {
                $name .= $staff['fname'];
            }
            if (isset($staff['lname'])) {
                $name .= " ".$staff['lname'];
            }

            $data[$i]['owner_id'] = $staff['user_id'];
            $data[$i]['contact_type'] = "staff";
            $data[$i]['name'] = ucwords(strtolower($name));
            $i++;
        }

        $client_details = Common::clientDetailsById($client_id);
        foreach ($client_details as $key => $details) {
            if (isset($details['corres_cont_name']) && $details['corres_cont_name'] != "") {
                $data[$i]['owner_id'] = $client_id;
                $data[$i]['contact_type'] = "corres";
                $data[$i]['name'] = ucwords(strtolower($details['corres_cont_name']));
            }
            $i++;
        }
        $relayth_data = Common::get_relationship_client($client_id);
        if (isset($relayth_data) && count($relayth_data) > 0) {
            foreach ($relayth_data as $key => $value) {
                $data[$i]['owner_id']       = $value['client_id'];
                $data[$i]['contact_type']   = 'org';
                $data[$i]['name']           = ucwords(strtolower($value['name']));
                $i++;
            }

        }
        return $data;
    }

    public function ajax_task_details()
    {
    	$data = array();
    	$session 		= Session::get('admin_details');
        $user_id 		= $session['id'];
        $groupUserId 	= $session['group_users'];
        $client_id 		= Input::get('client_id');
        //echo $client_id;die;
        $data['owner_list'] = $this->get_owner_list($client_id);
        //$details['task_details'] 	= ClientTaskDate::get_task_details();
        //$details['old_postion_types'] 	= Checklist::whereIn("user_id", $groupUserId)->where("status", "=", "old")->orderBy("name")->get();
		//$details['new_postion_types'] 	= Checklist::whereIn("user_id", $groupUserId)->where("status", "=", "new")->orderBy("name")->get();
        $data['check_list']  = Checklist::get_checklist();

        //print_r($data);die;
        echo View::make('onboard.task_list', $data);

	}

	public function ajax_new_task()
    {
    	$data = array();
    	$details = array();
    	$session 		= Session::get('admin_details');
        $user_id 		= $session['id'];
        $groupUserId 	= $session['group_users'];
        $client_id 		= Input::get('client_id');

        $staff_details = User::getAllStaffDetails();
        $i = 0;
		foreach ($staff_details as $key => $staff) {
            $name = "";
            if (isset($staff['fname']) && $staff['fname'] != "") {
                $name .= $staff['fname'];
            }
			if (isset($staff['lname'])) {
                $name .= " ".$staff['lname'];
            }

            $data[$i]['owner_id'] = $staff['user_id'];
            $data[$i]['contact_type'] = "staff";
            $data[$i]['name'] = ucwords(strtolower($name));
            $i++;
		}

		$client_details = Common::clientDetailsById($client_id);
		foreach ($client_details as $key => $details) {
            if (isset($details['corres_cont_name']) && $details['corres_cont_name'] != "") {
                $data[$i]['owner_id'] = $client_id;
                $data[$i]['contact_type'] = "corres";
                $data[$i]['name'] = ucwords(strtolower($details['corres_cont_name']));
            }
			$i++;
        }
        $relayth_data = Common::get_relationship_client($client_id);
        if (isset($relayth_data) && count($relayth_data) > 0) {
            foreach ($relayth_data as $key => $value) {
                $data[$i]['owner_id']       = $value['client_id'];
                $data[$i]['contact_type']   = $value['client'];
                $data[$i]['name']           = ucwords(strtolower($value['name']));
                $i++;
            }

        }

        $details['owner_list'] 		= $data;
        $details['old_postion_types'] 	= Checklist::whereIn("user_id", $groupUserId)->where("status", "=", "old")->orderBy("name")->get();
		$details['new_postion_types'] 	= Checklist::whereIn("user_id", $groupUserId)->where("status", "=", "new")->orderBy("name")->get();

        //print_r($data);die;
        echo View::make('onboard.add_new', $details);

	}

    public function delete_task_details()
    {
        $cleinttaskdate_id  = Input::get('cleinttaskdate_id');
        $ret = ClientTaskDate::where('cleinttaskdate_id', '=', $cleinttaskdate_id)->delete();
        echo $ret;
    }
    
    
    

}
