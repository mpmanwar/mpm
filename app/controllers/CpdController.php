<?php
//opcache_reset ();
//Cache::forget('user_list');

class CpdController extends BaseController {
    
    public function cpd_and_courses()
    {
        
       	$data['heading'] = "CPD & COURSES";
		$data['title'] = "CPD & COURSES";
      
        
       
      
                
        return View::make('staff.cpd.cpd_and_courses',$data);
       
    }
}
