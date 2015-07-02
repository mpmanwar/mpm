<?php
class Common extends Eloquent {

	public $timestamps = false;
	
	private function getApiKey()
	{
		$API_KEY = "hYeDtvCEXMaqkoQnzPv29P8HccoBGmQoyt6fhjqj";
		return $API_KEY;
	}
	public static function getGroupId($user_id)
	{
		$users	= User::where('user_id', '=', $user_id)->select("parent_id")->first();
    	if (isset($users) && count($users) >0 && $users['parent_id'] !=0) { 
    		$user_id = Common::getGroupId($users['parent_id']);   
		}
    	return $user_id;
	}

	public static function getUserIdByGroupId($group_id)
	{
		$groupUserId = array();
		$users = User::where("group_id", "=", $group_id)->select("user_id")->get();
		if(isset($users) && count($users) >0 ){
			foreach($users as $key=>$user_id){
				$groupUserId[$key]['user_id']	= $user_id->user_id;
			}
		}
		
		return $groupUserId;
	}

	public static function getUserAccess($user_id)
	{
		$user_access   = UserAccess::where("user_id", "=", $user_id)->where("access_id", "=", 5)->first();
        if(isset($user_access) && count($user_access) > 0){
            $return = 'Y';
        }else{
            $return = 'N';
        }

        return $return;
	}

	public static function getCompanyDetails($int)
	{
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, 'http://data.companieshouse.gov.uk/doc/company/' . $int . '.json'); 
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    curl_setopt($ch, CURLOPT_TIMEOUT, '10');
	    
	    $result = curl_exec($ch);
	    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    
	    curl_close($ch);
	    
	    switch($status)
	    {
	        case '200':
	            return json_decode($result);
	            break;
	        
	        default:
	            return false;
	            break;
	    }
	}

	public static function getCompanyData($int)
	{
		$jsontoken = shell_exec("curl -XGET -u hYeDtvCEXMaqkoQnzPv29P8HccoBGmQoyt6fhjqj: https://api.companieshouse.gov.uk/company/".$int);
		return json_decode($jsontoken);
	}

	public static function getOfficerDetails($int)
	{
		$jsontoken = shell_exec("curl -XGET -u hYeDtvCEXMaqkoQnzPv29P8HccoBGmQoyt6fhjqj: https://api.companieshouse.gov.uk/company/".$int."/officers");
		return json_decode($jsontoken);
	}

	public static function getFillingHistory($int)
	{
		$jsontoken = shell_exec("curl -XGET -u hYeDtvCEXMaqkoQnzPv29P8HccoBGmQoyt6fhjqj: https://api.companieshouse.gov.uk/company/".$int."/filing-history");
		return json_decode($jsontoken);
	}

	public static function getRegisteredOffice($int)
	{
		$jsontoken = shell_exec("curl -XGET -u hYeDtvCEXMaqkoQnzPv29P8HccoBGmQoyt6fhjqj: https://api.companieshouse.gov.uk/company/".$int."/registered-office-address");
		return json_decode($jsontoken);
	}

	public static function getCharges($int)
	{
		$jsontoken = shell_exec("curl -XGET -u hYeDtvCEXMaqkoQnzPv29P8HccoBGmQoyt6fhjqj: https://api.companieshouse.gov.uk/company/".$int."/charges");
		return json_decode($jsontoken);
	}

	public static function getInsolvency($int)
	{
		$jsontoken = shell_exec("curl -XGET -u hYeDtvCEXMaqkoQnzPv29P8HccoBGmQoyt6fhjqj: https://api.companieshouse.gov.uk/company/".$int."/insolvency");
		return json_decode($jsontoken);
	}

	public static function getSearchCompany($value)
	{//&items_per_page=5&start_index=2
		$jsontoken = shell_exec("curl -XGET -u hYeDtvCEXMaqkoQnzPv29P8HccoBGmQoyt6fhjqj: https://api.companieshouse.gov.uk/search?q=".$value);
		return json_decode($jsontoken);
	}

	public static function getDayCount($from)
	{
		$from = str_replace("/", "-", $from);
		$arr = explode('/', $from);
		$days = 0;
		if( $from != "" ){
			$date1 = $arr[2].'-'.$arr[1].'-'.$arr[0];
			$date2 = date("Y-m-d");
			//echo $date2;die;

			$diff = abs(strtotime($date2) - strtotime($date1));
			$days = round($diff/86400);
		}
		
		return $days;
	}

	public static function clientDetailsById($client_id)
	{
		$client_data = array();

		$clients = Client::where('client_id', '=', $client_id)->first();
		$client_data['is_archive'] 		= $clients['is_archive'];
		$client_data['is_relation_add'] = $clients['is_relation_add'];
		$client_data['type'] 			= $clients['type'];
		$client_data['user_id'] 		= $clients['user_id'];
		$client_data['is_deleted'] 		= $clients['is_deleted'];


		$client_details = StepsFieldsClient::where('client_id', '=', $client_id)->select("field_id", "field_name", "field_value")->get();

		$client_data['client_id'] 		= $client_id;

		$appointment_name = ClientRelationship::where('client_id', '=', $client_id)->select("appointment_with")->first();
		//echo $this->last_query();//die;
		$relation_name = StepsFieldsClient::where('client_id', '=', $appointment_name['appointment_with'])->where('field_name', '=', "business_name")->select("field_value")->first();

		if (isset($client_details) && count($client_details) > 0) {
			$address = "";

			foreach ($client_details as $client_row) {
				//get staff name start
				if (!empty($client_row['field_name']) && $client_row['field_name'] == "resp_staff") {
					$staff_name = User::where('user_id', '=', $client_row->field_value)->select("fname", "lname")->first();
					//echo $this->last_query();die;
					$client_data['staff_name'] = strtoupper(substr($staff_name['fname'], 0, 1)) . " " . strtoupper(substr($staff_name['lname'], 0, 1));
				}
				//get staff name end

				//get business name start
				if (!empty($relation_name['field_value'])) {
					$client_data['business_name'] = $relation_name['field_value'];
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
					$client_data[$client_row['field_name']] = $business_type['name'];
				} else {
					$client_data[$client_row['field_name']] = $client_row->field_value;
				}

			}

			$client_data['address'] = substr($address, 0, -2);
			
		}

		return $client_data;
	}

	public static function get_acting_client($client_id)
	{
		$acting_client = array();
		$data 	= array();
		$data1 	= array();
		$data2 	= array();

		$acting_client1 = ClientActing::where("client_id", "=", $client_id)->get();
		
        if(isset($acting_client1) && count($acting_client1) >0 ){
        	foreach ($acting_client1 as $key => $row) {
        		$clientId =  $row->acting_client_id;
        		
        		$client_name = StepsFieldsClient::where("field_name", "=", 'business_name')->where("client_id", "=", $clientId)->first();
        		
        		if(isset($client_name) && count($client_name) >0 ){
        			$data1[$key]['name'] = $client_name['field_value'];
        		}else{
        			$client_details = StepsFieldsClient::where("step_id", "=", 1)->where("client_id", "=", $clientId)->get();
	        		
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
        				$data1[$key]['name'] = trim($name);
        				
        			}
        			
        		}
        		$data1[$key]['acting_id'] 			= $row->acting_id;
        		$data1[$key]['user_id'] 			= $row->user_id;
        		$data1[$key]['client_id'] 			= $row->client_id;
        		$data1[$key]['acting_client_id'] 	= $row->acting_client_id;

        		//######## get client type #########//
				$client_data = Client::where("client_id", "=", $row->acting_client_id)->first();
				if(isset($client_data) && count($client_data) >0){
					if($client_data['type'] == "ind"){
						$data1[$key]['link'] = "/client/edit-ind-client/".$row->acting_client_id;
					}
					else if($client_data['type'] == "org"){
						$data1[$key]['link'] = "/client/edit-org-client/".$row->acting_client_id;
					}else if($client_data['type'] == "chd"){
						if($client_data['chd_type'] == "ind"){
							$data1[$key]['link'] = "/client/edit-ind-client/".$row->acting_client_id;
						}
						else if($client_data['chd_type'] == "org"){
							$data1[$key]['link'] = "/client/edit-org-client/".$row->acting_client_id;
						}else{
							$data1[$key]['link'] = "";
						}
					}else{
						$data1[$key]['link'] = "";
					}
					
				}
				//######## get client type #########//

        	}
        }


        $acting_client2 = ClientActing::where("acting_client_id", "=", $client_id)->get();
        if(isset($acting_client2) && count($acting_client2) >0 ){
        	foreach ($acting_client2 as $key => $row) {
        		$clientId =  $row->client_id;
        		
        		$client_name = StepsFieldsClient::where("field_name", "=", 'business_name')->where("client_id", "=", $clientId)->first();
        		
        		if(isset($client_name) && count($client_name) >0 ){
        			$data2[$key]['name'] = $client_name['field_value'];
        		}else{
        			$client_details = StepsFieldsClient::where("step_id", "=", 1)->where("client_id", "=", $clientId)->get();
	        		
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
        				$data2[$key]['name'] = trim($name);
        				
        			}
        			
        		}
        		$data2[$key]['acting_id'] 			= $row->acting_id;
        		$data2[$key]['user_id'] 			= $row->user_id;
        		$data2[$key]['client_id'] 			= $row->acting_client_id;
        		$data2[$key]['acting_client_id'] 	= $row->client_id;

        		//######## get client type #########//
				$client_data = Client::where("client_id", "=", $row->client_id)->first();
				if(isset($client_data) && count($client_data) >0){
					if($client_data['type'] == "ind"){
						$data2[$key]['link'] = "/client/edit-ind-client/".$row->client_id;
					}
					else if($client_data['type'] == "org"){
						$data2[$key]['link'] = "/client/edit-org-client/".$row->client_id;
					}else if($client_data['type'] == "chd"){
						if($client_data['chd_type'] == "ind"){
							$data2[$key]['link'] = "/client/edit-ind-client/".$row->client_id;
						}
						else if($client_data['chd_type'] == "org"){
							$data2[$key]['link'] = "/client/edit-org-client/".$row->client_id;
						}else{
							$data2[$key]['link'] = "";
						}
					}else{
						$data2[$key]['link'] = "";
					}
					
				}
				//######## get client type #########//

        	}
        }

        $acting = array_merge($data1, $data2);//print_r($acting);die;
        $i = 0;
        foreach ($acting as $key => $value) {
        	if(isset($value['name']) && $value['name'] != ""){
        		$client_value = Client::where("is_deleted", "=", "N")->where("client_id", "=", $value['acting_client_id'])->first();
        		if(isset($client_value['is_archive']) && $client_value['is_archive'] == "N"){
        			$data[$i]['name'] 				= $value['name'];
	        		$data[$i]['acting_id'] 			= $value['acting_id'];
	        		$data[$i]['user_id'] 			= $value['user_id'];
	        		$data[$i]['client_id'] 			= $value['client_id'];
	        		$data[$i]['acting_client_id'] 	= $value['acting_client_id'];
	        		$data[$i]['link'] 				= $value['link'];
	        		$i++;
        		}
        		
        	}
        }
        return $data;
	}


	public static function get_relationship_client($client_id)
	{
		$data = array();
		$data1 = array();
		$data2 = array();

		$relationship1 = DB::table('client_relationships as cr')->where("cr.client_id", "=", $client_id)
            ->join('relationship_types as rt', 'cr.relationship_type_id', '=', 'rt.relation_type_id')
            ->select('cr.client_relationship_id', 'rt.relation_type', 'cr.appointment_with as client_id', 'cr.acting')->get();

		if(isset($relationship1) && count($relationship1) >0 )
        {
        	foreach ($relationship1 as $key => $row) {
        		$client_name = StepsFieldsClient::where("field_name", "=", 'business_name')->where("client_id", "=", $row->client_id)->first();
        		if(isset($client_name) && count($client_name) >0 ){
        			$data1[$key]['name'] = $client_name['field_value'];
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
        				$data1[$key]['name'] = trim($name);
        				
        				        				
        			}
        			
        		}
       		    $data1[$key]['client_relationship_id'] 	= $row->client_relationship_id;
        		$data1[$key]['relation_type'] 			= $row->relation_type;
        		$data1[$key]['acting'] 					= $row->acting;
        		$data1[$key]['client_id'] 				= $row->client_id;
        		
			}
        }

        $relationship2 = DB::table('client_relationships as cr')->where("cr.appointment_with", "=", $client_id)
            ->join('relationship_types as rt', 'cr.relationship_type_id', '=', 'rt.relation_type_id')
            ->select('cr.client_relationship_id', 'rt.relation_type', 'cr.client_id', 'cr.acting')->get();

       	if(isset($relationship2) && count($relationship2) >0 )
        {
        	foreach ($relationship2 as $key => $row) {
        		$client_name = StepsFieldsClient::where("field_name", "=", 'business_name')->where("client_id", "=", $row->client_id)->first();
        		if(isset($client_name) && count($client_name) >0 ){
        			$data2[$key]['name'] = $client_name['field_value'];
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
        				$data2[$key]['name'] = trim($name);
        				
        				        				
        			}
        			
        		}
       		    $data2[$key]['client_relationship_id'] 	= $row->client_relationship_id;
        		$data2[$key]['relation_type'] 			= $row->relation_type;
        		$data2[$key]['acting'] 					= $row->acting;
        		$data2[$key]['client_id'] 				= $row->client_id;
        		
			}
        }

        $relationship = array_merge($data1, $data2);//print_r($relationship);die;
        $i = 0;
        foreach ($relationship as $key => $value) {
        	if(isset($value['name']) && $value['name'] != ""){
        		
        		$data[$i]['name'] 					= $value['name'];
        		$data[$i]['client_relationship_id'] = $value['client_relationship_id'];
        		$data[$i]['relation_type'] 			= $value['relation_type'];
        		$data[$i]['acting'] 				= $value['acting'];
        		$data[$i]['client_id'] 				= $value['client_id'];
        		$i++;
	        	
        	}
        }
        return $data;
	}

	public static function get_services_client($client_id)
	{
		$data2 = array();
		$service = DB::table('client_services as cs')->where("cs.client_id", "=", $client_id)
            ->join('services as s', 'cs.service_id', '=', 's.service_id')
            ->join('users as u', 'cs.staff_id', '=', 'u.user_id')
            ->select('cs.*', 'u.fname', 'u.lname', 's.service_name')->get();
        if(isset($service) && count($service) >0 )
        {
        	foreach ($service as $key => $row) {
        		$data2[$key]['client_service_id'] 	= $row->client_service_id;
        		$data2[$key]['client_id'] 			= $row->client_id;
        		$data2[$key]['service_id'] 			= $row->service_id;
        		$data2[$key]['user_id'] 			= $row->staff_id;
        		$data2[$key]['name'] 				= $row->fname." ".$row->fname;
        		$data2[$key]['service_name'] 		= $row->service_name;
        		
        	}
        }
        return $data2;
        exit;

	}

	
}
