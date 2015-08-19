<?php
//opcache_reset ();
//Cache::forget('user_list');
//use DB;
class HmrcController extends BaseController
{
    public function hmrc(){
        
        $data['heading'] = "HMRC";
        $data['title'] = "Hmrc";
        /*if (base64_decode($type) == 'profile') {
            $data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
        } else {
            $data['previous_page'] = '<a href="/staff-management">Staff Management</a>';
        }
        $data['staff_type'] = base64_decode($type);*/


       
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['user_type'] = $session['user_type'];
        $groupUserId = $session['group_users'];

         return View::make('hmrc.hmrc', $data);
    }

}
