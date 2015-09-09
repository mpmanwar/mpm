<?php
//opcache_reset ();
//Cache::forget('user_list');

class QuotesController extends BaseController {
	
	public function quotes(){
		$data['title'] = 'Quotes';
		$data['previous_page'] = '<a href="crm/MTE=/YWxs">CRM</a>';
		$data['heading'] = "QUOTES";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

	
    return View::make('crm.new_quotes', $data);
    
    }


}
