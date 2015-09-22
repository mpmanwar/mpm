<?php
class ClientTaskDate extends Eloquent{
	
	public $timestamps = false;

	public static function get_task_details()
	{
		$data = array();
		$details = ClientTaskDate::get();
		if(isset($details) && count($details) >0){
			foreach ($details as $key => $value) {
				$data[$key]['cleinttaskdate_id']= $value->cleinttaskdate_id;
				$data[$key]['user_id'] 			= $value->user_id;
				$data[$key]['client_id'] 		= $value->client_id;
				$data[$key]['taskdate'] 		= $value->taskdate;
				$data[$key]['cteatedtaskdate'] 	= $value->cteatedtaskdate;
				$data[$key]['check_list'] 		= $value->check_list;
				$data[$key]['task_owner'] 		= $value->task_owner;
				$data[$key]['status'] 			= $value->status;
			}
		}
		return $data;
	}


}
