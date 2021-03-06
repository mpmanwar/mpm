<?php
class CrmController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        if (empty($user_id)) {
            Redirect::to('/login');
        }
        if (isset($session['user_type']) && $session['user_type'] == "C") {
            Redirect::to('/client-portal')->send();
        }
    }

    public function index($page_open, $owner_id)
    {
        $data = array();
        $data['leads'] = array();

        $data['heading'] = "CRM";
        $data['title'] = "Crm";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $groupUserId = $session['group_users'];
        $won_value = Session::get('won_show_archive');
        $lost_value = Session::get('lost_show_archive');
        if (isset($won_value) && $won_value == 'Y') {
            $data['won_archive'] = 'Show Archived';
        } else {
            $data['won_archive'] = 'Hide Archived';
        }
        if (isset($lost_value) && $lost_value == 'Y') {
            $data['lost_archive'] = 'Show Archived';
        } else {
            $data['lost_archive'] = 'Hide Archived';
        }

        $data['page_open']          = base64_decode($page_open);
        $data['encode_page_open']   = $page_open;
        $data['encode_owner_id']    = $owner_id;
        $data['owner_id']           = base64_decode($owner_id);
        $data['goto_url']           = "/crm";
        $data['tab_no']             = $this->getTabNo($data['page_open']);

        //echo "<pre>";print_r($data);die;
        $data['titles'] = Title::orderBy("title_id")->get();
        $data['countries'] = Country::orderBy('country_name')->get();
        $data['old_org_types'] = OrganisationType::where("client_type", "=", "all")->
            orderBy("name")->get();
        $data['new_org_types'] = OrganisationType::where("client_type", "=", "org")->
            whereIn("user_id", $groupUserId)->where("status", "=", "new")->orderBy("name")->
            get();
        $data['industry_lists'] = IndustryList::getIndustryList();
        $data['staff_details'] = User::getAllStaffDetails();
        $data['old_lead_sources'] = LeadSource::getOldLeadSource();
        $data['new_lead_sources'] = LeadSource::getNewLeadSource();
        $data['leads_tabs'] = CrmLeadsTab::getAllTabDetails(); 

        $data['invoice_leads_details'] = CrmLead::getInvoiceLeadsDetails();
        $data['leads_details'] = CrmLead::getAllOpportunity();
        $total = 0;
        $average = 0;
        $likely = 0;
        $all_count = 0;
        if (isset($data['leads_details']) && count($data['leads_details']) > 0) {
            foreach ($data['leads_details'] as $key => $value) {
                if(isset($value['lead_status']) && ($value['lead_status'] != 8 && $value['lead_status'] != 9 && $value['lead_status'] != 10)){
                    $quoted_value = str_replace(",", "", $value['quoted_value']);
                    $total += $quoted_value;
                    $likely += ($value['deal_certainty'] * $quoted_value) / 100;

                    $status = CrmLeadsStatus::getDetailsByLeadsId($value['leads_id']);
                    //echo $this->last_query();
                    if (isset($status['leads_tab_id']) && ($status['leads_tab_id'] == 8 || $status['leads_tab_id'] == 9 || $status['leads_tab_id'] == 10)) {
                        $date = explode(' ', $status['likely']);
                        $data['leads_details'][$key]['deal_age'] = $this->getDealAge($value['date'], $date[0]);
                    } else {
                        $data['leads_details'][$key]['deal_age'] = $this->getAgeCount($value['date']);
                    }
                    $all_count++;
                    
                }
            }
            if(isset($all_count) && $all_count != 0){
                $average = $total/$all_count;
            }
        }
        $data['all_count']      = $all_count;
        $data['all_total']      = number_format($total, 2);
        $data['all_average']    = number_format($average, 2);
        $data['all_likely']     = number_format($likely, 2);

        //=================LEADS TAB ===================//
        if($data['tab_no'] == 5){
            $leads = $this->leadstabDetails();
            $data['leads'] = $leads;
        }
        
        //echo "<pre>";print_r($data['leads']);echo "</pre>";die;
        return View::make('crm.index', $data);
    }

    public function leadstabDetails()
    {
        $data = array();
        $leads = CrmLead::getAllLeads();
        $total = 0;
        $leads_count = 0;
        if (isset($leads) && count($leads) > 0) {
            foreach ($leads as $key => $value) {
                $leads_count++;
            }
        }
        $data['leads_details']  = $leads;
        $data['leads_count']    = $leads_count;

        return $data;
    }

    public function save_leads_data()
    {
        $data = array();
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $groupUserId    = $session['group_users'];

        $details = Input::get();
        $encode_page_open = $details['encode_page_open'];
        $encode_owner_id = $details['encode_owner_id'];
        $type = $details['type'];
        $leads_id = $details['leads_id'];

        if ($type == "ind") {
            $data['prospect_title'] = $details['prospect_title'];
            $data['prospect_fname'] = $details['prospect_fname'];
            $data['prospect_lname'] = $details['prospect_lname'];
        } else {
            $data['business_type'] = isset($details['business_type']) ? $details['business_type'] :
                "0";
            $data['prospect_name'] = $details['prospect_name'];
            $data['contact_title'] = $details['contact_title'];
            $data['contact_fname'] = $details['contact_fname'];
            $data['contact_lname'] = $details['contact_lname'];
        }
        $data['existing_client'] = isset($details['existing_client']) ? $details['existing_client'] :
            "0";
        $data['user_id'] = $user_id;
        $data['leads_type']     = "O";
        $data['client_type'] = $details['type'];
        $data['date'] = date('Y-m-d', strtotime($details['date']));
        $data['deal_certainty'] = $details['deal_certainty'];
        $data['deal_owner'] = isset($details['deal_owner']) ? $details['deal_owner'] :
            "0";
        $data['phone'] = $details['phone'];
        $data['mobile'] = $details['mobile'];
        $data['email'] = $details['email'];
        $data['website'] = $details['website'];
        $data['annual_revenue'] = $details['annual_revenue'];
        $data['quoted_value'] = $details['quoted_value'];
        $data['lead_source'] = isset($details['lead_source']) ? $details['lead_source'] :
            "0";
        $data['industry'] = isset($details['industry']) ? $details['industry'] : "0";
        $data['street'] = $details['street'];
        $data['city'] = $details['city'];
        $data['county'] = $details['county'];
        $data['postal_code'] = $details['postal_code'];
        $data['country_id'] = isset($details['country_id']) ? $details['country_id'] :
            "0";
        $data['notes'] = $details['notes'];

        if ($leads_id == 0) {
            $last_id = CrmLead::insertGetId($data);
            $leadstatus['user_id'] = $user_id;
            $leadstatus['leads_id'] = $last_id;
            $leadstatus['leads_tab_id'] = 2;
            $leadstatus['created'] = date("Y-m-d H:i:s");
            CrmLeadsStatus::insert($leadstatus);
        } else {
            $leads_type = CrmLead::getLeadsTypeByLeadsId($leads_id);
            if(isset($leads_type) && $leads_type == 'L'){
                $leadstatus['leads_tab_id'] = 2;
                CrmLeadsStatus::whereIn("user_id", $groupUserId)->where('leads_id', '=', $leads_id)->update($leadstatus);
            }
            CrmLead::where('leads_id', '=', $leads_id)->update($data);
        }

        return Redirect::to('/crm/' . $encode_page_open . '/' . $encode_owner_id);
        //print_r($data);die;
    }

    public function save_new_leads()
    {
        $data = array();
        $session = Session::get('admin_details');
        $user_id = $session['id'];

        $details = Input::get();
        $encode_page_open = $details['encode_page_open'];
        $encode_owner_id = $details['encode_owner_id'];
        $type = $details['new_type'];
        $leads_id = $details['new_leads_id'];

        if ($type == "ind") {
            $data['prospect_title'] = $details['new_prospect_title'];
            $data['prospect_fname'] = $details['new_prospect_fname'];
            $data['prospect_lname'] = $details['new_prospect_lname'];
        } else {
            $data['business_type'] = isset($details['new_business_type'])?$details['new_business_type']:
                "0";
            $data['prospect_name'] = $details['new_prospect_name'];
            $data['contact_title'] = $details['new_contact_title'];
            $data['contact_fname'] = $details['new_contact_fname'];
            $data['contact_lname'] = $details['new_contact_lname'];
        }
        $data['user_id']        = $user_id;
        $data['leads_type']     = "L";
        $data['client_type']    = $details['new_type'];
        $data['date']           = date('Y-m-d', strtotime($details['new_lead_date']));
        $data['deal_owner']     = isset($details['new_deal_owner']) ? $details['new_deal_owner']:"0";
        $data['phone']          = $details['new_phone'];
        $data['mobile']         = $details['new_mobile'];
        $data['email']          = $details['new_email'];
        $data['website']        = $details['new_website'];
        $data['lead_source']    = isset($details['new_lead_source']) ? $details['new_lead_source'] :
            "0";
        $data['industry']       = isset($details['new_industry']) ? $details['new_industry'] : "0";
        $data['notes']          = $details['new_notes'];

        if ($leads_id == 0) {
            $last_id = CrmLead::insertGetId($data);
            $leadstatus['user_id'] = $user_id;
            $leadstatus['leads_id'] = $last_id;
            $leadstatus['leads_tab_id'] = 12;
            $leadstatus['created'] = date("Y-m-d H:i:s");
            CrmLeadsStatus::insert($leadstatus);
        } else {
            CrmLead::where('leads_id', '=', $leads_id)->update($data);
        }

        return Redirect::to('/crm/' . $encode_page_open . '/' . $encode_owner_id);
        //print_r($data);die;
    }

    public function add_new_source()
    {
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['user_id'] = $user_id;
        $data['status'] = "new";
        $data['is_show'] = Input::get("modal_type");
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

    public function get_form_dropdown()
    {
        $data = array();
        $client_data = array();
        $leads_details = array();
        $leads_details['date'] = date("d-m-Y");
        $type = Input::get("type");
        $leads_id = Input::get("leads_id");

        //======== Client Details ========//
        if ($type == "ind") {
            $existing_clients = Client::getAllIndClientDetails();
            if (isset($existing_clients) && count($existing_clients) > 0) {
                foreach ($existing_clients as $key => $value) {
                    $client_data[$key]['client_id'] = $value['client_id'];
                    $client_data[$key]['client_name'] = $value['client_name'];
                }
            }
        } else {
            $existing_clients = Client::getAllOrgClientDetails();
            if (isset($existing_clients) && count($existing_clients) > 0) {
                foreach ($existing_clients as $key => $value) {
                    $client_data[$key]['client_id'] = isset($value['client_id'])?$value['client_id']:'';
                    $client_data[$key]['client_name'] = isset($value['business_name'])?$value['business_name']:'';
                }
            }
        }

        if (isset($client_data) && count($client_data) > 0) {
            foreach ($client_data as $value) {
                $client_name[] = strtolower($value['client_name']);
            }
            array_multisort($client_name, SORT_ASC, $client_data);
        }
        //======== Client Details ========//


        if ($leads_id != '0') {
            $leads_details = CrmLead::getLeadsByLeadsId($leads_id);
        } else {
            $leads_details['deal_certainty'] = 100;
        }

        $data['leads_details'] = $leads_details;
        $data['existing_clients'] = $client_data;

        echo json_encode($data);
    }

    public function save_edit_status()
    {
        $data = array();
        $step_id = Input::get('step_id');
        $type = Input::get('type');
        if (isset($type) && $type == "title") {
            $data['tab_name'] = Input::get("status_name");
            $title = $data['tab_name'];
        } else {
            $value = CrmLeadsTab::where("tab_id", "=", $step_id)->first();
            if ($value['status'] == "S") {
                $data['status'] = "H";
            } else {
                $data['status'] = "S";
            }
            $title = $value['tab_name'];
        }
        $sql = CrmLeadsTab::where("tab_id", "=", $step_id)->update($data);

        echo $title;
        exit;
    }

    public function delete_leads_details()
    {
        $leads_ids = Input::get('leads_delete_id');
        foreach ($leads_ids as $leads_id) {
            CrmLead::where('leads_id', '=', $leads_id)->update(array('is_deleted' => 'Y'));
            CrmLeadsStatus::where('leads_id', '=', $leads_id)->delete();
        }
    }

    public function sendto_another_tab()
    {
        $session = Session::get('admin_details');
        $user_id = $session['id'];

        $data['leads_tab_id'] = Input::get('tab_id');
        $data['leads_id'] = Input::get('leads_id');
        $data['user_id'] = $user_id;

        $leads_status = CrmLeadsStatus::getDetailsByLeadsId($data['leads_id']);
        if (isset($leads_status) && count($leads_status) > 0) {
            CrmLeadsStatus::where("leads_status_id", "=", $leads_status['leads_status_id'])->
                update($data);
            $last_id = $leads_status['leads_status_id'];
        } else {
            $data['created'] = date("Y-m-d H:i:s");
            $last_id = CrmLeadsStatus::insertGetId($data);
        }
        echo $last_id;
    }

    public function get_client_address()
    {
        $data = array();
        $client_id = Input::get('client_id');
        $client_type = Input::get('client_type');
        $details = Common::clientDetailsById($client_id);
        if ($client_type == "org") {
            $type = "corres";
            $data['address'] = ContactAddress::getClientContactAddress($client_id, $type);
            if (isset($details['business_name'])) {
                $data['address']['business_name'] = $details['business_name'];
            }
            if (isset($details['business_type'])) {
                if (strtolower($details['business_type']) == "llp") {
                    $business_type = 1;
                }
                if (strtolower($details['business_type']) == "company") {
                    $business_type = 2;
                }
                if (strtolower($details['business_type']) == "partnership") {
                    $business_type = 3;
                }
                if (strtolower($details['business_type']) == "sole trader") {
                    $business_type = 4;
                }
                $data['address']['business_type'] = $business_type;
            }
            if (isset($details['corres_cont_name'])) {
                $name = explode(" ", $details['corres_cont_name']);
                $data['address']['contact_fname'] = isset($name[0]) ? $name[0] : "";
                $data['address']['contact_lname'] = isset($name[1]) ? $name[1] : "";
            }
        } else {
            $type = "res";
            $data['address'] = ContactAddress::getClientContactAddress($client_id, $type);
            if (isset($details['title'])) {
                $data['address']['prospect_title'] = $details['title'];
            }
            if (isset($details['fname'])) {
                $data['address']['prospect_fname'] = $details['fname'];
            }
            if (isset($details['lname'])) {
                $data['address']['prospect_lname'] = $details['lname'];
            }

        }
        //print_r($data);

        echo json_encode($data);
        exit;
    }

    /*public function show_graph()
    {
    $data = array();
    $month      = Input::get('month');
    $year       = Input::get('year');
    $compare    = Input::get('compare');
    $day = $this->getDay($month, $year);
    ///////////////////////////
    $to_date    = $day.'-'.$month.'-'.$year;
    $from_date  = date('d-m-Y', strtotime('-1 months', strtotime('01-'.$month.'-'.$year)));
    //////////////////////////
    //echo $from_date."=".$to_date;die;
    $divided_by = 1000;

    $details = CrmLead::getDataWithDateRange($from_date, $to_date);
    $jan_total = $feb_total = $mar_total = $apr_total = $may_total = $jun_total = $jul_total = $aug_total = $sep_total = $oct_total = $nov_total = $dec_total = 0;
    if(isset($details) && count($details) >0){
    foreach ($details as $key => $value) {
    $date = explode("-", $value['date']);
    $month = $date[1];
    if($month == "01"){
    $jan_total += $value['quoted_value'];
    //$jan_won += $value['quoted_value'];
    }
    if($month == "02"){
    $feb_total += $value['quoted_value'];
    }
    if($month == "03"){
    $mar_total += $value['quoted_value'];
    }
    if($month == "04"){
    $apr_total += $value['quoted_value'];
    }
    if($month == "05"){
    $may_total += $value['quoted_value'];
    }
    if($month == "06"){
    $jun_total += $value['quoted_value'];
    }
    if($month == "07"){
    $jul_total += $value['quoted_value'];
    }
    if($month == "08"){
    $aug_total += $value['quoted_value'];
    }
    if($month == "09"){
    $sep_total += $value['quoted_value'];
    }
    if($month == "10"){
    $oct_total += $value['quoted_value'];
    }
    if($month == "11"){
    $nov_total += $value['quoted_value'];
    }
    if($month == "12"){
    $dec_total += $value['quoted_value'];
    }
    }
    }
    $data['jan_total'] = $jan_total/$divided_by;
    $data['feb_total'] = $feb_total/$divided_by;
    $data['mar_total'] = $mar_total/$divided_by;
    $data['apr_total'] = $apr_total/$divided_by;
    $data['may_total'] = $may_total/$divided_by;
    $data['jun_total'] = $jun_total/$divided_by;
    $data['jul_total'] = $jul_total/$divided_by;
    $data['aug_total'] = $aug_total/$divided_by;
    $data['sep_total'] = $sep_total/$divided_by;
    $data['oct_total'] = $oct_total/$divided_by;
    $data['nov_total'] = $nov_total/$divided_by;
    $data['dec_total'] = $dec_total/$divided_by;
    //print_r($data);
    //Common::last_query();
    echo view::make("crm/ajax.graph", $data);
    }*/
    public function show_graph()
    {
        $data = array();
        $month = Input::get('month');
        $year = Input::get('year');
        $compare = Input::get('compare');
        $day = $this->getDay($month, $year);
        ///////////////////////////
        $to_date = $year . '-' . $month . '-' . $day;
        $from_date = date('Y-m-d', strtotime('-' . $compare . ' months', strtotime('01-' .
            $month . '-' . $year)));
        //$from_year = explode('-', $from_date);
        //////////////////////////
        //echo $from_date."=".$to_date;die;
        $divided_by = 1000;

        $lead_status = CrmLeadsStatus::leadsStatusByTabId(11); //print_r($lead_status);die;
        if (isset($lead_status) && count($lead_status) > 0) {
            $jan_total = $feb_total = $mar_total = $apr_total = $may_total = $jun_total = $jul_total =
                $aug_total = $sep_total = $oct_total = $nov_total = $dec_total = 0;
            $jan_year = $feb_year = $mar_year = $apr_year = $may_year = $jun_year = $jul_year =
                $aug_year = $sep_year = $oct_year = $nov_year = $dec_year = '';
            foreach ($lead_status as $i => $row) {
                $details = CrmLead::getDataWithDateRangeAndLeadsId($from_date, $to_date, $row['leads_id']);
                //echo $this->last_query();
                if (isset($details) && count($details) > 0) {
                    foreach ($details as $key => $value) {
                        $date = explode("-", $value['date']);
                        $month = $date[1];
                        $year = $date[2];
                        if (isset($value['quoted_value']) && $value['quoted_value'] != "") {
                            $quoted_value = str_replace(',', '', $value['quoted_value']);
                        } else {
                            $quoted_value = 0;
                        }

                        if ($month == "01") {
                            $jan_total += $quoted_value;
                            $jan_year = '"Jan-' . $year . '"';
                        }
                        if ($month == "02") {
                            $feb_total += $quoted_value;
                            $feb_year = '"Feb-' . $year . '"';
                        }
                        if ($month == "03") {
                            $mar_total += $quoted_value;
                            $mar_year = '"Mar-' . $year . '"';
                        }
                        if ($month == "04") {
                            $apr_total += $quoted_value;
                            $apr_year = '"Apr-' . $year . '"';
                        }
                        if ($month == "05") {
                            $may_total += $quoted_value;
                            $may_year = '"May-' . $year . '"';
                        }
                        if ($month == "06") {
                            $jun_total += $quoted_value;
                            $jun_year = '"Jun-' . $year . '"';
                        }
                        if ($month == "07") {
                            $jul_total += $quoted_value;
                            $jul_year = '"Jul-' . $year . '"';
                        }
                        if ($month == "08") {
                            $aug_total += $quoted_value;
                            $aug_year = '"Aug-' . $year . '"';
                        }
                        if ($month == "09") {
                            $sep_total += $quoted_value;
                            $sep_year = '"Sept-' . $year . '"';
                        }
                        if ($month == "10") {
                            $oct_total += $quoted_value;
                            $oct_year = '"Oct-' . $year . '"';
                        }
                        if ($month == "11") {
                            $nov_total += $quoted_value;
                            $nov_year = '"Nov-' . $year . '"';
                        }
                        if ($month == "12") {
                            $dec_total += $quoted_value;
                            $dec_year = '"Dec-' . $year . '"';
                        }
                    }
                }
            }
        }

        $data['jan_total'] = $jan_total / $divided_by;
        $data['feb_total'] = $feb_total / $divided_by;
        $data['mar_total'] = $mar_total / $divided_by;
        $data['apr_total'] = $apr_total / $divided_by;
        $data['may_total'] = $may_total / $divided_by;
        $data['jun_total'] = $jun_total / $divided_by;
        $data['jul_total'] = $jul_total / $divided_by;
        $data['aug_total'] = $aug_total / $divided_by;
        $data['sep_total'] = $sep_total / $divided_by;
        $data['oct_total'] = $oct_total / $divided_by;
        $data['nov_total'] = $nov_total / $divided_by;
        $data['dec_total'] = $dec_total / $divided_by;

        $data['months'] = $jan_year . ', ' . $feb_year . ', ' . $mar_year . ', ' . $apr_year .
            ', ' . $may_year . ', ' . $jun_year . ', ' . $jul_year . ', ' . $aug_year . ', ' .
            $sep_year . ', ' . $oct_year . ', ' . $nov_year . ', ' . $dec_year;
        //print_r($data);
        //Common::last_query();
        echo view::make("crm/ajax.graph", $data);
    }

    public function getDay($month, $year)
    {
        if ($month == '01' || $month == '03' || $month == '05' || $month == '07' || $month ==
            '08' || $month == '10' || $month == '12') {
            $day = 31;
        } else
            if ($month == '04' || $month == '06' || $month == '09' || $month == '11') {
                $day = 30;
            } else {
                $value = $year % 4;
                if ($value == 0) {
                    $day = 28;
                } else {
                    $day = 29;
                }
            }
            return $day;
    }

    public function archive_leads()
    {
        $leads_ids  = Input::get("leads_ids");
        $status     = Input::get("status");
        $tab_id     = Input::get("tab_id");
        if($tab_id == 8){
            Session::put('won_show_archive', 'Y');
        }
        if($tab_id == 9){
            Session::put('lost_show_archive', 'Y');
        }

        //print_r($clients_id);die;
        foreach ($leads_ids as $leads_id) {
            if ($status == "Archive") {
                $up_data['is_archive'] = 'Y';
                $up_data['show_archive'] = 'Y';
            } else {
                $up_data['is_archive'] = 'N';
                $up_data['show_archive'] = 'N';
            }
            CrmLead::where('leads_id', '=', $leads_id)->update($up_data);
        }
    }

    public function show_archive_leads()
    {
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $groupUserId = $session['group_users'];

        $is_archive = Input::get("is_archive");
        $tab_id     = Input::get("tab_id");
        //echo $is_archive;die;
        if ($is_archive == "Y") {
            if($tab_id == 8){
                Session::put('won_show_archive', 'Y');
            }
            if($tab_id == 9){
                Session::put('lost_show_archive', 'Y');
            }
        } else {
            if($tab_id == 8){
                Session::put('won_show_archive', 'N');
            }
            if($tab_id == 9){
                Session::put('lost_show_archive', 'N');
            }
        }

        $group_leads_id = CrmLeadsStatus::leadsStatusByTabId($tab_id);

        if(isset($group_leads_id) && count($group_leads_id) >0){
            foreach ($group_leads_id as $key => $value) {
                $affected = CrmLead::whereIn("user_id", $groupUserId)->where("show_archive", "=", "Y")->where("leads_id", $value['leads_id'])->update(array("is_archive" => $is_archive));
            }
            
        }
        //echo $this->last_query();die;
    }

    public function graph_page()
    {
        $data = array();
        $data['heading'] = "GRAPH";
        $data['previous_page'] = '<a href="/crm/MTE=/YWxs">Crm</a>';
        $data['back_url'] = '/crm/MTE=/YWxs';
        $data['title'] = "Graph";
        $data['sub_title'] = "Graph";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $groupUserId = $session['group_users'];

        $data['months'] = array(
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December');

        return view::make("crm/graph_page", $data);
    }

    public function report()
    {
        $data = array();
        $data['heading'] = "LEAD VALUE REPORTS";
        //$data['previous_page'] = '<a href="/crm/MTE=/YWxs">CRM</a>';
        $data['back_url'] = '/crm/MTE=/YWxs';
        $data['title'] = "CRM";
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $groupUserId = $session['group_users'];

        $data['staff_details'] = User::getAllStaffDetails();

        return view::make("crm/report", $data);
    }


    public function renewals()
    {
        $data = array();
        $data['heading'] = "Renewals";
        $data['previous_page'] = '<a href="/crm/MTE=/YWxs">Crm</a>';
        $data['title'] = "Renewals";

        return view::make("crm/renwal", $data);
    }

    public function show_leads_report()
    {
        $data   = array();
        $data1  = array();
        $where  = array();
        
        $session    = Session::get('admin_details');
        $user_id    = $session['id'];
        $groupUserId = $session['group_users'];

        $details    = Input::get();
        $status_id  = $details['status_id'];
        $user_id    = $details['user_id'];
        $is_deleted = $details['is_deleted'];
        $is_archive = $details['is_archive'];
        $date_from  = date('Y-m-d', strtotime($details['date_from']));
        $date_to    = date('Y-m-d', strtotime($details['date_to']));

        if (isset($status_id) && $status_id != "") {
            $where['cls.leads_tab_id'] = $status_id;
        }

        if (isset($user_id) && $user_id != "") {
            if ($user_id == "unassigned") {
                $where['cl.deal_owner'] = 0;
                $converson_user = "0";
            } else {
                $where['cl.deal_owner'] = $user_id;
                $converson_user = $user_id;
            }
        } else {
            $converson_user = "all";
        }

        if (isset($is_deleted) && $is_deleted == "N") {
            $where['cl.is_deleted'] = 'N';
        }

        if (isset($is_archive) && $is_archive == 'N') {
            $where['cl.is_archive'] = 'N';
        }
        //echo $user_id;die;
        $details = DB::table('crm_leads_statuses as cls')->whereIn("cl.user_id", $groupUserId)->
            where($where)->where('cl.close_date', '!=', '0000-00-00')->whereBetween('cl.date', array($date_from, $date_to))->join('crm_leads as cl',
            'cls.leads_id', '=', 'cl.leads_id')->join('crm_leads_tabs as clt', 'clt.tab_id',
            '=', 'cls.leads_tab_id')->select('cl.*', 'clt.tab_name')->get();

        //echo $this->last_query();die;
        $outer_details = DB::table('crm_leads_statuses as cls')->whereIn("cl.user_id", $groupUserId)->
            where($where)->where('cl.close_date', '!=', '0000-00-00')->whereBetween('cl.date', array($date_from, $date_to))->join('crm_leads as cl',
            'cls.leads_id', '=', 'cl.leads_id')->groupBy('cl.deal_owner')->select('cl.deal_owner')->
            get();

        //echo $this->last_query();die;
        $avg_age = $total_amount = 0;
        $count = 1;
        $won = $lost = 0;
        if (isset($details) && count($details) > 0) {
            foreach ($details as $key => $row) {
                if (isset($row->deal_owner) && $row->deal_owner != "0") {
                    $name = User::getStaffNameById($row->deal_owner);
                } else {
                    $name = "";
                }

                if ($row->client_type == 'org') {
                    $prospect_name = $row->prospect_name;
                } else {
                    $prospect_name = $row->prospect_title . " " . $row->prospect_fname . " " . $row->
                        prospect_lname;
                }

                $data1[$key]['leads_id'] = $row->leads_id;
                $data1[$key]['deal_owner'] = $row->deal_owner;
                $data1[$key]['deal_owner_name'] = $name;
                $data1[$key]['prospect_name'] = $prospect_name;
                $data1[$key]['close_date'] = date('d-m-Y', strtotime($row->date));
                $data1[$key]['tab_name'] = $row->tab_name;
                $data1[$key]['quoted_value'] = number_format(str_replace(',', '', $row->
                    quoted_value), 2);
                $data1[$key]['age'] = $this->getAgeCount($row->date);

                $avg_age += $data1[$key]['age'];
                $count++;
            }
            $count--;
        }
        $data['details'] = $data1;
        $data['outer_details'] = $outer_details;
        $data['avg_age'] = $avg_age / $count;

        /////////////Converson Rate////////////
        $leads_details = CrmLead::getDataWithDateRange($date_from, $date_to);
        if (isset($leads_details) && count($leads_details) > 0) {
            foreach ($leads_details as $key => $value) {
                if ($converson_user == "all") {
                    $tab_id = CrmLeadsStatus::getTabIdByLeadsId($value['leads_id']);
                    if (isset($tab_id) && $tab_id == '8') {
                        $won++;
                    }
                    if (isset($tab_id) && $tab_id == '9') {
                        $lost++;
                    }
                } else {
                    if ($value['deal_owner_id'] == $converson_user) {
                        $tab_id = CrmLeadsStatus::getTabIdByLeadsId($value['leads_id']);
                        if (isset($tab_id) && $tab_id == '8') {
                            $won++;
                        }
                        if (isset($tab_id) && $tab_id == '9') {
                            $lost++;
                        }
                    }
                }

            }

        }

        if (($won + $lost) == 0) {
            $data['converson_rate'] = 0;
        } else {
            $data['converson_rate'] = $won * 100 / ($won + $lost);
        }

        //echo "Total : ".($won + $lost);die;
        /////////////Converson Rate////////////
        //print_r($data);die;
        echo view::make("crm/ajax/report", $data);
    }

    public function getAgeCount($from)
    {
        $days = 0;
        if ($from != "") {
            $date1 = $from;
            $date2 = date("Y-m-d");
            //echo $date2;die;

            $diff = strtotime($date2) - strtotime($date1);
            $days = round($diff / 86400);
        }

        return $days;
    }

    public function getDealAge($date1, $date2)
    {
        $days = 0;
        $diff = strtotime($date2) - strtotime($date1);
        $days = round($diff / 86400);

        return $days;
    }


    public function inboxmail()
    {

        return view::make("crm/inboxmail");
    }


    public function save_close_date()
    {
        $leads_id      = Input::get("leads_id");
        $close_date    = Input::get("close_date");

        $up_data['close_date'] = date('Y-m-d', strtotime($close_date));
        CrmLead::where('leads_id', '=', $leads_id)->update($up_data);
    }

    public function getTabNo($page_open)
    {
        $tab_no = 1;
        if($page_open == 51 || $page_open == 511 || $page_open == 512 || $page_open == 513){
            $tab_no = 5;
        }
        if($page_open == 611 || $page_open == 612 || $page_open == 613 || $page_open == 614 || $page_open == 615 || $page_open == 616 || $page_open == 617 || $page_open == 62 || $page_open == 63 || $page_open == 64 || $page_open == 65){
            $tab_no = 6;
        }

        return $tab_no;
    }

    public function sendto_client_list()
    {
        $leads_id       = Input::get("leads_id");
        $client_type    = Input::get("client_type");
        $leads_details  = CrmLead::getLeadsByLeadsId( $leads_id );
        $session        = Session::get('admin_details');
        $user_id        = $session['id'];
        $client_id = 0;

        if(isset($leads_details) && count($leads_details) >0){
            if(isset($leads_details['client_type']) && $leads_details['client_type'] == 'org'){
                $company_name = $leads_details['prospect_name'];
                if(isset($leads_details['business_type']) && ($leads_details['business_type'] == 1 || $leads_details['business_type'] == 2)){
                    //$company_name  = "BOOTH & BOOTH LTD";//echo $value;die;
                    $number = CrmLead::getCompanyNumber($company_name);
                    $client_id = 0;
                    if(isset($number) && $number != 0){
                        $value = $number.'=function';
                        $client_id  = App::make('ChdataController')->import_company_details($value);
                    }
                }else{
                    $client_id = Client::insertGetId(array("user_id"=>$user_id, 'type'=>'org', 'chd_type'=>'org'));
                    StepsFieldsClient::update_org_client($leads_details, $client_id);
                }

                if($client_id != 0){
                    CrmLead::where('leads_id', '=', $leads_id)->update(array('is_onboarding'=>'Y'));
                    Client::where('client_id', '=', $client_id)->update(array('is_onboard' => 'Y'));
                    StepsFieldsClient::update_step_field_client($leads_details, $client_id);
                }else{
                        $client_id  = 'spell_check';
                    }
                
            }else{
                $client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'ind', 'chd_type' => 'ind', 'is_onboard' => 'Y'));
                CrmLead::where('leads_id', '=', $leads_id)->update(array('is_onboarding'=>'Y'));
                StepsFieldsClient::update_ind_client($leads_details, $client_id);
            }
            Client::where('client_id', '=', $client_id)->update(array('crm_leads_id' => $leads_id));
        }
        

        echo $client_id;die;
    }


}
