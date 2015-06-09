<?php

class ClientController extends BaseController {
	public function edit_ind_client($client_id)
	{
		$data['title'] = "Edit Client";
        $data['heading'] = "";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $groupUserId = $session['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}
        
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
		$data['cont_address'] 		= App::make('HomeController')->get_contact_address();

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
		$data['subsections'] = App::make('HomeController')->buildtree($steps, "ind");
		//###########User added section and sub section start##########//

		//############# Get client data start ################//
		$relationship = DB::table('client_relationships as cr')->where("cr.client_id", "=", $client_id)
            ->join('relationship_types as rt', 'cr.relationship_type_id', '=', 'rt.relation_type_id')
            ->select('cr.client_relationship_id', 'cr.appointment_date', 'rt.relation_type', 'cr.client_id')->get();
        if(isset($relationship) && count($relationship) >0 )
        {
        	foreach ($relationship as $key => $row) {
        		$client_name = StepsFieldsClient::where("field_name", "=", 'business_name')->where("client_id", "=", $row->client_id)->first();
        		if(isset($client_name) && count($client_name) >0 ){
        			$data['relationship'][$key]['name'] = $client_name['field_value'];
        		}else{
        			/*$client_name = StepsFieldsClient::where("client_id", "=", $row->client_id)->first();
        			if(isset($client_name) && count($client_name) >0 ){

        			}*/
        			$data['relationship'][$key]['name'] = "Processing...";
        		}
        		$data['relationship'][$key]['client_relationship_id'] 	= $row->client_relationship_id;
        		$data['relationship'][$key]['appointment_date'] 		= $row->appointment_date;
        		$data['relationship'][$key]['relation_type'] 			= $row->relation_type;
        	}
        }
        //echo $this->last_query();die;

		$client_details = StepsFieldsClient::where('client_id', '=', $client_id)->select("field_id", "field_name", "field_value")->get();

		$client_data['client_id'] 		= $client_id;	

        if (isset($client_details) && count($client_details) > 0) {
			foreach ($client_details as $client_row) {
				$client_data[$client_row['field_name']] = $client_row->field_value;
			}
		}

		$data['client_details'] 	=	$client_data;

		//print_r($data['relationship']);die;
		//############# Get client data end ################//

        return View::make('home.individual.edit_individual_client', $data);
   
   	}

	public function get_country_code() {
		$country_id = Input::get("country_id");
		$country_code = Country::where("country_id", $country_id)->select("phone_code")->first();
		echo $country_code['phone_code'];
	}

	public function delete_user_field() {
		$field_id = Input::get("field_id");
		$affectedRows = StepsFieldsAddedUser::where('field_id', '=', $field_id)->delete();
		echo $affectedRows;
	}

	public function delete_section() {
		$step_id = Input::get("step_id");
		$affected = Step::where('step_id', '=', $step_id)->delete();
		if ($affected) {
			$affectedRows = StepsFieldsAddedUser::where('step_id', '=', $step_id)->delete();
			echo $affectedRows;
		}

	}

	public function delete_individual_client() {
		$client_delete_id = Input::get("client_delete_id");
		//print_r($client_delete_id);die;
		foreach ($client_delete_id as $client_id) {
			Client::where('client_id', '=', $client_id)->delete();
			StepsFieldsClient::where('client_id', '=', $client_id)->delete();
		}
	}

	public function search_tax_address() {
		$field_type = Input::get("field_type");
		$data = array();
		if (Request::ajax()) {
			if ($field_type == "I") {
				$data = TaxOfficeAddress::where("parent_id", "==", "0")->select("office_id", "office_name")->get();
			} elseif ($field_type == "C") {
				$data = CorporationTaxOffice::select("corp_tax_id as office_id", "office_name")->get();
			}
		}
		echo json_encode($data);
		exit;
	}

	public function add_business_type() {
		$session_data = Session::get('admin_details');
		
		$data['name'] 			= Input::get("org_name");
		$data['client_type'] 	= Input::get("client_type");
		$data['user_id'] 		= $session_data['id'];
		$data['status'] 		= "new";
		OrganisationType::insert($data);
		return Redirect::to('/organisation/add-client');
	}

	public function delete_org_name() {
		$field_id = Input::get("field_id");
		if (Request::ajax()) {
			$data = OrganisationType::where("organisation_id", "=", $field_id)->delete();
			echo $data;
		}
	}

	public function add_vat_scheme() {
		$session_data = Session::get('admin_details');

		$data['vat_scheme_name'] 	= Input::get("vat_scheme_name");
		$data['user_id'] 			= $session_data['id'];
		$data['status'] 			= "new";
		VatScheme::insert($data);
		return Redirect::to('/organisation/add-client');
	}

	public function delete_vat_scheme() {
		$field_id = Input::get("field_id");
		if (Request::ajax()) {
			$data = VatScheme::where("vat_scheme_id", "=", $field_id)->delete();
			echo $data;
		}
	}

	public function get_oldcont_address() {
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		$client_id = Input::get("client_id");
		$client_data = array();
		if (Request::ajax()) {
			$client_ids = Client::whereIn("user_id", $groupUserId)->where('type', '=', "org")->where('client_id', '=', $client_id)->where('user_id', '=', $user_id)->select("client_id")->get();
			//echo $this->last_query();die;
			$i = 0;
			if (isset($client_ids) && count($client_ids) > 0) {
				foreach ($client_ids as $client_id) {
					$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
					$client_data[$i]['client_id'] = $client_id->client_id;

					if (isset($client_details) && count($client_details) > 0) {
						foreach ($client_details as $client_row) {
							$client_data[$i][$client_row['field_name']] = $client_row['field_value'];
						}

						$i++;
					}
				}
			}
		}
		echo json_encode($client_data);
		exit;
	}

	public function add_services() {
		$session_data = Session::get('admin_details');

		$data['service_name'] = Input::get("service_name");
		$data['user_id'] 			= $session_data['id'];
		$data['status'] 			= "new";
		Service::insert($data);
		return Redirect::to('/organisation/add-client');
	}

	public function delete_services() {
		$field_id = Input::get("field_id");
		if (Request::ajax()) {
			$data = Service::where("service_id", "=", $field_id)->delete();
			echo $data;
		}
	}

	public function insert_section() {
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		$data['title'] 			= Input::get("subsec_name");
		$data['parent_id'] 		= Input::get("parent_id");
		$data['user_id'] 		= $user_id;
		$data['short_code'] 	= strtolower(Input::get("subsec_name"));
		$data['status'] 		= "new";
		$data['client_type'] 	= Input::get("client_type");
		if (Request::ajax()) {
			Step::insert($data);
			$steps = Step::whereIn("user_id", $groupUserId)->where("client_type", "=", $data['client_type'])->where("parent_id", "=", $data['parent_id'])->where("status", "=", "new")->get();
			echo json_encode($steps);
		}
	}

	public function get_subsection() {
		$admin_s = Session::get('admin_details');
		$groupUserId = $admin_s['group_users'];

		$step_id 		= Input::get("step_id");
		$client_type 	= Input::get("client_type");
		
		if (Request::ajax()) {
			$steps = Step::whereIn("user_id", $groupUserId)->where("client_type", "=", $client_type)->where("parent_id", "=", $step_id)->get();
			//echo $this->last_query();die;
			echo json_encode($steps);
		}
	}

	public function archive_client() {
		Session::put('show_archive', 'Y');

		$clients_id = Input::get("client_id");
		$status = Input::get("status");
		//print_r($clients_id);die;
		foreach ($clients_id as $client_id) {
			if($status == "Archive"){
				Client::where('client_id', '=', $client_id)->update(array("is_archive"=>"Y", "show_archive"=>"Y"));
			}else{
				Client::where('client_id', '=', $client_id)->update(array("is_archive"=>"N", "show_archive"=>"N"));
			}
			
			//echo $this->last_query();die;
		}
	}

	public function show_archive_client() {
		$is_archive = Input::get("is_archive");
		if($is_archive == "Y"){
			Session::put('show_archive', 'Y');
		}else{
			Session::put('show_archive', 'N');
		}

		$affected = DB::table('clients')->where("show_archive", "=", "Y")->update(array("is_archive"=>$is_archive));
		//echo $this->last_query();die;
	}

	public function edit_relation_type()
	{
		$data['relation_type'] = Input::get("relation_type");
		$client_type = Input::get("client_type");
		if($client_type == "org"){
			$data['relationship'] = RelationshipType::where("show_status", "=", "individual")->orderBy("relation_type_id")->get();
		}else{
			$data['relationship'] = RelationshipType::orderBy("relation_type_id")->get();
		}

		echo View::make("home.relationship_types", $data);
		
	}

	public function delete_relationship()
	{
		$delete_index = Input::get("delete_index");
		$client_type = Input::get("client_type");
		$resp = ClientRelationship::where("client_relationship_id", "=", $delete_index)->delete();
		echo $resp;
	}

}
