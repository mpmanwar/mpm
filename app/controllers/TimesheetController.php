<?php
//opcache_reset ();
//Cache::forget('user_list');
use DB;
class TimesheetController extends BaseController {
    
    public function time_sheet_reports($type)
    {
        //die('staffmanagement');
       	$data['heading'] = "TIME SHEET";
		$data['title'] = "Time Sheet Reports";
      	if(base64_decode($type) == 'profile'){
        	$data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        }else{
        	$data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        }
        $data['staff_type'] = base64_decode($type);
        
		
		$data['heading'] = "";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['user_type'] = $session['user_type'];
        $groupUserId = $session['group_users'];
		
	    $data['staff_details'] 	= User::whereIn("user_id", $groupUserId)->where("client_id", "=", 0)->select("user_id", "fname", "lname")->get();
		$data['old_vat_schemes'] = VatScheme::where("status", "=", "old")->orderBy("vat_scheme_name")->get();
		$data['new_vat_schemes'] = VatScheme::where("status", "=", "new")->whereIn("user_id", $groupUserId)->orderBy("vat_scheme_name")->get();
		
		$data['allClients'] 	 	= App::make("HomeController")->get_all_clients();
		
		
		$time_sheet_report = TimeSheetReport::orderBy("created_date","desc")->get();
		//echo $this->last_query();
		if(!empty($time_sheet_report)){
				foreach($time_sheet_report as $key=>$val){
						
					$data2[$key]['timesheet_id'] = $val['timesheet_id'];
					$data2[$key]['staff_detail'] 	= User::where("user_id", "=", $val['staff_id'])->select("user_id", "fname", "lname")->first();
					$data2[$key]['old_vat_scheme'] = VatScheme::where("vat_scheme_id", "=", $val['vat_scheme_type'])->select("vat_scheme_name")->first();
					$data2[$key]['client_detail'] = StepsFieldsClient::where("client_id", "=", $val['rel_client_id'])->where("field_name", "=", "business_name")->orWhere("field_name", "=", "client_name")->first();
					//echo $this->last_query();
					$data2[$key]['hrs'] = $val['hrs'];	
					$data2[$key]['notes'] = $val['notes'];	
					$data2[$key]['created_date'] = date("d-m-Y",strtotime($val['created_date']));					
				}
		if(!empty($data2)){		
		$data['time_sheet_report'] =  $data2;
		    }
		}
        
	   //echo $this->last_query();
      
                
        return View::make('staff.timesheet.time_sheet_reports',$data);
       
    }
	public function edit_time_sheet() {
	
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
		
		$data1['staff_id'] 			= Input::get("staff_id");
		$data1['rel_client_id'] 	= Input::get("rel_client_id");
		$data1['vat_scheme_type'] 	= Input::get("vat_scheme_type");
		$data1['hrs'] 	= Input::get("hrs");
		$data1['notes'] 	= Input::get("notes");
		$data1['user_id'] 		= $session_data['id'];
		$data1['created_date'] 		=  date('Y-m-d',strtotime(Input::get("date")));
		$editid		=  Input::get("editid");
		//echo '<pre>';
		//print_r($data1);
		//exit();
		$affected = TimeSheetReport::where("timesheet_id", "=", $editid)->update($data1);
		
		//echo $this->last_query();
		
		return Redirect::to('/time-sheet-reports/c3RhZmY=');
	}
	public function insert_time_sheet() {
	
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
		
		$data1['staff_id'] 			= Input::get("staff_id");
		$data1['rel_client_id'] 	= Input::get("rel_client_id");
		$data1['vat_scheme_type'] 	= Input::get("vat_scheme_type");
		$data1['hrs'] 	= Input::get("hrs");
		$data1['notes'] 	= Input::get("notes");
		$data1['user_id'] 		= $session_data['id'];
		$data1['created_date'] 		=  Input::get("date");
		//echo '<pre>';
		//var_dump($data1['created_date']);
		//exit();
		
		
		//echo 'ssss';
		//echo count($data1['created_date']);
				for($i=0;$i<count($data1['created_date']);$i++){
						
						
						$data[$i]['staff_id']			=$data1['staff_id'][$i]; 	
						$data[$i]['rel_client_id'] 	= $data1['rel_client_id'][$i];
						$data[$i]['vat_scheme_type']	= $data1['vat_scheme_type'][$i];
						$data[$i]['hrs']	=$data1['hrs'][$i];
						$data[$i]['notes'] 	= $data1['notes'][$i];
						$data[$i]['user_id']	= $session_data['id'];
						$data[$i]['created_date']		= date("Y-m-d",strtotime($data1['created_date'][$i]));
						//echo '<pre>';
						//print_r($data[$i]);
						//
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
	
	public function timesheet_templates(){
	
	 $timesheet_id = Input::get("timesheet_id");
	 $admin_s = Session::get('admin_details');
	 $user_id = $admin_s['id'];
	  $groupUserId = $admin_s['group_users'];


	 if (Request::ajax()) {

			$timesheetTemplates = TimeSheetReport::where("timesheet_id", $timesheet_id)->first();
			$timesheetTemplates['group'] = $groupUserId;
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($timesheetTemplates);
			//echo 'aaaaa';
			exit();
			
			}
	}
	
}
