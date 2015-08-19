<?php
//opcache_reset ();
//Cache::forget('user_list');
//use DB;
class HmrcController extends BaseController
{
    public function hmrc(){
        
        $data['heading'] = "HMRC";
        $data['title'] = "HMRC";
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
        
            $data['previous_page'] = '<a href="/hmrc">HMRC</a>';
       
            
       
        
        
        $session = Session::get('admin_details');
        $user_id = $session['id'];
        $data['user_type'] = $session['user_type'];
        $groupUserId = $session['group_users'];

        //$data['allClients'] 	 	= App::make("HomeController")->get_all_clients();

        $client_details = Client::getAllClientDetails();

        //echo '<pre>';print_r($client_details);die();
        if(isset($client_details) && count($client_details) >0)
		{
			foreach ($client_details as $key => $client_row) {
				$client_data[$key]['client_id'] 		= $client_row['client_id'];
				if(isset($client_row['client_type']) && $client_row['client_type'] == "org"){
					$client_data[$key]['client_name'] 	= $client_row['business_name'];
					$client_data[$key]['contact_type'] 	= "Business";
					$client_data[$key]['client_url'] 	= "/client/edit-org-client/".$client_row['client_id']."/".base64_encode('org_client');
					$client_data[$key]['email'] 		= isset($client_row['corres_cont_email'])?$client_row['corres_cont_email']:"";
					$client_data[$key]['telephone'] 	= isset($client_row['corres_cont_telephone'])?$client_row['corres_cont_telephone']:"";
					$client_data[$key]['mobile'] 		= isset($client_row['corres_cont_mobile'])?$client_row['corres_cont_mobile']:"";
					$client_data[$key]['corres_address']= isset($client_row['corres_address'])?$client_row['corres_address']:"";
					$client_data[$key]['contact_name'] 	= $this->getContactNameDropdown($client_row);
					$client_data[$key]['notes']			= ContactsNote::getNotes($client_row['client_id'], 'Business');
				}else if(isset($client_row['client_type']) && $client_row['client_type'] == "ind"){
					$client_data[$key]['client_name'] 	= $client_row['client_name'];
					$client_data[$key]['contact_type'] 	= "Individual";
					$client_data[$key]['client_url'] 	= "/client/edit-ind-client/".$client_row['client_id']."/".base64_encode('ind_client');
					$client_data[$key]['email'] 		= isset($client_row['serv_email'])?$client_row['serv_email']:"";
					$client_data[$key]['telephone'] 	= isset($client_row['serv_telephone'])?$client_row['serv_telephone']:"";
					$client_data[$key]['mobile'] 		= isset($client_row['serv_mobile'])?$client_row['serv_mobile']:"";
					$client_data[$key]['corres_address']= isset($client_row['address'])?$client_row['address']:"";
					$client_data[$key]['notes']			= ContactsNote::getNotes($client_row['client_id'], 'Individual');
				}
				
			}
		}
        $data['client_details'] = $client_data;
        


         return View::make('hmrc.authorisations', $data);
    }
    
    public function getContactNameDropdown($details)
	{
		$data = array();
		if(isset($details) && count($details) >0)
		{
			$i = 0;
			if(isset($details['trad_cont_name']) && $details['trad_cont_name'] != ""){
				$data[$i]['name'] = $details['trad_cont_name'];
				$i++;
			}
			if(isset($details['reg_cont_name']) && $details['reg_cont_name']!= ""){
				$data[$i]['name'] = $details['reg_cont_name'];
				$i++;
			}
			if(isset($details['corres_cont_name']) && $details['corres_cont_name']!= ""){
				$data[$i]['name'] = $details['corres_cont_name'];
				$i++;
			}
			if(isset($details['banker_cont_name']) && $details['banker_cont_name']!= ""){
				$data[$i]['name'] = $details['banker_cont_name'];
				$i++;
			}
			if(isset($details['oldacc_cont_name']) && $details['oldacc_cont_name']!= ""){
				$data[$i]['name'] = $details['oldacc_cont_name'];
				$i++;
			}
			if(isset($details['auditors_cont_name']) && $details['auditors_cont_name']!= ""){
				$data[$i]['name'] = $details['auditors_cont_name'];
				$i++;
			}
			if(isset($details['solicitors_cont_name']) && $details['solicitors_cont_name']!= ""){
				$data[$i]['name'] = $details['solicitors_cont_name'];
				$i++;
			}

			$rel_data = Common::get_relationship_client($details['client_id']);
			if(isset($rel_data) && count($rel_data) >0 ){
				foreach ($rel_data as $key => $value) {
					$data[$i]['name'] = $value['name'];
					$i++;
				}
			}
		}

		return $data;
	}

    
    
    public function emails(){
        $data['heading'] = "STRUCTURED EMAILS";
        $data['title'] = "Structured Emails";
        $data['previous_page'] = '<a href="/hmrc">HMRC</a>';
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
