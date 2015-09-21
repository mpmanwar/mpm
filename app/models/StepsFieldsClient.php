<?php
class StepsFieldsClient  extends Eloquent{
	
	public $timestamps = false;
	public static function update_step_field_client($details, $client_id)
    {
    	$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];

    	$name = "";
    	$step_id = 3;
    	if (isset($details['contact_title'])) {
			$name .= $details['contact_title'];
		}
		if (isset($details['contact_fname'])) {
			$name .= " ".$details['contact_fname'];
		}
		if (isset($details['contact_lname'])) {
			$name .= " ".$details['contact_lname'];
		}
		$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'corres_cont_name', $name);
		$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'cont_corres_addr', 'corres');
		$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'corres_name_check', 'corres_cont');

		if (isset($details['phone'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'corres_cont_telephone', $details['phone']);
		}
		if (isset($details['mobile'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'corres_cont_mobile', $details['mobile']);
		}
		if (isset($details['email'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'corres_cont_email', $details['email']);
		}
		if (isset($details['website'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'corres_cont_website', $details['website']);
		}

		if (isset($details['city'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'corres_cont_city', $details['city']);
		}
		if (isset($details['county'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'corres_cont_county', $details['county']);
		}
		if (isset($details['postal_code'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'corres_cont_postcode', $details['postal_code']);
		}
		if (isset($details['country_id'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'corres_cont_country', $details['country_id']);
		}
		$inserted = StepsFieldsClient::insert($arrData);
		return $inserted;
    }

    public static function update_ind_client($details, $client_id)
    {
    	$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];

    	$name = "";
    	$step_id = 3;
    	if (isset($details['prospect_title'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'title', $details['prospect_title']);
		}
		if (isset($details['prospect_fname'])) {
			$name .= " ".$details['prospect_fname'];
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'fname', $details['prospect_fname']);
		}
		if (isset($details['prospect_lname'])) {
			$name .= " ".$details['prospect_lname'];
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'lname', $details['prospect_lname']);
		}
		$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'client_name', $name);

		if (isset($details['phone'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'res_telephone', $details['phone']);
		}
		if (isset($details['mobile'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'res_mobile', $details['mobile']);
		}
		if (isset($details['email'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'res_email', $details['email']);
		}
		if (isset($details['website'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'res_website', $details['website']);
		}

		if (isset($details['city'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'res_city', $details['city']);
		}
		if (isset($details['county'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'res_county', $details['county']);
		}
		if (isset($details['postal_code'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'res_postcode', $details['postal_code']);
		}
		if (isset($details['country_id'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, $step_id, 'res_country', $details['country_id']);
		}
		$inserted = StepsFieldsClient::insert($arrData);
		return $inserted;
	}

	public static function update_org_client($details, $client_id)
    {
    	$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];

    	$name = "";
    	$step_id = 1;
    	$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'cont_corres_addr', 'corres');
    	$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'corres_name_check', 'corres_cont');
    	if (isset($details['business_type'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'business_type', $details['business_type']);
		}
		if (isset($details['prospect_name'])) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'business_name', $details['prospect_name']);
		}
		$inserted = StepsFieldsClient::insert($arrData);
		return $inserted;
	}
	

}
