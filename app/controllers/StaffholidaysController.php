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
		
      
        return View::make('staff.staffholidays.staff_holidays',$data);
       
    }
}
