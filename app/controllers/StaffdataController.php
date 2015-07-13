<?php
//opcache_reset ();
//Cache::forget('user_list');

class StaffdataController extends BaseController {
    
    public function staff_data()
    {
        //die('staffmanagement');
       	$data['heading'] = "";
		$data['title'] = "Staff List";
		$data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
      
      return View::make('staff.staffdata.staff_data',$data);
       
    }
}
