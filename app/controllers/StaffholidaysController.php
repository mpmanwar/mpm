<?php
//opcache_reset ();
//Cache::forget('user_list');

class StaffholidaysController extends BaseController {
    
    public function staff_holidays()
    {
        //die('staffmanagement');
       	$data['heading'] = "STAFF HOLIDAYS";
		$data['title'] = "STAFF HOLIDAYS";
      
        
       
      
                
        return View::make('staff.staffholidays.staff_holidays',$data);
       
    }
}
