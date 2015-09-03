<?php
class IndustryList extends Eloquent {

	public $timestamps = false;
	public static function getIndustryList()
    {
    	$data = array();
		$industry_details = IndustryList::get();
		if(isset($industry_details) && count($industry_details) >0){
			foreach ($industry_details as $key => $details) {
				$data[$key]['industry_id'] 		= $details->industry_id;
				$data[$key]['industry_name'] 	= $details->industry_name;
			}
		}
		//print_r($client_array);die;
		return $data;
    }
}
