<?php
//opcache_reset ();
//Cache::forget('user_list');

class StaffdataController extends BaseController {
    
    public function staff_data()
    {
        //die('staffmanagement');
       	$data['heading'] = "STAFF DATA";
		$data['title'] = "STAFF DATA";
      
      return View::make('staff.staffdata.staff_data',$data);
       
    }
}
