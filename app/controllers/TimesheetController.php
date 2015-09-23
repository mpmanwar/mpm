<?php
//opcache_reset ();
//Cache::forget('user_list');
//use DB;
class TimesheetController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        if (empty($user_id)) {
            Redirect::to('/login');
        }
        if (isset($session['user_type']) && $session['user_type'] == "C") {
            Redirect::to('/client-portal')->send();
        }
    }

    public function time_sheet_reports($type)
    {
        //die('staffmanagement');
        $data['heading'] = "TIME SHEET";
        $data['title'] = "Time Sheet Reports";
        if (base64_decode($type) == 'profile') {
            $data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        } else {
            $data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        }
        $data['staff_type'] = base64_decode($type);


        $data['heading'] = "";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['user_type'] = $session['user_type'];
        $groupUserId = $session['group_users'];

        //print_r($groupUserId);die();

        $data['staff_details'] = User::whereIn("user_id", $groupUserId)->where("client_id",
            "=", 0)->select("user_id", "fname", "lname")->get();
        $data['old_vat_schemes'] = VatScheme::where("status", "=", "old")->orderBy("vat_scheme_name")->
            get();
        $data['new_vat_schemes'] = VatScheme::where("status", "=", "new")->whereIn("user_id",
            $groupUserId)->orderBy("vat_scheme_name")->get();

        $data['allClients'] = App::make("HomeController")->get_all_clients();


        $time_sheet_report = TimeSheetReport::whereIn("user_id", $groupUserId)->orderBy("created_date",
            "desc")->get();
        //echo $this->last_query();die();
        if (!empty($time_sheet_report)) {
            foreach ($time_sheet_report as $key => $val) {

                $data2[$key]['timesheet_id'] = $val['timesheet_id'];
                $data2[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data2[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data2[$key]['hrs'] = $val['hrs'];
                $data2[$key]['notes'] = $val['notes'];
                $data2[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data2)) {
                $data['time_sheet_report'] = $data2;
            }
        }

        $time_sheet_reportlmt = TimeSheetReport::whereIn("user_id", $groupUserId)->
            orderBy("created_date", "desc")->take(90)->get();
        //echo $this->last_query();die();
        if (!empty($time_sheet_reportlmt)) {
            foreach ($time_sheet_reportlmt as $key => $val) {

                $data3[$key]['timesheet_id'] = $val['timesheet_id'];
                $data3[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data3[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data3[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data3[$key]['hrs'] = $val['hrs'];
                $data3[$key]['notes'] = $val['notes'];
                $data3[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data3)) {
                $data['time_sheet_reportlmt'] = $data3;
            }
        }


        /*
        $client_time_report = ClientTimeReport::whereIn("user_id", $groupUserId)->orderBy("created","desc")->get();
        
        if(!empty($client_time_report)){
        
        foreach($client_time_report as $key=>$val){
        
        $data3[$key]['ctr_id'] = $val['ctr_id'];
        //$data3[$key]['staff_detail'] 	= User::where("user_id", "=", $val['staff_id'])->select("user_id", "fname", "lname")->first();
        $data3[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['ctr_serv'])->select("vat_scheme_name")->first();
        //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
        $data3[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['ctr_client'])->where(function ($query) {$query->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name");})->first();
        
        //echo $this->last_query();
        $data3[$key]['fromdate'] = $val['fromdate'];	
        $data3[$key]['todate'] = $val['todate'];	
        $data3[$key]['created_date'] = date("d-m-Y",strtotime($val['created']));					
        }
        
        if(!empty($data3)){		
        $data['client_time_report'] =  $data3;
        }
        
        
        }
        
        $staff_time_report = StaffTimeReport::whereIn("user_id", $groupUserId)->orderBy("created","desc")->get();
        //echo '<pre>'; print_r($staff_time_report);die();
        
        if(!empty($staff_time_report)){
        
        foreach($staff_time_report as $key=>$val){
        
        $data4[$key]['str_id'] = $val['str_id'];
        $data4[$key]['staff_detail'] 	= User::where("user_id", "=", $val['str_staff'])->select("user_id", "fname", "lname")->first();
        
        //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
        $data4[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['str_client'])->where(function ($query) {$query->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name");})->first();
        
        //echo $this->last_query();
        $data4[$key]['fromdate'] = $val['strfromdate'];	
        $data4[$key]['todate'] = $val['strtodate'];	
        $data4[$key]['created_date'] = date("d-m-Y",strtotime($val['created']));					
        }
        
        if(!empty($data4)){		
        $data['staff_time_report'] =  $data4;
        }
        
        
        }
        */


        //echo '<pre>'; print_r($data3);die();

        //echo $this->last_query();

        //echo '<pre>';print_r($data2);die();

        return View::make('staff.timesheet.time_sheet_reports', $data);

    }
    public function edit_time_sheet()
    {

        $data['heading'] = "TIME SHEET";
        $data['title'] = "Time Sheet Reports";
        /*if(base64_decode($type) == 'profile'){
        $data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        }else{
        $data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        }*/
        $data['heading'] = "";
        $session_data = Session::get('admin_details');
        $data['user_type'] = $session_data['user_type'];
        $groupUserId = $session_data['group_users'];
        $data1 = array();
        //echo '<pre>';

        //print_r($session_data);

        $data1['staff_id'] = Input::get("staff_id");
        $data1['rel_client_id'] = Input::get("rel_client_id");
        $data1['vat_scheme_type'] = Input::get("vat_scheme_type");
        $data1['hrs'] = Input::get("hrs");
        $data1['notes'] = Input::get("notes");
        $data1['user_id'] = $session_data['id'];
        $data1['created_date'] = date('Y-m-d', strtotime(Input::get("date")));
        $editid = Input::get("editid");
        //echo '<pre>';
        //print_r($data1);
        //exit();
        $affected = TimeSheetReport::where("timesheet_id", "=", $editid)->update($data1);

        //echo $this->last_query();

        return Redirect::to('/time-sheet-reports/c3RhZmY=');
    }
    public function insert_time_sheet()
    {

        $data['heading'] = "TIME SHEET";
        $data['title'] = "Time Sheet Reports";
        /*if(base64_decode($type) == 'profile'){
        $data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        }else{
        $data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        }*/
        $data['heading'] = "";
        $session_data = Session::get('admin_details');
        $data['user_type'] = $session_data['user_type'];
        $groupUserId = $session_data['group_users'];
        $data1 = array();
        //echo '<pre>';

        //print_r($session_data);

        $data1['staff_id'] = Input::get("staff_id");
        $data1['rel_client_id'] = Input::get("rel_client_id");
        $data1['vat_scheme_type'] = Input::get("vat_scheme_type");
        $data1['hrs'] = Input::get("hrs");
        $data1['notes'] = Input::get("notes");
        $data1['user_id'] = $session_data['id'];
        $data1['created_date'] = Input::get("date");
        //echo '<pre>';
        //var_dump($data1['created_date']);
        //exit();


        //echo 'ssss';
        //echo count($data1['created_date']);
        for ($i = 0; $i < count($data1['created_date']); $i++) {


            $data[$i]['staff_id'] = $data1['staff_id'][$i];
            $data[$i]['rel_client_id'] = $data1['rel_client_id'][$i];
            $data[$i]['vat_scheme_type'] = $data1['vat_scheme_type'][$i];
            $data[$i]['hrs'] = $data1['hrs'][$i];
            $data[$i]['notes'] = $data1['notes'][$i];
            $data[$i]['user_id'] = $session_data['id'];
            $data[$i]['created_date'] = date("Y-m-d", strtotime($data1['created_date'][$i]));
            //echo '<pre>';
            //print_r($data[$i]);
            //die();
            $insert_id[$i] = TimeSheetReport::insertGetId($data[$i]);

        }


        //Redirect::to('/');


        //exit();


        return Redirect::to('/time-sheet-reports/c3RhZmY=');
        //echo '<pre>';
        //print_r($data2);
        //exit();
        //$insert_id = OrganisationType::insertGetId($data);
        //echo exit();
        //return View::make('staff.timesheet.time_sheet_reports',$data2);

    }

    public function timesheet_templates()
    {

        $timesheet_id = Input::get("timesheet_id");
        $admin_s = Session::get('admin_details');
        $user_id = $admin_s['id'];
        $groupUserId = $admin_s['group_users'];


        if (Request::ajax()) {

            $timesheetTemplates = TimeSheetReport::where("timesheet_id", $timesheet_id)->
                first();
            $timesheetTemplates['group'] = $groupUserId;
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($timesheetTemplates);
            //echo 'aaaaa';
            exit();

        }


    }


    public function insertclient_time_sheet()
    {
        $ctr_data = array();
        $data_ctr = array();
        $data = array();
        $ctr_data['ctr_client'] = Input::get("ctr_client");
        $ctr_data['ctr_serv'] = Input::get("ctr_serv");
        $ctr_data['fromdate'] = date('Y-m-d', strtotime(Input::get("fromdpick2")));
        $ctr_data['todate'] = date('Y-m-d', strtotime(Input::get("todpick")));
        // die();

        $form = $ctr_data['fromdate'];
        $to = $ctr_data['todate'];

        if ($ctr_data['ctr_serv'] != "") {


            $limitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $ctr_data['ctr_client'])->where('vat_scheme_type',
                '=', $ctr_data['ctr_serv'])->get();
        } else {
            $limitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $ctr_data['ctr_client'])->get();
        }
        //echo $this->last_query();
        //die();


        /*
        $postData = Input::all();
        //$ctr_data = array();

        //print_r($postData);die();
        $session = Session::get('admin_details');
        $user_id = $session['id'];

        $ctr_data['user_id'] = $user_id;

        if (isset($postData['ctr_client']) && !empty($postData['ctr_client'])) {

        $ctr_data['ctr_client'] = $postData['ctr_client'];
        }

        if (isset($postData['ctr_serv']) && !empty($postData['ctr_serv'])) {

        $ctr_data['ctr_serv'] = $postData['ctr_serv'];
        }
        if (isset($postData['fromdate']) && !empty($postData['fromdate'])) {

        $ctr_data['fromdate'] = date('Y-m-d', strtotime($postData['fromdate']));
        }
        
        if (isset($postData['todate']) && !empty($postData['todate'])) {

        $ctr_data['todate'] = date('Y-m-d', strtotime($postData['todate']));
        }

        $form = $ctr_data['fromdate'];
        $to = $ctr_data['todate'];

        $limitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->where('rel_client_id','=',$ctr_data['ctr_client'])->where('vat_scheme_type','=',$ctr_data['ctr_serv'])->get();

        echo $this->last_query();die();*/

        //echo '<pre>'; print_r($betweendata);die();

        if (!empty($limitimesheet)) {
            foreach ($limitimesheet as $key => $val) {
                //echo 'gddhdhdhd';

                $data_ctr[$key]['timesheet_id'] = $val['timesheet_id'];
                $data_ctr[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data_ctr[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data_ctr[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data_ctr[$key]['hrs'] = $val['hrs'];
                $data_ctr[$key]['notes'] = $val['notes'];
                $data_ctr[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data_ctr)) {
                $data['limitimesheet'] = $data_ctr;
            }
        }

        $client_timereport = $data['cfinal_array'] = array();
        if (isset($data['limitimesheet'])) {

            foreach ($data['limitimesheet'] as $eachR) {
                $temp = array();
                $temp['client_name'] = $eachR{'client_detail'}->field_value;
                $temp['staff_name'] = $eachR{'staff_detail'}->fname . " " . $eachR{
                    'staff_detail'}->lname;
                $temp['date'] = $eachR['created_date'];
                //$temp['service']  = $eachR{'old_vat_scheme'}->vat_scheme_name;

                $temp['hrs'] = $eachR['hrs'];


                //$client_timereport[$eachR{'client_detail'}->field_id][] = $temp;

                $client_timereport[$eachR{'old_vat_scheme'}->vat_scheme_name][] = $temp;


            }


        }

        $data['cfinal_array'] = $client_timereport;

        // echo '<pre>';
        // print_r($data['cfinal_array']);die;

        //header('Content-Type: application/json; charset=utf-8');
        //   echo json_encode($data['limitimesheet']);
        // echo '<pre>';
        //print_r($data);
        //die();


        //$ctr_id = ClientTimeReport::insertGetId($ctr_data);


        //print_r($ctr_id);
        // echo '<pre>'; print_r($postData);
        //echo "client_tr";die;


        //echo '<pre>'; print_r($postData);
        echo View::make('staff.timesheet.client_timereport')->with('cfinal_array', $data['cfinal_array']);

        //echo View::make('staff.timesheet.client_timereport', $data);
        //return Redirect::to('/time-sheet-reports/c3RhZmY=');
        //die('insertclient_time_sheet');
    }


    public function insertstaff_time_sheet()
    {

        $str_data = array();
        $data_str = array();
        $data = array();

        $str_data['str_staff'] = Input::get("str_staff");
        $str_data['str_client'] = Input::get("str_client");
        $str_data['strfromdate'] = date('Y-m-d', strtotime(Input::get("strdpick2")));
        $str_data['strtodate'] = date('Y-m-d', strtotime(Input::get("dpickclient")));


        $form = $str_data['strfromdate'];
        $to = $str_data['strtodate'];

        if ($str_data['str_client'] != "") {

            $strlimitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $str_data['str_client'])->where('staff_id', '=', $str_data['str_staff'])->
                get();

        } else {

            // $strlimitimesheet = TimeSheetReport::groupBy('rel_client_id')->whereBetween('created_date', array($form, $to))->where('staff_id','=',$str_data['str_staff'])->get();
            $strlimitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('staff_id', '=', $str_data['str_staff'])->get();
        }

        //echo $this->last_query();
        //die();
        //echo '<pre>';
        //print_r($strlimitimesheet);
        if (!empty($strlimitimesheet)) {
            foreach ($strlimitimesheet as $key => $val) {


                $data_str[$key]['timesheet_id'] = $val['timesheet_id'];
                $data_str[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data_str[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data_str[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data_str[$key]['hrs'] = $val['hrs'];
                $data_str[$key]['notes'] = $val['notes'];
                $data_str[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data_str)) {
                $data['limitimesheetstr'] = $data_str;
                //echo '<pre>';
                //print_r($data);
            }
        }

        $staff_timereport = $data['final_array'] = $data['total'] = array();
        if (isset($data['limitimesheetstr'])) {

            foreach ($data['limitimesheetstr'] as $eachR) {
                $temp = array();
                //$temp['client_name']  = $eachR{'client_detail'}->field_value;
                $temp['staff_name'] = $eachR{'staff_detail'}->fname . " " . $eachR{
                    'staff_detail'}->lname;
                $temp['date'] = $eachR['created_date'];
                $temp['service'] = $eachR{'old_vat_scheme'}->vat_scheme_name;

                $temp['hrs'] = $eachR['hrs'];


                //$staff_timereport[$eachR{'client_detail'}->field_id][] = $temp;

                $staff_timereport[$eachR{'client_detail'}->field_value][] = $temp;


            }


        }

        $data['final_array'] = $staff_timereport;
        // echo '<pre>';
        //print_r($data['final_array']);die;

        // echo View::make('staff.timesheet.staff_timereport')->with('limitimesheetstr',$data['limitimesheetstr'])->with('final_array',$data['final_array']);
        echo View::make('staff.timesheet.staff_timereport')->with('final_array', $data['final_array']);
        /*
        $postData = Input::all();
        //echo '<pre>'; print_r($postData);die();
        $str_data = array();
        $session = Session::get('admin_details');
        $user_id = $session['id'];

        $str_data['user_id'] = $user_id;

        if (isset($postData['str_staff']) && !empty($postData['str_staff'])) {

        $str_data['str_staff'] = $postData['str_staff'];
        }
        if (isset($postData['str_client']) && !empty($postData['str_client'])) {

        $str_data['str_client'] = $postData['str_client'];
        }
        if (isset($postData['strfromdate']) && !empty($postData['strfromdate'])) {

        $str_data['strfromdate'] = date('Y-m-d', strtotime($postData['strfromdate']));
        }
        if (isset($postData['strtodate']) && !empty($postData['strtodate'])) {

        $str_data['strtodate'] = date('Y-m-d', strtotime($postData['strtodate']));
        }


        $str_id = StaffTimeReport::insertGetId($str_data);
        //print_r($str_id);
        return Redirect::to('/time-sheet-reports/c3RhZmY=');*/


        //die('insertstaff_time_sheet');

    }

    public function editclient_time_sheet()
    {


        $ctr_id = Input::get("ctr_id");
        $admin_s = Session::get('admin_details');
        $user_id = $admin_s['id'];
        // $groupUserId = $admin_s['group_users'];


        if (Request::ajax()) {

            $clienttimesheet = ClientTimeReport::where("ctr_id", $ctr_id)->first();
            //$timesheetTemplates['group'] = $groupUserId;
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($clienttimesheet);
            //echo 'aaaaa';
            exit();

        }


    }

    public function editclient_time_report()
    {

        $data['heading'] = "TIME SHEET";
        $data['title'] = "Time Sheet Reports";
        /*if(base64_decode($type) == 'profile'){
        $data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        }else{
        $data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        }*/
        $data['heading'] = "";
        $session_data = Session::get('admin_details');
        $data['user_type'] = $session_data['user_type'];
        $groupUserId = $session_data['group_users'];

        $data_c = array();
        //echo '<pre>';

        //print_r($session_data);
        //ctredit_client
        $data_c['ctr_client'] = Input::get("ctredit_client");
        $data_c['ctr_serv'] = Input::get("ctredit_serv");
        //$data_c['vat_scheme_type'] 	= Input::get("vat_scheme_type");
        $data_c['fromdate'] = date('Y-m-d', strtotime(Input::get("editfromdpick")));
        $data_c['todate'] = date('Y-m-d', strtotime(Input::get("edittodpick")));
        $data_c['user_id'] = $session_data['id'];
        //$data1['created_date'] 		=  date('Y-m-d',strtotime(Input::get("date")));
        $editid = Input::get("editctrid");
        //echo '<pre>';
        //	print_r($data_c);
        //die();
        //exit();
        $affected = ClientTimeReport::where("ctr_id", "=", $editid)->update($data_c);

        //echo $this->last_query();die();

        return Redirect::to('/time-sheet-reports/c3RhZmY=');
    }


    public function fetcheditstaff_time_sheet()
    {


        $str_id = Input::get("str_id");
        $admin_s = Session::get('admin_details');
        $user_id = $admin_s['id'];
        // $groupUserId = $admin_s['group_users'];


        if (Request::ajax()) {

            $stafftimesheet = StaffTimeReport::where("str_id", $str_id)->first();
            //$timesheetTemplates['group'] = $groupUserId;
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($stafftimesheet);
            //echo 'aaaaa';
            exit();

        }


    }

    public function editstaff_time_report()
    {


        //die('sdfafafaf');


        $data['heading'] = "TIME SHEET";
        $data['title'] = "Time Sheet Reports";
        /*if(base64_decode($type) == 'profile'){
        $data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        }else{
        $data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        }*/
        $data['heading'] = "";
        $session_data = Session::get('admin_details');
        $data['user_type'] = $session_data['user_type'];
        $groupUserId = $session_data['group_users'];

        $data_s = array();
        //echo '<pre>';

        //print_r($session_data);
        //ctredit_client
        $data_s['str_client'] = Input::get("editstr_client");

        $data_s['str_staff'] = Input::get("editstr_staff");
        //$data_c['vat_scheme_type'] 	= Input::get("vat_scheme_type");
        $data_s['strfromdate'] = date('Y-m-d', strtotime(Input::get("editstrfromdate")));
        $data_s['strtodate'] = date('Y-m-d', strtotime(Input::get("editstrtodate")));
        $data_s['user_id'] = $session_data['id'];
        //$data1['created_date'] 		=  date('Y-m-d',strtotime(Input::get("date")));
        $editstrid = Input::get("editstrid");
        //echo '<pre>';
        //print_r($data_s);
        //die();
        //exit();
        $affected = StaffTimeReport::where("str_id", "=", $editstrid)->update($data_s);

        //echo $this->last_query();die();

        return Redirect::to('/time-sheet-reports/c3RhZmY=');


    }

    public function delete_time_report()
    {


        $del_id = Input::get("delid");
        //echo $del_id;die();
        $admin_s = Session::get('admin_details');
        $user_id = $admin_s['id'];

        echo $timesheet_id = TimeSheetReport::where("timesheet_id", "=", $del_id)->
            delete();

        //return Redirect::to('/time-sheet-reports/c3RhZmY=');

    }


    public function client_timereport()
    {

        $data['heading'] = "CLIENT TIME REPORT";
        $data['title'] = "Client Time Report";
        //if (base64_decode($type) == 'profile') {
        //            $data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        //        } else {
        $data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        //        }
        //        $data['staff_type'] = base64_decode($type);
        //

        //$data['heading'] = "";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['user_type'] = $session['user_type'];
        $groupUserId = $session['group_users'];
        //die('sddsdsd');

        $data['allClients'] = App::make("HomeController")->get_all_clients();
        $data['old_vat_schemes'] = VatScheme::where("status", "=", "old")->orderBy("vat_scheme_name")->
            get();
        $data['new_vat_schemes'] = VatScheme::where("status", "=", "new")->whereIn("user_id",
            $groupUserId)->orderBy("vat_scheme_name")->get();
        return View::make('staff.timesheet.client_report', $data);

    }

    public function staff_timereport()
    {

        $data['heading'] = "STAFF TIME REPORT";
        $data['title'] = "Staff Time Report";
        //if (base64_decode($type) == 'profile') {
        //            $data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        //        } else {
        $data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        //        }
        //        $data['staff_type'] = base64_decode($type);
        //

        // $data['heading'] = "";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['user_type'] = $session['user_type'];
        $groupUserId = $session['group_users'];
        //die('sddsdsd');
        $data['staff_details'] = User::whereIn("user_id", $groupUserId)->where("client_id",
            "=", 0)->select("user_id", "fname", "lname")->get();
        $data['allClients'] = App::make("HomeController")->get_all_clients();
        $data['old_vat_schemes'] = VatScheme::where("status", "=", "old")->orderBy("vat_scheme_name")->
            get();
        $data['new_vat_schemes'] = VatScheme::where("status", "=", "new")->whereIn("user_id",
            $groupUserId)->orderBy("vat_scheme_name")->get();

        //die('stafftimereport');

        return View::make('staff.timesheet.staff_report', $data);
    }

    public function staffdemo()
    {

        $data['heading'] = "STAFF TIME REPORT";
        $data['title'] = "Staff Time Report";
        //if (base64_decode($type) == 'profile') {
        //            $data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        //        } else {
        $data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        //        }
        //        $data['staff_type'] = base64_decode($type);
        //

        // $data['heading'] = "";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['user_type'] = $session['user_type'];
        $groupUserId = $session['group_users'];
        return View::make('staff.timesheet.demo', $data);
    }


    public function timesheetpdf()
    {


        //die('staffmanagement');
        $data['heading'] = "TIME SHEET";
        $data['title'] = "Time Sheet Reports";
        //if (base64_decode($type) == 'profile') {
        //    $data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        //  } else {
        //     $data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        // }
        // $data['staff_type'] = base64_decode($type);


        $data['heading'] = "";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['user_type'] = $session['user_type'];
        $groupUserId = $session['group_users'];

        //print_r($groupUserId);die();

        $data['staff_details'] = User::whereIn("user_id", $groupUserId)->where("client_id",
            "=", 0)->select("user_id", "fname", "lname")->get();
        $data['old_vat_schemes'] = VatScheme::where("status", "=", "old")->orderBy("vat_scheme_name")->
            get();
        $data['new_vat_schemes'] = VatScheme::where("status", "=", "new")->whereIn("user_id",
            $groupUserId)->orderBy("vat_scheme_name")->get();

        $data['allClients'] = App::make("HomeController")->get_all_clients();


        $time_sheet_report = TimeSheetReport::whereIn("user_id", $groupUserId)->orderBy("created_date",
            "desc")->get();
        //echo $this->last_query();die();
        if (!empty($time_sheet_report)) {
            foreach ($time_sheet_report as $key => $val) {

                $data2[$key]['timesheet_id'] = $val['timesheet_id'];
                $data2[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data2[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data2[$key]['hrs'] = $val['hrs'];
                $data2[$key]['notes'] = $val['notes'];
                $data2[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data2)) {
                $data['time_sheet_report'] = $data2;
            }
        }

        $time_sheet_reportlmt = TimeSheetReport::whereIn("user_id", $groupUserId)->
            orderBy("created_date", "desc")->take(90)->get();
        //echo $this->last_query();die();
        if (!empty($time_sheet_reportlmt)) {
            foreach ($time_sheet_reportlmt as $key => $val) {

                $data3[$key]['timesheet_id'] = $val['timesheet_id'];
                $data3[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data3[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data3[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data3[$key]['hrs'] = $val['hrs'];
                $data3[$key]['notes'] = $val['notes'];
                $data3[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data3)) {
                $data['time_sheet_reportlmt'] = $data3;
            }
        }


        $pdf = PDF::loadView('staff/timesheet/timesheetpdf', $data)->setPaper('a4')->
            setOrientation('landscape')->setWarnings(false);
        return $pdf->download('timesheetpdf.pdf');


    }


    public function timesheetexcel()
    {


        //die('staffmanagement');
        $data['heading'] = "TIME SHEET";
        $data['title'] = "Time Sheet Reports";
        //if (base64_decode($type) == 'profile') {
        //    $data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        //  } else {
        //     $data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        // }
        // $data['staff_type'] = base64_decode($type);


        $data['heading'] = "";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['user_type'] = $session['user_type'];
        $groupUserId = $session['group_users'];

        //print_r($groupUserId);die();

        $data['staff_details'] = User::whereIn("user_id", $groupUserId)->where("client_id",
            "=", 0)->select("user_id", "fname", "lname")->get();
        $data['old_vat_schemes'] = VatScheme::where("status", "=", "old")->orderBy("vat_scheme_name")->
            get();
        $data['new_vat_schemes'] = VatScheme::where("status", "=", "new")->whereIn("user_id",
            $groupUserId)->orderBy("vat_scheme_name")->get();

        $data['allClients'] = App::make("HomeController")->get_all_clients();


        $time_sheet_report = TimeSheetReport::whereIn("user_id", $groupUserId)->orderBy("created_date",
            "desc")->get();
        //echo $this->last_query();die();
        if (!empty($time_sheet_report)) {
            foreach ($time_sheet_report as $key => $val) {

                $data2[$key]['timesheet_id'] = $val['timesheet_id'];
                $data2[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data2[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data2[$key]['hrs'] = $val['hrs'];
                $data2[$key]['notes'] = $val['notes'];
                $data2[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data2)) {
                $data['time_sheet_report'] = $data2;
            }
        }

        $time_sheet_reportlmt = TimeSheetReport::whereIn("user_id", $groupUserId)->
            orderBy("created_date", "desc")->take(90)->get();
        //echo $this->last_query();die();
        if (!empty($time_sheet_reportlmt)) {
            foreach ($time_sheet_reportlmt as $key => $val) {

                $data3[$key]['timesheet_id'] = $val['timesheet_id'];
                $data3[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data3[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data3[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data3[$key]['hrs'] = $val['hrs'];
                $data3[$key]['notes'] = $val['notes'];
                $data3[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data3)) {
                $data['time_sheet_reportlmt'] = $data3;
            }
        }


        $viewToLoad = 'staff/timesheet/timesheetexcel';
        ///////////  Start Generate and store excel file ////////////////////////////
        Excel::create('timesheet_list', function ($excel)use ($data, $viewToLoad)
        {

            $excel->sheet('Sheetname', function ($sheet)use ($data, $viewToLoad)
            {
                $sheet->loadView($viewToLoad)->with($data); }
            )->save(); }
        );

        //


        $filepath = storage_path() . '/exports/timesheet_list.xls';
        $fileName = 'timesheet_list.xls';
        $headers = array('Content-Type: application/vnd.ms-excel', );

        return Response::download($filepath, $fileName, $headers);
        exit;


    }


    public function pdfclient_time_sheet($ctr_client,$ctr_serv,$fromdate,$todate)
    {
        
        $ctr_data = array();
        $data_ctr = array();
        $data = array();
        /*
        $ctr_data['ctr_client'] = Input::get("ctr_client");
        $ctr_data['ctr_serv'] = Input::get("ctr_serv");
        $ctr_data['fromdate'] = date('Y-m-d', strtotime(Input::get("fromdpick2")));
        $ctr_data['todate'] = date('Y-m-d', strtotime(Input::get("todpick")));*/
        // die();
       
      /*  $ctr_data['ctr_client'] = "3";
        $ctr_data['ctr_serv'] = "2";
        $ctr_data['fromdate'] = "2015-09-01";
        $ctr_data['todate'] = "2015-09-30";  */

        $ctr_data['ctr_client'] =$ctr_client ;
        $ctr_data['ctr_serv'] = $ctr_serv;
        $ctr_data['fromdate'] = date('Y-m-d', strtotime($fromdate));
        $ctr_data['todate'] = date('Y-m-d', strtotime($todate));


        $form = $ctr_data['fromdate'];
        $to = $ctr_data['todate'];

        if ($ctr_data['ctr_serv'] != "") {


            $limitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $ctr_data['ctr_client'])->where('vat_scheme_type',
                '=', $ctr_data['ctr_serv'])->get();
        } else {
            $limitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $ctr_data['ctr_client'])->get();
        }
        //echo $this->last_query();
        //die();

        if (!empty($limitimesheet)) {
            foreach ($limitimesheet as $key => $val) {
                //echo 'gddhdhdhd';

                $data_ctr[$key]['timesheet_id'] = $val['timesheet_id'];
                $data_ctr[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data_ctr[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data_ctr[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data_ctr[$key]['hrs'] = $val['hrs'];
                $data_ctr[$key]['notes'] = $val['notes'];
                $data_ctr[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data_ctr)) {
                $data['limitimesheet'] = $data_ctr;
            }
        }

        $client_timereport = $data['cfinal_array'] = array();
        if (isset($data['limitimesheet'])) {

            foreach ($data['limitimesheet'] as $eachR) {
                $temp = array();
                $temp['client_name'] = $eachR{'client_detail'}->field_value;
                $temp['staff_name'] = $eachR{'staff_detail'}->fname . " " . $eachR{
                    'staff_detail'}->lname;
                $temp['date'] = $eachR['created_date'];
                $temp['hrs'] = $eachR['hrs'];
                $client_timereport[$eachR{'old_vat_scheme'}->vat_scheme_name][] = $temp;

            }
        }

        $data['cfinal_array'] = $client_timereport;

        // echo View::make('staff.timesheet.client_timereport')->with('cfinal_array',$data['cfinal_array']);
        if (!empty($data['cfinal_array'])) {

            // return View::make('staff.timesheet.pdfclienttimereport', $data);


            $pdf = PDF::loadView('staff/timesheet/pdfclienttimereport', $data)->setPaper('a4')->setOrientation('landscape')->setWarnings(false);
            return $pdf->download('clienttimesheetpdf.pdf');
            // return Redirect::to('/timesheet/client-timereport');

        } else {
            //return Redirect::to('/timesheet/client-timereport');
        }
        
        //echo View::make('staff.timesheet.client_timereport', $data);

    }
    
     public function excelclient_time_sheet($ctr_client,$ctr_serv,$fromdate,$todate)
    {
        
        $ctr_data = array();
        $data_ctr = array();
        $data = array();
        
        $ctr_data['ctr_client'] =$ctr_client ;
        $ctr_data['ctr_serv'] = $ctr_serv;
        $ctr_data['fromdate'] = date('Y-m-d', strtotime($fromdate));
        $ctr_data['todate'] = date('Y-m-d', strtotime($todate));


        $form = $ctr_data['fromdate'];
        $to = $ctr_data['todate'];

        if ($ctr_data['ctr_serv'] != "") {


            $limitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $ctr_data['ctr_client'])->where('vat_scheme_type',
                '=', $ctr_data['ctr_serv'])->get();
        } else {
            $limitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $ctr_data['ctr_client'])->get();
        }
        //echo $this->last_query();
        //die();

        if (!empty($limitimesheet)) {
            foreach ($limitimesheet as $key => $val) {
                //echo 'gddhdhdhd';

                $data_ctr[$key]['timesheet_id'] = $val['timesheet_id'];
                $data_ctr[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data_ctr[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data_ctr[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data_ctr[$key]['hrs'] = $val['hrs'];
                $data_ctr[$key]['notes'] = $val['notes'];
                $data_ctr[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data_ctr)) {
                $data['limitimesheet'] = $data_ctr;
            }
        }

        $client_timereport = $data['cfinal_array'] = array();
        if (isset($data['limitimesheet'])) {

            foreach ($data['limitimesheet'] as $eachR) {
                $temp = array();
                $temp['client_name'] = $eachR{'client_detail'}->field_value;
                $temp['staff_name'] = $eachR{'staff_detail'}->fname . " " . $eachR{
                    'staff_detail'}->lname;
                $temp['date'] = $eachR['created_date'];
                $temp['hrs'] = $eachR['hrs'];
                $client_timereport[$eachR{'old_vat_scheme'}->vat_scheme_name][] = $temp;

            }
        }

        $data['cfinal_array'] = $client_timereport;

        // echo View::make('staff.timesheet.client_timereport')->with('cfinal_array',$data['cfinal_array']);
        if (!empty($data['cfinal_array'])) {
            $viewToLoad = 'staff/timesheet/excelclienttimereport';
        ///////////  Start Generate and store excel file ////////////////////////////
        Excel::create('clientftimesheet_list', function ($excel)use ($data, $viewToLoad)
        {

            $excel->sheet('Sheetname', function ($sheet)use ($data, $viewToLoad)
            {
                $sheet->loadView($viewToLoad)->with($data); }
            )->save(); }
        );

        //


        $filepath = storage_path() . '/exports/clientftimesheet_list.xls';
        $fileName = 'clientftimesheet_list.xls';
        $headers = array('Content-Type: application/vnd.ms-excel', );

        return Response::download($filepath, $fileName, $headers);
        exit;
        
        } 

    }
    
    
    
    
    public function pdfclientnotstaff_time_sheet($ctr_client,$fromdate,$todate){
        
        
        $ctr_data = array();
        $data_ctr = array();
        $data = array();
        /*
        $ctr_data['ctr_client'] = Input::get("ctr_client");
        $ctr_data['ctr_serv'] = Input::get("ctr_serv");
        $ctr_data['fromdate'] = date('Y-m-d', strtotime(Input::get("fromdpick2")));
        $ctr_data['todate'] = date('Y-m-d', strtotime(Input::get("todpick")));*/
        // die();
       
      /*  $ctr_data['ctr_client'] = "3";
        $ctr_data['ctr_serv'] = "2";
        $ctr_data['fromdate'] = "2015-09-01";
        $ctr_data['todate'] = "2015-09-30";  */

        $ctr_data['ctr_client'] =$ctr_client ;
        $ctr_data['ctr_serv'] = "";
        $ctr_data['fromdate'] = date('Y-m-d', strtotime($fromdate));
        $ctr_data['todate'] = date('Y-m-d', strtotime($todate));


        $form = $ctr_data['fromdate'];
        $to = $ctr_data['todate'];

        if ($ctr_data['ctr_serv'] != "") {


            $limitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $ctr_data['ctr_client'])->where('vat_scheme_type',
                '=', $ctr_data['ctr_serv'])->get();
        } else {
            $limitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $ctr_data['ctr_client'])->get();
        }
        //echo $this->last_query();
        //die();

        if (!empty($limitimesheet)) {
            foreach ($limitimesheet as $key => $val) {
                //echo 'gddhdhdhd';

                $data_ctr[$key]['timesheet_id'] = $val['timesheet_id'];
                $data_ctr[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data_ctr[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data_ctr[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data_ctr[$key]['hrs'] = $val['hrs'];
                $data_ctr[$key]['notes'] = $val['notes'];
                $data_ctr[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data_ctr)) {
                $data['limitimesheet'] = $data_ctr;
            }
        }

        $client_timereport = $data['cfinal_array'] = array();
        if (isset($data['limitimesheet'])) {

            foreach ($data['limitimesheet'] as $eachR) {
                $temp = array();
                $temp['client_name'] = $eachR{'client_detail'}->field_value;
                $temp['staff_name'] = $eachR{'staff_detail'}->fname . " " . $eachR{
                    'staff_detail'}->lname;
                $temp['date'] = $eachR['created_date'];
                $temp['hrs'] = $eachR['hrs'];
                $client_timereport[$eachR{'old_vat_scheme'}->vat_scheme_name][] = $temp;

            }
        }

        $data['cfinal_array'] = $client_timereport;

        // echo View::make('staff.timesheet.client_timereport')->with('cfinal_array',$data['cfinal_array']);
        if (!empty($data['cfinal_array'])) {

            // return View::make('staff.timesheet.pdfclienttimereport', $data);


            $pdf = PDF::loadView('staff/timesheet/pdfclienttimereport', $data)->setPaper('a4')->setOrientation('landscape')->setWarnings(false);
            return $pdf->download('clienttimesheetpdf.pdf');
            // return Redirect::to('/timesheet/client-timereport');

        } else {
            //return Redirect::to('/timesheet/client-timereport');
        }
        
        //echo View::make('staff.timesheet.client_timereport', $data);

    
        
    }
    
    
    
    
    public function excelclientnotstaff_time_sheet($ctr_client,$fromdate,$todate){
        
        
        $ctr_data = array();
        $data_ctr = array();
        $data = array();
       

        $ctr_data['ctr_client'] =$ctr_client ;
        $ctr_data['ctr_serv'] = "";
        $ctr_data['fromdate'] = date('Y-m-d', strtotime($fromdate));
        $ctr_data['todate'] = date('Y-m-d', strtotime($todate));


        $form = $ctr_data['fromdate'];
        $to = $ctr_data['todate'];

        if ($ctr_data['ctr_serv'] != "") {


            $limitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $ctr_data['ctr_client'])->where('vat_scheme_type',
                '=', $ctr_data['ctr_serv'])->get();
        } else {
            $limitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $ctr_data['ctr_client'])->get();
        }
        //echo $this->last_query();
        //die();

        if (!empty($limitimesheet)) {
            foreach ($limitimesheet as $key => $val) {
                //echo 'gddhdhdhd';

                $data_ctr[$key]['timesheet_id'] = $val['timesheet_id'];
                $data_ctr[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data_ctr[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data_ctr[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data_ctr[$key]['hrs'] = $val['hrs'];
                $data_ctr[$key]['notes'] = $val['notes'];
                $data_ctr[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data_ctr)) {
                $data['limitimesheet'] = $data_ctr;
            }
        }

        $client_timereport = $data['cfinal_array'] = array();
        if (isset($data['limitimesheet'])) {

            foreach ($data['limitimesheet'] as $eachR) {
                $temp = array();
                $temp['client_name'] = $eachR{'client_detail'}->field_value;
                $temp['staff_name'] = $eachR{'staff_detail'}->fname . " " . $eachR{
                    'staff_detail'}->lname;
                $temp['date'] = $eachR['created_date'];
                $temp['hrs'] = $eachR['hrs'];
                $client_timereport[$eachR{'old_vat_scheme'}->vat_scheme_name][] = $temp;

            }
        }

        $data['cfinal_array'] = $client_timereport;

        // echo View::make('staff.timesheet.client_timereport')->with('cfinal_array',$data['cfinal_array']);
        if (!empty($data['cfinal_array'])) {
            
            //
            $viewToLoad = 'staff/timesheet/excelclienttimereport';
        ///////////  Start Generate and store excel file ////////////////////////////
        Excel::create('clientftimesheet_list', function ($excel)use ($data, $viewToLoad)
        {

            $excel->sheet('Sheetname', function ($sheet)use ($data, $viewToLoad)
            {
                $sheet->loadView($viewToLoad)->with($data); }
            )->save(); }
        );

        //


        $filepath = storage_path() . '/exports/clientftimesheet_list.xls';
        $fileName = 'clientftimesheet_list.xls';
        $headers = array('Content-Type: application/vnd.ms-excel', );

        return Response::download($filepath, $fileName, $headers);
        exit;
        
        
            
            //
           } 
    
        
    }
    
    
    
    public function pdfstaffnoclient_time_sheet($str_staff,$strfromdate,$strtodate){
        
        

        $str_data = array();
        $data_str = array();
        $data = array();

        $str_data['str_staff'] = $str_staff;
        $str_data['str_client'] = "";
        $str_data['strfromdate'] = date('Y-m-d', strtotime($strfromdate));
        $str_data['strtodate'] = date('Y-m-d', strtotime($strtodate));


        $form = $str_data['strfromdate'];
        $to = $str_data['strtodate'];

        if ($str_data['str_client'] != "") {

            $strlimitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $str_data['str_client'])->where('staff_id', '=', $str_data['str_staff'])->
                get();

        } else {

            // $strlimitimesheet = TimeSheetReport::groupBy('rel_client_id')->whereBetween('created_date', array($form, $to))->where('staff_id','=',$str_data['str_staff'])->get();
            $strlimitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('staff_id', '=', $str_data['str_staff'])->get();
        }

        //echo $this->last_query();
        //die();
        //echo '<pre>';
        //print_r($strlimitimesheet);
        if (!empty($strlimitimesheet)) {
            foreach ($strlimitimesheet as $key => $val) {


                $data_str[$key]['timesheet_id'] = $val['timesheet_id'];
                $data_str[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data_str[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data_str[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data_str[$key]['hrs'] = $val['hrs'];
                $data_str[$key]['notes'] = $val['notes'];
                $data_str[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data_str)) {
                $data['limitimesheetstr'] = $data_str;
                //echo '<pre>';
                //print_r($data);
            }
        }

        $staff_timereport = $data['final_array'] = $data['total'] = array();
        if (isset($data['limitimesheetstr'])) {

            foreach ($data['limitimesheetstr'] as $eachR) {
                $temp = array();
                //$temp['client_name']  = $eachR{'client_detail'}->field_value;
                $temp['staff_name'] = $eachR{'staff_detail'}->fname . " " . $eachR{
                    'staff_detail'}->lname;
                $temp['date'] = $eachR['created_date'];
                $temp['service'] = $eachR{'old_vat_scheme'}->vat_scheme_name;

                $temp['hrs'] = $eachR['hrs'];


                //$staff_timereport[$eachR{'client_detail'}->field_id][] = $temp;

                $staff_timereport[$eachR{'client_detail'}->field_value][] = $temp;


            }


        }

        $data['final_array'] = $staff_timereport;
        
        //echo View::make('staff.timesheet.staff_timereport')->with('final_array', $data['final_array']);
        
        $pdf = PDF::loadView('staff/timesheet/pdfstafftimereport', $data)->setPaper('a4')->setOrientation('landscape')->setWarnings(false);
            return $pdf->download('stafftimesheetpdf.pdf');
        
        
        
        
        
                
    }
    
    public function pdfstaff_time_sheet($str_staff,$str_client,$strfromdate,$strtodate){
        
        
        
        

        $str_data = array();
        $data_str = array();
        $data = array();

        $str_data['str_staff'] = $str_staff;
        $str_data['str_client'] = $str_client;
        $str_data['strfromdate'] = date('Y-m-d', strtotime($strfromdate));
        $str_data['strtodate'] = date('Y-m-d', strtotime($strtodate));


        $form = $str_data['strfromdate'];
        $to = $str_data['strtodate'];

        if ($str_data['str_client'] != "") {

            $strlimitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $str_data['str_client'])->where('staff_id', '=', $str_data['str_staff'])->
                get();

        } else {

            // $strlimitimesheet = TimeSheetReport::groupBy('rel_client_id')->whereBetween('created_date', array($form, $to))->where('staff_id','=',$str_data['str_staff'])->get();
            $strlimitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('staff_id', '=', $str_data['str_staff'])->get();
        }

        //echo $this->last_query();
        //die();
        //echo '<pre>';
        //print_r($strlimitimesheet);
        if (!empty($strlimitimesheet)) {
            foreach ($strlimitimesheet as $key => $val) {


                $data_str[$key]['timesheet_id'] = $val['timesheet_id'];
                $data_str[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data_str[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data_str[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data_str[$key]['hrs'] = $val['hrs'];
                $data_str[$key]['notes'] = $val['notes'];
                $data_str[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data_str)) {
                $data['limitimesheetstr'] = $data_str;
                //echo '<pre>';
                //print_r($data);
            }
        }

        $staff_timereport = $data['final_array'] = $data['total'] = array();
        if (isset($data['limitimesheetstr'])) {

            foreach ($data['limitimesheetstr'] as $eachR) {
                $temp = array();
                //$temp['client_name']  = $eachR{'client_detail'}->field_value;
                $temp['staff_name'] = $eachR{'staff_detail'}->fname . " " . $eachR{
                    'staff_detail'}->lname;
                $temp['date'] = $eachR['created_date'];
                $temp['service'] = $eachR{'old_vat_scheme'}->vat_scheme_name;

                $temp['hrs'] = $eachR['hrs'];


                //$staff_timereport[$eachR{'client_detail'}->field_id][] = $temp;

                $staff_timereport[$eachR{'client_detail'}->field_value][] = $temp;


            }


        }

        $data['final_array'] = $staff_timereport;
        
        //echo View::make('staff.timesheet.staff_timereport')->with('final_array', $data['final_array']);
        
        $pdf = PDF::loadView('staff/timesheet/pdfstafftimereport', $data)->setPaper('a4')->setOrientation('landscape')->setWarnings(false);
            return $pdf->download('stafftimesheetpdf.pdf');
        
        
        
        
        
                
    
        
        
    }
    
    
    
    
    
    
    public function excelstaff_time_sheet($str_staff,$str_client,$strfromdate,$strtodate){
        
        
        
        

        $str_data = array();
        $data_str = array();
        $data = array();

        $str_data['str_staff'] = $str_staff;
        $str_data['str_client'] = $str_client;
        $str_data['strfromdate'] = date('Y-m-d', strtotime($strfromdate));
        $str_data['strtodate'] = date('Y-m-d', strtotime($strtodate));


        $form = $str_data['strfromdate'];
        $to = $str_data['strtodate'];

        if ($str_data['str_client'] != "") {

            $strlimitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $str_data['str_client'])->where('staff_id', '=', $str_data['str_staff'])->
                get();

        } else {

            // $strlimitimesheet = TimeSheetReport::groupBy('rel_client_id')->whereBetween('created_date', array($form, $to))->where('staff_id','=',$str_data['str_staff'])->get();
            $strlimitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('staff_id', '=', $str_data['str_staff'])->get();
        }

        //echo $this->last_query();
        //die();
        //echo '<pre>';
        //print_r($strlimitimesheet);
        if (!empty($strlimitimesheet)) {
            foreach ($strlimitimesheet as $key => $val) {


                $data_str[$key]['timesheet_id'] = $val['timesheet_id'];
                $data_str[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data_str[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data_str[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data_str[$key]['hrs'] = $val['hrs'];
                $data_str[$key]['notes'] = $val['notes'];
                $data_str[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data_str)) {
                $data['limitimesheetstr'] = $data_str;
                //echo '<pre>';
                //print_r($data);
            }
        }

        $staff_timereport = $data['final_array'] = $data['total'] = array();
        if (isset($data['limitimesheetstr'])) {

            foreach ($data['limitimesheetstr'] as $eachR) {
                $temp = array();
                //$temp['client_name']  = $eachR{'client_detail'}->field_value;
                $temp['staff_name'] = $eachR{'staff_detail'}->fname . " " . $eachR{
                    'staff_detail'}->lname;
                $temp['date'] = $eachR['created_date'];
                $temp['service'] = $eachR{'old_vat_scheme'}->vat_scheme_name;

                $temp['hrs'] = $eachR['hrs'];


                //$staff_timereport[$eachR{'client_detail'}->field_id][] = $temp;

                $staff_timereport[$eachR{'client_detail'}->field_value][] = $temp;


            }


        }

        $data['final_array'] = $staff_timereport;
        
        //echo View::make('staff.timesheet.staff_timereport')->with('final_array', $data['final_array']);
        
     
     
     //   $pdf = PDF::loadView('staff/timesheet/pdfstafftimereport', $data)->setPaper('a4')->setOrientation('landscape')->setWarnings(false);
            //return $pdf->download('stafftimesheetpdf.pdf');
        
        
        $viewToLoad = 'staff/timesheet/excelstafftimereport';
        ///////////  Start Generate and store excel file ////////////////////////////
        Excel::create('stafftimesheet_list', function ($excel)use ($data, $viewToLoad)
        {

            $excel->sheet('Sheetname', function ($sheet)use ($data, $viewToLoad)
            {
                $sheet->loadView($viewToLoad)->with($data); }
            )->save(); }
        );

        //


        $filepath = storage_path() . '/exports/stafftimesheet_list.xls';
        $fileName = 'stafftimesheet_list.xls';
        $headers = array('Content-Type: application/vnd.ms-excel', );

        return Response::download($filepath, $fileName, $headers);
        exit;

        
        
        
                
    
        
        
    }
    
    public function excelstaffnoclient_time_sheet($str_staff,$strfromdate,$strtodate){
        
        
        
        

        $str_data = array();
        $data_str = array();
        $data = array();

        $str_data['str_staff'] = $str_staff;
        $str_data['str_client'] = "";
        $str_data['strfromdate'] = date('Y-m-d', strtotime($strfromdate));
        $str_data['strtodate'] = date('Y-m-d', strtotime($strtodate));


        $form = $str_data['strfromdate'];
        $to = $str_data['strtodate'];

        if ($str_data['str_client'] != "") {

            $strlimitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('rel_client_id', '=', $str_data['str_client'])->where('staff_id', '=', $str_data['str_staff'])->
                get();

        } else {

            // $strlimitimesheet = TimeSheetReport::groupBy('rel_client_id')->whereBetween('created_date', array($form, $to))->where('staff_id','=',$str_data['str_staff'])->get();
            $strlimitimesheet = TimeSheetReport::whereBetween('created_date', array($form, $to))->
                where('staff_id', '=', $str_data['str_staff'])->get();
        }

        //echo $this->last_query();
        //die();
        //echo '<pre>';
        //print_r($strlimitimesheet);
        if (!empty($strlimitimesheet)) {
            foreach ($strlimitimesheet as $key => $val) {


                $data_str[$key]['timesheet_id'] = $val['timesheet_id'];
                $data_str[$key]['staff_detail'] = User::where("user_id", "=", $val['staff_id'])->
                    select("user_id", "fname", "lname")->first();
                $data_str[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->
                    select("vat_scheme_name")->first();
                //$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
                $data_str[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->
                    where(function ($query)
                {
                    $query->where("field_name", "=", "business_name")->orWhere("field_name", "=",
                        "client_name"); }
                )->first();

                //echo $this->last_query();
                $data_str[$key]['hrs'] = $val['hrs'];
                $data_str[$key]['notes'] = $val['notes'];
                $data_str[$key]['created_date'] = date("d-m-Y", strtotime($val['created_date']));
            }
            //echo $val;die();
            if (!empty($data_str)) {
                $data['limitimesheetstr'] = $data_str;
                //echo '<pre>';
                //print_r($data);
            }
        }

        $staff_timereport = $data['final_array'] = $data['total'] = array();
        if (isset($data['limitimesheetstr'])) {

            foreach ($data['limitimesheetstr'] as $eachR) {
                $temp = array();
                //$temp['client_name']  = $eachR{'client_detail'}->field_value;
                $temp['staff_name'] = $eachR{'staff_detail'}->fname . " " . $eachR{
                    'staff_detail'}->lname;
                $temp['date'] = $eachR['created_date'];
                $temp['service'] = $eachR{'old_vat_scheme'}->vat_scheme_name;

                $temp['hrs'] = $eachR['hrs'];


                //$staff_timereport[$eachR{'client_detail'}->field_id][] = $temp;

                $staff_timereport[$eachR{'client_detail'}->field_value][] = $temp;


            }


        }

        $data['final_array'] = $staff_timereport;
        
        //echo View::make('staff.timesheet.staff_timereport')->with('final_array', $data['final_array']);
        
     
     
     //   $pdf = PDF::loadView('staff/timesheet/pdfstafftimereport', $data)->setPaper('a4')->setOrientation('landscape')->setWarnings(false);
            //return $pdf->download('stafftimesheetpdf.pdf');
        
        
        $viewToLoad = 'staff/timesheet/excelstafftimereport';
        ///////////  Start Generate and store excel file ////////////////////////////
        Excel::create('stafftimesheet_list', function ($excel)use ($data, $viewToLoad)
        {

            $excel->sheet('Sheetname', function ($sheet)use ($data, $viewToLoad)
            {
                $sheet->loadView($viewToLoad)->with($data); }
            )->save(); }
        );

        //


        $filepath = storage_path() . '/exports/stafftimesheet_list.xls';
        $fileName = 'stafftimesheet_list.xls';
        $headers = array('Content-Type: application/vnd.ms-excel', );

        return Response::download($filepath, $fileName, $headers);
        exit;

        
        
        
                
    
        
        
    }

}
