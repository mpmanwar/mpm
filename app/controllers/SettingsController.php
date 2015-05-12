<?php

class SettingsController extends BaseController {
	
	public function index(){
		$data['title'] = "Settings - Dashboard";
		return View::make('settings.index', $data);
	}

}
