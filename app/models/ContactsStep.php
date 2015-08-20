<?php
class ContactsStep extends Eloquent {

	public $timestamps = false;

	public static function getAllSteps()
	{
		$data = array();
		$step_details = ContactsStep::get();
		if(isset($step_details) && count($step_details) >0){
			foreach ($step_details as $key => $details) {
				$data[$key]['step_id'] 		= $details->step_id;
				$data[$key]['user_id'] 		= $details->user_id;
				$data[$key]['shorting_id'] 	= $details->shorting_id;
				$data[$key]['short_code'] 	= $details->short_code;
				$data[$key]['title'] 		= $details->title;
				$data[$key]['status'] 		= $details->status;
				$data[$key]['step_type'] 	= $details->step_type;
				$data[$key]['created'] 		= $details->created;
			}
		}
		//print_r($data);die;
		return array_values($data);
	}

}
