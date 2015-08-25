<?php
class ContactAddress extends Eloquent {

	public $timestamps = false;

	public static function getAllContactDetails()
	{
		$data = array();
		$session 		= Session::get('admin_details');
		$user_id 		= $session['id'];
		$groupUserId 	= $session['group_users'];
		$contact_details = ContactAddress::whereIn("user_id", $groupUserId)->get();
		if(isset($contact_details) && count($contact_details) >0){
			foreach ($contact_details as $key => $details1) {
				$data[$key]['contact_id'] 		= $details1->contact_id;
				$data[$key]['user_id'] 			= $details1->user_id;
				$data[$key]['contact_type'] 	= $details1->contact_type;
				$data[$key]['contact_name'] 	= $details1->contact_name;
				$data[$key]['telephone_code'] 	= $details1->telephone_code;
				$data[$key]['telephone'] 		= $details1->telephone;
				$data[$key]['mobile_code'] 		= $details1->mobile_code;
		    	$data[$key]['mobile'] 			= $details1->mobile;
		    	$data[$key]['email'] 			= $details1->email;
		    	$data[$key]['website'] 			= $details1->website;
		    	$data[$key]['company_name'] 	= $details1->company_name;
				$data[$key]['addr_line1'] 		= $details1->addr_line1;
		    	$data[$key]['addr_line2'] 		= $details1->addr_line2;
		    	$data[$key]['city'] 			= $details1->city;
		    	$data[$key]['county'] 			= $details1->county;
		    	$data[$key]['postcode'] 		= $details1->postcode;
		    	$data[$key]['country'] 			= $details1->country;
		    	$data[$key]['address'] 			= $details1->addr_line1.", ".$details1->addr_line2.", ".$details1->city.", ".$details1->county.", ".$details1->postcode;
		    	if(isset($details1->contact_type) && $details1->contact_type == "company_name"){
		    		$data[$key]['name'] 			= $details1->company_name;
		    		$data[$key]['contact_person'] 	= $details1->contact_name;
		    	}else{
		    		$data[$key]['name'] 			= $details1->contact_name;
		    		$data[$key]['contact_person'] 	= "";
		    	}
			}
		}
		//print_r($data);
		return $data;
	}

	public static function getContactAddressByType($client_id, $type)
	{
		$data = array();
		$details = Common::clientDetailsById($client_id);
		if(isset($details) && count($details) >0){
			if($type == "tax_office"){

				if(isset($details['tax_address']) && $details['tax_address'] != ""){
					$data['address'] = $details['tax_address'];
				}else{
					$data['address'] = "";
				}
				if(isset($details['tax_telephone']) && $details['tax_telephone'] != ""){
					$data['telephone'] = $details['tax_telephone'];
				}else{
					$data['telephone'] = "";
				}
				$data['contact_person'] = "";
				$data['mobile'] 		= "";
				$data['email'] 			= "";

			}else if($type == "paye_emp"){

				if(isset($details['employer_office']) && $details['employer_office'] != ""){
					$data['address'] = $details['employer_office'];
				}else{
					$data['address'] = "";
				}
				if(isset($details['employer_telephone']) && $details['employer_telephone'] != ""){
					$data['telephone'] = $details['employer_telephone'];
				}else{
					$data['telephone'] = "";
				}
				$data['contact_person'] = "";
				$data['mobile'] 		= "";
				$data['email'] 			= "";

			}else{

				$address = "";
				if(isset($details[$type.'_cont_name']) && $details[$type.'_cont_name'] != ""){
					$data['contact_person'] = $details[$type.'_cont_name'];
				}else{
					$data['contact_person'] = "";
				}
				if(isset($details[$type.'_cont_telephone']) && $details[$type.'_cont_telephone'] != ""){
					$data['telephone'] = $details[$type.'_cont_telephone'];
				}else{
					$data['telephone'] = "";
				}
				if(isset($details[$type.'_cont_mobile']) && $details[$type.'_cont_mobile'] != ""){
					$data['mobile'] = $details[$type.'_cont_mobile'];
				}else{
					$data['mobile'] = "";
				}
				if(isset($details[$type.'_cont_email']) && $details[$type.'_cont_email'] != ""){
					$data['email'] = $details[$type.'_cont_email'];
				}else{
					$data['email'] = "";
				}
				if(isset($details[$type.'_cont_addr_line1']) && $details[$type.'_cont_addr_line1'] != ""){
					$address .= $details[$type.'_cont_addr_line1'].", ";
				}
				if(isset($details[$type.'_cont_addr_line2']) && $details[$type.'_cont_addr_line2'] != ""){
					$address .= $details[$type.'_cont_addr_line2'].", ";
				}
				if(isset($details[$type.'_cont_city']) && $details[$type.'_cont_city'] != ""){
					$address .= $details[$type.'_cont_city'].", ";
				}
				if(isset($details[$type.'_cont_county']) && $details[$type.'_cont_county'] != ""){
					$address .= $details[$type.'_cont_county'].", ";
				}
				if(isset($details[$type.'_cont_postcode']) && $details[$type.'_cont_postcode'] != ""){
					$address .= $details[$type.'_cont_postcode'].", ";
				}

				if($address != ""){
					$data['address'] = substr($address, 0, -2);
				}else{
					$data['address'] = "";
				}
			
			}
		}
		return $data;
	}

	public static function getAllContactAddress()
	{
		$address_data = array();

		$org_details = Client::getAllOrgClientDetails();
		$ind_details = Client::getAllIndClientDetails();
		$contact_details = ContactAddress::getAllContactDetails();
		$i = 0;
		if(isset($org_details) && count($org_details) >0){
			foreach ($org_details as $key => $value) {
				$array = array("trad", "corres", "reg", "bankers", "old_acc", "auditors", "solicitors");
				
				foreach($array as $row){
					if(isset($value[$row.'_cont_addr_line1']) && $value[$row.'_cont_addr_line1'] != ""){
						$address_data[$i]['address'] = $value[$row.'_cont_addr_line1'];
						$address_data[$i]['type'] = $row;
						$address_data[$i]['client_id'] = $value['client_id'];
						$i++;
					}
				}

			}
		}

		if(isset($ind_details) && count($ind_details) >0){
			foreach ($ind_details as $key => $value) {
				if(isset($value['serv_addr_line1']) && $value['serv_addr_line1'] != ""){
					$address_data[$i]['address'] = $value['serv_addr_line1'];
					$address_data[$i]['type'] = "res";
					$address_data[$i]['client_id'] = $value['client_id'];
					$i++;
				}
				if(isset($value['res_addr_line1']) && $value['res_addr_line1'] != ""){
					$address_data[$i]['address'] = $value['res_addr_line1'];
					$address_data[$i]['type'] = "res";
					$address_data[$i]['client_id'] = $value['client_id'];
					$i++;
				}

			}
		}

		if(isset($contact_details) && count($contact_details) >0){
			foreach ($contact_details as $key => $value) {
				if(isset($value['addr_line1']) && $value['addr_line1'] != ""){
					$address_data[$i]['address'] = $value['addr_line1'];
					$address_data[$i]['type'] = "other";
					$address_data[$i]['client_id'] = "0";
					$i++;
				}
				

			}
		}

		return $address_data;
		//$data['cont_address'] 	= App::make('HomeController')->get_orgcontact_address();

	}

}
