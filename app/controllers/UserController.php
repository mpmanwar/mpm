<?php
//opcache_reset ();
//use mail;

class UserController extends BaseController {
	
	public function user_list(){
		$data['title'] = "User List";
		$data['user_lists']	= User::get();
		if(isset($data['user_lists']) && count($data['user_lists']) > 0){
			$i = 0;
			foreach($data['user_lists'] as $user_list){
				$permissions = DB::table("user_permissions")->leftJoin('permissions', 'user_permissions.permission_id', '=', 'permissions.permission_id')
					->where('user_permissions.user_id', '=', $user_list->user_id)->select('permissions.name', 'permissions.permission_id')->get();
					//echo $this->last_query();die;
					//print_r($permissions);die;
					$permission = "";
					if(isset($permissions) && count($permissions) > 0){
						foreach($permissions as $usr_perission){
							$permission.= $usr_perission->name." + ";
						}
						$permission = substr($permission, 0, -3);
					}
					
				$data['user_lists'][$i]['permission']	= $permission;
				$i++;
			}
		}

		//echo "<prev>".print_r($data);die;
		return View::make('user.user_list', $data);
	}

	public function add_user(){
		$data['title'] = "Add User";
		$data['permission_list'] = Permission::get();
		return View::make('user.add_user', $data);
	}

	public function user_process()
	{
		$usr_data = array();
		$usrp_data = array();

		$postData = Input::all();
		//echo "<prev>".print_r($postData['permission']);die;

		$usr_data['fname']			= $postData['fname'];
		$usr_data['lname']			= $postData['lname'];
		$usr_data['email']			= $postData['email'];
		$usr_data['created']		= date("Y-m-d H:i:s");
		$usr_id = User::insertGetId($usr_data);
		$usr_data['user_id']		= $usr_id;

		foreach($postData['permission'] as $value){
			$usrp_data['user_id']		= $usr_id;
			$usrp_data['permission_id']	= $value;
			UserPermission::insert($usrp_data);
		}

		$this->sendMail($usr_data);

		return Redirect::to('/add-user');
	}

	private function sendMail($data)
	{//print_r($data);die;
		Mail::send('emails.add_user', $data, function($message) use ($data) {
            $message->from('anwar.khan@appsbee.com', 'MPM');
            $message->to($data['email'], $data['fname'].' '.$data['lname'])->subject("Test MPM");
            
        });
	}

}
