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

}
