<?php
//opcache_reset ();
//Cache::forget('user_list');

class TimesheetController extends BaseController {
    
    public function time_sheet_reports()
    {
        //die('staffmanagement');
       	$data['heading'] = "TIME SHEET";
		$data['title'] = "TIME SHEET";
      
        
       
      
                
        return View::make('staff.timesheet.time_sheet_reports',$data);
       
    }
}
