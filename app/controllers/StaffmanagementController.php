<?php
//opcache_reset ();
//Cache::forget('user_list');

class StaffmanagementController extends BaseController {
    
    public function staff_management()
    {
        //die('staffmanagement');
       	$data['heading'] = "Staff Management";
		$data['title'] = "Staff Management";
      
        
       
      
                
        return View::make('staff.staffmanagement',$data);
       
    }
}
