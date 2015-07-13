<?php
//opcache_reset ();
//Cache::forget('user_list');

class StaffholidaysController extends BaseController {
    
    public function staff_holidays()
    {
        //die('staffmanagement');
       	$data['heading'] = "";
		$data['title'] = "Staff Holidays";
		$data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
      
        return View::make('staff.staffholidays.staff_holidays',$data);
       
    }
}
