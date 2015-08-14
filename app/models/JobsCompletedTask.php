<?php
class JobsCompletedTask  extends Eloquent{
	
	public $timestamps = false;
	public static function getTaskByClientAndServiceId($client_id, $service_id)
	{
		$session        = Session::get('admin_details');
        $user_id        = $session['id'];
        $groupUserId    = $session['group_users'];

		$status_data = array();
		$JobStatus	= JobsCompletedTask::whereIn("user_id", $groupUserId)->where("client_id","=", $client_id)->where("service_id","=", $service_id)->first();
		if(isset($JobStatus) && count($JobStatus) >0){
			$status_data['task_id'] 		= $JobStatus['jobs_notes_id'];
			$status_data['client_id'] 		= $JobStatus['client_id'];
			$status_data['service_id'] 		= $JobStatus['service_id'];
			$status_data['user_id'] 		= $JobStatus['user_id'];
			$status_data['date'] 			= $JobStatus['date'];
			$status_data['created'] 		= $JobStatus['created'];
		}
		return $status_data;
	}

	public static function putCompletedTaskDate($client_id, $service_id, $status_id)
	{
		$status_data = array();
		$session        = Session::get('admin_details');
        $user_id        = $session['id'];
        $groupUserId    = $session['group_users'];

        if(isset($status_id) && $status_id == 10){
			$client_details = StepsFieldsClient::where('client_id', '=', $client_id)->where('field_name', '=', "made_up_date")->select("field_value")->first();
	        if(isset($client_details) && count($client_details) >0){
	        	$made_up_date = date("d-m-Y", strtotime("+1 year",strtotime($client_details['field_value'])));
	        }else{
	        	$made_up_date = "";
	        }


			$JobStatus	= JobsCompletedTask::whereIn("user_id", $groupUserId)->where("client_id","=", $client_id)->where("service_id","=", $service_id)->first();
			if((!isset($JobStatus) && count($JobStatus) <=0) && $made_up_date != ""){
				$status_data['client_id'] 		= $client_id;
				$status_data['service_id'] 		= $service_id;
				$status_data['user_id'] 		= $user_id;
				$status_data['date'] 			= $made_up_date;
				JobsCompletedTask::insert($status_data);
			}
		}
		return $status_data;
	}
	

}
