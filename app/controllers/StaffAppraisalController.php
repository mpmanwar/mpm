<?php
class StaffAppraisalController extends BaseController {
	
	public function index(){
		$data['title'] = 'Staff Appraisal';
		$data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
		$data['heading'] = "Staff Appraisal";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		//$data['client_details'] = Client::getAllOrgClientDetails();
		

		//echo "<prev>".print_r($data['client_details']);die;
		return View::make('staff.staff_appraisal.index', $data);
	}

	   

}
