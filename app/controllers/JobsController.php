<?php
class JobsController extends BaseController {
	
	public function dashboard(){
		$data['title'] = 'Jobs';
		//$data['previous_page'] = '<a href="/dashboard">Dashboard</a>';
		$data['heading'] = "JOBS";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		//echo "<prev>".print_r($data);die;
		return View::make('jobs.dashboard', $data);
	}

	public function send_manage_task(){
    	$service_id = Input::get("service_id");
    	$data["status"] = "Y";
    	$client_id = Input::get("client_id");
    	$jobs = JobsManage::where("client_id", "=", $client_id)->where("service_id", "=", $service_id)->first();
    	if(isset($jobs) && count($jobs) >0){
    		JobsManage::where("job_manage_id", "=", $jobs['job_manage_id'])->update($data);
    		$last_id = $jobs['job_manage_id'];
    	}else{
    		$data["service_id"] = $service_id;
    		$data["client_id"] 	= $client_id;
    		$last_id = JobsManage::insertGetId($data);
    	}

    	echo $last_id;
    }

    public function update_staff_filter()
    {
    	$staff_id = Input::get("staff_id");	
    	$service_id = Input::get("service_id");
    	if($staff_id != "all" && $staff_id != "none"){
    		$staff_id = base64_decode($staff_id);
    	}
    	AutosendTask::where('service_id','=',$service_id)->update(array('staff_filter'=>$staff_id));
    	echo 1;
    }


    

}
