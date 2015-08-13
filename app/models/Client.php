<?php
class Client extends Eloquent {

	public $timestamps = false;

	public static function getAllOrgClientDetails()
	{
		$client_data = array();
		$session        = Session::get('admin_details');
        $user_id        = $session['id'];
        $groupUserId    = $session['group_users'];

		$client_ids = Client::where("is_deleted", "=", "N")->where("type", "=", "org")->where("is_archive", "=", "N")->where("is_relation_add", "=", "N")->whereIn("user_id", $groupUserId)->select("client_id", "show_archive", "ch_manage_task")->orderBy("client_id", "DESC")->get();
		//Common::last_query();die;
		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
			foreach ($client_ids as $client_id) {
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				$client_data[$i]['client_id'] = $client_id->client_id;
				//$client_data[$i]['ch_manage_task'] 	= $client_id->ch_manage_task;

				// ############### GET MANAGE TASK START ################## //
				$jobs = JobsManage::whereIn("user_id", $groupUserId)->where("client_id", "=", $client_id->client_id)->first();
				//Common::last_query();
		    	if(isset($jobs) && count($jobs) >0){
		    		$client_data[$i]['ch_manage_task'] 	= $jobs['status'];
		    	}else{
		    		$client_data[$i]['ch_manage_task'] 	= "N";
		    	}
				// ############### GET MANAGE TASK END ################## //

				// ############### GET CLIENT LIST ALLOCATION START ################## //
				$list = ClientListAllocation::where("client_id", "=", $client_id->client_id)->get();
				if(isset($list) && count($list) >0){
					foreach ($list as $key => $row) {
						$client_data[$i]['allocation'][$row['service_id']]['service_id'] = $row['service_id'];
						$client_data[$i]['allocation'][$row['service_id']]['staff_id1'] = $row['staff_id1'];
						$client_data[$i]['allocation'][$row['service_id']]['staff_id2'] = $row['staff_id2'];
						$client_data[$i]['allocation'][$row['service_id']]['staff_id3'] = $row['staff_id3'];
						$client_data[$i]['allocation'][$row['service_id']]['staff_id4'] = $row['staff_id4'];
						$client_data[$i]['allocation'][$row['service_id']]['staff_id5'] = $row['staff_id5'];
					}
				}
				// ############### GET CLIENT LIST ALLOCATION END ################## //

				// ############### GET JOB STATUS START ################## //
				$JobStatus = JobStatus::whereIn("user_id", $groupUserId)->where("is_completed", "=", "N")->where("client_id", "=", $client_id->client_id)->get();
				//print_r($JobStatus);die;
				if(isset($JobStatus) && count($JobStatus) >0){
					foreach ($JobStatus as $key => $status_row) {
						$service_id = $status_row['service_id'];
						$client_data[$i]['job_status'][$service_id]['job_status_id'] = $status_row['job_status_id'];
						$client_data[$i]['job_status'][$service_id]['client_id'] = $status_row['client_id'];
						$client_data[$i]['job_status'][$service_id]['service_id'] = $status_row['service_id'];
						$client_data[$i]['job_status'][$service_id]['status_id'] = $status_row['status_id'];
						$client_data[$i]['job_status'][$service_id]['created'] = $status_row['created'];
					}//print_r($client_data);//die;
				}
				// ############### GET JOB STATUS END ################## //

				// ############### GET OTHER SERVICES START ################## //
				$client_data[$i]['services_id'] 	=   Client::getServicesIdByClient($client_id->client_id);
				// ############### GET OTHER SERVICES END ################## //


				// ############### GET VAT SCHEME USER START ################## //
				$service = Common::get_services_client($client_id->client_id);
				if(isset($service) && count($service) > 0){
					foreach ($service as $key => $value) {
						if(isset($value['service_name']) && $value['service_name'] == "VAT"){
							//$client_data[$i]['vat_staff_name'] 	= $value['name'];
							$client_data[$i]['vat_staff_name'] 	= $value['service_name'];
						}
					}
				}
				//print_r($service);
				// ############### GET VAT SCHEME USER END ################## //

				if (isset($client_details) && count($client_details) > 0) {
					$corres_address = "";
					$res_address	= "";
					foreach ($client_details as $client_row) {

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

						if (isset($client_row['field_name']) && $client_row['field_name'] == "vat_scheme_type") 
						{
							$VatScheme = VatScheme::where('vat_scheme_id', '=', $client_row->field_value)->first();
							$client_data[$i]['vat_scheme_name'] = $VatScheme['vat_scheme_name'];
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

						// ############### GET REGISTERED ADDRESS START ################## //
						if (isset($client_row->field_name) && $client_row->field_name == "reg_cont_addr_line1"){
							$res_address .= $client_row->field_value.", ";
						}
						if (isset($client_row->field_name) && $client_row->field_name == "reg_cont_addr_line2"){
							$res_address .= $client_row->field_value.", ";
						}
						if (isset($client_row->field_name) && $client_row->field_name == "reg_cont_city"){
							$res_address .= $client_row->field_value.", ";
						}
						if (isset($client_row->field_name) && $client_row->field_name == "reg_cont_county"){
							$res_address .= $client_row->field_value.", ";
						}
						if (isset($client_row->field_name) && $client_row->field_name == "reg_cont_postcode"){
							$res_address .= $client_row->field_value.", ";
						}
						// ############### GET REGISTERED ADDRESS END ################## //
					}
					$client_data[$i]['corres_address'] = substr($corres_address, 0 ,-2);
					$client_data[$i]['res_address'] = substr($res_address, 0 ,-2);

					$i++;
				}

				//echo $this->last_query();die;
			}
		}
		//print_r($client_data);die;
		return $client_data;
	}

	public static function getAllIndClientDetails()
	{
		$client_data 		= array();
		$session 			= Session::get('admin_details');
		$user_id 			= $session['id'];
		$groupUserId 		= $session['group_users'];

		$client_ids = Client::where("is_deleted", "=", "N")->where("type", "=", "ind")->where("is_archive", "=", "N")->where("is_relation_add", "=", "N")->whereIn("user_id", $groupUserId)->select("client_id", "show_archive")->get();
		//echo $this->last_query();die;
		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
			foreach ($client_ids as $client_id) {
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				
                $client_data[$i]['client_id'] 		= $client_id->client_id;
                $client_data[$i]['show_archive'] 	= $client_id->show_archive;

                // ############### GET CLIENT LIST ALLOCATION START ################## //
				$list = ClientListAllocation::where("client_id", "=", $client_id->client_id)->get();
				if(isset($list) && count($list) >0){
					foreach ($list as $key => $row) {
						$client_data[$i]['allocation'][$row['service_id']]['service_id'] = $row['service_id'];
						$client_data[$i]['allocation'][$row['service_id']]['staff_id1'] = $row['staff_id1'];
						$client_data[$i]['allocation'][$row['service_id']]['staff_id2'] = $row['staff_id2'];
						$client_data[$i]['allocation'][$row['service_id']]['staff_id3'] = $row['staff_id3'];
						$client_data[$i]['allocation'][$row['service_id']]['staff_id4'] = $row['staff_id4'];
						$client_data[$i]['allocation'][$row['service_id']]['staff_id5'] = $row['staff_id5'];
					}
				}
				// ############### GET CLIENT LIST ALLOCATION END ################## //

				$client_data[$i]['services_id'] 	=   Client::getServicesIdByClient($client_id->client_id);

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

						$client_data[$i]['relationship'] 	= Common::get_relationship_client($client_id->client_id);
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
		//print_r($client_data);die;
		return $client_data;
	}

	public static function getServicesIdByClient($client_id)
	{
		$data = array();
		$services = ClientService::where("client_id", "=", $client_id)->get();
		/*$queries = DB::getQueryLog();
		$last_query = end($queries);
		echo $last_query['query']."client_id : ".$client_id;*/
		//print_r($services);
		if(isset($services) && count($services) >0){
			foreach ($services as $key => $value) {
				$data[$key] = $value->service_id;
			}
		}
		return $data;
	}


	public static function getUnassignedClientDetails($service_id)
	{
		$client_details = Client::getAllOrgClientDetails();
		if(isset($client_details) && count($client_details) >0){
			foreach ($client_details as $key => $value) {
				$alloc_clients = ClientListAllocation::where("client_id", "=", $value['client_id'])->where("service_id", "=", $service_id)->first();

				if(isset($alloc_clients) && count($alloc_clients) >0){
					if($alloc_clients['staff_id1'] != 0 || $alloc_clients['staff_id2'] != 0 || $alloc_clients['staff_id3'] != 0 || $alloc_clients['staff_id4'] != 0 || $alloc_clients['staff_id5'] != 0 ){
						unset($client_details[$key]);
					}
				}else{
					$client_details[$key]['jobs_notes'] = JobsNote::getNotesByClientAndServiceId($value['client_id'], $service_id);
				}

			}
		}

		return array_values($client_details);
	}


	public static function getAssignedClientDetails($service_id, $staff_id)
	{
		$client_array = array();
		$client_details = Client::getAllOrgClientDetails();
		if(isset($client_details) && count($client_details) >0){
			foreach ($client_details as $key => $value) {
				$alloc_clients = ClientListAllocation::where("client_id", "=", $value['client_id'])->where("service_id", "=", $service_id)->first();

				if(isset($alloc_clients) && count($alloc_clients) >0){
					if($alloc_clients['staff_id1'] == $staff_id || $alloc_clients['staff_id2'] == $staff_id || $alloc_clients['staff_id3'] == $staff_id || $alloc_clients['staff_id4'] == $staff_id || $alloc_clients['staff_id5'] == $staff_id ){
						$client_array[$key] = $client_details[$key];

						$client_array[$key]['jobs_notes'] = JobsNote::getNotesByClientAndServiceId($value['client_id'], $service_id);
					}
				}

			}
		}

		return array_values($client_array);
	}

	public static function getClientByServiceId( $service_id )
	{
		$client_array = array();
		$client_details = Client::getAllOrgClientDetails();
		if(isset($client_details) && count($client_details) >0){
			foreach ($client_details as $key => $details) {
				if((isset($details['services_id']) && in_array($service_id, $details['services_id']))){
					$client_array[$key] = $client_details[$key];
					$client_array[$key]['jobs_notes'] = JobsNote::getNotesByClientAndServiceId($details['client_id'], $service_id);
				}
			}
		}
		//print_r($client_array);die;
		return array_values($client_array);
	}




}
