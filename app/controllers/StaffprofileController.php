<?php
class StaffprofileController extends BaseController {
    
    public function dashboard()
    {
    	$session = Session::get('admin_details');
		$data['user_id'] 	= $session['id'];
		$data['user_type'] 	= $session['user_type'];
		$data['heading'] 	= "";
		$data['title'] 		= "Staff Profile";
		
		if(!isset($data['user_id']) && $data['user_id'] == ""){
			return Redirect::to('/');
		}else if(isset($data['user_type']) && $data['user_type'] == "C"){
			return Redirect::to('/invitedclient-dashboard');
		}

        return View::make('staff.profile.profiledashboard',$data);
    }

    public function my_details($user_id)
    {
    	$data = array();
    	$session = Session::get('admin_details');
		$data['user_id'] 	= $session['id'];
		$data['user_type'] 	= $session['user_type'];
		$data['heading'] 	= "";
		$data['title'] 		= "My Details";
		$data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
		
		if(!isset($data['user_id']) && $data['user_id'] == ""){
			return Redirect::to('/');
		}else if(isset($data['user_type']) && $data['user_type'] == "C"){
			return Redirect::to('/invitedclient-dashboard');
		}

		$data['staff_details'] = $this->userDetailsByUserId($data['user_id']);

		//print_r($data['staff_details']);die;
    	return View::make("staff.profile.my_details", $data);
    }

    public function userDetailsByUserId($user_id)
    {
    	$data      = array();
        $step_data = array();
    	$details = User::where("user_id", "=", $user_id)->first();
    	if(isset($details) && count($details) >0){
    		$fname = "";
    		$lname = "";
    		if(isset($details['fname']) && $details['fname'] != ""){
				$fname.=$details['fname'];
			}
			if(isset($details['lname']) && $details['lname'] != ""){
				$lname.=$details['lname'];
			}
			$staff_name = $fname." ".$lname;
			$data['initial_badge'] = App::make('ClientController')->get_initial_badge($staff_name);
    		$data['staff_name'] 	= $staff_name;
    		$data['parent_id'] 		= $details['parent_id'];
    		$data['group_id'] 		= $details['group_id'];
    		$data['client_id'] 		= $details['client_id'];
    		$data['email'] 			= $details['email'];
    		$data['password'] 		= $details['password'];
    		$data['phone'] 			= $details['phone'];
    		$data['user_type'] 		= $details['user_type'];
    		$data['status'] 		= $details['status'];
    		$data['website'] 		= $details['website'];
    		$data['fname'] 			= $details['fname'];
    		$data['lname'] 			= $details['lname'];
    		$data['country'] 		= $details['country'];
    		$data['created'] 		= $details['created'];

            $fields = StepsFieldsStaff::where("user_id", "=", $user_id)->get();
            if( isset($fields) && count($fields) >0 ){
                foreach ($fields as $value) {
                    $step_data[$value['field_name']] = $value->field_value;
                }
            }
            $data['step_data']  = $step_data;
    	}

    	return $data;
    }

    public function user_details_process()
    {

    }

    public function to_list()
    {
    	$data = array();
    	$session = Session::get('admin_details');
		$data['user_id'] 	= $session['id'];
		$data['user_type'] 	= $session['user_type'];
		$data['heading'] 	= "";
		$data['title'] 		= "To List";
		$data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
		
		if(!isset($data['user_id']) && $data['user_id'] == ""){
			return Redirect::to('/');
		}else if(isset($data['user_type']) && $data['user_type'] == "C"){
			return Redirect::to('/invitedclient-dashboard');
		}

		return View::make("staff.profile.to_list", $data);
    }

    



}
