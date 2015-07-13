<?php
//opcache_reset ();
//Cache::forget('user_list');

class TimesheetController extends BaseController {
    
    public function time_sheet_reports()
    {
        //die('staffmanagement');
       	$data['heading'] = "";
		$data['title'] = "Time Sheet Reports";
      	$data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        
       
      
                
        return View::make('staff.timesheet.time_sheet_reports',$data);
       
    }
}
