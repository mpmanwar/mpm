<?php
class StaffdataController extends BaseController {
    
    public function staff_data()
    {
    	$session = Session::get('admin_details');
		$user_id = $session['id'];
		$user_type 		= $session['user_type'];
		$groupUserId 	= $session['group_users'];
		
		if(!isset($user_id) && $user_id == ""){
			return Redirect::to('/');
		}else if(isset($user_type) && $user_type == "C"){
			return Redirect::to('/invitedclient-dashboard');
		}

        $data['heading'] 	= "";
		$data['title'] 		= "Staff List";
		$data['previous_page'] 	= '<a href="/staff-management">Staff Management</a>';

		$data['staff_details']	= $this->getAllStaffDetails();
		//print_r($data['staff_details']);die;
      
      	return View::make('staff.staffdata.staff_data',$data);
       
    }

    public function getAllStaffDetails()
    {
    	$details 	= array();
    	$step_data 	= array();
    	$session = Session::get('admin_details');
		$user_id = $session['id'];
		$user_type 		= $session['user_type'];
		$groupUserId 	= $session['group_users'];

		$staff = User::whereIn("user_id", $groupUserId)->where("client_id", "=", 0)->get();
		//echo $this->last_query();die;
		if( isset($staff) && count($staff) >0 ){
			foreach ($staff as $key => $value) {
				$details[$key]['user_id'] 		= $value->user_id;
				$details[$key]['parent_id'] 	= $value->parent_id;
	    		$details[$key]['group_id'] 		= $value->group_id;
	    		$details[$key]['client_id'] 	= $value->client_id;
	    		$details[$key]['fname'] 		= $value->fname;
	    		$details[$key]['lname'] 		= $value->lname;
	    		$details[$key]['email'] 		= $value->email;
	    		$details[$key]['password'] 		= $value->password;
	    		$details[$key]['phone'] 		= $value->phone;
	    		$details[$key]['website'] 		= $value->website;
	    		$details[$key]['country'] 		= $value->country;
	    		$details[$key]['user_type'] 	= $value->user_type;
	    		$details[$key]['status'] 		= $value->status;
	    		$details[$key]['created'] 		= $value->created;

	    		$fields = StepsFieldsStaff::where("user_id", "=", $value->user_id)->get();
	    		if( isset($fields) && count($fields) >0 ){
					foreach ($fields as $value) {
						$step_data[$value['field_name']] = $value->field_value;
					}
				}
				$details[$key]['step_data']  = $step_data;


			}
		}
		
		return $details;
    }
}
