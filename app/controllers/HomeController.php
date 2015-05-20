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
		$client_data 	= array();
		$user_id 		= 1;
		$client_ids		= Client::where("type", "=", "ind")->where('user_id', '=', $user_id)->select("client_id")->get();
		$i = 0;
		if( isset($client_ids) && count($client_ids) >0 ){
			foreach($client_ids as $client_id){
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				$client_data[$i]['client_id'] 	= $client_id->client_id;

				if( isset($client_details) && count($client_details) >0 ){
					foreach($client_details as $client_row){
						if( isset($client_row['field_name']) && $client_row['field_name'] == "business_type" ){
							$business_type = OrganisationType::where('organisation_id', '=', $client_row->field_value)->first();
							$client_data[$i][$client_row['field_name']] 	= $business_type['name'];
						}else{
							$client_data[$i][$client_row['field_name']] 	= $client_row->field_value;
						}
						
					}

					$i++;
				}
				
				//echo $this->last_query();die;
			}
		}
		$data['client_details']		= $client_data;

		//print_r($data);die;
		return View::make('home.individual.individual_client', $data);
	}

	public function organisation_clients(){
		$data['title'] 	= "Organisation Clients List";

		$client_data 	= array();
		$user_id 		= 1;
		$client_ids		= Client::where("type", "=", "org")->where('user_id', '=', $user_id)->select("client_id")->get();
		$i = 0;
		if( isset($client_ids) && count($client_ids) >0 ){
			foreach($client_ids as $client_id){
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				$client_data[$i]['client_id'] 	= $client_id->client_id;

				if( isset($client_details) && count($client_details) >0 ){
					foreach($client_details as $client_row){
						if( isset($client_row['field_name']) && $client_row['field_name'] == "business_type" ){
							$business_type = OrganisationType::where('organisation_id', '=', $client_row->field_value)->first();
							$client_data[$i][$client_row['field_name']] 	= $business_type['name'];
						}else{
							$client_data[$i][$client_row['field_name']] 	= $client_row->field_value;
						}
						
					}

					$i++;
				}
				
				//echo $this->last_query();die;
			}
		}
		$data['client_details']		= $client_data;

		//print_r($data);die;
		
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
		$data['org_types']		= OrganisationType::get();
		$data['rel_types'] 		= RelationshipType::orderBy("relation_type_id")->get();
		$data['steps'] 			= Step::orderBy("step_id")->get();
		return View::make('home.organisation.add_organisation_client', $data);
	}

	public function insert_individual_client(){
		
		$postData = Input::all();
		print_r($postData);die;
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
		$rel_type_id 		= Input::get("rel_type_id");
		if (Request::ajax()) {   
			$rel_types 	= RelationshipType::where("relation_type_id", "=", $rel_type_id)->first();
			//echo $this->last_query();die;         
        }

        $rel_types['appointment_date'] 		= date("m/d/Y", strtotime(Input::get('date')));
	
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
		$services 	= Input::get("services");
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

	public function search_client()
	{
		$client_details = array();
		$user_id 		= 1;
		$search_value 	= Input::get("search_value");
		$client_type 	= Input::get("client_type");
		$client_ids		= Client::where("type", "=", $client_type)->where('user_id', '=', $user_id)->select("client_id")->get();
		$i = 0;
		foreach($client_ids as $client_id){
			$client_name = StepsFieldsClient::where("field_value", "like", '%'.$search_value.'%')->where('field_name', '=', 'name')->where('client_id', '=', $client_id->client_id)->select("field_value")->first();
			if( isset($client_name) && count($client_name) >0 ){
				$client_details[$i]['client_id'] 	= $client_id->client_id;
				$client_details[$i]['client_name'] 	= $client_name['field_value'];
				$i++;
			}
			
			//echo $this->last_query();
		}

        echo json_encode($client_details);
        exit();
	}

	public function insert_organisation_client()
	{
		$postData 			= Input::all();
		$data 				= array();
		$arrData			= array();
		$user_id 			 = 1;

		//print_r($postData['app_hidd_array']);die;

		$client_id = Client::insertGetId(array("user_id"=>$user_id, 'type'=>'org'));

//#############BUSINESS INFORMATION START###################//
		$step_id = 1;
		if(!empty($postData['client_code'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'client_code', $postData['client_code']);
		}
		if(!empty($postData['business_type'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'business_type', $postData['business_type']);
		}
		if(!empty($postData['business_name'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'business_name', $postData['business_name']);
		}
		if(!empty($postData['registration_number'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'registration_number', $postData['registration_number']);
		}
		if(!empty($postData['incorporation_date'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'incorporation_date', $postData['incorporation_date']);
		}
		if(!empty($postData['registered_date'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'registered_date', $postData['registered_date']);
		}
		if(!empty($postData['business_desc'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'business_desc', $postData['business_desc']);
		}
		if(!empty($postData['made_up_date'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'made_up_date', $postData['made_up_date']);
		}
		if(!empty($postData['next_ret_due'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'next_ret_due', $postData['next_ret_due']);
		}
		if(!empty($postData['ch_auth_code'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'ch_auth_code', $postData['ch_auth_code']);
		}
		if(!empty($postData['acc_ref_day']) && !empty($postData['acc_ref_month'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'acc_ref_date', $postData['acc_ref_day'].'-'.$postData['acc_ref_month']);
		}
		if(!empty($postData['last_acc_madeup_date'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'last_acc_madeup_date', $postData['last_acc_madeup_date']);
		}
		if(!empty($postData['next_acc_due'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'next_acc_due', $postData['next_acc_due']);
		}
//#############BUSINESS INFORMATION END###################//

//#############TAX INFORMATION START###################//
		$step_id = 2;
		if(!empty($postData['reg_for_vat'])){

			if(!empty($postData['effective_date'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'effective_date', $postData['effective_date']);
			}
			if(!empty($postData['vat_number'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'vat_number', $postData['vat_number']);
			}
			if(!empty($postData['vat_scheme'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'vat_scheme', $postData['vat_scheme']);
			}
			if(!empty($postData['vat_scheme_cash'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'vat_scheme_cash', $postData['vat_scheme_cash']);
			}
			if(!empty($postData['vat_scheme_accrual'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'vat_scheme_accrual', $postData['vat_scheme_accrual']);
			}
			if(!empty($postData['ret_frequency'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'ret_frequency', $postData['ret_frequency']);
			}
			if(!empty($postData['vat_stagger'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'vat_stagger', $postData['vat_stagger']);
			}
		}
		if(!empty($postData['ec_scale_list'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'ec_scale_list', $postData['ec_scale_list']);
		}

		if(!empty($postData['tax_div'])){
			if(!empty($postData['tax_reference'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_reference', $postData['tax_reference']);
			}
			if(!empty($postData['tax_reference_type'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_reference_type', $postData['tax_reference_type']);
			}
			if(!empty($postData['tax_district'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'tax_district', $postData['tax_district']);
			}
			if(!empty($postData['postal_address'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'postal_address', $postData['postal_address']);
			}
			if(!empty($postData['post_code'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'post_code', $postData['post_code']);
			}
			if(!empty($postData['telephone'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'telephone', $postData['telephone']);
			}
		}

		if(!empty($postData['paye_reg'])){
			if(!empty($postData['cis_registered'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cis_registered', $postData['cis_registered']);
			}

			if(!empty($postData['acc_office_ref'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'acc_office_ref', $postData['acc_office_ref']);
			}
			if(!empty($postData['paye_reference'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'paye_reference', $postData['paye_reference']);
			}
			if(!empty($postData['paye_district'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'paye_district', $postData['paye_district']);
			}
			if(!empty($postData['employer_office'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'employer_office', $postData['employer_office']);
			}
			if(!empty($postData['employer_postcode'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'employer_postcode', $postData['employer_postcode']);
			}
			if(!empty($postData['employer_telephone'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'employer_telephone', $postData['employer_telephone']);
			}
		}

//#############TAX INFORMATION END###################//

//#############CONTACT INFORMATION START###################//
		$step_id = 3;
		if(!empty($postData['reg_office_addr'])){
			if(!empty($postData['cont_addr_type'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_addr_type', $postData['cont_addr_type']);
			}
			if(!empty($postData['cont_name'])){
				$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_name', $postData['cont_name']);
			}
		}
		if(!empty($postData['cont_addr_line1'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_addr_line1', $postData['cont_addr_line1']);
		}
		if(!empty($postData['cont_addr_line2'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_addr_line2', $postData['cont_addr_line2']);
		}
		if(!empty($postData['cont_city'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_city', $postData['cont_city']);
		}
		if(!empty($postData['cont_county'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_county', $postData['cont_county']);
		}
		if(!empty($postData['cont_postcode'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_postcode', $postData['cont_postcode']);
		}
		if(!empty($postData['cont_country'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_country', $postData['cont_country']);
		}
		if(!empty($postData['cont_trad_addr'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_trad_addr', $postData['cont_trad_addr']);
		}
		if(!empty($postData['cont_corres_addr'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_corres_addr', $postData['cont_corres_addr']);
		}
		if(!empty($postData['cont_banker_addr'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_banker_addr', $postData['cont_banker_addr']);
		}
		if(!empty($postData['cont_trad_addr'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_trad_addr', $postData['cont_trad_addr']);
		}
		if(!empty($postData['cont_old_acc_addr'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_old_acc_addr', $postData['cont_old_acc_addr']);
		}
		if(!empty($postData['cont_auditors_addr'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_auditors_addr', $postData['cont_auditors_addr']);
		}
		if(!empty($postData['cont_solicitors_addr'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_solicitors_addr', $postData['cont_solicitors_addr']);
		}
		if(!empty($postData['cont_others_addr'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'cont_others_addr', $postData['cont_others_addr']);
		}
		if(!empty($postData['notes'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'notes', $postData['notes']);
		}
//############# CONTACT INFORMATION END ###################//

//############# RELATIONSHIP START ###################//
		if(!empty($postData['app_hidd_array'])){
			$relData	= array();
			$app_hidd_array = explode(",", $postData['app_hidd_array']);//print_r($app_hidd_array);
			foreach($app_hidd_array as $row){
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
		if(!empty($postData['bank_name'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'bank_name', $postData['bank_name']);
		}
		if(!empty($postData['bank_short_code'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'bank_short_code', $postData['bank_short_code']);
		}
		if(!empty($postData['bank_acc_no'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'bank_acc_no', $postData['bank_acc_no']);
		}
		if(!empty($postData['bank_mark_source'])){
			$arrData[] = $this->save_client($user_id, $client_id, $step_id, 'bank_mark_source', $postData['bank_mark_source']);
		}
//############# OTHERS INFORMATION END ###################//



		StepsFieldsClient::insert($arrData);
		return Redirect::to('/organisation/add-client'); 
	}

	public function save_client($user_id, $client_id, $step_id, $field_name, $field_value)
	{
		$data = array();
		$data['user_id']		= $user_id;
		$data['client_id']		= $client_id;
		$data['step_id']		= $step_id;
		$data['field_name']		= $field_name;
		$data['field_value']	= $field_value;
		return $data;
		//OrganisationClient::insert($data);
	}

	/*public function save_client($user_id, $step_id, $field_name, $field_value)
	{
		$arrData = array( 
	        "user_id"      => 1,
	        "step_id"       => 1, 
	        "field_name"       => 'client_code', 
	        "field_value"    => $postData['client_code']
	    );
	    return $arrData;
	}*/

}
