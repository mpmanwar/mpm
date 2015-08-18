<?php
//opcache_reset ();
//Cache::forget('user_list');

class StaffholidaysController extends BaseController {
    
    public function staff_holidays($type)
    {
        if(base64_decode($type) == 'profile'){
        	$data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        }else{
        	$data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        }
        $data['staff_type'] = base64_decode($type);
       	$data['heading'] 	= "HOLIDAYS/TIME OFF ";
		$data['title'] 		= "Staff Holidays";
	
    	$session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['user_type'] = $session['user_type'];
        $groupUserId = $session['group_users'];

        //print_r($groupUserId);die();

        $data['staff_details'] = User::whereIn("user_id", $groupUserId)->where("client_id",
            "=", 0)->select("user_id", "fname", "lname")->get();
    
    // echo '<pre>'; print_r($data);die();
        
        return View::make('staff.staffholidays.staff_holidays',$data);
       
    }
}
