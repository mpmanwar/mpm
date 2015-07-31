<?php
class NotesController extends BaseController {
	
	public function index(){
		$data['title'] = 'Notes';
		$data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
		$data['heading'] = "NOTES";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		
		

		//echo "<prev>".print_r($data['client_details']);die;
		return View::make('staff.notes.index', $data);
	}

	

    

}
