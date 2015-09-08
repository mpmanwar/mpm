<?php

class FileandsignController extends BaseController {
    
    public function fileandsign(){
        
         $data['heading'] = "FILE AND SIGN ";
        $data['title'] = "File & Sign";
        $admin_s = Session::get('admin_details');
        $user_id = $admin_s['id'];
        $group_id = $admin_s['group_id'];
        //print_r($user_id);die();
        $groupUserId = $admin_s['group_users'];
        
        return View::make('fileandsign.fileandsign', $data);
        
    }

}
