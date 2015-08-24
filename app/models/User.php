<?php
class User extends Eloquent {

	public $timestamps = false;
	public static function getStaffNameById($staff_id)
	{
		$details = User::where("user_id", "=", $staff_id)->select("fname", "lname")->first();
		$name = "";
		if(!empty($details['fname'])){
			$name.=$details['fname'];
		}
		if(!empty($details['lname'])){
			$name.=" ".$details['lname'];
		}
		return $name;
	}

	public static function getAllStaffDetails()
    {
        $details 		= array();
        $step_data 		= array();
        $session 		= Session::get('admin_details');
        $user_id 		= $session['id'];
        $user_type 		= $session['user_type'];
        $groupUserId 	= $session['group_users'];

        $staff = User::whereIn("user_id", $groupUserId)->where("client_id", "=", 0)->get();
        //echo $this->last_query();die;
        if (isset($staff) && count($staff) > 0) {
            foreach ($staff as $key => $value) {
                $details[$key]['user_id'] 	= $value->user_id;
                $details[$key]['parent_id'] = $value->parent_id;
                $details[$key]['group_id'] 	= $value->group_id;
                $details[$key]['client_id'] = $value->client_id;
                $details[$key]['fname'] 	= $value->fname;
                $details[$key]['lname'] 	= $value->lname;
                $details[$key]['email'] 	= $value->email;
                $details[$key]['password'] 	= $value->password;
                $details[$key]['phone'] 	= $value->phone;
                $details[$key]['website'] 	= $value->website;
                $details[$key]['country'] 	= $value->country;
                $details[$key]['user_type'] = $value->user_type;
                $details[$key]['status'] 	= $value->status;
                $details[$key]['created'] 	= $value->created;

                $fields = StepsFieldsStaff::where("staff_id", "=", $value->user_id)->get();
                if (isset($fields) && count($fields) > 0) {
                    $address = "";
                    $res_address = "";
                    foreach ($fields as $value) {
                    	
                    	if (isset($value['field_name']) && $value['field_name'] == 'res_addr_line1'){
		                    $res_address .= $value->field_value . ", ";
		                }

		                if (isset($value['field_name']) && $value['field_name'] == 'res_addr_line2'){
		                    $res_address .= $value->field_value . ", ";
		                }

		                if (isset($value['field_name']) && $value['field_name'] == 'res_city'){
		                    $address .= $value->field_value. ", ";
		                    $res_address .= $value->field_value. ", ";
		                }

		                if (isset($value['field_name']) && $value['field_name'] == 'res_county'){
		                    //$address .= $value->field_value . ", ";
		                    $res_address .= $value->field_value . ", ";
		                }
		                if (isset($value['field_name']) && $value['field_name'] == 'res_postcode'){
		                    $res_address .= $value->field_value.", ";
		                }


		                $step_data['address'] = substr($address, 0, -2);
		                $step_data['reg_address'] = substr($res_address, 0, -2);
                        $step_data[$value['field_name']] = $value->field_value;
                    }
                }

                $details[$key]['step_data'] = $step_data;
                
		    }
        }

        //print_r($details);die();

        return $details;
    }
}
