<?php

class HomeController extends BaseController {
	
	public function db_connect(){
        if (DB::connection()->getDatabaseName())
        {
            echo "Conncted sucessfully to database : " . DB::connection()->getDatabaseName();
            die;
        }
    }

	public function dashboard(){
		$data['title'] = "Dashboard";
		return View::make('home.dashboard', $data);
	}

	public function individual_clients(){
		$data['title'] = "Individual Clients List";
		return View::make('home.individual.individual_client', $data);
	}

	public function organisation_clients(){
		$data['title'] = "Organisation Clients List";
		$data['client_details']	= OrganisationClient::where("user_id", "=", 1)->get();
		return View::make('home.organisation.organisation_client', $data);
	}

	public function add_individual_client(){
		$data['title'] 				= "Add Individual Client";
		$data['rel_types'] 			= RelationshipType::orderBy("relation_type_id")->get();
		$data['marital_status'] 	= MaritalStatus::orderBy("marital_status_id")->get();
		$data['titles'] 			= Title::orderBy("title_id")->get();
		$data['tax_office'] 		= TaxOfficeAddress::select("office_id", "office_name")->get();
		$data['tax_office_by_id'] 	= TaxOfficeAddress::where("office_id", "=", 1)->first();
		$data['steps'] 				= Step::orderBy("step_id")->get();

		$data['steps_fields_users'] = StepsFieldsAddedUser::get();
		$data['responsible_staff'] = User::select('fname', 'lname', 'user_id')->get();
		//$data['responsible_staff'] = User::select(DB::raw('concat(fname," ",lname) as full_name,user_id'))->lists('full_name', 'user_id');
		//print_r($data['responsible_staff']);die;
		//echo $this->last_query();die;
		return View::make('home.individual.add_individual_client', $data);
	}

	public function add_organisation_client(){
		$data['title'] 			= "Add Organisation Client";
		$data['org_types']		= OrganizationType::get();
		$data['rel_types'] 		= RelationshipType::orderBy("relation_type_id")->get();
		$data['steps'] 			= Step::orderBy("step_id")->get();
		return View::make('home.organisation.add_organisation_client', $data);
	}

	

	public function get_office_address()
	{
		$tax_office_address = array();
		$office_id = Input::get("office_id");
		if (Request::ajax()) {   
			$tax_office_address 	= TaxOfficeAddress::where("office_id", "=", $office_id)->first();
			//echo $this->last_query();die;         
        }

        echo json_encode($tax_office_address);
        exit();
	}

	function save_relationship()
	{
		$rel_types	= array();
		$user_id 	= 1;
		$name 		= Input::get("name");
		$date		= Input::get("date");
		$type 		= Input::get("type");

		if (Request::ajax()) {   
			$rel_types 	= RelationshipType::where("relation_type_id", "=", $type)->first();
			//echo $this->last_query();die;         
        }
        $rel_types['date'] 		= date("m/d/Y", strtotime(Input::get("date")));

        echo json_encode($rel_types);
        exit();

	}

	public function save_userdefined_field()
	{
		$data = array();
		$data['user_id'] 		= 1;
		$data['step_id'] 		= Input::get("step_id");
		$data['field_name']		= Input::get("field_name");
		$data['field_type']		= Input::get("field_type");
		//$data['field_label']	= Input::get("field_label");
		$field_id = StepsFieldsUser::insertGetId($data);
		return Redirect::to('/individual/add-client');
	}

	function save_services()
	{
		$rel_types	= array();
		$user_id 	= 1;
		$services 		= Input::get("services");
		$staff		= Input::get("staff");

		if (Request::ajax()) {   
			//$rel_types 	= RelationshipType::where("relation_type_id", "=", $type)->first();
			//echo $this->last_query();die;         
        }
        $rel_types['services'] 		= $services;
        $rel_types['staff'] 		= $staff;

        echo json_encode($rel_types);
        exit();
	}


	public function insert_organisation_client()
	{
		$postData 			= Input::all();
		$data 				= array();
		
		if(!empty($postData['client_code'])){
			$this->save_client(1, 1, 'client_code', $postData['client_code']);
		}
		if(!empty($postData['business_type'])){
			$this->save_client(1, 1, 'business_type', $postData['business_type']);
		}
		if(!empty($postData['business_name'])){
			$this->save_client(1, 1, 'business_name', $postData['business_name']);
		}
		if(!empty($postData['registration_number'])){
			$this->save_client(1, 1, 'registration_number', $postData['registration_number']);
		}
		if(!empty($postData['incorporation_date'])){
			$this->save_client(1, 1, 'incorporation_date', $postData['incorporation_date']);
		}
		if(!empty($postData['registered_date'])){
			$this->save_client(1, 1, 'registered_date', $postData['registered_date']);
		}
		if(!empty($postData['business_desc'])){
			$this->save_client(1, 1, 'business_desc', $postData['business_desc']);
		}
		if(!empty($postData['made_up_date'])){
			$this->save_client(1, 1, 'made_up_date', $postData['made_up_date']);
		}
		if(!empty($postData['next_ret_due'])){
			$this->save_client(1, 1, 'next_ret_due', $postData['next_ret_due']);
		}
		if(!empty($postData['ch_auth_code'])){
			$this->save_client(1, 1, 'ch_auth_code', $postData['ch_auth_code']);
		}
		if(!empty($postData['acc_ref_day']) && !empty($postData['acc_ref_month'])){
			$this->save_client(1, 1, 'acc_ref_date', $postData['acc_ref_day'].'-'.$postData['acc_ref_month']);
		}
		if(!empty($postData['last_acc_madeup_date'])){
			$this->save_client(1, 1, 'last_acc_madeup_date', $postData['last_acc_madeup_date']);
		}
		if(!empty($postData['next_acc_due'])){
			$this->save_client(1, 1, 'next_acc_due', $postData['next_acc_due']);
		}

		return Redirect::to('/organisation/add-client'); 
	}

	public function save_client($user_id, $step_id, $field_name, $field_value)
	{
		$data['user_id']		= $user_id;
		$data['step_id']		= $step_id;
		$data['field_name']		= $field_name;
		$data['field_value']	= $field_value;
		OrganisationClient::insert($data);
	}


}
