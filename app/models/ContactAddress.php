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

}
