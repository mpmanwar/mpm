<?php
class ChAnnualReturnController extends BaseController {
	
	public function index($service_id, $page_open, $staff_id){
		$data 			= array();
		$clientId 		= array();
		$client_data 	= array();
		$data['goto_url']	= "/ch-annual-return/".$service_id;
		$data['heading'] 	= "CH ANNUAL RETURNS";
		$data['title'] 		= "CH Annual Returns";
		$data['previous_page'] = '<a href="/jobs-dashboard">Jobs</a>';
		$data['service_id'] = $service_id;
		$data['staff_id'] 	= base64_decode($staff_id);
		$data['page_open'] 	= base64_decode($page_open);
		$data['encode_page_open'] 	= $page_open;
		$data['encode_staff_id'] 	= $staff_id;
		
		$session 			= Session::get('admin_details');
		$user_id 			= $session['id'];
		$groupUserId 		= $session['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		$autosend = AutosendTask::whereIn("user_id", $groupUserId)->where('service_id', '=', $data['service_id'])->first();
		if(isset($autosend) && $autosend['staff_filter'] != ""){
			$data['staff_id'] 	= $autosend['staff_filter'];
		}


		if($data['staff_id'] == "all"){
			$data['company_details'] = Client::getClientByServiceId( $data['service_id'] );
		}else if($data['staff_id'] == "none"){
			$data['company_details'] = Client::getUnassignedClientDetails( $data['service_id'] );
		}else{
			$data['company_details'] = Client::getAssignedClientDetails($data['service_id'], $data['staff_id']);
		}
		
		$all_count = 0;
		if(isset($data['company_details']) && count($data['company_details']) >0){
			foreach ($data['company_details'] as $key => $details) {
				//if($data['page_open'] == 21){
					$autosend = AutosendTask::whereIn("user_id", $groupUserId)->where('service_id', '=', $data['service_id'])->first();
					if(isset($autosend) && count($autosend) >0 ){
						if((isset($details['deadret_count']) && $details['deadret_count'] <= $autosend['days'])){
							JobsManage::updateJobManage($details['client_id'], $service_id);
							$data['company_details'][$key]['ch_manage_task'] = "Y";
						}
					}
				//}
				
				if(isset($details['ch_manage_task']) && $details['ch_manage_task']== "Y"){
					$all_count+=1;
					$clientId[] = $details['client_id'];
				}
				
			}
		}
		//print_r($clientId);print_r($groupUserId);die;
		$data['all_count'] = $all_count;

		$data['jobs_steps'] = JobsStep::getAllJobSteps();
		if(isset($data['jobs_steps']) && count($data['jobs_steps']) >0){
			foreach ($data['jobs_steps'] as $key => $row) {
				$jobs_steps = JobStatus::getJobStatusByStatusId($data['service_id'], $row['step_id'], $clientId);
				$data['jobs_steps'][$key]['count'] = count($jobs_steps);
			}
		}
		$data['Job_status'] 	= JobStatus::getJobStatusByServiceId($data['service_id'], $clientId);
		$data['not_started_count'] = $all_count - count($data['Job_status']);
		$data['staff_details'] 	= User::whereIn("user_id", $groupUserId)->where("client_id", "=", 0)->select("user_id", "fname", "lname")->get();

		$data['completed_task'] = JobStatus::getCompletedTaskByServiceId( $data['service_id'], 10, $clientId );

		$data['autosend'] = AutosendTask::whereIn("user_id", $groupUserId)->where('service_id', '=', $data['service_id'])->first();
		
		//echo "<prev>".print_r($data['company_details']);die;
		return View::make('ch_data.channual_return_list', $data);
	}

    

}
