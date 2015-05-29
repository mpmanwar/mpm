<?php
//opcache_reset ();
//Cache::forget('user_list');

class UserController extends BaseController {
	
	public function user_list(){
		$data['title'] = "User List";
		$data['heading'] = "USER LIST";
		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		if (Cache::has('user_list')) {
			$data = Cache::get('user_list');

		} else {

			$data['user_lists']	= User::orderBy("user_id", "Desc")->get();
			if(isset($data['user_lists']) && count($data['user_lists']) > 0){

				$i = 0;
				foreach ($data['user_lists'] as $user_list) {
					/*$permissions = DB::table("user_permissions")->leftJoin('permissions', 'user_permissions.permission_id', '=', 'permissions.permission_id')->where('user_permissions.user_id', '=', $user_list->user_id)->select('permissions.name', 'permissions.permission_id')->get();
					//echo $this->last_query();die;
					//print_r($permissions);die;
					$permission = "";
					if (isset($permissions) && count($permissions) > 0) {
						foreach ($permissions as $usr_perission) {
							$permission .= $usr_perission->name . " + ";
						}
						$permission = substr($permission, 0, -3);
					}*/

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

			Cache::put('user_list', $data, 10);
		}

		//echo "<prev>".print_r($data);die;
		return View::make('user.user_list', $data);
	}


	public function add_user() {
		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id

		if (empty($user_id)) {
			return Redirect::to('/');
		}
		$data['title'] = "Add User";
		$data['heading'] = "ADD USER DETAILS";
		$data['permission_list'] = Permission::get();
		$data['access_list'] = Access::get();
		return View::make('user.add_user', $data);
	}

	public function user_process() {
		$usr_data = array();
		$usrp_data = array();

		$postData = Input::all();
		//echo "<prev>".print_r($postData['permission']);die;
		$validator = $this->validateChinForm($postData);
		if ($validator->passes()) {
			$usr_data['fname'] = $postData['fname'];
			$usr_data['lname'] = $postData['lname'];
			$usr_data['email'] = $postData['email'];
			$usr_data['user_type'] = $postData['user_type'];
			$usr_data['created'] = date("Y-m-d H:i:s");
			$usr_id = User::insertGetId($usr_data);
			$usr_data['user_id'] = $usr_id;
			$usr_data['link'] = url()."/user/create-password/".base64_encode($usr_id);

			if ($postData['user_type'] != "C") {
				if (!empty($postData['permission']) && count($postData['permission']) > 0) {
					foreach ($postData['permission'] as $value) {
						$usrp_data['user_id'] = $usr_id;
						$usrp_data['permission_id'] = $value;
						UserPermission::insert($usrp_data);
					}
				}

			}

			if (!empty($postData['user_access']) && count($postData['user_access']) > 0) {
				foreach ($postData['user_access'] as $value) {
					$usracc_data['user_id'] = $usr_id;
					$usracc_data['access_id'] = $value;
					UserAccess::insert($usracc_data);
				}
			}

			$this->send_mail($usr_data);
			Session::flash('message', 'The email has been sent to the new user.');
			Cache::flush();
			return Redirect::to('/user-list');
		} else {
			return Redirect::to('/add-user')->withInput()->withErrors($validator);
		}
	}

	private function send_mail($data) {
		Mail::send('emails.add_user', $data, function ($message) use ($data) {
			$message->from('anwar.khan@appsbee.com', 'MPM');
			$message->to($data['email'], $data['fname'] . ' ' . $data['lname'])->subject("Welcome to MPM");

		});
	}

	public function validateChinForm($postData) {
		$messages = array(
			'fname.required' => 'Please enter first name',
			'email.required' => 'Please enter email address',
		);

		$rules = array(
			'fname' => 'required|alpha',
			'email' => 'required|email',
		);

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
			Session::flash('message', 'Users are successfully deleted');
		}
		Cache::flush();
		return Redirect::to("user-list");

	}

	public function edit_user($id) {
		$peruser_per = array();
		$data['title'] = "User Edit";
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
		$data['user_type'] = $postData['user_type'];
		//echo print_r($postData['permission']);die;
		UserPermission::where('user_id', '=', $id)->delete();

		if ($postData['user_type'] != "C") {
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
		return Redirect::action('UserController@user_list');
	}

	public function pdf() {
		$data['title'] = "User List";
		$data['user_lists'] = User::get();
		if (isset($data['user_lists']) && count($data['user_lists']) > 0) {
			$i = 0;
			foreach ($data['user_lists'] as $user_list) {
				$permissions = DB::table("user_permissions")->leftJoin('permissions', 'user_permissions.permission_id', '=', 'permissions.permission_id')
				                                            ->where('user_permissions.user_id', '=', $user_list->user_id)->select('permissions.name', 'permissions.permission_id')->get();
				//echo $this->last_query();die;
				//print_r($permissions);die;
				$permission = "";
				if (isset($permissions) && count($permissions) > 0) {
					foreach ($permissions as $usr_perission) {
						$permission .= $usr_perission->name . " + ";
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
			Session::flash('message', 'You have successfully created your password');
			User::where('user_id', '=', base64_decode($postData['user_id']))->update(array("password"=>base64_encode($postData['password'])));
			//echo $this->last_query();die;
		}

		return Redirect::to('/user/create-password/'.$postData['user_id']);
	}

}
