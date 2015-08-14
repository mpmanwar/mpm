<?php
class ClientListAllocation extends Eloquent {

	public $timestamps = false;
	public static function getAllocatedStaff($client_id, $service_id)
    {
    	$client_array = array();
		$client_details = ClientListAllocation::where("client_id", "=", $client_id)->where("service_id", "=", $service_id)->first();
		if(isset($client_details) && count($client_details) >0){
			foreach ($client_details as $key => $details) {
				for($k=1;$k<=5;$k++){
					if(isset($details['staff_id'.$k]) && $details['staff_id'.$k] != "0"){
						$client_array[$k]['column_no'] 	= $k;
						$client_array[$k]['staff_id'] 	= $details['staff_id'.$k];
						$client_array[$k]['staff_name'] = User::getStaffNameById($details['staff_id'.$k]);
					}
				}
			}
		}
		//print_r($client_array);die;
		return array_values($client_array);
    }

}
