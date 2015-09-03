<?php
//opcache_reset ();
//Cache::forget('user_list');

class CpdController extends BaseController {
    public function __construct()
    {
        parent::__construct();
        $session        = Session::get('admin_details');
        $user_id        = $session['id'];
        if (empty($user_id)) {
            Redirect::to('/login');
        }
        if (isset($session['user_type']) && $session['user_type'] == "C") {
            Redirect::to('/client-portal')->send();
        }
    }
    
    public function cpd_and_courses($type)
    {
        
       	$data['heading'] = "CPD & COURSES";
		$data['title'] = "Cpd & Courses";
      	if(base64_decode($type) == 'profile'){
        	$data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        }else{
        	$data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        }
        $data['staff_type'] = base64_decode($type);
        
       
      
                
        return View::make('staff.cpd.cpd_and_courses',$data);
       
    }
}
