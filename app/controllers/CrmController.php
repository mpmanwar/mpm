<?php
class CrmController extends BaseController
{

    public function index($page_open, $owner_id){
        $data['heading']= "CRM";
        $data['title']  = "Crm";
        $session        = Session::get('admin_details');
        $user_id        = $session['id'];
        $groupUserId    = $session['group_users'];

        $data['page_open']          = base64_decode($page_open);
        $data['encode_page_open']   = $page_open;
        $data['encode_owner_id']    = $owner_id;
        $data['owner_id']           = base64_decode($owner_id);
        $data['goto_url']           = "/crm";
        
        
        $data['titles']         = Title::orderBy("title_id")->get();
        $data['countries']      = Country::orderBy('country_name')->get();
        $data['old_org_types']  = OrganisationType::where("client_type", "=", "all")->orderBy("name")->get();
        $data['new_org_types']  = OrganisationType::where("client_type", "=", "org")->whereIn("user_id", $groupUserId)->where("status", "=", "new")->orderBy("name")->get();
        $data['industry_lists'] = IndustryList::getIndustryList();
        $data['staff_details']  = User::getAllStaffDetails();
        $data['old_lead_sources']   = LeadSource::getOldLeadSource();
        $data['new_lead_sources']   = LeadSource::getNewLeadSource();
        $data['leads_tabs']         = CrmLeadsTab::getAllTabDetails();
        $data['existing_clients']   = Client::getAllClientDetails();
        $data['leads_details']      = CrmLead::getAllDetails();
        //echo "<pre>";print_r($data['existing_clients']);echo "</pre>";die;
        return View::make('crm.index', $data);
    }

    public function save_leads_data()
    {
        $data       = array();
        $session    = Session::get('admin_details');        

        $details    = Input::get();
        $encode_page_open   = $details['encode_page_open'];
        $encode_owner_id    = $details['encode_owner_id'];
        $type               = $details['type'];

        if($type == "ind"){
            $data['prospect_title'] = $details['prospect_title'];
            $data['prospect_fname'] = $details['prospect_fname'];
            $data['prospect_lname'] = $details['prospect_lname'];
        }else{
            $data['business_type']  = $details['business_type'];
            $data['prospect_name']  = $details['prospect_name'];
            $data['contact_title']  = $details['contact_title'];
            $data['contact_fname']  = $details['contact_fname'];
            $data['contact_lname']  = $details['contact_lname'];
        }
        $data['user_id']        = $session['id'];
        $data['client_type']    = $details['type'];
        $data['deal_certainty'] = $details['deal_certainty'];
        $data['deal_owner']     = $details['deal_owner'];
        $data['phone']          = $details['phone'];
        $data['mobile']         = $details['mobile'];
        $data['email']          = $details['email'];
        $data['website']        = $details['website'];
        $data['annual_revenue'] = $details['annual_revenue'];
        $data['quoted_value']   = $details['quoted_value'];
        $data['lead_source']    = $details['lead_source'];
        $data['industry']       = $details['industry'];
        $data['street']         = $details['street'];
        $data['city']           = $details['city'];
        $data['province']       = $details['province'];
        $data['postal_code']    = $details['postal_code'];
        $data['country_id']     = $details['country_id'];
        $data['notes']          = $details['notes'];
        
        CrmLead::insert($data);
        return Redirect::to('/crm/'.$encode_page_open.'/'.$encode_owner_id);
        //print_r($data);die;
    }

    public function add_new_source()
    {
        $session             = Session::get('admin_details');
        $user_id             = $session['id'];
        $data['user_id']     = $user_id;
        $data['status']      = "new";
        $data['is_show']     = Input::get("modal_type");
        $data['source_name'] = Input::get("source_name");
        $last_id = LeadSource::insertGetId($data);
        echo $last_id;
    }

    public function delete_source_name()
    {
        $source_id = Input::get("field_id");
        LeadSource::where("source_id", "=", $source_id)->delete();
        echo $source_id;
    }
    
    
    
    
    
    

}
