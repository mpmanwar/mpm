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
		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		$data['heading'] = "CLIENT LIST - INDIVIDUALS";
		$data['title'] = "Individual Clients List";
		$client_data = array();

		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id

		//$user_id = 1;
		$client_ids = Client::where("type", "=", "ind")->where('user_id', '=', $user_id)->select("client_id")->get();
		//echo $this->last_query();die;
		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
			foreach ($client_ids as $client_id) {
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				
                $client_data[$i]['client_id'] = $client_id->client_id;

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
						}
						//get staff name end

						//get business name start
						if (!empty($relation_name['field_value'])) {
							$client_data[$i]['business_name'] = $relation_name['field_value'];
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
		$data['client_details'] = $client_data;

		$data['client_fields'] = ClientField::where("field_type", "=", "ind")->get();
//die;
		//print_r($data);die;
		return View::make('home.individual.individual_client', $data);
	}

	public function organisation_clients() {
		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id

		if (empty($user_id)) {
			return Redirect::to('/');
		}
		$data['heading'] = "CLIENTS LIST - ORGANISATIONS";
		$data['title'] = "Organisation Clients List";

		$client_data = array();

		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
		//$user_id = 1;
		$client_ids = Client::where("type", "=", "org")->where('user_id', '=', $user_id)->select("client_id")->get();

		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
			foreach ($client_ids as $client_id) {
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				$client_data[$i]['client_id'] = $client_id->client_id;

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
		$to = date("Y-m-d H:i:s");
		$first_date = strtotime($from);
	    $second_date = strtotime($to);
	    $offset = $second_date-$first_date; 
	    return floor($offset/60/60/24);
	}

	public function add_individual_client() {

		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id

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
		$data['steps'] 				= Step::orderBy("step_id")->get();
		$data['responsible_staff'] 	= User::select('fname', 'lname', 'user_id')->get();
		$data['countries'] 			= Country::where("country_id", "!=", 1)->orderBy('country_name')->get();
		$data['field_types'] 		= FieldType::get();
		$data['cont_address'] 		= $this->get_contact_address();

		$steps_fields_users = StepsFieldsAddedUser::where("substep_id", "=", '0')->where("client_type", "=", "ind")->get();
		foreach ($steps_fields_users as $key => $steps_fields_row) {
			$steps_fields_users[$key]->select_option = explode(",", $steps_fields_row->select_option);
		}
		$data['steps_fields_users'] = $steps_fields_users;

		//###########User added section and sub section start##########//
		$steps = array();
		$subsections = Step::where("status", "=", "new")->get();
		foreach ($subsections as $key => $val) {
			if (isset($val->status) && $val->status == "new") {
				$steps[$key]['step_id'] = $val->step_id;
				$steps[$key]['short_code'] = $val->short_code;
				$steps[$key]['title'] = $val->title;
				$steps[$key]['status'] = $val->status;
			}

		}
		$data['subsections'] = $this->buildtree($steps, "ind");
		//###########User added section and sub section start##########//

		//print_r($data['subsections']);die;
		//echo $this->last_query();die;
		return View::make('home.individual.add_individual_client', $data);
	}

	public function add_organisation_client() {

		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		$data['heading'] = "ADD CLIENT";
		$data['title'] = "Add Client";
		$data['org_types'] = OrganisationType::orderBy("organisation_id")->get();
		$data['rel_types'] = RelationshipType::orderBy("relation_type_id")->get();
		$data['steps'] = Step::orderBy("step_id")->get();
		$data['staff_details'] = User::select("user_id", "fname", "lname")->get();
		$data['tax_office'] = TaxOfficeAddress::select("parent_id", "office_id", "office_name")->get();
		$data['services'] = Service::get();
		$data['countries'] = Country::where("country_id", "!=", 1)->orderBy('country_name')->get();
		$data['field_types'] = FieldType::get();
		$data['vat_schemes'] = VatScheme::get();
		$data['cont_address'] = $this->get_contact_address();
		$data['reg_address'] = RegisteredAddress::get();

		$steps_fields_users = StepsFieldsAddedUser::where("client_type", "=", "org")->where("step_id", "<=", '5')->get();
		foreach ($steps_fields_users as $key => $steps_fields_row) {
			$steps_fields_users[$key]->select_option = explode(",", $steps_fields_row->select_option);
		}
		$data['steps_fields_users'] = $steps_fields_users;

		//###########User added section and sub section start##########//
		$steps = array();
		$subsections = Step::where("status", "=", "new")->get();
		foreach ($subsections as $key => $val) {
			if (isset($val->status) && $val->status == "new") {
				$steps[$key]['step_id'] = $val->step_id;
				$steps[$key]['short_code'] = $val->short_code;
				$steps[$key]['title'] = $val->title;
				$steps[$key]['status'] = $val->status;
			}

		}
		//print_r($steps);die;
		$data['subsections'] = $this->buildtree($steps, "org");
		//print_r($data['subsections']);die;
		//###########User added section and sub section start##########//

		return View::make('home.organisation.add_organisation_client', $data);

	}

	public function buildtree($steps, $client_type) {
		$branch = array();
		foreach ($steps as $element) {
			//$children = StepsFieldsAddedUser::where("step_id", "=", $element['step_id'])->where("client_type", "=", $client_type)->get();
			$children = StepsFieldsAddedUser::where("substep_id", "!=", '0')->where("client_type", "=", $client_type)->get();
			foreach ($children as $key => $steps_fields_row) {
				$children[$key]->select_option = explode(",", $steps_fields_row->select_option);
			}
			if (isset($children) && count($children) > 0) {
				foreach ($children as $key => $row) {
					$substep = Step::where("step_id", "=", $row->substep_id)->first();
					$element['parent'][$key]['name'] = $substep['title'];

					$element['children'][$key]['field_id'] = $row->field_id;
					$element['children'][$key]['user_id'] = $row->user_id;
					$element['children'][$key]['step_id'] = $row->step_id;
					$element['children'][$key]['field_type'] = $row->field_type;
					$element['children'][$key]['field_name'] = $row->field_name;
					$element['children'][$key]['field_value'] = $row->field_value;
					$element['children'][$key]['select_option'] = $row->select_option;
					$element['children'][$key]['client_type'] = $row->client_type;
				}
				$branch[] = $element;
			}

		}
		return $branch;
	}

	public function get_contact_address() {
		$client_data = array();

		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
		//$user_id = 1;

		$client_ids = Client::where('type', '=', "org")->where('user_id', '=', $user_id)->select("client_id")->get();
		//echo $this->last_query();die;
		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
			foreach ($client_ids as $client_id) {
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				$client_data[$i]['client_id'] = $client_id->client_id;
				//echo $this->last_query();die;

				if (isset($client_details) && count($client_details) > 0) {
					foreach ($client_details as $client_row) {
						if (isset($client_row['field_name']) && ($client_row['field_name'] == "cont_addr_line1" || $client_row['field_name'] == "cont_addr_line2")) {
							$client_data[$i][$client_row['field_name']] = $client_row['field_value'];
						}
					}

					$i++;
				}
			}
		}
		//print_r($client_data);die;
		return $client_data;
	}

	public function insert_individual_client() {

		$postData = Input::all();

		$arrData = array();

		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
		//$user_id = 1;
		$client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'ind'));

//################ GENERAL SECTION START #################//
		$step_id = 1;
		if (!empty($postData['client_code'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'client_code', $postData['client_code']);

		}

		//$fulltitle = Title::select("title_name")->where('title_id', $postData['title'])->first();
		if (!empty($postData['title'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'title', $postData['title']);
		}
		if (!empty($postData['fname'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'fname', $postData['fname']);
		}
		if (!empty($postData['mname'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'mname', $postData['mname']);
		}
		if (!empty($postData['lname'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'lname', $postData['lname']);
		}
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
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_office_id', $postData['tax_office_id']);
		}
		if (!empty($postData['tax_address'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_address', $postData['tax_address']);
		}
		if (!empty($postData['tax_city'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_city', $postData['tax_city']);
		}
		if (!empty($postData['tax_region'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_region', $postData['tax_region']);
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
		if (!empty($postData['serv_telephone'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'telephone', $postData['serv_tele_code'] . " " . $postData['serv_telephone']);
		}
		if (!empty($postData['serv_mobile'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'mobile', $postData['serv_mobile_code'] . " " . $postData['serv_mobile']);

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

//################ OTHERS SECTION END #################//
		$step_id = 5;
		/*if (!empty($postData['others_check'])) {
		$checkbox_list='';
		for ( $i=0; $i< count($postData['others_check']); $i++ ){
		$checkbox_list=$checkbox_list.' '.$postData['others_check'][$i];
		}
		$arrData[] = $this->save_client($user_id,$client_id, $step_id, 'others_check', $checkbox_list);
		}*/
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

		//print_r($arrData);die;
		StepsFieldsClient::insert($arrData);
		return Redirect::to('/individual-clients');

		//return View::make('home.organisation.add_organisation_client', $data);
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
		$rel_type_id = Input::get("rel_type_id");
		if (Request::ajax()) {
			$rel_types = RelationshipType::where("relation_type_id", "=", $rel_type_id)->first();
			//echo $this->last_query();die;
		}

		//$rel_types['appointment_date'] = date("m/d/Y", strtotime(Input::get('app_date')));
		$rel_types['appointment_date'] = Input::get('app_date');

		echo json_encode($rel_types);
		exit();

	}

	public function save_userdefined_field() {
		$data = array();

		$admin_s = Session::get('admin_details'); // session

		$data['user_id'] 		= $admin_s['id'];
		$data['step_id'] 		= Input::get("step_id");
		$data['substep_id'] 	= Input::get("substep_id");
		$data['field_name'] 	= Input::get("field_name");
		$data['field_type'] 	= Input::get("field_type");
		$data['client_type'] 	= Input::get("client_type");
		$data['select_option'] 	= Input::get("select_option");

		$field_id = StepsFieldsAddedUser::insertGetId($data);
		if ($data['client_type'] == "ind") {
			return Redirect::to('/individual/add-client');
		} else {
			return Redirect::to('/organisation/add-client');
		}

	}

	function save_services() {
		$rel_types = array();
		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
		//$user_id = 1;
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
		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
		//$user_id = 1;
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
		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
		//$user_id = 1;
		$search_value = Input::get("search_value");
		$client_ids = Client::where('user_id', '=', $user_id)->select("client_id", "type")->get();

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
	}

	public function insert_organisation_client() {
		$postData = Input::all();
		$data = array();
		$arrData = array();
		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
		//$user_id = 1;

		//print_r($postData['app_hidd_array']);die;

		$client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'org'));

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
		if (!empty($postData['made_up_date'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'made_up_date', $postData['made_up_date']);
		}
		if (!empty($postData['next_ret_due'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'next_ret_due', $postData['next_ret_due']);
		}
		if (!empty($postData['ch_auth_code'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'ch_auth_code', $postData['ch_auth_code']);
		}
		if (!empty($postData['acc_ref_day']) && !empty($postData['acc_ref_month'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'acc_ref_date', $postData['acc_ref_day'] . '-' . $postData['acc_ref_month']);
		}
		if (!empty($postData['last_acc_madeup_date'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'last_acc_madeup_date', $postData['last_acc_madeup_date']);
		}
		if (!empty($postData['next_acc_due'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'next_acc_due', $postData['next_acc_due']);
		}
//#############BUSINESS INFORMATION END###################//

//#############TAX INFORMATION START###################//
		$step_id = 2;
		if (!empty($postData['reg_for_vat'])) {

			if (!empty($postData['effective_date'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'effective_date', $postData['effective_date']);
			}
			if (!empty($postData['vat_number'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'vat_number', $postData['vat_number']);
			}
			if (!empty($postData['vat_scheme'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'vat_scheme', $postData['vat_scheme']);
			}
			if (!empty($postData['vat_scheme_cash'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'vat_scheme_cash', $postData['vat_scheme_cash']);
			}
			if (!empty($postData['vat_scheme_accrual'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'vat_scheme_accrual', $postData['vat_scheme_accrual']);
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

//#############TAX INFORMATION END###################//

//#############CONTACT INFORMATION START###################//
		$step_id = 3;
		if (!empty($postData['reg_office_addr'])) {
			if (!empty($postData['cont_addr_type'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_addr_type', $postData['cont_addr_type']);
			}
			if (!empty($postData['cont_name'])) {
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_name', $postData['cont_name']);
			}
		}
		if (!empty($postData['cont_addr_line1'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_addr_line1', $postData['cont_addr_line1']);
		}
		if (!empty($postData['cont_addr_line2'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_addr_line2', $postData['cont_addr_line2']);
		}
		if (!empty($postData['cont_city'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_city', $postData['cont_city']);
		}
		if (!empty($postData['cont_county'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_county', $postData['cont_county']);
		}
		if (!empty($postData['cont_postcode'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_postcode', $postData['cont_postcode']);
		}
		if (!empty($postData['cont_country'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_country', $postData['cont_country']);
		}
		if (!empty($postData['cont_trad_addr'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_trad_addr', $postData['cont_trad_addr']);
		}
		if (!empty($postData['cont_corres_addr'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_corres_addr', $postData['cont_corres_addr']);
		}
		if (!empty($postData['cont_banker_addr'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_banker_addr', $postData['cont_banker_addr']);
		}
		if (!empty($postData['cont_trad_addr'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_trad_addr', $postData['cont_trad_addr']);
		}
		if (!empty($postData['cont_old_acc_addr'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_old_acc_addr', $postData['cont_old_acc_addr']);
		}
		if (!empty($postData['cont_auditors_addr'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_auditors_addr', $postData['cont_auditors_addr']);
		}
		if (!empty($postData['cont_solicitors_addr'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_solicitors_addr', $postData['cont_solicitors_addr']);
		}
		if (!empty($postData['cont_others_addr'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_others_addr', $postData['cont_others_addr']);
		}
		if (!empty($postData['notes'])) {
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'notes', $postData['notes']);
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
