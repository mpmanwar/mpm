<?php
//opcache_reset ();
//Cache::forget('user_list');

class CpdController extends BaseController {
    
    public function cpd_and_courses()
    {
        
       	$data['heading'] = "";
		$data['title'] = "Cpd & Courses";
      	$data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        
       
      
                
        return View::make('staff.cpd.cpd_and_courses',$data);
       
    }
}
