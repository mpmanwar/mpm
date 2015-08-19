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
    
    public function authorisations(){
        $data['heading'] = "AUTHORISATIONS";
        $data['title'] = "Authorisations";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['user_type'] = $session['user_type'];
        $groupUserId = $session['group_users'];

        $data['allClients'] 	 	= App::make("HomeController")->get_all_clients();






         return View::make('hmrc.authorisations', $data);
    }
    
    
    public function emails(){
        $data['heading'] = "STRUCTURED EMAILS";
        $data['title'] = "Structured Emails";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['user_type'] = $session['user_type'];
        $groupUserId = $session['group_users'];








         return View::make('hmrc.emails', $data);
        
    }
    public function tool(){
        $data['heading'] = "TOOL & CALCULATORS";
        $data['title'] = "Tool & Calculators";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['user_type'] = $session['user_type'];
        $groupUserId = $session['group_users'];








         return View::make('hmrc.tool', $data);
        
    }

}
