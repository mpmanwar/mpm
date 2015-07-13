<?php

class SettingsController extends BaseController {

	public function index() {
		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id

		if (empty($user_id)) {
			return Redirect::to('/');
		}
		$data['heading'] = "";
		$data['title'] = "Settings Dashboard";
		return View::make('settings.index', $data);
	}

}
