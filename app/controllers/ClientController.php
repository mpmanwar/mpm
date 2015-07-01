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
		$data['substep'] 			= Step::whereIn("user_id", $groupUserId)->where("client_type", "=", "ind")->where("parent_id", "=", 1)->orderBy("step_id")->get();
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

		
		$data['relationship'] 	 = Common::get_relationship_client($client_id);
		$data['acting'] 		 = Common::get_acting_client($client_id);
		$data['acting_dropdown'] = $this->get_acting_dropdown( $data['relationship'], $data['acting'] );
        

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

		$data['old_org_types'] = OrganisationType::where("client_type", "=", "all")->orderBy("name")->get();
		$data['new_org_types'] = OrganisationType::where("client_type", "=", "org")->whereIn("user_id", $groupUserId)->where("status", "=", "new")->orderBy("name")->get();

		$data['rel_types'] 		= RelationshipType::orderBy("relation_type_id")->get();
		$data['steps'] 			= Step::where("status", "=", "old")->orderBy("step_id")->get();
		$data['substep'] 	= Step::where("client_type", "=", "org")->where("parent_id", "=", 1)->whereIn("user_id", $groupUserId)->orderBy("step_id")->get();
		$data['staff_details'] 	= User::whereIn("user_id", $groupUserId)->select("user_id", "fname", "lname")->get();
		$data['tax_office'] 	= TaxOfficeAddress::select("parent_id", "office_id", "office_name")->get();


		$first_serv = DB::table('services')->where("status", "=", "old")->where("user_id", "=", 0);
		
        $data['services'] 		= Service::where("status", "=", "new")->whereIn("user_id", $groupUserId)->union($first_serv)->orderBy("service_id")->get();

		$data['old_services'] 	= Service::where("status", "=", "old")->orderBy("service_name")->get();
		$data['new_services'] 	= Service::where("status", "=", "new")->whereIn("user_id", $groupUserId)->orderBy("service_name")->get();


        $data['countries'] 		= Country::orderBy('country_name')->get();
		$data['field_types'] 	= FieldType::get();

		$data['old_vat_schemes'] = VatScheme::where("status", "=", "old")->orderBy("vat_scheme_name")->get();
		$data['new_vat_schemes'] = VatScheme::where("status", "=", "new")->whereIn("user_id", $groupUserId)->orderBy("vat_scheme_name")->get();
		//echo $this->last_query();die;
		//$data['cont_address'] 	 = App::make("HomeController")->getAllOrgContactAddress();
		$data['cont_address'] 	 = App::make("HomeController")->get_orgcontact_address();
		$data['allClients'] 	 = App::make("HomeController")->get_all_clients();
        
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
		//print_r($data['subsections']);die;
		
		$data['relationship'] 		= Common::get_relationship_client($client_id);
		$data['acting'] 			= Common::get_acting_client($client_id);
		$data['acting_dropdown'] 	= $this->get_acting_dropdown( $data['relationship'], $data['acting'] );
		//print_r($data['acting_dropdown']);die;

		$client_details = StepsFieldsClient::where('client_id', '=', $client_id)->select("field_id", "field_name", "field_value")->get();

		$client_data['client_id'] 		= $client_id;	

        if (isset($client_details) && count($client_details) > 0) {
			foreach ($client_details as $client_row) {
				$client_data[$client_row['field_name']] = $client_row->field_value;
			}
		}

		$data['months'] =	array("01"=>"JAN", "02"=>"FEB", "03"=>"MAR", "04"=>"APR", "05"=>"MAY", "06"=>"JUN","07"=>"JUL", "08"=>"AUG", "09"=>"SEPT", "10"=>"OCT", "11"=>"NOV", "12"=>"DEC");

		$data['client_details'] 	=	$client_data;
       
       	$data['services_table'] 	=   Common::get_services_client($client_id);;
      	//echo $this->last_query();
   		//print_r($data['services']);die;      

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
			$del_data['is_deleted'] = "Y";
			Client::where('client_id', '=', $client_id)->update($del_data);
			//Client::where('client_id', '=', $client_id)->delete();
			//StepsFieldsClient::where('client_id', '=', $client_id)->delete();
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
			$client_ids = Client::where('is_deleted', '=', "N")->whereIn("user_id", $groupUserId)->where('type', '=', "ind")->where('client_id', '=', $client_id)->where('user_id', '=', $user_id)->select("client_id")->get();
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
			$client_ids = Client::where('is_deleted', '=', "N")->whereIn("user_id", $groupUserId)->where('type', '=', "org")->where('client_id', '=', $client_id)->where('user_id', '=', $user_id)->select("client_id")->get();
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

	public function delete_client_services() {
		$client_service_id = Input::get("client_service_id");
		if (Request::ajax()) {
			$data = ClientService::where("client_service_id", "=", $client_service_id)->delete();
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
    
    
    
    
    public function delete_editservices(){
        //die('asfafa');
        //echo $client_id;
         $delete_id = Input::get("delete_id");
         $client_id= Input::get("client_id");
        
        $row= ClientService::where("client_service_id", "=", $delete_id)->delete();
        
        $str = '<table width="100%" class="table table-bordered table-hover dataTable" id="myServTable">
                  <input type="hidden" id="serv_hidd_array" name="serv_hidd_array" value="">
                    <tr>
                      <td align="center"><strong>Service</strong></td>
                      <td align="center"><strong>Staff</strong></td>
                      <td align="center"><strong>Action</strong></td>
                    </tr>';
        $arr = array();
        $arr['service'] =   DB::table('client_services')->where("client_id", "=", $client_id)->get();
        
        foreach($arr['service'] as $key=>$service_row){
                        
                $arr['service'][$key]->servicedetails =  DB::table('services')->where("service_id", "=", $service_row->service_id)->first();
                $arr['service'][$key]->staffcedetails =  DB::table('users')->where("user_id", "=", $service_row->staff_id)->first();   
        }
        $data['servicessss']=$arr['service']; 
        $arr = array();
            $arr1 = array();
            $i=0;
            if(!empty($data['servicessss'] )){
            foreach($data['servicessss'] as $key=>$val){
            
            $arr[$key] = $val->servicedetails; 
            $arr1[$key] = $val->staffcedetails;
            $str .= '<tr id="added_service_tr'.$key.'">
            <td align="center">'.$arr[$key]->service_name.'</td>
            <td align="center">'.$arr1[$key]->fname.' '.$arr1[$key]->lname.'</td>
            <td align="center"><a href="javascript:void(0)" class="edit_service" data-edit_index="'.$key.'" id="'.$key.'"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" class="delete_client_service"  data-delete_index="'.$key.'" id="'.$val->client_service_id.'*'.$val->client_id.'"><i class="fa fa-trash-o fa-fw"></i><input type="hidden" value="'.$arr[$key]->service_id.'" id="stafftxt_id'.$key.'" name="stafftxt_id[]"><input type="hidden" value="'.$arr1[$key]->user_id.'" id="servicetxt_id'.$key.'" name="servicetxt_id[]"></td>
            </tr>';
            $i++;
            }
        }  
        $str .= '</table>';   
        //$str1 = count($data['servicessss']);   
        echo $str;
        
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

	public function get_corporation_address() {
		$office_address = array();
		$office_id = Input::get("office_id");
		if (Request::ajax()) {
			$office_address = CorporationTaxOffice::where("corp_tax_id", "=", $office_id)->first();
			//echo $this->last_query();die;
		}

		echo json_encode($office_address);
		exit();
	}

	public function acting_relationship() {
		$return_data = array();
		$client_details = array();
		$acting_client_id = Input::get("acting_client_id");
		$client_details = Common::clientDetailsById($acting_client_id);

		if(isset($client_details['business_name']) && $client_details['business_name'] != "" ){
        	$name = $client_details['business_name'];
      	}else{
        	$name = $client_details['client_name'];
      	}


      	$client_data = Client::where("client_id", "=", $acting_client_id)->first();
		if(isset($client_data) && count($client_data) >0){
			if($client_data['type'] == "ind"){
				$link = "/client/edit-ind-client/".$acting_client_id;
			}
			else if($client_data['type'] == "org"){
				$link = "/client/edit-org-client/".$acting_client_id;
			}else{
				$link = "";
			}
			
		}

		$return_data['name'] = $name;
		$return_data['link'] = $link;
		echo json_encode($return_data);
		exit();
	}

	public function add_to_client()
	{
		$session 		= Session::get('admin_details');
		$user_id 		= $session['id'];

		$type = Input::get("type");
		

		$date_add['type'] 				= $type;
		$date_add['user_id'] 			= $user_id;
		$date_add['is_relation_add'] 	= "Y";

		$client_id = Client::insertGetId($date_add);
		
		$step_id = 1;
		if(isset($type) && $type == 'ind'){
			$title = Input::get("title");
			$fname = Input::get("fname");
			$mname = Input::get("mname");
			$lname = Input::get("lname");

			$client_name = "";
			if (isset($title) && $title != "") {
				$client_name.=$title." ";
				$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'title', $title);
			}
			if (isset($fname) && $fname != "") {
				$client_name.=$fname." ";
				$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'fname', $fname);
			}
			if (isset($mname) && $mname != "") {
				$client_name.=$mname." ";
				$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'mname', $mname);
			}
			if (isset($lname) && $lname != "") {
				$client_name.=$lname;
				$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'lname', $lname);
			}
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'client_name', trim($client_name));
		}

		if(isset($type) && $type == 'org'){
			$name = Input::get("name");
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'business_name', $name);
		}
		
		$query = StepsFieldsClient::insert($arrData);
		if($query){
			$ret_val = $client_id;
		}else{
			$ret_val = 0;
		}
		echo $ret_val;exit;

	}

	public function delete_acting()
	{
		$delete_index = Input::get("delete_index");
		$resp = ClientActing::where("acting_id", "=", $delete_index)->delete();
		echo $resp;
	}

	public function save_database_acting()
	{
		$acting_client_id 	= Input::get("acting_client_id");
		$acting_id 			= Input::get("acting_id");

		$data['acting_client_id'] 	= $acting_client_id;
		ClientActing::where("acting_id", "=", $acting_id)->update($data);
		
		$client_details = Common::clientDetailsById($acting_client_id);

		if(isset($client_details['business_name']) && $client_details['business_name'] != "" ){
        	$name = $client_details['business_name'];
      	}else{
        	$name = $client_details['client_name'];
      	}

		$return_data['name'] = $name;
		echo json_encode($return_data);
		exit();

	}

	public function get_name_and_type()
	{
		$data['allClients'] 	= App::make("HomeController")->get_all_clients();
		$data['rel_types'] 		= RelationshipType::orderBy("relation_type_id")->get();

		echo json_encode($data);
		exit();
	}

	public function delete_addtolist_client()
	{
		$client_id 	= Input::get("client_id");
		$client_details = Client::where("is_relation_add", "=", "Y")->where("client_id", "=", $client_id)->first();
		if(isset($client_details) && count($client_details) >0 )
		{
			Client::where("client_id", "=", $client_id)->delete();
		}
		echo 1;
	}

	public function get_acting_dropdown($relationship, $acting)
	{
		$acting_dropdown = array();
		if(isset($relationship) && count($relationship)){
			foreach ($relationship as $key => $value) {
				$getValue = $this->is_in_array($acting, 'acting_client_id', $value['client_id']);
				if($getValue == "yes"){
					$acting_dropdown[] = $value['client_id'];
				}
			}
		}
		return $acting_dropdown;
	}

	public function is_in_array($array, $key, $key_value){
		$within_array = 'no';
		foreach( $array as $k=>$v ){
	        if( is_array($v) ){
	            $within_array = $this->is_in_array($v, $key, $key_value);
	            if( $within_array == 'yes' ){
	                break;
	            }
	        } else {
                if( $v == $key_value && $k == $key ){
                    $within_array = 'yes';
                    break;
                }
	        }
        }
      return $within_array;
	}
}
