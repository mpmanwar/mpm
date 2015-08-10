<?php
class VatReturnsController extends BaseController {
	
	public function index($page_open, $staff_id){
		$data['goto_url']	= "/vat-returns";
		$data['title'] = 'Vat';
		$data['previous_page'] = '<a href="/jobs-dashboard">Jobs</a>';
		$data['heading'] = "VAT";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		$data['service_id'] = 1;
		$data['staff_id'] 	= base64_decode($staff_id);
		$data['page_open'] 	= base64_decode($page_open);
		$data['encode_page_open'] 	= $page_open;

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		if($data['staff_id'] == "all"){
			$data['company_details'] = Client::getAllOrgClientDetails();
		}else if($data['staff_id'] == "none"){
			$data['company_details'] = Client::getUnassignedClientDetails( $data['service_id'] );
		}else{
			$data['company_details'] = Client::getAssignedClientDetails($data['service_id'], $data['staff_id']);
		}
		
		//$data['company_details']	= Client::ClientDetailsByServiceId($data['service_id']);
		$all_count = 0;
		if(isset($data['company_details']) && count($data['company_details']) >0){
			foreach ($data['company_details'] as $key => $details) {
				if(isset($details['services_id']) && in_array($data['service_id'], $details['services_id'])){

					if($data['page_open'] == 21){
						$autosend = AutosendTask::where('service_id', '=', $data['service_id'])->first();
						if(isset($autosend) && count($autosend) >0 ){
							if(isset($details['deadacc_count']) && $details['deadacc_count']<=$autosend['days']){
								$update_data['ch_manage_task'] =  'Y';
								$qry_ch=Client::where('client_id', '=', $details['client_id'])->update($update_data);
								$data['company_details'][$key]['ch_manage_task'] = "Y";
							}
						}
					}
					
					if(isset($details['ch_manage_task']) && $details['ch_manage_task']== "Y"){
						$all_count+=1;
					}
				}
			}
		}
		$data['all_count'] = $all_count;

		$data['jobs_steps'] = JobsStep::getAllJobSteps();
		if(isset($data['jobs_steps']) && count($data['jobs_steps']) >0){
			foreach ($data['jobs_steps'] as $key => $row) {
				$jobs_steps = JobStatus::getJobStatusByStatusId($data['service_id'], $row['step_id']);
				$data['jobs_steps'][$key]['count'] = count($jobs_steps);
			}
		}
		$data['Job_status'] 	= JobStatus::getJobStatusByServiceId($data['service_id']);
		$data['not_started_count'] = $all_count - count($data['Job_status']);
		$data['staff_details'] 	= User::whereIn("user_id", $groupUserId)->where("client_id", "=", 0)->select("user_id", "fname", "lname")->get();

		$data['autosend'] = AutosendTask::where('service_id', '=', $data['service_id'])->first();
		

		//echo "<prev>".print_r($data['client_details']);die;
		return View::make('jobs.vat_returns.index', $data);
	}

	public function manage_tasks(){
		$data['title'] = 'Manage Deadlines';
		$data['previous_page'] = '<a href="/vat-returns">Vat Returns</a>';
		$data['heading'] = "VAT - Manage Deadlines";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		//$data['client_details'] = Client::getAllOrgClientDetails();
		

		//echo "<prev>".print_r($data['client_details']);die;
		return View::make('jobs.vat_returns.manage_tasks', $data);
	}

    

}
