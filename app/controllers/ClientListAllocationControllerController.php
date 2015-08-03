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

		//$data['client_details'] = Client::getAllOrgClientDetails();
		

		//echo "<prev>".print_r($data['client_details']);die;
		return View::make('settings.client_list_allication.index', $data);
	}

	
    

}
