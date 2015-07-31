<?php
class StaffmanagementController extends BaseController {
    
    public function staff_management()
    {
        //die('staffmanagement');
       	$data['heading'] = "";
		$data['title'] = "Staff Management";
      
        return View::make('staff.staffmanagement',$data);
       
    }
}
