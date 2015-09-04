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

	public static function getContactDetailsById($contact_id)
	{
		$data = array();
		$details1 = ContactAddress::where("contact_id", $contact_id)->first();
		if(isset($details1) && count($details1) >0){
			$data['contact_id'] 		= $details1->contact_id;
			$data['user_id'] 			= $details1->user_id;
			$data['contact_type'] 		= $details1->contact_type;
			$data['contact_name'] 		= $details1->contact_name;
			$data['telephone_code'] 	= $details1->telephone_code;
			$data['telephone'] 			= $details1->telephone;
			$data['mobile_code'] 		= $details1->mobile_code;
	    	$data['mobile'] 			= $details1->mobile;
	    	$data['email'] 				= $details1->email;
	    	$data['website'] 			= $details1->website;
	    	$data['company_name'] 		= $details1->company_name;
			$data['addr_line1'] 		= $details1->addr_line1;
	    	$data['addr_line2'] 		= $details1->addr_line2;
	    	$data['city'] 				= $details1->city;
	    	$data['county'] 			= $details1->county;
	    	$data['postcode'] 			= $details1->postcode;
	    	$data['country'] 			= $details1->country;
	    	$data['address'] 			= $details1->addr_line1.", ".$details1->addr_line2.", ".$details1->city.", ".$details1->county.", ".$details1->postcode;
	    	if(isset($details1->contact_type) && $details1->contact_type == "company_name"){
	    		$data['name'] 			= $details1->company_name;
	    		$data['contact_person'] = $details1->contact_name;
	    	}else{
	    		$data['name'] 			= $details1->contact_name;
	    		$data['contact_person'] = "";
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
					$address_data[$i]['type'] = "serv";
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
					$address_data[$i]['address'] 	= $value['addr_line1'];
					$address_data[$i]['type'] 		= "other";
					$address_data[$i]['client_id'] 	= $value['contact_id'];
					$i++;
				}
				

			}
		}

		return $address_data;
		//$data['cont_address'] 	= App::make('HomeController')->get_orgcontact_address();

	}

	public static function getGroupContactDetails($step_id)
	{
		$contacts = array();

		$details = ContactsGroup::getContactsGroupByGroupId($step_id);
		$count = 0;
		if(isset($details) && count($details) >0)
		{
			foreach ($details as $key => $value) {
				if(isset($value['contact_type']) && $value['contact_type'] == "org"){
					$client_row = Common::clientDetailsById($value['client_id']);
					if(isset($client_row) && count($client_row) >0){
						$contacts[$count] = ContactAddress::getContactAddressByType($client_row['client_id'], "corres");
						$contacts[$count]['client_id']		= $client_row['client_id'];
						$contacts[$count]['client_name']	= $client_row['business_name'];
						$contacts[$count]['client_type']	= "org";

						$count++;
					}
				}

				if(isset($value['contact_type']) && $value['contact_type'] == "ind"){
					$client_row = Common::clientDetailsById($value['client_id']);
					if(isset($client_row) && count($client_row) >0){
						$contacts[$count]['client_id']		= $client_row['client_id'];
						$contacts[$count]['client_name']	= $client_row['client_name'];
						$contacts[$count]['client_type']	= "ind";
						$contacts[$count]['contact_person']	= "";
						$contacts[$count]['telephone']		= isset($client_row['serv_telephone'])?$client_row['serv_telephone']:"";
						$contacts[$count]['mobile']			= isset($client_row['serv_mobile'])?$client_row['serv_mobile']:"";
						$contacts[$count]['email']			= isset($client_row['serv_email'])?$client_row['serv_email']:"";
						$contacts[$count]['address']		= ContactAddress::getResidentialAddress($client_row);

						$count++;
					}
				}

				if(isset($value['contact_type']) && $value['contact_type'] == "staff"){
					$staff_row = User::getStaffDetailsById($value['client_id']);
					if(isset($staff_row) && count($staff_row) >0){
						$contacts[$count]['client_id']		= $staff_row['user_id'];
						$contacts[$count]['client_name']	= $staff_row['fname']." ".$staff_row['lname'];
						$contacts[$count]['client_type']	= "staff";
						$contacts[$count]['contact_person']	= "";
						$contacts[$count]['telephone']		= isset($staff_row['res_telephone'])?$staff_row['res_telephone']:"";
						$contacts[$count]['mobile']			= isset($staff_row['res_mobile'])?$staff_row['res_mobile']:"";
						$contacts[$count]['email']			= isset($staff_row['res_email'])?$staff_row['res_email']:"";
						$contacts[$count]['address']		= isset($staff_row['res_address'])?$staff_row['res_address']:"";

						$count++;
					}
				}

				if(isset($value['contact_type']) && $value['contact_type'] == "other"){
					$other_row = ContactAddress::getContactDetailsById($value['client_id']);
					if(isset($other_row) && count($other_row) >0){
						$contacts[$count]['client_id']		= $other_row['contact_id'];
						$contacts[$count]['client_name']	= $other_row['name'];
						$contacts[$count]['client_type']	= "other";
						$contacts[$count]['contact_person']	= isset($other_row['contact_person'])?$other_row['contact_person']:"";;
						$contacts[$count]['telephone']		= isset($other_row['telephone'])?$other_row['telephone']:"";
						$contacts[$count]['mobile']			= isset($other_row['mobile'])?$other_row['mobile']:"";
						$contacts[$count]['email']			= isset($other_row['email'])?$other_row['email']:"";
						$contacts[$count]['address']		= isset($other_row['address'])?$other_row['address']:"";

						$count++;
					}
				}


			}
		}

		return $contacts;
	}

	public static function getResidentialAddress($client_row)
	{
		$address = "";
		if(isset($client_row['res_addr_line1']) && $client_row['res_addr_line1'] != ""){
			$address .= $client_row['res_addr_line1'].", ";
		}
		if(isset($client_row['res_addr_line2']) && $client_row['res_addr_line2'] != ""){
			$address .= $client_row['res_addr_line2'].", ";
		}
		if(isset($client_row['res_city']) && $client_row['res_city'] != ""){
			$address .= $client_row['res_city'].", ";
		}
		if(isset($client_row['res_county']) && $client_row['res_county'] != ""){
			$address .= $client_row['res_county'].", ";
		}
		if(isset($client_row['res_postcode']) && $client_row['res_postcode'] != ""){
			$address .= $client_row['res_postcode'].", ";
		}
		return substr($address, 0, -2);

	}

	public static function getClientContactAddress($client_id, $type)
	{
		$data = array();
		$details = Common::clientDetailsById($client_id);
		if(isset($details) && count($details) >0){
			if($type == "res" || $type == "serv"){
				if(isset($details[$type.'_tele_code']) && $details[$type.'_tele_code'] != ""){
					$data['telephone_code'] = $details[$type.'_tele_code'];
				}else{
					$data['telephone_code'] = "";
				}
				if(isset($details[$type.'_telephone']) && $details[$type.'_telephone'] != ""){
					$data['telephone'] = $details[$type.'_telephone'];
				}else{
					$data['telephone'] = "";
				}
				if(isset($details[$type.'_mobile_code']) && $details[$type.'_mobile_code'] != ""){
					$data['mobile_code'] = $details[$type.'_mobile_code'];
				}else{
					$data['mobile_code'] = "";
				}
				if(isset($details[$type.'_mobile']) && $details[$type.'_mobile'] != ""){
					$data['mobile'] = $details[$type.'_mobile'];
				}else{
					$data['mobile'] = "";
				}
				if(isset($details[$type.'_email']) && $details[$type.'_email'] != ""){
					$data['email'] = $details[$type.'_email'];
				}else{
					$data['email'] = "";
				}
				if(isset($details[$type.'_skype']) && $details[$type.'_skype'] != ""){
					$data['skype'] = $details[$type.'_skype'];
				}else{
					$data['skype'] = "";
				}
				if(isset($details[$type.'_website']) && $details[$type.'_website'] != ""){
					$data['website'] = $details[$type.'_website'];
				}else{
					$data['website'] = "";
				}

				if(isset($details[$type.'_addr_line1']) && $details[$type.'_addr_line1'] != ""){
					$data['address1'] = $details[$type.'_addr_line1'];
				}else{
					$data['address1'] = "";
				}
				if(isset($details[$type.'_addr_line2']) && $details[$type.'_addr_line2'] != ""){
					$data['address2'] = $details[$type.'_addr_line2'];
				}else{
					$data['address2'] = "";
				}
				if(isset($details[$type.'_city']) && $details[$type.'_city'] != ""){
					$data['city'] = $details[$type.'_city'];
				}else{
					$data['city'] = "";
				}
				if(isset($details[$type.'_county']) && $details[$type.'_county'] != ""){
					$data['county'] = $details[$type.'_county'];
				}else{
					$data['county'] = "";
				}
				if(isset($details[$type.'_postcode']) && $details[$type.'_postcode'] != ""){
					$data['postcode'] = $details[$type.'_postcode'];
				}else{
					$data['postcode'] = "";
				}
				if(isset($details[$type.'_country']) && $details[$type.'_country'] != ""){
					$data['country'] = $details[$type.'_country'];
				}else{
					$data['country'] = "";
				}

			}else{
				if(isset($details[$type.'_cont_name']) && $details[$type.'_cont_name'] != ""){
					$data['contact_name'] = $details[$type.'_cont_name'];
				}else{
					$data['contact_name'] = "";
				}
				if(isset($details[$type.'_cont_tele_code']) && $details[$type.'_cont_tele_code'] != ""){
					$data['telephone_code'] = $details[$type.'_cont_tele_code'];
				}else{
					$data['telephone_code'] = "";
				}
				if(isset($details[$type.'_cont_telephone']) && $details[$type.'_cont_telephone'] != ""){
					$data['telephone'] = $details[$type.'_cont_telephone'];
				}else{
					$data['telephone'] = "";
				}
				if(isset($details[$type.'_cont_mobile_code']) && $details[$type.'_cont_mobile_code'] != ""){
					$data['mobile_code'] = $details[$type.'_cont_mobile_code'];
				}else{
					$data['mobile_code'] = "";
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
				if(isset($details[$type.'_cont_skype']) && $details[$type.'_cont_skype'] != ""){
					$data['skype'] = $details[$type.'_cont_skype'];
				}else{
					$data['skype'] = "";
				}
				if(isset($details[$type.'_cont_website']) && $details[$type.'_cont_website'] != ""){
					$data['website'] = $details[$type.'_cont_website'];
				}else{
					$data['website'] = "";
				}

				if(isset($details[$type.'_cont_addr_line1']) && $details[$type.'_cont_addr_line1'] != ""){
					$data['address1'] = $details[$type.'_cont_addr_line1'];
				}else{
					$data['address1'] = "";
				}
				if(isset($details[$type.'_cont_addr_line2']) && $details[$type.'_cont_addr_line2'] != ""){
					$data['address2'] = $details[$type.'_cont_addr_line2'];
				}else{
					$data['address2'] = "";
				}
				if(isset($details[$type.'_cont_city']) && $details[$type.'_cont_city'] != ""){
					$data['city'] = $details[$type.'_cont_city'];
				}else{
					$data['city'] = "";
				}
				if(isset($details[$type.'_cont_county']) && $details[$type.'_cont_county'] != ""){
					$data['county'] = $details[$type.'_cont_county'];
				}else{
					$data['county'] = "";
				}
				if(isset($details[$type.'_cont_postcode']) && $details[$type.'_cont_postcode'] != ""){
					$data['postcode'] = $details[$type.'_cont_postcode'];
				}else{
					$data['postcode'] = "";
				}
				if(isset($details[$type.'_cont_country']) && $details[$type.'_cont_country'] != ""){
					$data['country'] = $details[$type.'_cont_country'];
				}else{
					$data['country'] = "";
				}
				
			
			}
		}
		return $data;
	}

}
