<?php
class CrmLeadsTab extends Eloquent {

	public $timestamps = false;
	
	public static function getAllTabDetails()
    {
    	$data = array();
		$data = CrmLeadsTab::get();
		if(isset($data) && count($data) >0){
			foreach ($data as $i => $details) {
				$data[$i]['tab_id'] 		= $details->tab_id;
				$data[$i]['tab_name'] 		= $details->tab_name;
				$data[$i]['color_code'] 	= $details->color_code;
			}
		}
		//print_r($data);die;
		return $data;
    }


}
