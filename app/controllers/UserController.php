<?php

class UserController extends BaseController {
	
	public function user_list(){
		$data['title'] = "User List";
		return View::make('user.user_list', $data);
	}

	public function add_user(){
		$data['title'] = "Add User";
		return View::make('user.add_user', $data);
	}

	public function user_process()
	{
		
	}

}
