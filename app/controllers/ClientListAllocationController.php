<?php
class ClientListAllocationController extends BaseController {
	
	public function index(){
		$data['title'] = 'Client List Allocation';
		$data['previous_page'] = '<a href="/settings-dashboard">Settings</a>';
		$data['heading'] = "CLIENT LIST ALLOCATION";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		$data['staff_details'] 	= User::whereIn("user_id", $groupUserId)->where("client_id", "=", 0)->select("user_id", "fname", "lname")->get();
		$data['old_services'] 	= Service::where("status", "=", "old")->orderBy("service_name")->get();
		$data['new_services'] 	= Service::where("status", "=", "new")->whereIn("user_id", $groupUserId)->orderBy("service_name")->get();

		$data['org_client_details'] 	=   Client::getAllOrgClientDetails();
		$data['ind_client_details'] 	=   Client::getAllIndClientDetails();

		//echo "<prev>".print_r($data['old_services']);die;
		return View::make('settings.client_list_allication.index', $data);
	}


	public function search_allocation_clients()
	{
		$data = array();
		$data['client_type'] 	= Input::get("client_type");
		$data['service_id']		= Input::get("service_id");

		if($data['client_type'] == "org"){
			$data['org_client_details'] 	=   Client::getAllOrgClientDetails();
		}else{
			$data['ind_client_details'] 	=   Client::getAllIndClientDetails();
		}

		echo View::make("settings.client_list_allication.search_allocation_list", $data);
	}

	
    

}