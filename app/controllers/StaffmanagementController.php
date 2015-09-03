<?php
class StaffmanagementController extends BaseController {
	public function __construct()
	{
		parent::__construct();
	    $session 		= Session::get('admin_details');
		$user_id 		= $session['id'];
		if (empty($user_id)) {
			Redirect::to('/login');
		}
		if (isset($session['user_type']) && $session['user_type'] == "C") {
			Redirect::to('/client-portal')->send();
		}
	}
    
    public function staff_management()
    {
        //die('staffmanagement');
       	$data['heading'] = "";
		$data['title'] = "Staff Management";
      
        return View::make('staff.staffmanagement',$data);
       
    }
}
