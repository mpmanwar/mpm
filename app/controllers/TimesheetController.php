<?php
//opcache_reset ();
//Cache::forget('user_list');

class TimesheetController extends BaseController {
    
    public function time_sheet_reports($type)
    {
        //die('staffmanagement');
       	$data['heading'] = "TIME SHEET";
		$data['title'] = "Time Sheet Reports";
      	if(base64_decode($type) == 'profile'){
        	$data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        }else{
        	$data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        }
        $data['staff_type'] = base64_decode($type);
        
       
      
                
        return View::make('staff.timesheet.time_sheet_reports',$data);
       
    }
}
