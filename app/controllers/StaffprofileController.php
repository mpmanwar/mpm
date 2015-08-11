<?php
class StaffprofileController extends BaseController
{

    public function dashboard()
    {
        $session = Session::get('admin_details');
        $data['user_id'] = $session['id'];
        $data['user_type'] = $session['user_type'];
        $data['heading'] = "";
        $data['title'] = "Staff Profile";

        if (!isset($data['user_id']) && $data['user_id'] == "") {
            return Redirect::to('/');
        } else
            if (isset($data['user_type']) && $data['user_type'] == "C") {
                return Redirect::to('/invitedclient-dashboard');
            }

        return View::make('staff.profile.profiledashboard', $data);
    }

    public function my_details($user_id, $type_id)
    {
        
       // print_r($user_id);
       // print_r(base64_decode($type_id));die();
        $admin_s = Session::get('admin_details');
	//	$user_id = $admin_s['id'];
	//	$data['user_type'] 	= $admin_s['user_type'];
		$groupUserId 		= $admin_s['group_users'];
        
        
        // $type_name= base64_decode($type_id);
        //echo $type_id;

        $data = array();
        $data['page_name'] = base64_decode($type_id);
        $session = Session::get('admin_details');
        $data['user_id'] = $session['id'];
        $data['user_type'] = $session['user_type'];
        $data['heading'] = "";
        $data['title'] = "My Details";
        if($data['page_name'] == "profile"){
            $data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        }else{
            $data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        }
        

        $data['titles'] = Title::orderBy("title_id")->get();
        $data['marital_status'] = MaritalStatus::orderBy("marital_status_id")->get();
        $data['countries'] = Country::orderBy('country_name')->get();
        $data['nationalities'] = Nationality::get();
        
        $data['old_postion_types'] = Position::whereIn("user_id", $groupUserId)->where("status", "=", "old")->orderBy("name")->get();
		$data['new_postion_types'] = Position::whereIn("user_id", $groupUserId)->where("status", "=", "new")->orderBy("name")->get();
        
        
        $data['old_department_types'] = Department::whereIn("user_id", $groupUserId)->where("status", "=", "old")->orderBy("name")->get();
		$data['new_department_types'] = Department::whereIn("user_id", $groupUserId)->where("status", "=", "new")->orderBy("name")->get();
        


        if (!isset($data['user_id']) && $data['user_id'] == "") {
            return Redirect::to('/');
        } else
            if (isset($data['user_type']) && $data['user_type'] == "C") {
                return Redirect::to('/invitedclient-dashboard');
            }

        $data['staff_id'] = $user_id;
        $data['staff_details'] = $this->userDetailsByUserId($user_id);

       // echo '<pre>';
      // print_r($data['staff_details']);
        //die;
        return View::make("staff.profile.my_details", $data);
    }


    public function userDetailsByUserId($user_id)
    {
        
        //print_r($user_id);die();
        
        $data = array();
        $step_data = array();

        $details = User::where("user_id", "=", $user_id)->first();
        if (isset($details) && count($details) > 0) {
            $fname = "";
            $lname = "";
            if (isset($details['fname']) && $details['fname'] != "") {
                $fname .= $details['fname'];
            }
            if (isset($details['lname']) && $details['lname'] != "") {
                $lname .= $details['lname'];
            }
            $staff_name = $fname . " " . $lname;
            $data['initial_badge'] = App::make('ClientController')->get_initial_badge($staff_name);
            $data['staff_name'] = $staff_name;
            $data['parent_id'] = $details['parent_id'];
            $data['group_id'] = $details['group_id'];
            $data['client_id'] = $details['client_id'];
            $data['email'] = $details['email'];
            $data['password'] = $details['password'];
            $data['phone'] = $details['phone'];
            $data['user_type'] = $details['user_type'];
            $data['status'] = $details['status'];
            $data['website'] = $details['website'];
            $data['fname'] = $details['fname'];
            $data['lname'] = $details['lname'];
            $data['country'] = $details['country'];
            $data['created'] = $details['created'];

            $fields = StepsFieldsStaff::where("user_id", "=", $user_id)->get();
            if (isset($fields) && count($fields) > 0) {
                foreach ($fields as $value) {
                    $step_data[$value['field_name']] = $value->field_value;
                }
            }

            $data['step_data'] = $step_data;
        }
        //echo '<pre>';print_r($step_data);die();

        $step_ids = array();

        $fields_staffid = StepsFieldsStaff::where("staff_id", "=", $user_id)->where("field_name",
            "=", "stafffile1")->orWhere("field_name", "=", "stafffile2")->orWhere("field_name",
            "=", "stafffile3")->orWhere("field_name", "=", "stafffile4")->select('field_id',
            'field_name')->get();

        //echo $this->last_query();
        foreach ($fields_staffid as $value) {

            $step_ids[$value['field_name']] = $value->field_id;

        }

        $data['step_staffids'] = $step_ids;


        $step_profids = array();
        $fields_profid = StepsFieldsStaff::where("staff_id", "=", $user_id)->where("field_name",
            "=", "profilefile1")->orWhere("field_name", "=", "profilefile2")->orWhere("field_name",
            "=", "profilefile3")->orWhere("field_name", "=", "profilefile4")->select('field_id',
            'field_name')->get();

        //echo $this->last_query();
        foreach ($fields_profid as $value) {

            $step_profids[$value['field_name']] = $value->field_id;

        }
        $data['step_profids'] = $step_profids;


        return $data;
    }


    public function user_details_process()
    {
        $postData = Input::all();


        //echo "<pre>";
        //print_r($postData['country']);die();

        /* if( $postData['oldstafffile1']!=""){
        die('if');
        }
        else{
        die('else');
        }*/


        //$postData['res_postcode'];
        //echo "<pre>";
        // print_r($postData['res_postcode']);die();
        $data = array();
        $userData = array();
        $arrData = array();

        $session = Session::get('admin_details');
        $data['user_id'] = $session['id'];

        $user_id = $data['user_id'];
        $data['user_type'] = $session['user_type'];

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

        $userprof_update = User::where("user_id", "=", $postData['staff_id'])->update($userData);
        $staff_id = $postData['staff_id'];

        //$filevalue=('staff_file1,staff_file2,staff_file3,staff_file4,prof_file1,prof_file2,prof_file3,prof_file4');

        $result = StepsFieldsStaff::where("staff_id", "=", $staff_id)->get();


        /*if (isset($result) && count($result) > 0) {

            if ($postData['page_name'] == "staff") {
                StepsFieldsStaff::where("staff_id", "=", $staff_id)->where("field_name", "!=",
                    "stafffile1")->orWhere("field_name", "!=", "stafffile2")->orWhere("field_name",
                    "!=", "stafffile3")->orWhere("field_name", "!=", "stafffile4")->delete();
            }else{
                StepsFieldsStaff::where("staff_id", "=", $staff_id)->where("field_name", "!=",
                    "profilefile1")->orWhere("field_name", "!=", "profilefile2")->orWhere("field_name",
                    "!=", "profilefile3")->orWhere("field_name", "!=", "profilefile4")->delete();
            } */


        StepsFieldsStaff::where("staff_id", "=", $staff_id)->where("field_name", "!=",
                    "stafffile1")->where("field_name", "!=", "stafffile2")->where("field_name",
                    "!=", "stafffile3")->where("field_name", "!=", "stafffile4")->where("field_name", "!=",
                    "profilefile1")->where("field_name", "!=", "profilefile2")->where("field_name",
                    "!=", "profilefile3")->where("field_name", "!=", "profilefile4")->delete();
//echo $this->last_query();die;
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
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'marital_status',
                $postData['marital_status']);
        }

        if (!empty($postData['nationality'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'nationality', $postData['nationality']);
        }

        if (!empty($postData['country'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'country', $postData['country']);
        }
        if (!empty($postData['position_type'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'position_type', $postData['position_type']);
        }
        if (!empty($postData['ni_number'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'ni_number', $postData['ni_number']);
        }
        if (!empty($postData['tax_reference'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'tax_reference',
                $postData['tax_reference']);
        }


        if (!empty($postData['professional_body'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'professional_body', $postData['professional_body']);
        }


        if (!empty($postData['student_number'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'student_number',
                $postData['student_number']);
        }

        //echo '<pre>';print_r($arrData);die();
        //################ GENERAL SECTION START #################//


        //################ Contact info START #################//
        $step_id = 2;
        if (!empty($postData['res_addr_line1'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'res_addr_line1',
                $postData['res_addr_line1']);
        }

        if (!empty($postData['res_addr_line2'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'res_addr_line2',
                $postData['res_addr_line2']);
        }
        if (!empty($postData['res_city'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'res_city', $postData['res_city']);
        }

        if (!empty($postData['res_county'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'res_county', $postData['res_county']);
        }

        if (!empty($postData['res_postcode'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'res_postcode',
                $postData['res_postcode']);
        }

        if (!empty($postData['res_country'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'res_country', $postData['res_country']);
        }


        if (!empty($postData['serv_tele_code'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'serv_tele_code',
                $postData['serv_tele_code']);
        }
        if (!empty($postData['serv_telephone'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'serv_telephone',
                $postData['serv_telephone']);
        }

        if (!empty($postData['serv_mobile_code'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id,
                'serv_mobile_code', $postData['serv_mobile_code']);
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
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'emer_telephone',
                $postData['emer_telephone']);
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
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id,
                'holiday_entitlement', $postData['holiday_entitlement']);
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
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'qualifications',
                $postData['qualifications']);
        }

        if (!empty($postData['leaving_date'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'leaving_date',
                $postData['leaving_date']);
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

        if (!empty($postData['note'])) {
            $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'note', $postData['note']);
        }

        //################ Other START #################//


        // ################# File upload in the other section start ############### //
        for ($i = 1; $i <= 4; $i++) {
            if (($postData['page_name']) == "staff") {
                if (Input::hasFile('stafffile'.$i)) {
                    $file   = Input::file('stafffile'.$i);
                    $destinationPath = "uploads/stafffile/";
                    $fileName   = Input::file('stafffile'.$i)->getClientOriginalName();
                    
                    //$random = str_random(4);
                    //$file_name=$random.$fileName;
                    
                    $result     = Input::file('stafffile'.$i)->move($destinationPath, $fileName);
                    
                    $arrData[]  = $this->save_profile($user_id, $staff_id, $step_id, 'stafffile'.$i,
                        $fileName);

                    //ClientFile::where("client_file_id", "=", $client_file_id)->update($file_data);

                    ### delete the previous image if exists ###
                    /*  if (isset($file_details['stafffile' . $i]) && $file_details['stafffile' . $i] !=
                    "") {
                    $prevPath = "uploads/stafffile/" . $file_details['stafffile' . $i];
                    if (file_exists($prevPath)) {
                    unlink($prevPath);
                    }
                    } */

                    ### delete the previous image if exists ###

                }else {
                    if(isset($postData['oldstafffile'.$i]) && $postData['oldstafffile'.$i] != ""){
                        $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'stafffile'.$i,
                        $postData['oldstafffile'.$i]);
                    }
                }

            }else{
                if (Input::hasFile('profilefile' . $i)) {
                    $file = Input::file('profilefile' . $i);
                    $destinationPath = "uploads/profilefile/";
                    $fileName = Input::file('profilefile' . $i)->getClientOriginalName();
                    //$fileName = $fileName;
                    $result = Input::file('profilefile' . $i)->move($destinationPath, $fileName);

                    $file_data['profilefile' . $i] = $fileName;

                    $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'profilefile' .
                        $i, $fileName);

                    //ClientFile::where("client_file_id", "=", $client_file_id)->update($file_data);

                    ### delete the previous image if exists ###
                    /*  if (isset($file_details['profilefile' . $j]) && $file_details['profilefile' . $j] !=
                    "") {
                    $prevPath = "uploads/profilefile/" . $file_details['profilefile' . $j];
                    if (file_exists($prevPath)) {
                    unlink($prevPath);
                    }
                    } */

                    ### delete the previous image if exists ###

                } else {
                    if(isset($postData['oldprofilefile'.$i]) && $postData['oldprofilefile'.$i] != ""){
                        $arrData[] = $this->save_profile($user_id, $staff_id, $step_id, 'profilefile'.$i, $postData['oldprofilefile'.$i]);
                    }
                }
            }


        }
        // ################# File upload in the other section end ############### //


        StepsFieldsStaff::insert($arrData);
        //echo '<pre>';print_r($arrData);
        //die();
        //return Redirect::to('/staff-details');
        return Redirect::to('/staff-profile');
        //die('insert');
    }


    public function save_profile($user_id, $staff_id, $step_id, $field_name, $field_value)
    {
        $data = array();
        $data['user_id'] = $user_id;
        $data['staff_id'] = $staff_id;
        $data['step_id'] = $step_id;
        $data['field_name'] = $field_name;
        $data['field_value'] = $field_value;
        return $data;
        //OrganisationClient::insert($data);
    }

    public function delete_stafffile()
    {
        $user_id=Input::get("del_id");
        
       //print_r($user_id);die();
        $field_name= StepsFieldsStaff::where("field_id", "=", $user_id)->select('field_name')->first();
       
       echo $field_name['field_name'];
       //die();
       
       
       
       
       StepsFieldsStaff::where("field_id", "=", $user_id)->delete();
       
      
       //print_r($user_id);die();
       //echo $this->last_query();die;       
       //return Redirect::to('/staff-details');
        
        //print_r($user_id);die();
        
        
    }
    public function add_position_type()
    {
        $session_data = Session::get('admin_details');
		
		$data['name'] 			= Input::get("org_name");
		$data['user_id'] 		= $session_data['id'];
		$data['status'] 		= "new";
		$insert_id = Position::insertGetId($data);
		echo $insert_id;exit();
		//return Redirect::to('/organisation/add-client');

         
    }
    
    public function add_department_type()
    {
        $session_data = Session::get('admin_details');
		
		$data['name'] 			= Input::get("dept_name");
		$data['user_id'] 		= $session_data['id'];
		$data['status'] 		= "new";
		$insert_id = Department::insertGetId($data);
		echo $insert_id;exit();
		//return Redirect::to('/organisation/add-client');

         
    }
    
    
    
    
    
    
    	public function delete_position_type() {
		$field_id = Input::get("field_id");
		if (Request::ajax()) {
			$data = Position::where("position_id", "=", $field_id)->delete();
			echo $data;
		}
	}
    
    public function delete_department_type() {
		$field_id = Input::get("field_id");
		if (Request::ajax()) {
			$data = Department::where("department_id", "=", $field_id)->delete();
			echo $data;
		}
	}
    
    
    //public function prof_file(){

    //  echo'adafafa';
    //$postData = Input::all();
    //echo 'adfafaf';
    //        //print_r($_FILES);die;
    //print_r($postData);die();
    //
    // }


    public function to_list()
    {
        $data = array();
        $session = Session::get('admin_details');
        $data['user_id'] = $session['id'];
        $data['user_type'] = $session['user_type'];
        $data['heading'] = "";
        $data['title'] = "To List";
        $data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';

        if (!isset($data['user_id']) && $data['user_id'] == "") {
            return Redirect::to('/');
        } else
            if (isset($data['user_type']) && $data['user_type'] == "C") {
                return Redirect::to('/invitedclient-dashboard');
            }

        return View::make("staff.profile.to_list", $data);
    }


}
