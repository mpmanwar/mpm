<?php
class JobsManage extends Eloquent {

	public $timestamps = false;

	public static function updateJobManage($client_id, $service_id)
	{
		$session        = Session::get('admin_details');
        $user_id        = $session['id'];
        $groupUserId    = $session['group_users'];

		$jobs = JobsManage::whereIn("user_id", $groupUserId)->where("client_id", "=", $client_id)->where("service_id", "=", $service_id)->first();
        $job_data["status"]    = "Y";
        if(isset($jobs) && count($jobs) >0){
            /*$notes = JobsNote::whereIn("user_id", $groupUserId)->where("client_id", "=", $client_id)->where("service_id", "=", $service_id)->first();
            if(isset($notes) && count($notes) > 0){
                $update_data['notes'] =  "";
                JobsNote::whereIn("user_id", $groupUserId)->where("client_id", "=", $client_id)->where("service_id", "=", $service_id)->update($update_data);
            }*/
            
            JobsManage::where("job_manage_id", "=", $jobs['job_manage_id'])->update($job_data);
            $last_id = $jobs['job_manage_id'];
        }else{
            $job_data["user_id"]    = $user_id;
            $job_data["service_id"] = $service_id;
            $job_data["client_id"]  = $client_id;
            $last_id = JobsManage::insertGetId($job_data);
        }

        return $last_id;
	}

}
