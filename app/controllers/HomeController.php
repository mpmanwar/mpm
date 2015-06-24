<?php

class HomeController extends BaseController {

	public function db_connect() {
		if (DB::connection()->getDatabaseName()) {
			echo "Conncted sucessfully to database : " . DB::connection()->getDatabaseName();
			die;
		}
	}

	public function dashboard() {
		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
		//print_r($admin_s);die;
		if (!isset($user_id) && $user_id == "") {
			return Redirect::to('/');
		}

		$data['heading'] = "DASHBOARD";
		$data['title'] = "Dashboard";
		return View::make('home.dashboard', $data);
	}

	public function individual_clients() {
		$client_data 		= array();
		$data['heading'] 	= "CLIENT LIST - INDIVIDUALS";
		$data['title'] 		= "Individual Clients List";
		$admin_s 			= Session::get('admin_details');
		$user_id 			= $admin_s['id'];
		$groupUserId 		= Common::getUserIdByGroupId($admin_s['group_id']);

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		$client_ids = Client::where("type", "=", "ind")->where("is_archive", "=", "N")->whereIn("user_id", $groupUserId)->select("client_id", "show_archive")->get();
		//echo $this->last_query();die;
		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
			foreach ($client_ids as $client_id) {
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				
                $client_data[$i]['client_id'] 		= $client_id->client_id;
                $client_data[$i]['show_archive'] 	= $client_id->show_archive;

				$appointment_name = ClientRelationship::where('client_id', '=', $client_id->client_id)->select("appointment_with")->first();
				//echo $this->last_query();//die;
				$relation_name = StepsFieldsClient::where('client_id', '=', $appointment_name['appointment_with'])->where('field_name', '=', "business_name")->select("field_value")->first();

				if (isset($client_details) && count($client_details) > 0) {
					$address = "";
					foreach ($client_details as $client_row) {
						//get staff name start
						if (!empty($client_row['field_name']) && $client_row['field_name'] == "resp_staff") {
							$staff_name = User::where('user_id', '=', $client_row->field_value)->select("fname", "lname")->first();
							//echo $this->last_query();die;
							$client_data[$i]['staff_name'] = strtoupper(substr($staff_name['fname'], 0, 1)) . " " . strtoupper(substr($staff_name['lname'], 0, 1));
						}
						//get staff name end

						//get business name start
						if (!empty($relation_name['field_value'])) {
							$client_data[$i]['business_name'] = $relation_name['field_value'];
						}
						//get business name end


						//get residencial address
						if (isset($client_row['field_name']) && $client_row['field_name'] == "res_addr_line1") {
							$address .= $client_row->field_value.", ";
						}	
						if (isset($client_row['field_name']) && $client_row['field_name'] == "res_addr_line2") {
							$address .= $client_row->field_value.", ";
						}
						if (isset($client_row['field_name']) && $client_row['field_name'] == "res_city") {
							$address .= $client_row->field_value.", ";
						}	
						if (isset($client_row['field_name']) && $client_row['field_name'] == "res_county") {
							$address .= $client_row->field_value.", ";
						}	
						if (isset($client_row['field_name']) && $client_row['field_name'] == "res_postcode") {
							$address .= $client_row->field_value.", ";
						}			


						if (isset($client_row['field_name']) && $client_row['field_name'] == "business_type") {
							$business_type = OrganisationType::where('organisation_id', '=', $client_row->field_value)->first();
							$client_data[$i][$client_row['field_name']] = $business_type['name'];
						} else {
							$client_data[$i][$client_row['field_name']] = $client_row->field_value;
						}

					}

					$client_data[$i]['address'] = substr($address, 0, -2);
					$i++;
				}

				

			}
		}
		$data['client_details'] = $client_data;

		$data['client_fields'] = ClientField::where("field_type", "=", "ind")->get();
//die;
		//print_r($data['client_details']);die;
		return View::make('home.individual.individual_client', $data);
	}

	public function organisation_clients() {
		$client_data 		= array();
		$data['heading'] 	= "CLIENTS LIST - ORGANISATIONS";
		$data['title'] 		= "Organisation Clients List";
		$admin_s 			= Session::get('admin_details'); // session
		$user_id 			= $admin_s['id']; //session user id
		$groupUserId 		= Common::getUserIdByGroupId($admin_s['group_id']);

		if (empty($user_id)) {
			return Redirect::to('/');
		}
		
		$client_ids = Client::where("type", "=", "org")->where("is_archive", "=", "N")->whereIn("user_id", $groupUserId)->select("client_id", "show_archive")->orderBy("client_id", "DESC")->get();
		//echo $this->last_query();die;
		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
			foreach ($client_ids as $client_id) {
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				$client_data[$i]['client_id'] = $client_id->client_id;
				$client_data[$i]['show_archive'] 	= $client_id->show_archive;

				$appointment_name = ClientRelationship::where('client_id', '=', $client_id->client_id)->select("appointment_with")->first();
				//echo $this->last_query();//die;
				$relation_name = StepsFieldsClient::where('client_id', '=', $appointment_name['appointment_with'])->where('field_name', '=', "name")->select("field_value")->first();

				if (isset($client_details) && count($client_details) > 0) {
					foreach ($client_details as $client_row) {
						//get business name start
						if (!empty($relation_name['field_value'])) {
							$client_data[$i]['staff_name'] = $relation_name['field_value'];
						}

						if (isset($client_row['field_name']) && $client_row['field_name'] == "next_acc_due"){
							$client_data[$i]['deadacc_count'] = $this->getDayCount($client_row->field_value);
						}
						if (isset($client_row['field_name']) && $client_row['field_name'] == "next_ret_due"){
							$client_data[$i]['deadret_count'] = $this->getDayCount($client_row->field_value);
						}

						if (isset($client_row['field_name']) && $client_row['field_name'] == "business_type") 
						{
							$business_type = OrganisationType::where('organisation_id', '=', $client_row->field_value)->first();
							$client_data[$i][$client_row['field_name']] = $business_type['name'];
						} else {
							$client_data[$i][$client_row['field_name']] = $client_row->field_value;
						}

					}

					$i++;
				}

				//echo $this->last_query();die;
			}
		}
		$data['client_details'] = $client_data;

		$data['client_fields'] = ClientField::where("field_type", "=", "org")->get();

		//print_r($data['client_details']);die;

		return View::make('home.organisation.organisation_client', $data);
	}

	function getDayCount($from)
	{
		//$from = str_replace("/", "-", $from);
		$arr = explode('-', $from);
		$date1 = $arr[2].'-'.$arr[1].'-'.$arr[0];
		$date2 = date("Y-m-d");
		//echo $date2;die;

		$diff = abs(strtotime($date2) - strtotime($date1));
		$days = round($diff/86400);
		return $days;
	}

	public function add_individual_client() {

		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		$data['heading'] 	= "ADD CLIENT";
		$data['title'] 		= "Add Client";
		$data['rel_types'] 	= RelationshipType::where("show_status", "=", "individual")->orderBy("relation_type_id")->get();
		$data['marital_status'] = MaritalStatus::orderBy("marital_status_id")->get();
		$data['titles'] 		= Title::orderBy("title_id")->get();
		$data['tax_office'] 	= TaxOfficeAddress::select("parent_id", "office_id", "office_name")->get();
		$data['tax_office_by_id'] 	= TaxOfficeAddress::where("office_id", "=", 1)->first();
		$data['steps'] 				= Step::where("status", "=", "old")->orderBy("step_id")->get();
		$data['substep'] 			= Step::whereIn("user_id", $groupUserId)->where("client_type", "=", "ind")->where("parent_id", "=", 1)->orderBy("step_id")->get();//echo $this->last_query();
		$data['responsible_staff'] 	= User::whereIn("user_id", $groupUserId)->select('fname', 'lname', 'user_id')->get();
		$data['countries'] 			= Country::orderBy('country_name')->get();
		$data['field_types'] 		= FieldType::get();
		$data['cont_address'] 		= $this->get_contact_address();
        
        //print_r($data['cont_address']);die;

		$steps_fields_users = StepsFieldsAddedUser::whereIn("user_id", $groupUserId)->where("substep_id", "=", '0')->where("client_type", "=", "ind")->get();
		foreach ($steps_fields_users as $key => $steps_fields_row) {
			$steps_fields_users[$key]->select_option = explode(",", $steps_fields_row->select_option);
		}
		$data['steps_fields_users'] = $steps_fields_users;

		//###########User added section and sub section start##########//
		$steps = array();
		$subsections = Step::whereIn("user_id", $groupUserId)->where("status", "=", "new")->get();
		//echo $this->last_query();die;
		foreach ($subsections as $key => $val) {
			if (isset($val->status) && $val->status == "new") {
				$steps[$key]['step_id'] 	= $val->step_id;
				$steps[$key]['parent_id'] 	= $val->parent_id;
				$steps[$key]['short_code'] 	= $val->short_code;
				$steps[$key]['title'] 		= $val->title;
				$steps[$key]['status'] 		= $val->status;
			}

		}
		$data['subsections'] = $this->buildtree($steps, "ind");
		//###########User added section and sub section start##########//

		//print_r($data['subsections']);die;
		//echo $this->last_query();die;
		return View::make('home.individual.add_individual_client', $data);
	}

	public function add_organisation_client() {
	   
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		$data['heading'] 		= "ADD CLIENT";
		$data['title'] 			= "Add Client";

		/*$first = DB::table('organisation_types')->where("client_type", "=", "all")->where("status", "=", "old")->where("user_id", "=", 0);
		$data['org_types'] = OrganisationType::where("client_type", "=", "org")->where("status", "=", "new")->whereIn("user_id", $groupUserId)->union($first)->orderBy("name")->get();*/
		$data['old_org_types'] = OrganisationType::where("client_type", "=", "all")->orderBy("name")->get();
		$data['new_org_types'] = OrganisationType::where("client_type", "=", "org")->whereIn("user_id", $groupUserId)->where("status", "=", "new")->orderBy("name")->get();


		$data['rel_types'] 		= RelationshipType::orderBy("relation_type_id")->get();
		$data['steps'] 			= Step::where("status", "=", "old")->orderBy("step_id")->get();
		$data['substep'] 		= Step::where("client_type", "=", "org")->where("parent_id", "=", 1)->whereIn("user_id", $groupUserId)->orderBy("step_id")->get();
		$data['staff_details'] 	= User::whereIn("user_id", $groupUserId)->select("user_id", "fname", "lname")->get();
		$data['tax_office'] 	= TaxOfficeAddress::select("parent_id", "office_id", "office_name")->get();

		/*$first_serv = DB::table('services')->where("status", "=", "old")->where("user_id", "=", 0);
		$data['services'] 		= Service::where("status", "=", "new")->whereIn("user_id", $groupUserId)->union($first_serv)->orderBy("service_id")->get();*/
		$data['old_services'] 	= Service::where("status", "=", "old")->orderBy("service_name")->get();
		$data['new_services'] 	= Service::where("status", "=", "new")->whereIn("user_id", $groupUserId)->orderBy("service_name")->get();

		$data['countries'] 		= Country::orderBy('country_name')->get();
		$data['field_types'] 	= FieldType::get();

		/*$first_vat = DB::table('vat_schemes')->where("status", "=", "old")->where("user_id", "=", 0);
		$data['vat_schemes'] 	= VatScheme::where("status", "=", "new")->whereIn("user_id", $groupUserId)->union($first_vat)->orderBy("vat_scheme_id")->get();*/
		$data['old_vat_schemes'] = VatScheme::where("status", "=", "old")->orderBy("vat_scheme_name")->get();
		$data['new_vat_schemes'] = VatScheme::where("status", "=", "new")->whereIn("user_id", $groupUserId)->orderBy("vat_scheme_name")->get();
		//echo $this->last_query();die;
		$data['cont_address'] 	= $this->get_orgcontact_address();
		//$data['cont_address'] 	 = $this->getAllOrgContactAddress();
        
        //print_r($data['cont_address'] );die();
        
		$data['reg_address'] 	= RegisteredAddress::orderBy("reg_id")->get();

		$steps_fields_users = StepsFieldsAddedUser::whereIn("user_id", $groupUserId)->where("substep_id", "=", '0')->where("client_type", "=", "org")->get();
		foreach ($steps_fields_users as $key => $steps_fields_row) {
			$steps_fields_users[$key]->select_option = explode(",", $steps_fields_row->select_option);
		}
		$data['steps_fields_users'] = $steps_fields_users;

		//###########User added section and sub section start##########//
		$steps = array();
		$subsections = Step::whereIn("user_id", $groupUserId)->where("status", "=", "new")->get();
		foreach ($subsections as $key => $val) {
			if (isset($val->status) && $val->status == "new") {
				$steps[$key]['step_id'] 	= $val->step_id;
				$steps[$key]['parent_id'] 	= $val->parent_id;
				$steps[$key]['short_code'] 	= $val->short_code;
				$steps[$key]['title'] 		= $val->title;
				$steps[$key]['status'] 		= $val->status;
			}

		}
		$data['subsections'] = $this->buildtree($steps, "org");
		//###########User added section and sub section start##########//
		$data['months'] =	array("01"=>"JAN", "02"=>"FEB", "03"=>"MAR", "04"=>"APR", "05"=>"MAY", "06"=>"JUN","07"=>"JUL", "08"=>"AUG", "09"=>"SEPT", "10"=>"OCT", "11"=>"NOV", "12"=>"DEC");

		return View::make('home.organisation.add_organisation_client', $data);

	}

	public function buildtree($steps, $client_type) {
		$branch = array();
		foreach ($steps as $element) {
			$children = StepsFieldsAddedUser::where("substep_id", "=", $element['step_id'])->where("client_type", "=", $client_type)->get();
			foreach ($children as $key => $steps_fields_row) {
				$children[$key]->select_option = explode(",", $steps_fields_row->select_option);
			}
			if (isset($children) && count($children) > 0) {
				foreach ($children as $key => $row) {
					$element['children'][$key]['field_id'] 		= $row->field_id;
					$element['children'][$key]['user_id'] 		= $row->user_id;
					$element['children'][$key]['step_id'] 		= $row->step_id;
					$element['children'][$key]['field_type'] 	= $row->field_type;
					$element['children'][$key]['field_name'] 	= $row->field_name;
					$element['children'][$key]['field_value'] 	= $row->field_value;
					$element['children'][$key]['select_option'] = $row->select_option;
					$element['children'][$key]['client_type'] 	= $row->client_type;
				}
				$branch[] = $element;
			}

		}
		return $branch;
	}

	public function get_contact_address() {
		$client_data = array();
		
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		$client_ids = Client::where('type', '=', "ind")->whereIn('user_id', $groupUserId)->select("client_id")->get();
 		//$client_array = Client::where("type", "=", "ind")->where('user_id', '=', $groupUserId)->select("client_id")->get();
		//echo $this->last_query();//die;
		$i = 0;
		if (isset($client_ids)) {
			foreach($client_ids as $key=>$client_id) {
			$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
             
             	$client_data[$i]['client_id'] = $client_id->client_id;
				//echo $this->last_query();//die;

				if (isset($client_details) && count($client_details) > 0) {
				    foreach ($client_details as $client_row) {
						if(isset($client_row['field_name']) && $client_row['field_name'] == "res_addr_line1"){
					       $client_data[$i]['res_addr_line1'] = $client_row['field_value'];
                        }
                        if(isset($client_row['field_name']) && $client_row['field_name'] == "serv_addr_line1"){
					       $client_data[$i]['serv_addr_line1'] = $client_row['field_value'];
                        }
                       
					}
				}
                $i++;
			}
		}
		//echo "<pre>";print_r($client_data);die;
		return $client_data;
	}
    
    public function get_orgcontact_address() {
		$client_data = array();

		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
        $groupUserId = $admin_s['group_users'];

		$client_ids = Client::where('type', '=', "org")->whereIn('user_id', $groupUserId)->select("client_id")->get();

		//echo $this->last_query();die;
		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
		  	foreach ($client_ids as $client_id) {
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();

             	$client_data[$i]['client_id'] = $client_id->client_id;
				//echo $this->last_query();die;

				if (isset($client_details) && count($client_details) > 0) {
				   	foreach ($client_details as $client_row) {
					   
						if (isset($client_row['field_name']) && ($client_row['field_name'] == "trad_cont_addr_line1" )){
					
                            $client_data[$i]['trad_cont_addr_line1'] = $client_row['field_value'];
                        }
                        
                       	if (isset($client_row['field_name']) && ($client_row['field_name'] == "reg_cont_addr_line1" )){
					
                            $client_data[$i]['reg_cont_addr_line1'] = $client_row['field_value'];
                        }
                        
                        if (isset($client_row['field_name']) && ($client_row['field_name'] == "corres_cont_addr_line1" )){
					
                            $client_data[$i]['corres_cont_addr_line1'] = $client_row['field_value'];
                        }
                        
                        if (isset($client_row['field_name']) && ($client_row['field_name'] == "banker_cont_addr_line1" )){
					
                            $client_data[$i]['banker_cont_addr_line1'] = $client_row['field_value'];
                        }
                        
                        if (isset($client_row['field_name']) && ($client_row['field_name'] == "oldacc_cont_addr_line1" )){
					
                            $client_data[$i]['oldacc_cont_addr_line1'] = $client_row['field_value'];
                        }
                        
                        if (isset($client_row['field_name']) && ($client_row['field_name'] == "auditors_cont_addr_line1" )){
					
                            $client_data[$i]['auditors_cont_addr_line1'] = $client_row['field_value'];
                        }
                        
                        if (isset($client_row['field_name']) && ($client_row['field_name'] == "solicitors_cont_addr_line1" )){
					
                            $client_data[$i]['solicitors_cont_addr_line1'] = $client_row['field_value'];
                        }
                        
                        
					}

					
                           //res_addr_line1
				}
                $i++;
			}
		}
		//echo "<pre>";print_r($client_data);die;
		return $client_data;
	}
    public function getAllOrgContactAddress() {
		$client_data = array();

		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
        $groupUserId = $admin_s['group_users'];

		$client_ids = Client::where('type', '=', "org")->whereIn('user_id', $groupUserId)->select("client_id")->get();

		//echo $this->last_query();die;
		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
		  	foreach ($client_ids as $client_id) {
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();

             	$client_data[$i]['client_id'] = $client_id->client_id;
				//echo $this->last_query();die;

				if (isset($client_details) && count($client_details) > 0) {
				   	foreach ($client_details as $client_row) {
					   
						if (isset($client_row['field_name']) && ($client_row['field_name'] == "trad_cont_addr_line1" )){
					
                            $client_data[$i]['trad_cont_addr_line1'] = $client_row['field_value'];
                        }
                        
                       	if (isset($client_row['field_name']) && ($client_row['field_name'] == "reg_cont_addr_line1" )){
					
                            $client_data[$i]['reg_cont_addr_line1'] = $client_row['field_value'];
                        }
                        
                        if (isset($client_row['field_name']) && ($client_row['field_name'] == "corres_cont_addr_line1" )){
					
                            $client_data[$i]['corres_cont_addr_line1'] = $client_row['field_value'];
                        }
                        
                        if (isset($client_row['field_name']) && ($client_row['field_name'] == "banker_cont_addr_line1" )){
					
                            $client_data[$i]['banker_cont_addr_line1'] = $client_row['field_value'];
                        }
                        
                        if (isset($client_row['field_name']) && ($client_row['field_name'] == "oldacc_cont_addr_line1" )){
					
                            $client_data[$i]['oldacc_cont_addr_line1'] = $client_row['field_value'];
                        }
                        
                        if (isset($client_row['field_name']) && ($client_row['field_name'] == "auditors_cont_addr_line1" )){
					
                            $client_data[$i]['auditors_cont_addr_line1'] = $client_row['field_value'];
                        }
                        
                        if (isset($client_row['field_name']) && ($client_row['field_name'] == "solicitors_cont_addr_line1" )){
					
                            $client_data[$i]['solicitors_cont_addr_line1'] = $client_row['field_value'];
                        }
                        
                        
					}

					
                           //res_addr_line1
				}
                $i++;
			}
		}



		//echo "<pre>";print_r($client_data);die;
		return $client_data;
	}

	public function insert_individual_client() {
		$postData = Input::all();
		$arrData = array();

		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];
		
		if(isset($postData['client_id']) && $postData['client_id'] == "new"){
			$client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'ind'));
		}else{
			$client_id = $postData['client_id'];
			StepsFieldsClient::where("client_id", "=", $client_id)->delete();
		}
		
//echo $this->last_query();die;
//################ GENERAL SECTION START #################//
		$step_id = 1;
		if (!empty($postData['client_code'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'client_code', $postData['client_code']);
		}

		$client_name = "";
		if (!empty($postData['title'])) {
			$client_name.=$postData['title']." ";
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'title', $postData['title']);
		}
                
		if (!empty($postData['fname'])) {
			$client_name.=$postData['fname']." ";
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'fname', $postData['fname']);
		}
        
		if (!empty($postData['mname'])) {
			$client_name.=$postData['mname']." ";
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'mname', $postData['mname']);
		}
        
		if (!empty($postData['lname'])) {
			$client_name.=$postData['lname'];
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'lname', $postData['lname']);
		}
        
		$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'client_name', trim($client_name));

		if (!empty($postData['gender'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'gender', $postData['gender']);
		}
		if (!empty($postData['dob'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'dob', $postData['dob']);
		}
		if (!empty($postData['marital_status'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'marital_status', $postData['marital_status']);
		}
		if (!empty($postData['spouse_dob'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'spouse_dob', $postData['spouse_dob']);
		}
		if (!empty($postData['nationality'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'nationality', $postData['nationality']);
		}
		if (!empty($postData['occupation'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'occupation', $postData['occupation']);
		}
//################ GENERAL SECTION END #################//

//################ TAX SECTION START #################//
		$step_id = 2;
		if (!empty($postData['ni_number'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'ni_number', $postData['ni_number']);
		}
		if (!empty($postData['tax_reference'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_reference', $postData['tax_reference']);
		}
		if (!empty($postData['other_office_id'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_office_id', $postData['other_office_id']);
		} else {
			if (!empty($postData['tax_office_id'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_office_id', $postData['tax_office_id']);
			}
		}
		if (!empty($postData['tax_address'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_address', $postData['tax_address']);
		}
		if (!empty($postData['tax_zipcode'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_zipcode', $postData['tax_zipcode']);
		}
		if (!empty($postData['tax_telephone'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_telephone', $postData['tax_telephone']);
		}
		if (!empty($postData['tax_region'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_region', $postData['tax_region']);
		}
//################ TAX INFORMATION SECTION END #################//

//################ CONTACT INFORMATION SECTION START #################//
		$step_id = 3;
		if (!empty($postData['res_addr_line1'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'res_addr_line1', $postData['res_addr_line1']);
		}
		if (!empty($postData['res_addr_line2'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'res_addr_line2', $postData['res_addr_line2']);
		}
		if (!empty($postData['res_city'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'res_city', $postData['res_city']);
		}
		if (!empty($postData['res_county'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'res_county', $postData['res_county']);
		}
		if (!empty($postData['res_postcode'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'res_postcode', $postData['res_postcode']);
		}
		if (!empty($postData['res_country'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'res_country', $postData['res_country']);
		}
		if (!empty($postData['serv_addr_line1'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'serv_addr_line1', $postData['serv_addr_line1']);
		}
		if (!empty($postData['serv_addr_line2'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'serv_addr_line2', $postData['serv_addr_line2']);
		}
		if (!empty($postData['serv_city'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'serv_city', $postData['serv_city']);
		}
		if (!empty($postData['serv_county'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'serv_county', $postData['serv_county']);
		}

		if (!empty($postData['serv_postcode'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'serv_postcode', $postData['serv_postcode']);
		}
		if (!empty($postData['serv_country'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'serv_country', $postData['serv_country']);
		}
		if (!empty($postData['serv_tele_code'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'serv_tele_code', $postData['serv_tele_code']);
		}
		if (!empty($postData['serv_telephone'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'serv_telephone', $postData['serv_telephone']);
		}
		if (!empty($postData['serv_mobile_code'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'serv_mobile_code', $postData['serv_mobile_code']);

		}
		if (!empty($postData['serv_mobile'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'serv_mobile', $postData['serv_mobile']);

		}
		if (!empty($postData['serv_email'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'serv_email', $postData['serv_email']);
		}
		if (!empty($postData['serv_website'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'serv_website', $postData['serv_website']);
		}
		if (!empty($postData['serv_skype'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'serv_skype', $postData['serv_skype']);
		}
//################ CONTACT INFORMATION SECTION END #################//

//############# RELATIONSHIP START ###################//
		if (!empty($postData['app_hidd_array'])) {
			$relData = array();
			$app_hidd_array = explode(",", $postData['app_hidd_array']); //print_r($app_hidd_array);
			foreach ($app_hidd_array as $row) {
				$rel_row = explode("mpm", $row);
				$app_date = explode("-", $rel_row['1']);
				$relData[] = array(
					'client_id' => $client_id,
					'appointment_with' => $rel_row['0'],
					'appointment_date' => $app_date[2]."-".$app_date[1]."-".$app_date[0],
					'relationship_type_id' => $rel_row['2'],
				);
			}
			ClientRelationship::insert($relData);

		}
//#############RELATIONSHIP END ###################//

//################ OTHERS SECTION END #################//
		$step_id = 5;
		if (!empty($postData['aml_checks'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'aml_checks', $postData['aml_checks']);
		}
		if (!empty($postData['acting'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'acting', $postData['acting']);
		}
		if (!empty($postData['tax_ret_req'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_ret_req', $postData['tax_ret_req']);
		}
		if (!empty($postData['resp_staff'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'resp_staff', $postData['resp_staff']);
		}

		//################## USER ADDED FIELD START ###############//
		$field_added = StepsFieldsAddedUser::where("client_type", "=", "ind")->whereIn("user_id", $groupUserId)->get();
		//echo $this->last_query();die;
		if(isset($field_added) && count($field_added) > 0){
			foreach ($field_added as $key => $value) {
				$field_name = strtolower($value->field_name);
				if (isset($postData[$field_name]) && $postData[$field_name] != "") {
					$arrData[] = $this->save_client($user_id, $client_id, $value->step_id, $field_name, $postData[$field_name]);
				}
			}
		}
		//################## USER ADDED FIELD END ###############//

		//print_r($arrData);die;
		StepsFieldsClient::insert($arrData);
		return Redirect::to('/individual-clients');

	}

	public function get_office_address() {
		$tax_office_address = array();
		$office_id = Input::get("office_id");
		if (Request::ajax()) {
			$tax_office_address = TaxOfficeAddress::where("office_id", "=", $office_id)->first();
			//echo $this->last_query();die;
		}

		echo json_encode($tax_office_address);
		exit();
	}

	function save_relationship() {
		$rel_types = array();
		$rel_type_id 	= Input::get("rel_type_id");
		$rel_client_id 	= Input::get("rel_client_id");

		if (Request::ajax()) {
			$rel_types = RelationshipType::where("relation_type_id", "=", $rel_type_id)->first();
			//echo $this->last_query();die;
		}

		//$rel_types['appointment_date'] = date("m/d/Y", strtotime(Input::get('app_date')));
		$rel_types['appointment_date'] = Input::get('app_date');

		//######## get client type #########//
		$client_data = Client::where("client_id", "=", $rel_client_id)->first();
		if(isset($client_data) && count($client_data) >0){
			if($client_data['type'] == "ind"){
				$rel_types['link'] = "/client/edit-ind-client/".$rel_client_id;
			}
			else if($client_data['type'] == "org"){
				$rel_types['link'] = "/client/edit-org-client/".$rel_client_id;
			}else{
				$rel_types['link'] = "";
			}
			
		}
		//######## get client type #########//

		echo json_encode($rel_types);
		exit();

	}

	public function save_userdefined_field() {
		$data = array();

		$admin_s = Session::get('admin_details'); // session
		$back_url = Input::get("back_url");

		$data['user_id'] 		= $admin_s['id'];
		$data['step_id'] 		= Input::get("step_id");
		$data['substep_id'] 	= Input::get("substep_id");
		$data['field_name'] 	= str_replace(" ", "_", Input::get("field_name"));
		$data['field_type'] 	= Input::get("field_type");
		$data['client_type'] 	= Input::get("client_type");
		$data['select_option'] 	= Input::get("select_option");

		$field_id = StepsFieldsAddedUser::insertGetId($data);
		if ($back_url == "add_ind") {
			return Redirect::to('/individual/add-client');
		}else if ($back_url == "edit_ind") {
			return Redirect::to('/client/edit-ind-client/'.Input::get("client_id"));
		}else if ($back_url == "add_org") {
			return Redirect::to('/organisation/add-client');
		} else if ($back_url == "edit_org") {
			return Redirect::to('/client/edit-org-client/'.Input::get("client_id"));
		}

	}

	function save_services() {
		$rel_types = array();
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		
		$service_id = Input::get("service_id");
		$staff_id = Input::get("staff_id");

		if (Request::ajax()) {
			$temp_types = Service::where("service_id", "=", $service_id)->first();
			$user = User::where("user_id", "=", $staff_id)->select("fname", "lname")->first();
			//echo $this->last_query();die;
		}
		$rel_types['service'] = $temp_types['service_name'];
		$rel_types['staff'] = $user['fname'] . " " . $user['lname'];

		echo json_encode($rel_types);
		exit();
	}

	public function search_client() {
		$client_details = array();
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		
		$search_value = Input::get("search_value");
		$client_type = Input::get("client_type");
		$client_ids = Client::where("type", "=", $client_type)->where('user_id', '=', $user_id)->select("client_id")->get();
		if ($client_type == "org") {
			$field_name = 'business_name';
		} else {
			$field_name = 'fname';
		}
		$i = 0;
		foreach ($client_ids as $client_id) {
			$client_name = StepsFieldsClient::where("field_value", "like", '%' . $search_value . '%')->where('field_name', '=', $field_name)->where('client_id', '=', $client_id->client_id)->select("field_value")->first();
			if (isset($client_name) && count($client_name) > 0) {
				$client_details[$i]['client_id'] = $client_id->client_id;
				$client_details[$i]['client_name'] = $client_name['field_value'];
				$i++;
			}

			//echo $this->last_query();
		}

		echo json_encode($client_details);
		exit();
	}

	public function search_all_client() {
		$client_details = array();
		$clients = array();

		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];
		
		$search_value = Input::get("search_value");
		$client_ids = Client::whereIn('user_id', $groupUserId)->where("type", "!=", "chd")->select("client_id")->get();
		//echo $this->last_query();die;
		if(isset($client_ids) && count($client_ids) >0 ){
			foreach($client_ids as $key=>$client_id){
				$clients[$key]['client_id']	= $client_id->client_id;
			}
		}
		//echo $this->last_query();die;
		$org_client = $this->getOrgClient($clients, $search_value);
		$ind_client = $this->getIndClient($clients, $search_value);
		//$chd_client = $this->getChdClient($clients, $search_value);
		$client_details = array_merge($org_client, $ind_client);//print_r($client_details);die;
		//$client_details = $this->getUniqueArray($client_details);

		echo json_encode($client_details);
		exit();
	}

	function getUniqueArray($data)
	{
		$data1 = array();
	    $data1 = $data;
	    for($q=0;$q<count($data);$q++)
	    {
            for($p=0;$p<count($data1);$p++)
            {
                if ($data[$q]["client_name"] != $data1[$p]["client_name"])
                {
                        $data1[$p]["client_id"] 	= $data[$q]["client_id"];
                        $data1[$p]["client_name"] 	= $data[$q]["client_name"];
                }
            }
	    }
	    $data1 = array_values(array_map("unserialize", array_unique(array_map("serialize", $data1))));
	    return $data1;
	}

	function getOrgClient($client_ids, $search_value)
	{
		$clients = array();
		$client_name = StepsFieldsClient::where("field_value", "like", '%' . $search_value . '%')->where('field_name', '=', 'business_name')->whereIn('client_id', $client_ids)->select("field_value", "client_id")->get();

		if(isset($client_name) && count($client_name) >0 ){
			foreach($client_name as $key=>$name){
				$clients[$key]['client_id']		= $name->client_id;
				$clients[$key]['client_name']	= $name->field_value;
			}
		}
		//echo $this->last_query();die;
		return $clients;
	}
	function getIndClient($client_ids, $search_value)
	{
		$clients = array();
		$client_name = StepsFieldsClient::where("field_value", "like", '%' . $search_value . '%')->where('field_name', '=', 'client_name')->whereIn('client_id', $client_ids)->select("field_value", "client_id")->get();

		if(isset($client_name) && count($client_name) >0 ){
			foreach($client_name as $key=>$name){
				$clients[$key]['client_id']		= $name->client_id;
				$clients[$key]['client_name']	= $name->field_value;
			}
		}
		//echo $this->last_query();die;
		return $clients;
	}

	/*public function search_all_client() {
		$client_details = array();
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];
		
		$search_value = Input::get("search_value");
		$client_ids = Client::whereIn('user_id', $groupUserId)->select("client_id", "type")->get();

		$i = 0;
		foreach ($client_ids as $client_id) {
			if ($client_id->type == "org") {
				$client_name = StepsFieldsClient::where("field_value", "like", '%' . $search_value . '%')->where('field_name', '=', 'business_name')->where('client_id', '=', $client_id->client_id)->select("field_value")->first();
				//$field_name = 'business_name';
			} else {
				//$field_name = 'fname';
				$client_name = StepsFieldsClient::where("field_value", "like", '%' . $search_value . '%')->where('field_name', '=', 'fname')->orwhere('field_name', '=', 'mname')->orwhere('field_name', '=', 'lname')->where('client_id', '=', $client_id->client_id)->select("field_value")->get();
			}
			
			//echo $this->last_query();die;
			if (isset($client_name) && count($client_name) > 0) {
				$client_details[$i]['client_id'] = $client_id->client_id;
				if ($client_id->type == "org") {die("lll");
					$client_details[$i]['client_name'] = $client_name['field_value'];
				}else{
					$name = "";
					foreach($client_name as $value){
						$name.=$value->field_value." ";
					}
					$client_details[$i]['client_name'] = trim($name);
				}
				
				$i++;
			}

			//echo $this->last_query();
		}

		echo json_encode($client_details);
		exit();
	}*/

	public function insert_organisation_client() {
	   
       
		$postData = Input::all();
		$data = array();
		$arrData = array();
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if(isset($postData['client_id']) && $postData['client_id'] == "new"){
			$client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'org'));
		}else{
			$client_id = $postData['client_id'];
			StepsFieldsClient::where("client_id", "=", $client_id)->delete();
			//ClientRelationship::where("client_id", "=", $client_id)->delete();
		}

//#############BUSINESS INFORMATION START###################//
		$step_id = 1;
		if (!empty($postData['client_code'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'client_code', $postData['client_code']);
		}
		if (!empty($postData['business_type'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'business_type', $postData['business_type']);
		}
		if (!empty($postData['business_name'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'business_name', $postData['business_name']);
		}
		if (!empty($postData['registration_number'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'registration_number', $postData['registration_number']);
		}
		if (!empty($postData['incorporation_date'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'incorporation_date', $postData['incorporation_date']);
		}
		if (!empty($postData['registered_in'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'registered_in', $postData['registered_in']);
		}
		if (!empty($postData['business_desc'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'business_desc', $postData['business_desc']);
		}

		if(isset($postData['ann_ret_check']) && $postData['ann_ret_check'] != ""){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'ann_ret_check', $postData['ann_ret_check']);

			if (!empty($postData['made_up_date'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'made_up_date', $postData['made_up_date']);
			}
			if (!empty($postData['next_ret_due'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'next_ret_due', $postData['next_ret_due']);
			}
			if (!empty($postData['ch_auth_code'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'ch_auth_code', $postData['ch_auth_code']);
			}
		}

		if(isset($postData['yearend_acc_check']) && $postData['yearend_acc_check'] != ""){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'yearend_acc_check', $postData['yearend_acc_check']);

			if (!empty($postData['acc_ref_day'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'acc_ref_day', $postData['acc_ref_day']);
			}
			if (!empty($postData['acc_ref_month'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'acc_ref_month', $postData['acc_ref_month']);
			}
			if (!empty($postData['last_acc_madeup_date'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'last_acc_madeup_date', $postData['last_acc_madeup_date']);
			}
			if (!empty($postData['next_acc_due'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'next_acc_due', $postData['next_acc_due']);
			}
		}
//#############BUSINESS INFORMATION END###################//

//#############TAX INFORMATION START###################//
		$step_id = 2;
		if (isset($postData['reg_for_vat']) && $postData['reg_for_vat'] != "") {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'reg_for_vat', $postData['reg_for_vat']);

			if (!empty($postData['effective_date'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'effective_date', $postData['effective_date']);
			}
			if (!empty($postData['vat_number'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'vat_number', $postData['vat_number']);
			}
			if (!empty($postData['vat_scheme_type'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'vat_scheme_type', $postData['vat_scheme_type']);
			}
			if (!empty($postData['vat_scheme'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'vat_scheme', $postData['vat_scheme']);
			}
			if (!empty($postData['ret_frequency'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'ret_frequency', $postData['ret_frequency']);
			}
			if (!empty($postData['vat_stagger'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'vat_stagger', $postData['vat_stagger']);
			}
		}

		if (!empty($postData['ec_scale_list'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'ec_scale_list', $postData['ec_scale_list']);
		}

		if (!empty($postData['tax_div'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_div', $postData['tax_div']);

			if (!empty($postData['tax_reference'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_reference', $postData['tax_reference']);
			}
			if (!empty($postData['tax_reference_type'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_reference_type', $postData['tax_reference_type']);
			}
			if (!empty($postData['other_office_id'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_office_id', $postData['other_office_id']);
			} else {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_office_id', $postData['tax_office_id']);
			}
			if (!empty($postData['tax_address'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_address', $postData['tax_address']);
			}
			if (!empty($postData['tax_zipcode'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_zipcode', $postData['tax_zipcode']);
			}
			if (!empty($postData['tax_telephone'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_telephone', $postData['tax_telephone']);
			}
		}

		if (!empty($postData['paye_reg'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'paye_reg', $postData['paye_reg']);

			if (!empty($postData['cis_registered'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cis_registered', $postData['cis_registered']);
			}

			if (!empty($postData['acc_office_ref'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'acc_office_ref', $postData['acc_office_ref']);
			}
			if (!empty($postData['paye_reference'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'paye_reference', $postData['paye_reference']);
			}
			if (!empty($postData['paye_district'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'paye_district', $postData['paye_district']);
			}
			if (!empty($postData['employer_office'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'employer_office', $postData['employer_office']);
			}
			if (!empty($postData['employer_postcode'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'employer_postcode', $postData['employer_postcode']);
			}
			if (!empty($postData['employer_telephone'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'employer_telephone', $postData['employer_telephone']);
			}
		}

		if (!empty($postData['hmrc_login_details'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'hmrc_login_details', $postData['hmrc_login_details']);
		}

//#############TAX INFORMATION END###################//

//#############CONTACT INFORMATION START###################//
		$step_id 	= 3;
		$array 	 	= array("trad", "reg", "corres", "banker", "oldacc", "auditors", "solicitors");
		foreach($array as $key=>$val){//echo $postData['cont_'.$val.'_addr'];die;
			if (isset($postData['cont_'.$val.'_addr']) && $postData['cont_'.$val.'_addr'] != "") {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_'.$val.'_addr', $postData['cont_'.$val.'_addr']);
				if (isset($postData[$val.'_name_check']) && $postData[$val.'_name_check'] != "") {
					$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_name_check', $postData[$val.'_name_check']);

					if (!empty($postData[$val.'_cont_name'])) {
						$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_cont_name', $postData[$val.'_cont_name']);
					}
					if (!empty($postData[$val.'_cont_tele_code'])) {
						$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_cont_tele_code', $postData[$val.'_cont_tele_code']);
					}
					if (!empty($postData[$val.'_cont_telephone'])) {
						$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_cont_telephone', $postData[$val.'_cont_telephone']);
					}
					if (!empty($postData[$val.'_cont_mobile_code'])) {
						$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_cont_mobile_code', $postData[$val.'_cont_mobile_code']);
					}
					if (!empty($postData[$val.'_cont_mobile'])) {
						$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_cont_mobile', $postData[$val.'_cont_mobile']);
					}
					if (!empty($postData[$val.'_cont_email'])) {
						$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_cont_email', $postData[$val.'_cont_email']);
					}
					if (!empty($postData[$val.'_cont_website'])) {
						$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_cont_website', $postData[$val.'_cont_website']);
					}
					if (!empty($postData[$val.'_cont_skype'])) {
						$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_cont_skype', $postData[$val.'_cont_skype']);
					}

				}

				if (!empty($postData[$val.'_cont_addr_line1'])) {
					$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_cont_addr_line1', $postData[$val.'_cont_addr_line1']);
				}
				if (!empty($postData[$val.'_cont_addr_line2'])) {
					$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_cont_addr_line2', $postData[$val.'_cont_addr_line2']);
				}
				if (!empty($postData[$val.'_cont_city'])) {
					$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_cont_city', $postData[$val.'_cont_city']);
				}
				if (!empty($postData[$val.'_cont_county'])) {
					$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_cont_county', $postData[$val.'_cont_county']);
				}
				if (!empty($postData[$val.'_cont_postcode'])) {
					$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_cont_postcode', $postData[$val.'_cont_postcode']);
				}
				if (!empty($postData[$val.'_cont_country'])) {
					$arrData[] = $this->save_client($user_id, $client_id, $step_id, $val.'_cont_country', $postData[$val.'_cont_country']);
				}

			}
		}

//############# CONTACT INFORMATION END ###################//

//############# RELATIONSHIP START ###################//
		if (!empty($postData['app_hidd_array'])) {
			$relData = array();
			$app_hidd_array = explode(",", $postData['app_hidd_array']); //print_r($app_hidd_array);
			foreach ($app_hidd_array as $row) {
				$rel_row = explode("mpm", $row);
				$relData[] = array(
					'client_id' => $client_id,
					'appointment_with' => $rel_row['0'],
					'appointment_date' => date("Y-m-d H:i:s", strtotime($rel_row['1'])),
					'relationship_type_id' => $rel_row['2'],
				);
			}
			ClientRelationship::insert($relData);

		}
//#############RELATIONSHIP END ###################//

//############# OTHERS INFORMATION START ###################//
		$step_id = 5;
		if (!empty($postData['bank_name'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'bank_name', $postData['bank_name']);
		}
		if (!empty($postData['bank_short_code'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'bank_short_code', $postData['bank_short_code']);
		}
		if (!empty($postData['bank_acc_no'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'bank_acc_no', $postData['bank_acc_no']);
		}
		if (!empty($postData['bank_mark_source'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'bank_mark_source', $postData['bank_mark_source']);
		}
//############# OTHERS INFORMATION END ###################//

//############# SERVICES START ###################//
		if (!empty($postData['serv_hidd_array'])) {
			$relData = array();
			$serv_hidd_array = explode(",", $postData['serv_hidd_array']); //print_r($serv_hidd_array);
			foreach ($serv_hidd_array as $row) {
				$rel_row = explode("mpm", $row);
				$relData[] = array(
					'client_id' => $client_id,
					'service_id' => $rel_row['0'],
					'staff_id' => $rel_row['1'],
				);
			}
			ClientService::insert($relData);

		}
//############# SERVICES END ###################//

//################## USER ADDED FIELD START ###############//
$field_added = StepsFieldsAddedUser::where("client_type", "=", "org")->whereIn("user_id", $groupUserId)->get();
//echo $this->last_query();die;
if(isset($field_added) && count($field_added) > 0){
	foreach ($field_added as $key => $value) {
		$field_name = strtolower($value->field_name);
		if (isset($postData[$field_name]) && $postData[$field_name] != "") {
			$arrData[] = $this->save_client($user_id, $client_id, $value->step_id, $field_name, $postData[$field_name]);
		}
	}
}
//################## USER ADDED FIELD END ###############//

		StepsFieldsClient::insert($arrData);
		return Redirect::to('/organisation-clients');
	}

	public function save_client($user_id, $client_id, $step_id, $field_name, $field_value) {
		$data = array();
		$data['user_id'] = $user_id;
		$data['client_id'] = $client_id;
		$data['step_id'] = $step_id;
		$data['field_name'] = $field_name;
		$data['field_value'] = $field_value;
		return $data;
		//OrganisationClient::insert($data);
	}

	public function show_new_table() {
		$data = array();
		$postData = Input::all();

		$four = $postData['four'];
		$six = $postData['six'];
		$seven = $postData['seven'];
		$eight = $postData['eight'];
		$nine = $postData['nine'];
		$ten = $postData['ten'];

		$client_data = array();

		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
		//$user_id = 1;
		$client_ids = Client::where("type", "=", "ind")->where('user_id', '=', $user_id)->select("client_id")->get();
		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
			foreach ($client_ids as $client_id) {
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				//$client_data[$i]['client_id'] 	= $client_id->client_id;

				$appointment_name = ClientRelationship::where('client_id', '=', $client_id->client_id)->select("appointment_with")->first();
				//echo $this->last_query();//die;
				$relation_name = StepsFieldsClient::where('client_id', '=', $appointment_name['appointment_with'])->where('field_name', '=', "business_name")->select("field_value")->first();

				if (isset($client_details) && count($client_details) > 0) {
					foreach ($client_details as $client_row) {

						//get staff name start
						if (!empty($client_row['field_name']) && $client_row['field_name'] == "resp_staff") {
							$staff_name = User::where('user_id', '=', $client_row->field_value)->select("fname", "lname")->first();
							//echo $this->last_query();die;
							$client_data[$i]['staff_name'] = $staff_name['fname'] . " " . $staff_name['lname'];
						}
						//get staff name end

						//get business name start
						if (!empty($relation_name['field_value']) && in_array("business_name", $postData)) {
							$client_data[$i]['business_name'] = $relation_name['field_value'];
						}
						//get business name end

						//get client name start
						if (!empty($client_row['field_name']) && $client_row['field_name'] == "name") {
							$client_data[$i][$client_row['field_name']] = $client_row->field_value;
						}
						//get client name end

						if ($client_row['field_name'] == $four || $client_row['field_name'] == $six || $client_row['field_name'] == $seven || $client_row['field_name'] == $eight || $client_row['field_name'] == $nine || $client_row['field_name'] == $ten) {
							$client_data[$i][$client_row['field_name']] = $client_row->field_value;

							if (($client_row['field_name'] == "acting") && in_array("acting", $postData)) {
								$client_data[$i]['acting'] = "Yes";
							}

						}
					}
				}
				$i++;
			}
		}

		//print_r($client_data);die;
		echo json_encode($client_data);
		exit();
	}

	public function search_individual_client() {
		$data = array();
		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
		//$user_id = 1;
		$postData = Input::all();
		$search_value = $postData['search_value'];

		$client_ids = Client::where("type", "=", "ind")->where('user_id', '=', $user_id)->select("client_id")->get();
		//echo $this->last_query();die;
		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
			foreach ($client_ids as $client_id) {
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				//echo $this->last_query();die;
				//$client_data[$i]['client_id'] 	= $client_id->client_id;

				$appointment_name = ClientRelationship::where('client_id', '=', $client_id->client_id)->select("appointment_with")->first();
				//echo $this->last_query();//die;
				$relation_name = StepsFieldsClient::where('client_id', '=', $appointment_name['appointment_with'])->where('field_name', '=', "business_name")->select("field_value")->first();

				if (isset($client_details) && count($client_details) > 0) {
					foreach ($client_details as $client_row) {
						//get staff name start
						if (!empty($client_row['field_name']) && $client_row['field_name'] == "resp_staff") {
							$staff_name = User::where('user_id', '=', $client_row->field_value)->select("fname", "lname")->first();
							//echo $this->last_query();die;
							$client_data[$i]['staff_name'] = strtoupper(substr($staff_name['fname'], 0, 1)) . " " . strtoupper(substr($staff_name['lname'], 0, 1));
						} else {
							$client_data[$i]['staff_name'] = "";
						}
						//get staff name end

						//get business name start
						if (!empty($relation_name['field_value'])) {
							$client_data[$i]['business_name'] = $relation_name['field_value'];
						}
						//get business name end

						//get Acting start
						if (!empty($client_row['field_name']) && $client_row['field_name'] == "acting") {
							$client_data[$i]['acting'] = "Yes";
						} else {
							$client_data[$i]['acting'] = "No";
						}
						//get business name end

						if (isset($client_row['field_name']) && $client_row['field_name'] == "business_type") {
							$business_type = OrganisationType::where('organisation_id', '=', $client_row->field_value)->first();
							$client_data[$i][$client_row['field_name']] = $business_type['name'];
						} else {
							$client_data[$i][$client_row['field_name']] = $client_row->field_value;
						}

					}

					$i++;
				}

			}
		}

		foreach ($client_data as $key => $value) {
			if (!in_array_field($search_value, $client_data['name'], $client_data)) {
				unset($client_data[$key]);
			}
		}

		print_r($client_data);die;
		echo json_encode($client_data);
		exit();
	}
    
    /*
    public function edit_client($client_id){
        
        //print_r($clientid);die('j');
        
         //$data['title'] = "Client Edit";
          //  $data['heading'] = "Client USER";
        
   	$client_details = StepsFieldsClient::where('client_id', '=', $client_id)->select("field_id", "field_name", "field_value")->get();
			
        
        
        
        
        //$data['clientinfo'] = StepsFieldsClient::select('*')->where('client_id', '=', $client_id)->get();
        echo "<pre>";print_r($client_details);
        die('edit');
    }*/




	
}
