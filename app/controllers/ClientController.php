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
            ->select('cr.client_relationship_id', 'cr.appointment_date', 'rt.relation_type', 'cr.appointment_with as client_id')->get();

        if(isset($relationship) && count($relationship) >0 )
        {
        	foreach ($relationship as $key => $row) {
        		$client_name = StepsFieldsClient::where("field_name", "=", 'business_name')->where("client_id", "=", $row->client_id)->first();
        		if(isset($client_name) && count($client_name) >0 ){
        			$data['relationship'][$key]['name'] = $client_name['field_value'];
        		}else{
        			$client_details = StepsFieldsClient::where("step_id", "=", 1)->where("client_id", "=", $row->client_id)->get();
        			//echo $this->last_query();die;
        			if(isset($client_details) && count($client_details) >0 ){
        				$name = "";
        				foreach($client_details as $client_name){
        					if(isset($client_name->field_name) && $client_name->field_name == "fname"){
	        					$name .= $client_name->field_value." ";
	        				}
	        				if(isset($client_name->field_name) && $client_name->field_name == "mname"){
	        					$name .= $client_name->field_value." ";
	        				}
	        				if(isset($client_name->field_name) && $client_name->field_name == "lname"){
	        					$name .= $client_name->field_value." ";
	        				}
        				}
        				$data['relationship'][$key]['name'] = trim($name);
        			}
        			
        		}
        		$data['relationship'][$key]['client_relationship_id'] 	= $row->client_relationship_id;
        		$data['relationship'][$key]['appointment_date'] 		= $row->appointment_date;
        		$data['relationship'][$key]['appointment_with'] 		= $row->client_id;
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

		//print_r($data['titles']);die;
		//############# Get client data end ################//

        return View::make('home.individual.edit_individual_client', $data);
   
   	}

   	public function edit_org_client($client_id)
	{
		$data['title'] = "Edit Client";
        $data['heading'] = "";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $groupUserId = $session['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		/*$first = DB::table('organisation_types')->where("client_type", "=", "all")->where("status", "=", "old")->where("user_id", "=", 0);
		$data['org_types'] = OrganisationType::where("client_type", "=", "org")->where("status", "=", "new")->whereIn("user_id", $groupUserId)->union($first)->orderBy("name")->get();*/
		$data['old_org_types'] = OrganisationType::where("client_type", "=", "all")->orderBy("name")->get();
		$data['new_org_types'] = OrganisationType::where("client_type", "=", "org")->whereIn("user_id", $groupUserId)->where("status", "=", "new")->orderBy("name")->get();

		$data['rel_types'] 		= RelationshipType::orderBy("relation_type_id")->get();
		$data['steps'] 			= Step::where("status", "=", "old")->orderBy("step_id")->get();
		$data['subsections'] 	= Step::where("client_type", "=", "org")->where("parent_id", "=", 1)->orderBy("step_id")->get();
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
		$data['cont_address'] 	= App::make("HomeController")->get_orgcontact_address();
        
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
		$data['subsections'] = App::make("HomeController")->buildtree($steps, "org");
		//###########User added section and sub section start##########//

		//############# Get client data start ################//
		$relationship = DB::table('client_relationships as cr')->where("cr.client_id", "=", $client_id)
            ->join('relationship_types as rt', 'cr.relationship_type_id', '=', 'rt.relation_type_id')
            ->select('cr.client_relationship_id', 'cr.appointment_date', 'rt.relation_type', 'cr.appointment_with as client_id', 'cr.acting')->get();
        //echo $this->last_query();die;
        if(isset($relationship) && count($relationship) >0 )
        {
        	foreach ($relationship as $key => $row) {
        		$client_name = StepsFieldsClient::where("field_name", "=", 'business_name')->where("client_id", "=", $row->client_id)->first();
        		if(isset($client_name) && count($client_name) >0 ){
        			$data['relationship'][$key]['name'] = $client_name['field_value'];
        		}else{
        			$client_details = StepsFieldsClient::where("step_id", "=", 1)->where("client_id", "=", $row->client_id)->get();
        			//echo $this->last_query();die;
        			if(isset($client_details) && count($client_details) >0 ){
        				$name = "";
        				foreach($client_details as $client_name){
        					if(isset($client_name->field_name) && $client_name->field_name == "client_name"){
	        					$name = $client_name->field_value;
	        					break;
	        				}
        					if(isset($client_name->field_name) && $client_name->field_name == "fname"){
	        					$name .= $client_name->field_value." ";
	        				}
	        				if(isset($client_name->field_name) && $client_name->field_name == "mname"){
	        					$name .= $client_name->field_value." ";
	        				}
	        				if(isset($client_name->field_name) && $client_name->field_name == "lname"){
	        					$name .= $client_name->field_value." ";
	        				}
        				}
        				$data['relationship'][$key]['name'] = trim($name);
        				
        				        				
        			}
        			
        		}
        		$data['relationship'][$key]['client_relationship_id'] 	= $row->client_relationship_id;
        		$data['relationship'][$key]['appointment_date'] 		= date("d-m-Y", strtotime($row->appointment_date));
        		$data['relationship'][$key]['appointment_with'] 		= $row->client_id;
        		$data['relationship'][$key]['relation_type'] 			= $row->relation_type;
        		$data['relationship'][$key]['acting'] 					= $row->acting;
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

		$data['months'] =	array("01"=>"JAN", "02"=>"FEB", "03"=>"MAR", "04"=>"APR", "05"=>"MAY", "06"=>"JUN","07"=>"JUL", "08"=>"AUG", "09"=>"SEPT", "10"=>"OCT", "11"=>"NOV", "12"=>"DEC");

		$data['client_details'] 	=	$client_data;

		//print_r($data['steps_fields_users']);die;
		//############# Get client data end ################//

		return View::make('home.organisation.edit_organisation_client', $data);
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
		$insert_id = OrganisationType::insertGetId($data);
		echo $insert_id;exit();
		//return Redirect::to('/organisation/add-client');
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
		$insert_id = VatScheme::insertGetId($data);
		echo $insert_id;exit();
		//return Redirect::to('/organisation/add-client');
	}

	public function delete_vat_scheme() {
		$field_id = Input::get("field_id");
		if (Request::ajax()) {
			$data = VatScheme::where("vat_scheme_id", "=", $field_id)->delete();
			echo $data;
		}
	}

	public function get_oldcont_address() {
    //die('ddd');
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
        
		$groupUserId = $admin_s['group_users'];

		$client_id = Input::get("client_id");
        
		$client_data = array();
		if (Request::ajax()) {
			$client_ids = Client::whereIn("user_id", $groupUserId)->where('type', '=', "ind")->where('client_id', '=', $client_id)->where('user_id', '=', $user_id)->select("client_id")->get();
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
    
    
    
    public function get_orgoldcont_address() {
    //die('orgort');
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
		$insert_id = Service::insertGetId($data);
		echo $insert_id;exit();
		//return Redirect::to('/organisation/add-client');
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

	public function save_database_relationship()
	{
		$data = array();
		$type = "";
		$edit_id 		= Input::get("edit_id");
		$client_type 	= Input::get("client_type");
		$client_id 		= Input::get("client_id");
		$name 			= Input::get("name");
		$acting 		= Input::get("acting");
		$rel_type_id 	= Input::get("rel_type_id");
		$date 			= date("Y-m-d", strtotime(Input::get("app_date")));

		
		if(Input::get("rel_client_id") != ""){
			$data['appointment_with'] = Input::get("rel_client_id");
		}
		//$data['appointment_date'] = $date[2]."-".$date[1]."-".$date[0];
		$data['appointment_date'] 		= $date;
		$data['relationship_type_id'] 	= Input::get("rel_type_id");
		$data['acting'] 				= $acting;
		
		$resp = ClientRelationship::where("client_relationship_id", "=", $edit_id)->update($data);
		//echo $this->last_query();die;
		//if($resp){
			$relationship = RelationshipType::where("relation_type_id", "=", $data['relationship_type_id'])->first();
			$type = $relationship['relation_type'];

			//################# Change Officers Type Start #################//
			if($client_type == "change"){
				if (strpos($type, 'Corporate') !== false){
					$cl_data["type"] = "org";
					$getData = StepsFieldsClient::where("client_id", "=", $client_id)->where("field_name", "=", "client_name")->first();
					$clin_data['user_id'] 		= $getData['user_id'];
					$clin_data['client_id'] 	= $getData['client_id'];
					$clin_data['step_id'] 		= $getData['step_id'];
					$clin_data['field_name'] 	= "business_name";
					$clin_data['field_value'] 	= $getData['field_value'];

					$checkData = StepsFieldsClient::where("client_id", "=", $client_id)->where("field_name", "=", "business_name")->first();
					if(!isset($checkData)){
						StepsFieldsClient::insert($clin_data);
					}else{
						StepsFieldsClient::where("client_id", "=", $client_id)->where("field_name", "=", "business_name")->update(array("field_value"=>$name));
					}
				
				}else{
					$cl_data["type"] = "ind";
				}
			}else{
				$cl_data["type"] = "chd";
			}
			Client::where("client_id", "=", $client_id)->update($cl_data);
			//echo $this->last_query();die;
			//################# Change Officers Type End #################//

		//}
			//echo $this->last_query();die;
		echo $type;
	}

	public function save_acting_relationship()
	{
		$client_type 	= Input::get("client_type");
		$client_id 		= Input::get("client_id");
		$acting 		= Input::get("acting");
		$type 			= Input::get("rel_type");
		$edit_id 		= Input::get("edit_id");

		$data['acting'] 				= $acting;
		ClientRelationship::where("client_relationship_id", "=", $edit_id)->update($data);
		//################# Change Officers Type Start #################//
		if($client_type == "change"){
			if (strpos($type, 'Corporate') !== false){
				$cl_data["type"] = "org";
				$getData = StepsFieldsClient::where("client_id", "=", $client_id)->where("field_name", "=", "client_name")->first();
				$clin_data['user_id'] 		= $getData['user_id'];
				$clin_data['client_id'] 	= $getData['client_id'];
				$clin_data['step_id'] 		= $getData['step_id'];
				$clin_data['field_name'] 	= "business_name";
				$clin_data['field_value'] 	= $getData['field_value'];

				$checkData = StepsFieldsClient::where("client_id", "=", $client_id)->where("field_name", "=", "business_name")->first();
				if(!isset($checkData)){
					StepsFieldsClient::insert($clin_data);
				}
			
			}else{
				$cl_data["type"] = "ind";
			}
		}else{
			$cl_data["type"] = "chd";
		}
		$success = Client::where("client_id", "=", $client_id)->update($cl_data);
		//echo $this->last_query();die;
		//################# Change Officers Type End #################//

		echo $success;
	}

}
