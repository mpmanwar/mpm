<?php
class Client extends Eloquent {

	public $timestamps = false;

	public static function getAllOrgClientDetails()
	{
		$client_data = array();
		$session 			= Session::get('admin_details');
		$user_id 			= $session['id'];
		$groupUserId 		= Common::getUserIdByGroupId($session['group_id']);

		$client_ids = Client::where("is_deleted", "=", "N")->where("type", "=", "org")->where("is_archive", "=", "N")->where("is_relation_add", "=", "N")->whereIn("user_id", $groupUserId)->select("client_id", "show_archive", "ch_manage_task")->orderBy("client_id", "DESC")->get();
		//echo $this->last_query();die;
		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
			foreach ($client_ids as $client_id) {
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				$client_data[$i]['client_id'] = $client_id->client_id;
				$client_data[$i]['ch_manage_task'] 	= $client_id->ch_manage_task;


				// ############### GET VAT SCHEME USER START ################## //
				$service = Common::get_services_client($client_id->client_id);
				if(isset($service) && count($service) > 0){
					foreach ($service as $key => $value) {
						if(isset($value['service_name']) && $value['service_name'] == "VAT"){
							$client_data[$i]['vat_staff_name'] 	= $value['name'];
						}
					}
				}
				//print_r($service);
				// ############### GET VAT SCHEME USER END ################## //

				if (isset($client_details) && count($client_details) > 0) {
					$corres_address = "";
					foreach ($client_details as $client_row) {

						if (isset($client_row['field_name']) && $client_row['field_name'] == "next_acc_due"){
							$client_data[$i]['deadacc_count'] = App::make('HomeController')->getDayCount($client_row->field_value);
						}
						if (isset($client_row['field_name']) && $client_row['field_name'] == "next_ret_due"){
							$client_data[$i]['deadret_count'] = App::make('HomeController')->getDayCount($client_row->field_value);
						}

						if (isset($client_row['field_name']) && $client_row['field_name'] == "business_type") 
						{
							$business_type = OrganisationType::where('organisation_id', '=', $client_row->field_value)->first();
							$client_data[$i][$client_row['field_name']] = $business_type['name'];
						} else {
							$client_data[$i][$client_row['field_name']] = $client_row->field_value;
						}

						if (isset($client_row['field_name']) && $client_row['field_name'] == "vat_scheme_type") 
						{
							$VatScheme = VatScheme::where('vat_scheme_id', '=', $client_row->field_value)->first();
							$client_data[$i]['vat_scheme_name'] = $VatScheme['vat_scheme_name'];
						}

						// ############### GET CORRESPONDENSE ADDRESS START ################## //
						if (isset($client_row->field_name) && $client_row->field_name == "corres_cont_addr_line1"){
							$corres_address .= $client_row->field_value.", ";
						}
						if (isset($client_row->field_name) && $client_row->field_name == "corres_cont_addr_line2"){
							$corres_address .= $client_row->field_value.", ";
						}
						if (isset($client_row->field_name) && $client_row->field_name == "corres_cont_county"){
							$corres_address .= $client_row->field_value.", ";
						}
						// ############### GET CORRESPONDENSE ADDRESS END ################## //
					}
					$client_data[$i]['corres_address'] = substr($corres_address, 0 ,-2);

					$i++;
				}

				//echo $this->last_query();die;
			}
		}
		return $client_data;
	}

}
