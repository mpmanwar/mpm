<?php
//opcache_reset ();
//Cache::forget('user_list');

class UserController extends BaseController {
	
	public function user_list(){
		$data['title'] = 'Manage User';
		$data['previous_page'] = '<a href="/settings-dashboard">Settings</a>';
		$data['heading'] = "USER LIST";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		/*if (Cache::has('user_list')) {
			$data = Cache::get('user_list');

		} else {*/

			//$user_lists	= User::where('user_id', '=', $user_id)->first();
			
			/*$parentId = array();
			$childId = array();

			$parentId = $this->getParentId($user_id, $admin_s['group_id']);
			//$childId = $this->getChildId($user_id);
			if(count($parentId) > 0){
				$parentId = array_unique($parentId);
			}
			
			//print_r($parentId);die;
			$groupId = array_merge($parentId,$childId);*/
						
			$data['user_lists']	= User::whereIn("user_id", $groupUserId)->where("user_type", "!=", "C")->get();
			//echo $this->last_query();die;

			if(isset($data['user_lists']) && count($data['user_lists']) > 0){

				$i = 0;
				foreach ($data['user_lists'] as $user_list) {
					$access = DB::table("user_accesses")->leftJoin('accesses', 'user_accesses.access_id', '=', 'accesses.access_id')->where('user_accesses.user_id', '=', $user_list->user_id)->select('accesses.access_name', 'accesses.access_id')->get();
					//echo $this->last_query();die;
					//print_r($permissions);die;
					$permission = "";
					if (isset($access) && count($access) > 0) {
						foreach ($access as $usr_perission) {
							$permission .= $usr_perission->access_name . " + ";
						}
						$permission = substr($permission, 0, -3);
					}

					$data['user_lists'][$i]['permission'] = $permission;
					$data['user_lists'][$i]['login_count'] = LoginDetail::where("user_id", "=", $user_list->user_id)->count();
					$last_login = LoginDetail::where("user_id", "=", $user_list->user_id)->orderBy('id', 'desc')->pluck('login_date');
					$data['user_lists'][$i]['last_login'] = $this->getDateFormat($last_login);
					$i++;
				}
			}

			$viewToLoad = 'user.excel';
			///////////  Start Generate and store excel file ////////////////////////////
			Excel::create('UserList', function ($excel) use ($data, $viewToLoad) {

				$excel->sheet('Sheetname', function ($sheet) use ($data, $viewToLoad) {
					$sheet->loadView($viewToLoad)->with($data);
				})->save();

			});
			///////////  End Generate and store excel file ////////////////////////////

			/*Cache::put('user_list', $data, 10);
		}*/

		//echo "<prev>".print_r($data);die;
		return View::make('user.user_list', $data);
	}


    public function getParentId($user_id, $group_id, $parrent_array = null) {
    	global $parrent_array, $chield_array;
    	$users	= User::where('user_id', '=', $user_id)->where('group_id', '=', $group_id)->select("parent_id")->first();
    	
    	if (isset($users) && count($users) >0 && $users['parent_id'] !=0) { 
    		$parrent_array[] = $users['parent_id'];  
    		$chield_array = $this->getChildId($users['parent_id'], $group_id);
    		//print_r($chield_array);
    		$parrent_array = array_merge($parrent_array, $chield_array);
			$this->getParentId($users['parent_id'], $group_id, $parrent_array);   
		}elseif($users['parent_id'] == 0)
		{
			$parrent_array = $this->getChildId($users['parent_id'], $group_id);
		} 
    	return $parrent_array;
    }

    public function getChildId($parent_id, $group_id, $chield_array = null) {
    	global $chield_array;
    	$users	= User::where('parent_id', '=', $parent_id)->where('group_id', '=', $group_id)->select("user_id")->get();
    	//echo $this->last_query();
    	if( isset($users) && count($users) >0 ){
    		foreach ($users as $element) {
    			$chield_array[]	= $element->user_id;
    			$this->getChildId($element->user_id, $group_id, $chield_array);
    		}
    	}
    	//print_r($chield_array);
    	return $chield_array;
    }


	public function add_user() {
		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id

		if (empty($user_id)) {
			return Redirect::to('/');
		}
		$data['title'] 		= "Add User";
		$data['previous_page'] = '<a href="/settings-dashboard">Settings</a>';
		$data['sub_url'] = '<a href="/user-list">Manage User</a>';
		$data['heading'] 	= "ADD USER DETAILS";
		$data['permission_list'] 	= Permission::get();
		$data['access_list'] 		= Access::get();
		$data['individual_client'] 	= App::make("HomeController")->get_all_ind_clients();
		//print_r($data['relation_list']);die;
		return View::make('user.add_user', $data);
	}

	public function user_process() {
		$usr_data = array();
		$usrp_data = array();
		$admin_s = Session::get('admin_details'); // session

		$postData = Input::all();
		//echo "<prev>".print_r($postData['permission']);die;
		$validator = $this->validateChinForm($postData);
		if ($validator->passes()) {
			$usr_data['parent_id'] 	= $admin_s['id'];
			$usr_data['group_id'] 	= $admin_s['group_id'];
			$usr_data['created'] 	= date("Y-m-d H:i:s");
			$usr_data['user_type'] 	= $postData['user_type'];
			
			if ($postData['user_type'] == "S") {

				$usr_data['fname'] 		= $postData['fname'];
				$usr_data['lname'] 		= $postData['lname'];
				$usr_data['email'] 		= $postData['email'];				

				if (!empty($postData['permission']) && count($postData['permission']) > 0) {
					foreach ($postData['permission'] as $value) {
						$usrp_data['user_id'] = $usr_id;
						$usrp_data['permission_id'] = $value;
						UserPermission::insert($usrp_data);
					}
				}

				if (!empty($postData['user_access']) && count($postData['user_access']) > 0) {
					foreach ($postData['user_access'] as $value) {
						$usracc_data['user_id'] = $usr_id;
						$usracc_data['access_id'] = $value;
						UserAccess::insert($usracc_data);
					}
				}

			}else{
				$usr_data['email'] 				= $postData['client_email'];
				$usr_data['client_id'] 			= $postData['client_id'];
			}

			$usr_id = User::insertGetId($usr_data);

			if(isset($postData['related_client']) && count($postData['related_client']) > 0){
				$relatedData = array();
				foreach ($postData['related_client'] as $row) {
					$relatedData[] = array(
						'user_id' 		=> $usr_id,
						'client_id' 	=> $row,
						'status' 		=> "A"
					);
				}
				UserRelatedCompany::insert($relatedData);
			}



			$usr_data['user_id'] 	= $usr_id;
			$usr_data['link'] = url()."/user/create-password/".base64_encode($usr_id);
			if ($postData['user_type'] == "C") {
				$client_name = Common::clientDetailsById($postData['client_id']);
				$usr_data['fname'] 		= $client_name['fname'];
				$usr_data['lname'] 		= $client_name['lname'];
			}
			

			$this->send_mail($usr_data);
			Session::flash('message', 'The email has been sent to the new user.');
			//Cache::flush();
			return Redirect::to('/user-list');
		} else {
			return Redirect::to('/add-user')->withInput()->withErrors($validator);
		}
	}

	private function send_mail($data) {
		Mail::send('emails.add_user', $data, function ($message) use ($data) {
			$message->from('abel02@icloud.com', 'i-Practice');
			$message->to($data['email'], $data['fname'].' '.$data['lname'])->subject("Welcome to i-Practice");

		});
	}

	public function validateChinForm($postData) {
		if ($postData['user_type'] == "S") {
			$messages = array(
				'fname.required' => 'Please enter first name',
				'email.required' => 'Please enter email address',
			);

			$rules = array(
				'fname' => 'required|alpha',
				'email' => 'required|email',
			);
		}else{
			$messages = array(
				'client_id.required' => 'Please select client name',
				'client_email.required' => 'Please enter email address',
			);

			$rules = array(
				'client_id' => 'required',
				'client_email' => 'required|email',
			);
		}

		return Validator::make($postData, $rules, $messages);
	}

	public function getDateFormat($date) {
		return isset($date) ? date("d M Y H:i a", strtotime($date)) : "";
	}

	public function delete_users() {
		$userIds = Input::get('user_delete_id');
		//print_r($userData);
		foreach ($userIds as $key => $value) {
			$User_delete = User::where("user_id", "=", $value)->delete();
            //$StepsFieldsClient_delete = StepsFieldsClient::where("user_id", "=", $value)->delete();
            
           // $Noticefont_delete = Noticefont::where("user_id", "=", $value)->delete();
           // $Noticefont_delete = Noticeexcel::where("user_id", "=", $value)->delete();
            
                        
            
			Session::flash('message', 'Users are successfully deleted');
		}
		Cache::flush();
		return Redirect::to("user-list");

	}

	public function edit_user($id) {
		$peruser_per = array();
		$data['title'] = "Edit User";
		$data['previous_page'] = '<a href="/settings-dashboard">Settings</a>';
		$data['sub_url'] = '<a href="/user-list">Manage User</a>';
		$data['heading'] = "EDIT USER";

		if (Cache::has('edit_user')) {
			$data = Cache::get('edit_user');
		} else {
			$data['info'] = User::select('*')->where('user_id', '=', $id)->get();
			//print_r($data['info']);die;
			$data['access_list'] = Access::get();
			$data['user_acc_list'] = UserAccess::where('user_id', '=', $id)->get();
			if(isset($data['user_acc_list']) && count($data['user_acc_list']) >0 )
			{
				foreach ($data['user_acc_list'] as $key=>$usr_acc) {
					$data['access_id'][$key] = $usr_acc->access_id;
				}
			}
			
			$data['permission_list'] = Permission::get();
			$data['per_list'] = UserPermission::where('user_id', '=', $id)->get();

			$i = 0;
			$data['permission_id'] = array();
			foreach ($data['per_list'] as $usr_per) {
				$data['permission_id'][$i] = $usr_per->permission_id;
				$i++;
			}

			Cache::put('edit_user', $data, 10);
		}

		//print_r($peruser_per);die();
		Cache::flush();
		return View::make("user/edit_user", $data);

	}

	public function saveedit() {

		$id = Input::get("user_id");

		$usrp_data = array();
		$postData = Input::all();
		$data['fname'] = $postData['fname'];
		$data['lname'] = $postData['lname'];
		$data['email'] = $postData['email'];
		if(empty($postData['user_type'])){
			$data['user_type'] = $postData['hidd_user_type'];
		}else{
			$data['user_type'] = $postData['user_type'];
		}
		//echo print_r($postData['permission']);die;
		UserPermission::where('user_id', '=', $id)->delete();

		if ($data['user_type'] != "C") {
			if (!empty($postData['permission']) && count($postData['permission']) > 0) {
				foreach ($postData['permission'] as $value) {
					$usrp_data['user_id'] = $id;
					$usrp_data['permission_id'] = $value;
					UserPermission::insert($usrp_data);
				}
			}

		}

		//##########User Access Start############//
		UserAccess::where('user_id', '=', $id)->delete();
		if (!empty($postData['user_access']) && count($postData['user_access']) > 0) {
			foreach ($postData['user_access'] as $value) {
				$usracc_data['user_id'] = $id;
				$usracc_data['access_id'] = $value;
				UserAccess::insert($usracc_data);
			}
		}
		//##########User Access End############//

		//print_r($data);die();

		User::where('user_id', '=', $id)->update($data);
		Cache::flush();
		return Redirect::to('/user-list');
	}

	public function pdf() {
		$data['title'] = "User List";
		$session = Session::get('admin_details');
        $groupUserId = $session['group_users'];

		$data['user_lists'] = User::whereIn("user_id", $groupUserId)->get();
		if (isset($data['user_lists']) && count($data['user_lists']) > 0) {
			$i = 0;
			$i = 0;
			foreach ($data['user_lists'] as $user_list) {
				$access = DB::table("user_accesses")->leftJoin('accesses', 'user_accesses.access_id', '=', 'accesses.access_id')->where('user_accesses.user_id', '=', $user_list->user_id)->select('accesses.access_name', 'accesses.access_id')->get();
				//echo $this->last_query();die;
				//print_r($permissions);die;
				$permission = "";
				if (isset($access) && count($access) > 0) {
					foreach ($access as $usr_perission) {
						$permission .= $usr_perission->access_name . " + ";
					}
					$permission = substr($permission, 0, -3);
				}

				$data['user_lists'][$i]['permission'] = $permission;
				$data['user_lists'][$i]['login_count'] = LoginDetail::where("user_id", "=", $user_list->user_id)->count();
				$last_login = LoginDetail::where("user_id", "=", $user_list->user_id)->orderBy('id', 'desc')->pluck('login_date');
				$data['user_lists'][$i]['last_login'] = $this->getDateFormat($last_login);
				$i++;
			}
		}

		$pdf = PDF::loadView('user/pdf', $data)->setPaper('a4')->setOrientation('landscape')->setWarnings(false);
		return $pdf->download('user_list.pdf');
	}

	function download_excel() {
		$filepath = storage_path() . '/exports/UserList.xls';
		$fileName = 'UserList.xls';
		$headers = array(
			'Content-Type: application/vnd.ms-excel',
		);

		return Response::download($filepath, $fileName, $headers);
		exit;
	}

	public function create_user_password($id)
	{
		$data['user_id'] 	= $id;
		$data['title']		= "Create Password";		
		return View::make("user/change_password", $data);
		
	}

	public function create_new_password()
	{
		$postData 	= Input::get();
		$messages = array(
			'password.required' => 'Please enter your password',
			'con_pass.required' => 'Please enter confirmation password',
			'con_pass.matchpassword' => "confirmation password doesn't match");

		$rules = array(
			'password' => 'required',
			'con_pass' => 'required|same:password'
		);
		$validator = Validator::make($postData, $rules, $messages);

		if ($validator->fails()) {
			return Redirect::to('/user/create-password/'.$postData['user_id'])->withErrors($validator)->withInput();
		} else {
			$change_data['status'] = "A";
			$change_data['password'] = md5($postData['password']);
			Session::flash('success', 'You have successfully created your password');
			User::where('user_id', '=', base64_decode($postData['user_id']))->update($change_data);
			//echo $this->last_query();die;
		}

		//return Redirect::to('/user/create-password/'.$postData['user_id']);
		return Redirect::to('/');
	}

	public function update_status()
	{
		$user_id = Input::get("user_id");
		$status = Input::get("status");

		if (Request::ajax()) {
			$userdata = User::where("user_id", "=", $user_id)->select('status')->first();
			if($userdata['status'] == "I"){
				$status = "A";
				$ret = 'Active';
			}
			if($userdata['status'] == "A"){
				$status = "I";
				$ret = 'Inactive';
			}
			$data = User::where("user_id", "=", $user_id)->update(array('status'=>$status));
			//echo $this->last_query();die;
			
			echo $ret;
		}
	}

	function get_relation_client($value)
	{
		$relation_client = array();
		$relation_client1 = array();
		$relation_client2 = array();
		$value 			 = explode("=", $value);
		$client_id 		 = $value[0];
		$calling_type 	 = $value[1];

		$clients1 = DB::table('client_relationships as cr')->where("cr.client_id", "=", $client_id)
        	->join('clients as c', 'c.client_id', '=', 'cr.appointment_with')
        	->join('steps_fields_clients as sfc', 'sfc.client_id', '=', 'c.client_id')
        	->where('sfc.field_name', '=', 'business_name')
        	->where("c.type", "=", "org")
        	->select('cr.appointment_with as client_id', 'sfc.field_value as client_name')->get();

       	
		//echo $this->last_query();//die;
        if( isset($clients1) && count($clients1) >0 ){
        	foreach ($clients1 as $key => $value) {
        		$relation_client1[$key]['client_id'] 	= $value->client_id;
        		$relation_client1[$key]['client_name'] 	= $value->client_name;
        	}
        	
        }

        $clients2 = DB::table('client_relationships as cr')->where("cr.appointment_with", "=", $client_id)
        	->join('clients as c', 'c.client_id', '=', 'cr.client_id')
        	->join('steps_fields_clients as sfc', 'sfc.client_id', '=', 'c.client_id')
        	->where('sfc.field_name', '=', 'business_name')
        	->where("c.type", "=", "org")
        	->select('cr.client_id', 'sfc.field_value as client_name')->get();
		//echo $this->last_query();//die;
        if( isset($clients2) && count($clients2) >0 ){
        	foreach ($clients2 as $key => $value) {
        		$relation_client2[$key]['client_id'] 	= $value->client_id;
        		$relation_client2[$key]['client_name'] 	= $value->client_name;
        	}
        	
        }

        $relation_client = array_merge($relation_client1, $relation_client2);
        $relation_client = array_unique($relation_client, SORT_REGULAR);//print_r($relationship);die;

		
		//print_r($relation_client);die;
		if ($calling_type == "ajax") {
			echo json_encode($relation_client);
			exit;
		}else{
			return $relation_client;
			exit;
		}
	}

	public function delete_user_client()
	{
		$client_id 	= Input::get('client_id');
		$user_id 	= Input::get('user_id');
		$qry = User::where('user_id', "=", $user_id)->delete();
		if($qry){
			echo 1;
		}else{
			echo 0;
		}
		exit;
	}

	public function update_related_company_status()
	{
		$related_company_id 	= Input::get('related_company_id');
		$data['status'] 		= Input::get('status');
		$qry = UserRelatedCompany::where('related_company_id', "=", $related_company_id)->update($data);
		if($qry){
			echo 1;
		}else{
			echo 0;
		}
		exit;
	}

}
