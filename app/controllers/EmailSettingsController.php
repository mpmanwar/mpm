<?php

//use Excel;
class EmailSettingsController extends BaseController {
		
	public function index()
	{
		$data['title'] = "Email Settings";
		

        //echo "<pre>";print_r($data);die;
		return View::make("email_settings.index", $data);
	}

	

}
