<?php
class CrmController extends BaseController
{

    public function index($page_open, $owner_id){
        $data['heading'] = "CRM";
        $data['title'] = "Crm";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['page_open']          = base64_decode($page_open);
        $data['encode_page_open']   = $page_open;
        $data['encode_owner_id']    = $owner_id;
        $data['owner_id']           = base64_decode($owner_id);
        $data['goto_url']           = "/crm";
        
        $groupUserId = $session['group_users'];
        $data['titles']         = Title::orderBy("title_id")->get();
        $data['countries']      = Country::orderBy('country_name')->get();
        $data['old_org_types'] = OrganisationType::where("client_type", "=", "all")->orderBy("name")->get();
        $data['new_org_types'] = OrganisationType::where("client_type", "=", "org")->whereIn("user_id", $groupUserId)->where("status", "=", "new")->orderBy("name")->get();
        $data['industry_lists'] = IndustryList::getIndustryList();
        $data['staff_details']  = User::getAllStaffDetails();
        return View::make('crm.index', $data);
    }
    
    
    
    
    
    

}
