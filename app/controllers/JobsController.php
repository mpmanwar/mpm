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


    

}
