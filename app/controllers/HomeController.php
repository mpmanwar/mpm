<?php

class HomeController extends BaseController {

	public function db_connect() {
		if (DB::connection()->getDatabaseName()) {
			echo "Conncted sucessfully to database : " . DB::connection()->getDatabaseName();
			die;
		}
	}

	public function dashboard() {
		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
		//print_r($admin_s);die;
		if (!isset($user_id) && $user_id == "") {
			return Redirect::to('/');
		}

		$data['heading'] = "DASHBOARD";
		$data['title'] = "Dashboard";
		return View::make('home.dashboard', $data);
	}

	




	
}
