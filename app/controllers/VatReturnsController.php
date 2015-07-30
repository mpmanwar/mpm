<?php
class VatReturnsController extends BaseController {
	
	public function index(){
		$data['title'] = 'Vat Returns';
		//$data['previous_page'] = '<a href="/dashboard">Dashboard</a>';
		$data['heading'] = "VAT - Permanent DATA";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		$data['client_details'] = Client::getAllOrgClientDetails();
		

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
