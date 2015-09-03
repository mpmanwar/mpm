<?php
class StaffdataController extends BaseController{
    public function __construct()
    {
        parent::__construct();
        $session        = Session::get('admin_details');
        $user_id        = $session['id'];
        if (empty($user_id)) {
            Redirect::to('/login');
        }
        if (isset($session['user_type']) && $session['user_type'] == "C") {
            Redirect::to('/client-portal')->send();
        }
    }

    public function staff_data()
    {
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $user_type = $session['user_type'];
        $groupUserId = $session['group_users'];

        if (!isset($user_id) && $user_id == "") {
            return Redirect::to('/');
        } else
            if (isset($user_type) && $user_type == "C") {
                return Redirect::to('/invitedclient-dashboard');
            }

        $data['heading'] = "";
        $data['title'] = "Staff List";
        $data['previous_page'] = '<a href="/staff-management">Staff Management</a>';

        $data['staff_details'] = $this->getAllStaffDetails();


        $address = "";

        if (isset($data['staff_details']) && count($data['staff_details']) > 0) {

            foreach ($data['staff_details'] as $key => $add) {


                if (isset($add['step_data']['res_addr_line1'])) {
                    $add['step_data']['res_addr_line1'];
                }


                if (isset($add['step_data']['res_addr_line1'])) {
                    $address .= $add['step_data']['res_addr_line1'] . ", ";
                }

                if (isset($add['step_data']['res_addr_line2'])) {
                    $address .= $add['step_data']['res_addr_line2'] . ", ";
                }

                if (isset($add['step_data']['res_city'])) {
                    $address .= $add['step_data']['res_city'] . ", ";
                }

                if (isset($add['step_data']['res_county'])) {
                    $address .= $add['step_data']['res_county'] . ", ";
                }
                if (isset($add['step_data']['res_postcode'])) {
                    $address .= $add['step_data']['res_postcode'];
                }


                $data['staff_details'][$key]['fulladdress'] = $address;
            }
        }


        return View::make('staff.staffdata.staff_data', $data);

    }

    public function getAllStaffDetails()
    {
        $details = array();
        $step_data = array();
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $user_type = $session['user_type'];
        $groupUserId = $session['group_users'];

        $staff = User::whereIn("user_id", $groupUserId)->where("is_archive", "=", "N")->where("client_id", "=", 0)->
            get();
        //echo $this->last_query();die;
        if (isset($staff) && count($staff) > 0) {
            foreach ($staff as $key => $value) {
                $details[$key]['user_id']       = $value->user_id;
                $details[$key]['parent_id']     = $value->parent_id;
                $details[$key]['group_id']      = $value->group_id;
                $details[$key]['client_id']     = $value->client_id;
                $details[$key]['fname']         = $value->fname;
                $details[$key]['lname']         = $value->lname;
                $details[$key]['email']         = $value->email;
                $details[$key]['password']      = $value->password;
                $details[$key]['phone']         = $value->phone;
                $details[$key]['website']       = $value->website;
                $details[$key]['country']       = $value->country;
                $details[$key]['user_type']     = $value->user_type;
                $details[$key]['status']        = $value->status;
                $details[$key]['is_archive']    = $value->is_archive;
                $details[$key]['show_archive']  = $value->show_archive;
                $details[$key]['created']       = $value->created;

                //print_r($value->user_id);die();

                $fields = StepsFieldsStaff::where("staff_id", "=", $value->user_id)->get();
                //echo $this->last_query();
                //                echo '<pre>';
                //                print_r($fields);die;

                if (isset($fields) && count($fields) > 0) {
                    foreach ($fields as $value) {
                        $step_data[$value['field_name']] = $value->field_value;
                    }
                }

                $details[$key]['step_data'] = $step_data;
                
                if (isset($details[$key]['step_data']['department']) && count($details[$key]['step_data']['department']) > 0) {
        $fields_staffid = Department::where("department_id", "=", $details[$key]['step_data']['department'])->select('name')->first();
        $details[$key]['department_name'] = $fields_staffid['name'];
        }
        
        if (isset($details[$key]['step_data']['position_type']) && count($details[$key]['step_data']['position_type']) > 0) {
        $fields_Position = Position::where("position_id", "=", $details[$key]['step_data']['position_type'])->select('name')->first();
        
        $details[$key]['position_name'] = $fields_Position['name'];
        }


            }
        }

        return $details;
    }

    public function archive_staff() {
        Session::put('show_staff_archive', 'Y');

        $users_id = Input::get("users_id");
        $status = Input::get("status");
        //print_r($users_id);die;
        foreach ($users_id as $user_id) {
            if($status == "Archive"){
                User::where('user_id', '=', $user_id)->update(array("is_archive"=>"Y", "show_archive"=>"Y"));
            }else{
                User::where('user_id', '=', $user_id)->update(array("is_archive"=>"N", "show_archive"=>"N"));
            }
            
            //echo $this->last_query();die;
        }
    }

    public function show_archive_staff() {
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $groupUserId = $session['group_users'];

        $is_archive = Input::get("is_archive");
        if($is_archive == "Y"){
            Session::put('show_staff_archive', 'Y');
        }else{
            Session::put('show_staff_archive', 'N');
        }

        $affected = User::whereIn("user_id", $groupUserId)->where("show_archive", "=", "Y")->update(array("is_archive"=>$is_archive));
        echo $affected;
        //echo $this->last_query();die;
    }
}
