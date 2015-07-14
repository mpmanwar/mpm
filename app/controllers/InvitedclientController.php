<?php

class InvitedclientController extends BaseController {

	
	public function Invitedclient_dashboard() {
	    $session 	= Session::get('admin_details');
		$user_id 	= $session['id'];
		$user_type 	= $session['user_type'];
		if(!isset($user_id) && $user_id == ""){
			return Redirect::to('/');
		}else if(isset($user_type) && $user_type != "C"){
			return Redirect::to('/dashboard');
		}

		$data['heading'] 		= "";
		$data['title'] 			= "Client Portal";
		$data['client_id'] 		= $session['client_id'];
		$value = $data['client_id']."="."function";
		//$data['relation_list'] 	= App::make("UserController")->get_relation_client($value);
		$data['relation_list'] 	= $this->all_relation_client_details($user_id);
		return View::make('Invitedclient.Invitedclient', $data);
	}

	function all_relation_client_details($user_id)
	{

		$details = array();
		if( isset($user_id) && $user_id != "" )
		{
			$clients = DB::table('user_related_companies as urc')->where("urc.user_id", $user_id)
			->join('clients as c', 'c.client_id', "=", 'urc.client_id')
        	->join('steps_fields_clients as sfc', 'sfc.client_id', '=', 'c.client_id')
        	->where('sfc.field_name', '=', 'business_name')
        	->where("c.type", "=", "org")
        	->select('c.client_id', 'sfc.field_value as client_name', 'urc.related_company_id', 'urc.status')->get();
        	//echo $this->last_query();die;
        	if( isset($clients) && count($clients) >0 ){
	        	foreach ($clients as $key => $value) {
	        		$details[$key]['related_company_id'] 	= $value->related_company_id;
	        		$details[$key]['client_id'] 			= $value->client_id;
	        		$details[$key]['client_name'] 			= $value->client_name;
	        		$details[$key]['status'] 				= $value->status;
	        	}
	        	
	        }
		}

		return $details;
	}
    
    
    public function my_details(){
        //die('yes');
        $admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
        $data['heading'] = "Invitedclient";
		$data['title'] = "Invitedclient";
        
        
        $client_ids = Client::where("type", "=", "org")->where('user_id', '=', $user_id)->select("client_id")->get();
        $data1 = array();
        foreach($client_ids as $key=>$client_id){
             
       $data1[$key] = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->where('field_name', '=', 'business_name')->select("field_value")->first();
             
            }
       $data['b_name']= $data1;
       
       $data['rel_types'] 	= RelationshipType::where("show_status", "=", "individual")->orderBy("relation_type_id")->get();

        $data['titles'] 		= Title::orderBy("title_id")->get();
       	$data['marital_status'] = MaritalStatus::orderBy("marital_status_id")->get();
        $data['countries'] 			= Country::orderBy('country_name')->get();
        $data['tax_office'] 	= TaxOfficeAddress::select("parent_id", "office_id", "office_name")->get();
		$data['tax_office_by_id'] 	= TaxOfficeAddress::where("office_id", "=", 1)->first();
   	    $data['steps'] 				= Step::where("status", "=", "old")->orderBy("step_id")->get();
        //echo "<pre>";print_r($data['b_name'][0]['field_value']);die;
		return View::make('Invitedclient.add_Invitedclient', $data);
    } 
    
    
    
   public function insert_invitedclient_client(){
    
        $postData = Input::all();
        //echo "<pre>";print_r($postData);die();
        
        $arrData = array();

		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
        
		$groupUserId = $admin_s['group_users'];
        
   
    
    echo $client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'ind')) ;
   
    //################ GENERAL SECTION START #################//
    
    $step_id = 1;
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


    StepsFieldsClient::insert($arrData);
    
    return Redirect::to('/invitedclient-details');
    
        
    
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
    
    
    
    public function relationship(){
        
        $admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];
        
        $data['heading'] = "Invitedclient rel";
		$data['title'] = "Invitedclient rel";
        
        
        
        $first = DB::table('organisation_types')->where("client_type", "=", "all")->where("status", "=", "old")->where("user_id", "=", 0);
		$data['org_types'] = OrganisationType::where("client_type", "=", "org")->where("status", "=", "new")->whereIn("user_id", $groupUserId)->union($first)->orderBy("organisation_id")->get();
        $data['reg_address'] 	= RegisteredAddress::get();
        
        
        $data['rel_types'] 		= RelationshipType::orderBy("relation_type_id")->get();
        $data['tax_office'] 	= TaxOfficeAddress::select("parent_id", "office_id", "office_name")->get();

		$first_serv = DB::table('services')->where("status", "=", "old")->where("user_id", "=", 0);
		$data['services'] 		= Service::where("status", "=", "new")->whereIn("user_id", $groupUserId)->union($first_serv)->orderBy("service_id")->get();
        $data['countries'] 		= Country::orderBy('country_name')->get();
		$data['field_types'] 	= FieldType::get();
        $first_vat = DB::table('vat_schemes')->where("status", "=", "old")->where("user_id", "=", 0);
		$data['vat_schemes'] 	= VatScheme::where("status", "=", "new")->whereIn("user_id", $groupUserId)->union($first_vat)->orderBy("vat_scheme_id")->get();
		
		return View::make('Invitedclient.add_relationship_client', $data);
        
    }
    
    
    public function insert_relationship_client(){
        
        //die('invitedclient-relationship');
        
        $postData = Input::all();
		$data = array();
		$arrData = array();
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		$client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'org'));
        
        
            //echo "<pre>";print_r($postData);die();
        
        //#############BUSINESS INFORMATION START###################//
		$step_id = 1;
	
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
        StepsFieldsClient::insert($arrData);
        
         return Redirect::to('/invitedclient-relationship');
        
        echo "<pre>"; print_r($arrData);die();
        
        
        
    }
    
    
    
    
    
    
    public function search_invited_client() {
        //die('search_invited_client');
		$data = array();
		$admin_s = Session::get('admin_details'); // session
		//$user_id = $admin_s['id']; //session user id
		$user_id = 10;
		$postData = Input::all();
        
		//$search_value = $postData['search_value'];

		echo $client_ids = Client::where("type", "=", "org")->where('user_id', '=', $user_id)->select("client_id")->get();
        
        foreach($client_ids as $key=>$client_id){
                //$data['b_name']=$client_id; die();
            //echo $client_id;
           echo $data['b_name'] = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->where('field_name', '=', 'business_name')->select("field_value")->get(); 
            echo $this->last_query();
        }
       
		
	//die; 
    }
    
   
}
