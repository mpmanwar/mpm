<?php
class CrmLead extends Eloquent {

	public $timestamps = false;
	
	public static function getAllDetails()
    {
    	$data = array();
    	$session        = Session::get('admin_details');
        $user_id        = $session['id'];
        $groupUserId    = $session['group_users'];
		$crm_data = CrmLead::whereIn("user_id", $groupUserId)->where("is_deleted", "=", "N")->where("is_archive", "=", "N")->get();
		if(isset($crm_data) && count($crm_data) >0){
			foreach ($crm_data as $key => $details) {
				$data[$key]['leads_id']       = $details->leads_id;
				$data[$key]['user_id']        = $details->user_id;
				$data[$key]['client_type']    = $details->client_type;
				$data[$key]['date']    		  = $details->date;
				$data[$key]['deal_certainty'] = $details->deal_certainty;
				$data[$key]['existing_client']= $details->existing_client;
		        $data[$key]['deal_owner']     = User::getStaffNameById($details->deal_owner);
		        $data[$key]['phone']          = $details->phone;
		        $data[$key]['mobile']         = $details->mobile;
		        $data[$key]['email']          = $details->email;
		        $data[$key]['website']        = $details->website;
				$data[$key]['prospect_title'] = $details->prospect_title;
            	$data[$key]['prospect_fname'] = $details->prospect_fname;
            	$data[$key]['prospect_lname'] = $details->prospect_lname;
            	$data[$key]['business_type']  = $details->business_type;
	            $data[$key]['prospect_name']  = $details->prospect_name;
	            $data[$key]['contact_title']  = $details->contact_title;
	            $data[$key]['contact_fname']  = $details->contact_fname;
	            $data[$key]['contact_lname']  = $details->contact_lname;
				$data[$key]['annual_revenue'] = $details->annual_revenue;
		        $data[$key]['quoted_value']   = $details->quoted_value;
		        $data[$key]['lead_source']    = $details->lead_source;
		        $data[$key]['industry']       = $details->industry;
		        $data[$key]['street']         = $details->street;
		        $data[$key]['city']           = $details->city;
		        $data[$key]['county']         = $details->county;
		        $data[$key]['postal_code']    = $details->postal_code;
		        $data[$key]['country_id']     = $details->country_id;
		        $data[$key]['notes']          = $details->notes;
		        $data[$key]['is_invoiced']    = $details->is_invoiced;
		        $data[$key]['is_archive']     = $details->is_archive;
		        $data[$key]['show_archive']   = $details->show_archive;
		        $data[$key]['lead_status']    = CrmLeadsStatus::getTabIdByLeadsId( $details->leads_id );
			}
		}
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
    }

    public static function getInvoiceLeadsDetails()
    {
    	$data = array();
    	$session        = Session::get('admin_details');
        $user_id        = $session['id'];
        $groupUserId    = $session['group_users'];
		$crm_data = CrmLead::whereIn("user_id", $groupUserId)->where("is_invoiced", "=", "Y")->where("is_archive", "=", "N")->get();
		if(isset($crm_data) && count($crm_data) >0){
			foreach ($crm_data as $key => $details) {
				$data[$key]['leads_id']       = $details->leads_id;
				$data[$key]['user_id']        = $details->user_id;
				$data[$key]['client_type']    = $details->client_type;
				$data[$key]['date']    		  = $details->date;
				$data[$key]['deal_certainty'] = $details->deal_certainty;
				$data[$key]['existing_client']= $details->existing_client;
		        $data[$key]['deal_owner']     = User::getStaffNameById($details->deal_owner);
		        $data[$key]['phone']          = $details->phone;
		        $data[$key]['mobile']         = $details->mobile;
		        $data[$key]['email']          = $details->email;
		        $data[$key]['website']        = $details->website;
				$data[$key]['prospect_title'] = $details->prospect_title;
            	$data[$key]['prospect_fname'] = $details->prospect_fname;
            	$data[$key]['prospect_lname'] = $details->prospect_lname;
            	$data[$key]['business_type']  = $details->business_type;
	            $data[$key]['prospect_name']  = $details->prospect_name;
	            $data[$key]['contact_title']  = $details->contact_title;
	            $data[$key]['contact_fname']  = $details->contact_fname;
	            $data[$key]['contact_lname']  = $details->contact_lname;
				$data[$key]['annual_revenue'] = $details->annual_revenue;
		        $data[$key]['quoted_value']   = $details->quoted_value;
		        $data[$key]['lead_source']    = $details->lead_source;
		        $data[$key]['industry']       = $details->industry;
		        $data[$key]['street']         = $details->street;
		        $data[$key]['city']           = $details->city;
		        $data[$key]['county']         = $details->county;
		        $data[$key]['postal_code']    = $details->postal_code;
		        $data[$key]['country_id']     = $details->country_id;
		        $data[$key]['notes']          = $details->notes;
		        $data[$key]['is_invoiced']    = $details->is_invoiced;
		        $data[$key]['is_archive']     = $details->is_archive;
		        $data[$key]['show_archive']   = $details->show_archive;
		        $data[$key]['lead_status']    = CrmLeadsStatus::getTabIdByLeadsId( $details->leads_id );
			}
		}
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
    }

    public static function getDataWithDateRange($from_date, $to_date)
    {
    	$data = array();
    	$session        = Session::get('admin_details');
        $user_id        = $session['id'];
        $groupUserId    = $session['group_users'];
		$crm_data = CrmLead::whereIn("user_id", $groupUserId)->whereBetween('date', array($from_date, $to_date))->where("is_deleted", "=", "N")->where("is_archive", "=", "N")->get();
		if(isset($crm_data) && count($crm_data) >0){
			foreach ($crm_data as $key => $details) {
				$data[$key]['leads_id']       = $details->leads_id;
				$data[$key]['user_id']        = $details->user_id;
				$data[$key]['client_type']    = $details->client_type;
				$data[$key]['date']    		  = $details->date;
				$data[$key]['deal_certainty'] = $details->deal_certainty;
				$data[$key]['existing_client']	  = $details->existing_client;
		        $data[$key]['deal_owner']     = User::getStaffNameById($details->deal_owner);
		        $data[$key]['phone']          = $details->phone;
		        $data[$key]['mobile']         = $details->mobile;
		        $data[$key]['email']          = $details->email;
		        $data[$key]['website']        = $details->website;
				$data[$key]['prospect_title'] = $details->prospect_title;
            	$data[$key]['prospect_fname'] = $details->prospect_fname;
            	$data[$key]['prospect_lname'] = $details->prospect_lname;
            	$data[$key]['business_type']  = $details->business_type;
	            $data[$key]['prospect_name']  = $details->prospect_name;
	            $data[$key]['contact_title']  = $details->contact_title;
	            $data[$key]['contact_fname']  = $details->contact_fname;
	            $data[$key]['contact_lname']  = $details->contact_lname;
				$data[$key]['annual_revenue'] = $details->annual_revenue;
		        $data[$key]['quoted_value']   = $details->quoted_value;
		        $data[$key]['lead_source']    = $details->lead_source;
		        $data[$key]['industry']       = $details->industry;
		        $data[$key]['street']         = $details->street;
		        $data[$key]['city']           = $details->city;
		        $data[$key]['county']         = $details->county;
		        $data[$key]['postal_code']    = $details->postal_code;
		        $data[$key]['country_id']     = $details->country_id;
		        $data[$key]['notes']          = $details->notes;
		        $data[$key]['is_invoiced']    = $details->is_invoiced;
		        $data[$key]['is_archive']     = $details->is_archive;
		        $data[$key]['show_archive']   = $details->show_archive;
		        $data[$key]['lead_status']    = CrmLeadsStatus::getTabIdByLeadsId( $details->leads_id );
			}
		}
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
    }

    public static function getLeadsByLeadsId( $leads_id )
    {
    	$data = array();
    	$session        = Session::get('admin_details');
        $user_id        = $session['id'];
        $groupUserId    = $session['group_users'];
		$details = CrmLead::where("leads_id", "=", $leads_id)->where("is_deleted", "=", "N")->where("is_archive", "=", "N")->first();
		if(isset($details) && count($details) >0){
			$data['leads_id']       = $details->leads_id;
			$data['user_id']        = $details->user_id;
			$data['existing_client']= $details->existing_client;
			$data['client_type']    = $details->client_type;
			$data['date'] 			= $details->date;
			$data['deal_certainty'] = $details->deal_certainty;
			$data['deal_owner']     = $details->deal_owner;
	        $data['phone']          = $details->phone;
	        $data['mobile']         = $details->mobile;
	        $data['email']          = $details->email;
	        $data['website']        = $details->website;
			$data['prospect_title'] = $details->prospect_title;
        	$data['prospect_fname'] = $details->prospect_fname;
        	$data['prospect_lname'] = $details->prospect_lname;
        	$data['business_type']  = $details->business_type;
            $data['prospect_name']  = $details->prospect_name;
            $data['contact_title']  = $details->contact_title;
            $data['contact_fname']  = $details->contact_fname;
            $data['contact_lname']  = $details->contact_lname;
			$data['annual_revenue'] = $details->annual_revenue;
	        $data['quoted_value']   = $details->quoted_value;
	        $data['lead_source']    = $details->lead_source;
	        $data['industry']       = $details->industry;
	        $data['street']         = $details->street;
	        $data['city']           = $details->city;
	        $data['county']         = $details->county;
	        $data['postal_code']    = $details->postal_code;
	        $data['country_id']     = $details->country_id;
	        $data['notes']          = $details->notes;
	        $data['is_invoiced']    = $details->is_invoiced;
	        $data['is_archive']     = $details->is_archive;
		    $data['show_archive']   = $details->show_archive;
		}
		//echo "<pre>";print_r($data);echo "</pre>";die;
		return $data;
    }

    public static function getLeadsCount()
    {
    	$session        = Session::get('admin_details');
        $user_id        = $session['id'];
        $groupUserId    = $session['group_users'];
		$crm_count = CrmLead::whereIn("user_id", $groupUserId)->where("is_deleted", "=", "N")->where("is_archive", "=", "N")->get()->count();
		return $crm_count;
    }

    public static function getTotalQuotedValue( $leads_tab_id )
    {
    	$data = array();
    	$session        = Session::get('admin_details');
        $user_id        = $session['id'];
        $groupUserId    = $session['group_users'];
		$status_details = CrmLeadsStatus::leadsStatusByTabId($leads_tab_id);

		if(isset($status_details) && count($status_details) >0){
			$total    = 0;
	        $average  = 0;
	        $likely   = 0;
			foreach ($status_details as $key => $value) {
				$crn_lead = CrmLead::where("leads_id", "=", $value['leads_id'])->where("is_deleted", "=", "N")->where("is_archive", "=", "N")->first();
				if(isset($crn_lead->quoted_value) && $crn_lead->quoted_value != ""){
					$quoted_value = str_replace(",", "", $crn_lead->quoted_value);
					$total += $quoted_value;
					$likely += ($crn_lead->deal_certainty*$quoted_value)/100;
				}
				$average = $total/count($status_details);
			}
			/*$data['total']     = number_format($total, 2, '.', '');
	        $data['average']   = number_format($average, 2, '.', '');
	        $data['likely']    = number_format($likely, 2, '.', '');*/
	        $data['total']     = number_format($total, 2);
	        $data['average']   = number_format($average, 2);
	        $data['likely']    = number_format($likely, 2);
			
		}

		return $data;
    }




}
