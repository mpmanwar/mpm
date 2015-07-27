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

    public function my_details($user_id,$type_id)
    {
       // $type_name= base64_decode($type_id);
        //echo $type_id;
        
    	$data = array();
        $data['page_name'] 	= base64_decode($type_id);
    	$session = Session::get('admin_details');
		$data['user_id'] 	= $session['id'];
		$data['user_type'] 	= $session['user_type'];
		$data['heading'] 	= "";
		$data['title'] 		= "My Details";
		$data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
		$data['titles'] 		= Title::orderBy("title_id")->get();
        $data['marital_status'] = MaritalStatus::orderBy("marital_status_id")->get();
        $data['countries'] 			= Country::orderBy('country_name')->get();
        $data['nationalities'] 		= Nationality::get();
        
        
		if(!isset($data['user_id']) && $data['user_id'] == ""){
			return Redirect::to('/');
		}else if(isset($data['user_type']) && $data['user_type'] == "C"){
			return Redirect::to('/invitedclient-dashboard');
		}
        
        $data['staff_id']=$user_id;
		$data['staff_details'] = $this->userDetailsByUserId($user_id);

		//echo '<pre>';
        //print_r($data);die;
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
         $postData = Input::all();
         //$postData['res_postcode'];
          //echo "<pre>";
          // print_r($postData['res_postcode']);die();
        
        $data = array();
        $userData = array();
       	$arrData  	= array();

    	$session = Session::get('admin_details');
		$data['user_id'] 	= $session['id'];
        
        $user_id=$data['user_id'];
		$data['user_type'] 	= $session['user_type'];
        
        // update for user table
                if (!empty($postData['fname'])) {
                    $userData['fname'] = $postData['fname'];
                    }
                if (!empty($postData['lname'])) {
                    $userData['lname'] = $postData['lname'];
                    }
                if (!empty($postData['email'])) {
                    $userData['email'] = $postData['email'];
                    }
                    
                $userprof_update = User::where("user_id", "=", $data['user_id'])->
                        update($userData);
                
            // update for user table    
        //echo "<pre>";
        //print_r($userData);
        //die();
        
        
        $staff_id=$postData['staff_id'];
        
        //$filevalue=('staff_file1,staff_file2,staff_file3,staff_file4,prof_file1,prof_file2,prof_file3,prof_file4');
        
        $result = StepsFieldsStaff::where("staff_id", "=", $staff_id)->get();
			
          
            if (isset($result) && count($result) > 0)
             {
                
          //StepsFieldsStaff::where("staff_id", "=", $staff_id)->where("field_name","<>",$filevalue)->delete();
                StepsFieldsStaff::where("staff_id", "=", $staff_id)->delete();
                }
        
        //################ GENERAL SECTION START #################//
		$step_id = 1;
		if (!empty($postData['title'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'title', $postData['title']);
		}
        if (!empty($postData['mname'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'mname', $postData['mname']);
		}
                        
        if (!empty($postData['gender'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'gender', $postData['gender']);
		}
        if (!empty($postData['dob'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'dob', $postData['dob']);
		}
        if (!empty($postData['marital_status'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'marital_status', $postData['marital_status']);
		}
        
        if (!empty($postData['nationality'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'nationality', $postData['nationality']);
		}
        
        if (!empty($postData['country'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'country', $postData['country']);
		}
        if (!empty($postData['position'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'position', $postData['position']);
		}
        if (!empty($postData['ni_number'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'ni_number', $postData['ni_number']);
		}
        if (!empty($postData['tax_reference'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'tax_reference', $postData['tax_reference']);
		}
         //echo '<pre>';print_r($arrData);die();
         //################ GENERAL SECTION START #################//
         
         
         //################ Contact info START #################//
		$step_id = 2;
		if (!empty($postData['res_addr_line1'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'res_addr_line1', $postData['res_addr_line1']);
		}
                        
        if (!empty($postData['res_addr_line2'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'res_addr_line2', $postData['res_addr_line2']);
		}
        if (!empty($postData['res_city'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'res_city', $postData['res_city']);
		}
                        
        if (!empty($postData['res_county'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'res_county', $postData['res_county']);
		}
        
        if (!empty($postData['res_postcode'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'res_postcode', $postData['res_postcode']);
		}
                        
        if (!empty($postData['res_country'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'res_country', $postData['res_country']);
		}
        
        
        if (!empty($postData['serv_tele_code'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'serv_tele_code', $postData['serv_tele_code']);
		}
        if (!empty($postData['serv_telephone'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'serv_telephone', $postData['serv_telephone']);
		}
        
         if (!empty($postData['serv_mobile_code'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'serv_mobile_code', $postData['serv_mobile_code']);
		}
        
        
        
         if (!empty($postData['serv_mobile'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'serv_mobile', $postData['serv_mobile']);
		}
        if (!empty($postData['skype'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'skype', $postData['skype']);
		}
        
        
        if (!empty($postData['emer_name'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'emer_name', $postData['emer_name']);
		}
        if (!empty($postData['emer_telephone'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'emer_telephone', $postData['emer_telephone']);
		}
        if (!empty($postData['emer_mobile'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'emer_mobile', $postData['emer_mobile']);
		}
        
         //echo '<pre>';print_r($arrData);die();
         //################ Contact Info START #################//
         
         
         //################ emp START #################//
		$step_id = 3;
		if (!empty($postData['start_date'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'start_date', $postData['start_date']);
		}
                        
        if (!empty($postData['holiday_entitlement'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'holiday_entitlement', $postData['holiday_entitlement']);
		}
     
         if (!empty($postData['salary'])) {
  			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'salary', $postData['salary']);
		}
        
        if (!empty($postData['department'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'department', $postData['department']);
		}
        if (!empty($postData['res_country'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'res_country', $postData['res_country']);
		}
        
        if (!empty($postData['qualifications'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'qualifications', $postData['qualifications']);
		}
        
        if (!empty($postData['leaving_date'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'leaving_date', $postData['leaving_date']);
		}
        
        
        
         //################ Emp START #################//
         
         
          //################ Other START #################//
		$step_id = 4;
		if (!empty($postData['bank_name'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'bank_name', $postData['bank_name']);
		}
                        
        if (!empty($postData['short_code'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'short_code', $postData['short_code']);
		}
        
        if (!empty($postData['acc_no'])) {
			$arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'acc_no', $postData['acc_no']);
		}
        
        //################ Other START #################//
         
         
         
         
         StepsFieldsStaff::insert($arrData);
         //echo '<pre>';print_r($arrData);
         //die();
         return Redirect::to('/staff-details');
         //die('insert');
    }
    
    
    
    public function save_profile($user_id, $staff_id, $step_id, $field_name, $field_value) {
		$data = array();
		$data['user_id'] = $user_id;
		$data['staff_id'] = $staff_id;
		$data['step_id'] = $step_id;
		$data['field_name'] = $field_name;
		$data['field_value'] = $field_value;
		return $data;
		//OrganisationClient::insert($data);
	}
    
    
    public function prof_file(){
        
        $postData = Input::all();
        
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
