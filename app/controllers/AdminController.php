<?php

class AdminController extends BaseController {

	public function signup() {
		$data['title'] = "Sign Up";

		$data['coun'] = Country::where("country_id", "!=", 1)->orderBy('country_name')->
		get();
		// $data['coun'] 		= Country::select('country_name')->get();
		return View::make('admin/signup', $data);
	}

	public function signup_process() {
		//die('sign');
		if ($this->isPostRequest()) {
			$postData = Input::all();
			$messages = array(
				'fname.required' => 'Please enter your first name',
				'email.required' => 'Please enter your email/username',
				'password.required' => 'Please enter your password',
				'confirmation_password.required' => 'Please enter confirmation password',
				'confirmation_password.matchpassword' => "confirmation password doesn't match");

			//print_r($messages);die();
			$rules = array(
				'fname' => 'required|alpha',
				'lname' => 'required|alpha',
				'email' => 'required|email',
				'password' => 'required',
				'confirmation_password' => 'required|same:password',
				'phone' => 'required');
			$validator = Validator::make($postData, $rules, $messages);

			if ($validator->fails()) {
				return Redirect::to('/admin-signup')->withErrors($validator)->withInput();
			} else {
				$insert_data['first_name'] = $postData['fname'];
				$insert_data['last_name'] = $postData['lname'];
				$insert_data['practice_name'] = $postData['practicename'];
				$insert_data['email_address'] = $postData['email'];
				$insert_data['password'] = md5($postData['password']);
				$insert_data['phone'] = $postData['phone'];
				$insert_data['website'] = $postData['website'];
				$insert_data['country'] = $postData['country'];

				Admin::insert($insert_data);
				Session::flash('message', 'You have successfully registered');
			}

			return Redirect::to('/admin-signup');
		}
	}

	public function login() {
		$data['title'] = "Login";
		return View::make('admin/login', $data);

	}

	public function login_process() {
		$postData = Input::all();
		$messages = array(
			"userid.required" => "Please enter your userid",
			"password.required" => "Please enter your password",
		);
		//print_r($messages);die();

		$rules = array(
			"userid" => "required",
			"password" => "required",
		);
		// print_r($rules);die();
		$validator = Validator::make($postData, $rules, $messages);

		if ($validator->fails()) {

			return Redirect::to('/')->withErrors($validator)->withInput();
		} else {

			$admin = User::where('email', $postData['userid'])->where('password',
				md5($postData['password']))->first();
			//echo $this->last_query();die;
			if (isset($admin) && count($admin) > 0) {
				//############### Check user status ##############//
				if($admin->status == "I"){
					Session::flash('message', 'You are inactive user, Please contact with admin');
					return Redirect::to('/');
				}
				//############### Check user status ##############//

				$arr['id'] 			= $admin->user_id;
				$arr['first_name'] 	= $admin->fname;
				$arr['last_name'] 	= $admin->fname;
				$arr['email'] 		= $admin->email;
				$arr['user_type'] 	= $admin->user_type;
				Session::put('admin_details', $arr);

				LoginDetail::insert(array('login_date'=>date("Y-m-d H:i:s"), 'user_id'=>$admin->user_id));

				return Redirect::to('/dashboard');
			} else {
				Session::flash('message', 'Your username/password doesn`t match');
				return Redirect::to('/');
			}
		}
		

		

	}

	/*public function login_process() {
		if ($this->isPostRequest()) {
			$postData = Input::all();
			$messages = array(
				"userid.required" => "Please enter your userid",
				"password.required" => "Please enter your password",
			);
			//print_r($messages);die();

			$rules = array(
				"userid" => "required",
				"password" => "required",
			);
			// print_r($rules);die();
			$validator = Validator::make($postData, $rules, $messages);

			if ($validator->fails()) {

				return Redirect::to('/')->withErrors($validator)->withInput();
			} else {

				$admin = Admin::where('email_address', $postData['userid'])->where('password',
					md5($postData['password']))->first();

				if (isset($admin) && count($admin) > 0) {

					$arr['id'] = $admin->id;
					$arr['first_name'] = $admin->first_name;
					$arr['last_name'] = $admin->last_name;
					$arr['practice_name'] = $admin->practice_name;
					$arr['email_address'] = $admin->email_address;
					$arr['phone'] = $admin->phone;
					$arr['website'] = $admin->website;
					$arr['country'] = $admin->country;

					Session::put('admin_details', $arr);
					return Redirect::to('/dashboard');
				} else {
					Session::flash('message', 'Your username/password doesn`t match');
				}
			}
		}

		return Redirect::to('/');

	}*/

	public function logout() {
		Session::flush();
        Session::regenerate();
		return Redirect::to('/');
	}

	public function forgot_password() {

		return View::make('admin/password');

	}

	public function password_send() {

		$usr_data = array();
		$postData = Input::all();

		$usr_data['email'] = $postData['userid'];
		$admin = Admin::where('email_address', $usr_data['email'])->first();

		if ($admin) {
			$usr_data['newpass'] = str_random(8);
			$data = array('password' => md5($usr_data['newpass']));
			Admin::where('email_address', '=', $usr_data['email'])->update($data);

			$this->send_mail($usr_data);
			Session::flash('message', 'The new password has been sent to your email.');
			return Redirect::to('/forgot-password');

		} else {
			Session::flash('message_error', 'Your username/password doesn`t match');
			return Redirect::to('/forgot-password');
		}

	}

	private function send_mail($data) {
		Mail::send('emails.password_admin', $data, function ($message) use ($data) {
			$message->from('anwar.khan@appsbee.com', 'MPM'); $message->to($data['email'])->
			subject("Welcome to MPM");}
		);
	}
	public function adminprofile() {

		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id

		if (empty($user_id)) {
			return Redirect::to('/');
		}
		$data['title'] = "Profile";
		$data['heading'] = "PROFILE";
		$admin_s = Session::get('admin_details');
		$adminid = $admin_s['id'];

		$data['admin_details'] = Admin::where('id', $adminid)->first();
		$country = Country::where('country_id', $data['admin_details']['country'])->
		first();
		$data['admin_details']['country'] = $country['country_name'];

		return View::make('admin/profile', $data);
	}

	public function change_password() {
		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id

		if (empty($user_id)) {
			return Redirect::to('/');
		}
		$data['title'] = "Edit Password";
		$data['heading'] = "EDIT PASSWORD";
		return View::make('admin/change_password', $data);
	}

	public function new_pass() {

		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		$usr_data = array();
		$postData = Input::all();
		$admin_s = Session::get('admin_details');
		$adminid = $admin_s['id'];

		$messages = array(
			"old_password.required" => "Please enter your Old Password",
			"new_password.required" => "Please enter your New Password",
			"conform_password.required" => "Please enter your confirm_password",
		);

		$rules = array(
			'old_password' => 'required',
			'new_password' => 'required',
			'conform_password' => 'required|same:new_password',
		);
		$validator = Validator::make($postData, $rules, $messages);

		if ($validator->fails()) {
			return Redirect::to('/change-password')->withErrors($validator)->withInput();
		} else {
			$usr_data['password'] = md5($postData['old_password']);
			$admin = Admin::where('password', $usr_data['password'])->first();
			if ($admin) {
				$data = array('password' => md5($postData['new_password']));
				Admin::where('id', '=', $adminid)->update($data);
				Session::flash('message_su', 'Successfully update your password');
			} else {
				Session::flash('message', 'Please enter your correct old password');
			}

		}
		return Redirect::to('/change-password');

	}

	public function profile_edit() {
		$data['title'] = "Edit - Profile";
		$data['coun'] = Country::where("country_id", "!=", 1)->orderBy('country_name')->
		get();
		$admin_s = Session::get('admin_details');

		$data['admin_details'] = Admin::where('id', $admin_s['id'])->first();
		return View::make('admin/profile_edit', $data);
	}

	public function profile_update() {
		$admin_s = Session::get('admin_details');

		$usr_data = array();
		$postData = Input::all();
		//print_r($postData);die();
		$data = array(
			'first_name' => $postData['first_name'],
			'last_name' => $postData['last_name'],
			'website' => $postData['website'],
			'practice_name' => $postData['practice_name'],
			'phone' => $postData['phone'],
			'country' => $postData['country']);

		Admin::where('id', '=', $admin_s['id'])->update($data);
		//die('update');
		return Redirect::to('/admin-profile');
	}

}

