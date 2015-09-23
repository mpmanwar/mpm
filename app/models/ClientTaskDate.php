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

	public static function get_task_by_client($client_id, $checklist_id)
	{
		$data = array();
		$value = ClientTaskDate::where('client_id', '=', $client_id)->where('check_list', '=', $checklist_id)->first();
		if(isset($value) && count($value) >0){
			//foreach ($details as $key => $value) {
				$data['cleinttaskdate_id']= $value->cleinttaskdate_id;
				$data['user_id'] 			= $value->user_id;
				$data['client_id'] 		= $value->client_id;
				$data['taskdate'] 		= $value->taskdate;
				$data['cteatedtaskdate'] 	= $value->cteatedtaskdate;
				$data['check_list'] 		= $value->check_list;
				$data['task_owner'] 		= $value->task_owner;
				$data['status'] 			= $value->status;
			//}
		}
		return $data;
	}


}
