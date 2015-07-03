<?php
class ChdataController extends BaseController {
	
	/*public function index()
	{
		$data 			= array();
		$details_data 	= array();
		$data['heading'] 	= "CH DATA";
		$data['title'] 		= "Ch Data";
		
		$numbers = CompanyNumber::orderBy("cn_id", "DESC")->get();
		if(isset($numbers) && count($numbers) >0 ){
			foreach ($numbers as $key => $row) {
				$details = Common::getCompanyDetails($row->number);
				if(isset($details) && count($details) >0 ){
					$details_data[$key]['company_number'] 		= $details->primaryTopic->CompanyNumber;
					$details_data[$key]['company_name'] 		= $details->primaryTopic->CompanyName;
					$details_data[$key]['incorporation_date'] 	= $details->primaryTopic->IncorporationDate;
					$details_data[$key]['acc_ref_date'] 		= $details->primaryTopic->Accounts->AccountRefDay."/".$details->primaryTopic->Accounts->AccountRefMonth;
					$details_data[$key]['auth_code'] 			= "";
					$details_data[$key]['last_ret_made_date'] 	= $details->primaryTopic->Returns->LastMadeUpDate;
					$details_data[$key]['next_due_date'] 		= $details->primaryTopic->Returns->NextDueDate;
					$details_data[$key]['count_down'] 			= Common::getDayCount($details->primaryTopic->Returns->NextDueDate);

				}
			}
		}
		$data['company_details']	= $details_data;
		//print_r($details);die;
		return View::make('ch_data.chdata_list', $data);
		

	}*/

	public function index()
	{
		$data 			= array();
		$client_data 	= array();
		$data['heading'] 	= "CH DATA";
		$data['title'] 		= "Ch Data";
		
		$admin_s 			= Session::get('admin_details'); // session
		$user_id 			= $admin_s['id']; //session user id
		$groupUserId 		= Common::getUserIdByGroupId($admin_s['group_id']);

		if (empty($user_id)) {
			return Redirect::to('/');
		}
		
		$client_ids = Client::where("is_deleted", "=", "N")->where("type", "=", "org")->where("is_archive", "=", "N")->whereIn("user_id", $groupUserId)->select("client_id", "show_archive")->orderBy("client_id", "DESC")->get();
		//echo $this->last_query();die;

		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
			foreach ($client_ids as $client_id) {
				$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				$client_data[$i]['client_id'] = $client_id->client_id;
				
				if (isset($client_details) && count($client_details) > 0) {
					foreach ($client_details as $client_row) {
						if (isset($client_row['field_name']) && $client_row['field_name'] == "next_acc_due"){
							$client_data[$i]['deadacc_count'] = App::make('HomeController')->getDayCount($client_row->field_value);
						}
						if (isset($client_row['field_name']) && $client_row['field_name'] == "next_ret_due"){
							$client_data[$i]['count_down'] = App::make('HomeController')->getDayCount($client_row->field_value);
						}

						$client_data[$i][$client_row['field_name']] = $client_row->field_value;
					}
					$details_data[$i]['auth_code'] 			= "";
					$i++;
				}

				//echo $this->last_query();die;
			}
		}

		$data['company_details']	= $client_data;
		//print_r($data['company_details']);die;
		return View::make('ch_data.chdata_list', $data);
		

	}

	public function chdata_details($number)
	{
		$data = array();
		$data['heading'] 	= "COMPANY DETAILS";
		$data['title'] 		= "Company Details";
		$details 			= Common::getCompanyDetails($number);
		$registered_office 	= Common::getRegisteredOffice($number);
		$officers 			= Common::getOfficerDetails($number);
		$filling_history 	= Common::getFillingHistory($number);
		//$insolvency 		= Common::getInsolvency($number);

		$data['details']			= $details->primaryTopic;
		$data['officers']			= $officers->items;
		$data['filling_history']	= $filling_history->items;
		$data['registered_office']	= $registered_office;

		$data['nature_of_business']	= $this->getSicDescription($details->primaryTopic->SICCodes->SicText);
		$data['client_data']		= $this->getRegisteredIn($details->primaryTopic->CompanyNumber);
		$data['insolvency']			= Common::getInsolvency($number);
		$data['charges']			= Common::getCharges($number);

		//print_r($data['officers']);die;
		return View::make("ch_data.chdata_details", $data);
	}

	private function getSicDescription($sic_codes)
	{
		$text = "";
		if(isset($sic_codes) && count($sic_codes) >0 ){
			$text = implode(",", $sic_codes);
		}
		return $text;
	}

	private function getRegisteredIn($company_no)
	{
		$array = array();
		$details = StepsFieldsClient::where("field_value", "=", $company_no)->where("step_id", "=", 1)->where("field_name", "=", "registration_number")->first();
		//print_r($details);echo $this->last_query();die;
		if( isset($details) && count($details) >0 ){
			$all_details = StepsFieldsClient::where("client_id", "=", $details['client_id'])->where("step_id", "=", 1)->get();
			foreach ($all_details as $key => $value) {
				if(isset($value->field_name) && $value->field_name == "registered_in"){
					$reg_in = RegisteredAddress::where("reg_id", "=", $value->field_value)->first();
					$array['registered_in'] = $reg_in['reg_name'];
				}
				if(isset($value->field_name) && $value->field_name == "ch_auth_code"){
					$array['ch_auth_code'] = $value->field_value;
				}
			}

		}
		//print_r($array);die;
		//echo $this->last_query();die;
		return $array;
	}

	public function officers_details()
	{
		$number = Input::get("number");
		$key 	= Input::get("key");
		$data 		= array();
		$off_data 	= array();

		$officers 	= Common::getOfficerDetails($number);
		
		$off_data['date_of_birth'] 			= isset($officers->items[$key]->date_of_birth)?$officers->items[$key]->date_of_birth:"";
		$off_data['nationality'] 			= isset($officers->items[$key]->nationality)?$officers->items[$key]->nationality:"";
		$off_data['officer_role'] 			= isset($officers->items[$key]->officer_role)?$officers->items[$key]->officer_role:"";
		$off_data['name'] 					= isset($officers->items[$key]->name)?$officers->items[$key]->name:"";
		$off_data['occupation'] 			= isset($officers->items[$key]->occupation)?$officers->items[$key]->occupation:"";
		$off_data['appointed_on'] 			= isset($officers->items[$key]->appointed_on)?$officers->items[$key]->appointed_on:"";
		$off_data['resigned_on'] 			= isset($officers->items[$key]->resigned_on)?$officers->items[$key]->resigned_on:"";
		$off_data['country_of_residence'] 	= isset($officers->items[$key]->country_of_residence)?$officers->items[$key]->country_of_residence:"";
		$off_data['address'] 				= isset($officers->items[$key]->address)?$officers->items[$key]->address:"";
		$off_data['links'] 					= isset($officers->items[$key]->links)?$officers->items[$key]->links:"";

		$data['officers'] = $off_data;

		echo View::make("ch_data.ajax_officer_details", $data);
		
	}

	public function import_from_ch($back_url)
	{
		$data['title'] = "Import from CH";
		$data['heading'] = "";
		$data['back_url'] = base64_decode($back_url);
		//echo $data['back_url'];die;
		return View::make("ch_data.import_from_ch", $data);
	}

	public function search_company()
	{
		$company = array();
		$value = str_replace(" ", "+", Input::get("value"));
		//$value = "Alexander+Rosse";
		$compamy_details	= Common::getSearchCompany($value);
		if(isset($compamy_details->items) && count($compamy_details->items) >0 )
		{//print_r($compamy_details->items);die;
			foreach ($compamy_details->items as $key => $value) {
				$company[$key]['company_name'] 		= $value->title;
				$company[$key]['company_number'] 	= $value->company_number;
			}
		}
		$data['company_details'] 	= $company;
		//print_r($data);die;

		echo View::make("ch_data.ajax_company_search_result", $data);
	}

	public function company_details()
	{
		$number 	= Input::get("number");
		$back_url 	= Input::get("back_url");
		$data 		= array();
		$data['officers']	= array();
		
		$details 			= Common::getCompanyDetails($number);
		$registered_office 	= Common::getRegisteredOffice($number);
		$officers 			= Common::getOfficerDetails($number);
		if(isset($officers->items) && count($officers->items) > 0){
			$data['officers']	= $officers->items;
		}
//print_r($data['officers']);die;
		$data['details']			= $details->primaryTopic;
		
		$data['registered_office']	= $registered_office;
		$data['nature_of_business']	= $this->getSicDescription($details->primaryTopic->SICCodes->SicText);

		if($back_url == "ind_list"){
			echo View::make("ch_data.ajax_ind_company_details", $data);
		}else{
			echo View::make("ch_data.ajax_company_details", $data);
		}
		
		
	}

	public function update_existing_client($client_id)
	{
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];

		$client_value = Client::where("client_id", "=", $client_id)->first();
		if(isset($client_value) && count($client_value) >0 ){
			$update['type'] = $client_value['chd_type'];
		}
		$update['is_deleted'] = "N";

		Client::where("client_id", "=", $client_id)->update($update);
		StepsFieldsClient::where("client_id", "=", $client_id)->delete();


		$appointment = ClientRelationship::where('appointment_with', '=', $client_id)->select("client_id", "relationship_type_id")->first();
		if(isset($appointment) && count($appointment) >0 ){
			/*$rel_data['appointment_with'] 		= $appointment['client_id'];
			$rel_data['relationship_type_id'] 	= $appointment['relationship_type_id'];
			$rel_data['client_id'] 				= $client_id;
			ClientRelationship::insert($rel_data);*/


			$act_data['user_id'] 			= $user_id;
			$act_data['client_id'] 			= $client_id;
			$act_data['acting_client_id'] 	= $appointment['client_id'];
			ClientActing::insert($act_data);
		}

	}

	public function import_company_details($number)
	{
		//$number = Input::get("number");
		//$number = "05244480";
		$data = array();
		//$details 			= Common::getCompanyDetails($number);
		$details 			= Common::getCompanyData($number);
		//print_r($details);die;
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];

		//################# If company number exists Start ##################//
		$client_data = StepsFieldsClient::where("field_name", "=", "registration_number")->where("field_value", "=", $details->company_number)->first();
		//echo $this->last_query();die;
		if(isset($client_data) && count($client_data) >0 ){
			$client_id = $client_data['client_id'];
			$this->update_existing_client($client_id);
			
		}else{
			$client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'org'));
		}
		//################# If company number exists End ##################//
		
		

		$ret_check = 0;
		$acc_check = 0;
		if (isset($details->company_name)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'business_name', $details->company_name);
		}
		if (isset($details->company_number)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'registration_number', $details->company_number);
		}
		if (isset($details->date_of_creation)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'incorporation_date', $details->date_of_creation);
		}
		if (isset($details->type)) {
			if($details->type == "ltd" || $details->type == "limited"){
				$type = 2;
			}else if($details->type == "llp"){
				$type = 1;
			}else{
				$type = "";
			}
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'business_type', $type);
		}
		if (isset($details->jurisdiction)) {
			//$reg_in = RegisteredAddress::where("reg_name", "=", ucwords(str_replace("-", " ", $details->jurisdiction)))->select("reg_id")->first();
			$reg_in = RegisteredAddress::where("reg_name", "=", ucwords($details->jurisdiction))->select("reg_id")->first();
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'registered_in', $reg_in['reg_id']);
		}
		if (isset($details->sic_codes) && count($details->sic_codes) >0 ) {
			$codes_data = "";
			foreach ($details->sic_codes as $key => $value) {
				$sic_codes = SicCodesDescription::where("sic_codes", "=", $value)->first();
				$codes_data .= $sic_codes['description'].", ";
			}
			$codes_data = substr($codes_data, 0, -2);
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'business_desc', $codes_data);
		}
		if (isset($details->annual_return->next_due)) {
			$ret_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'next_ret_due', str_replace("/", "-", $details->annual_return->next_due));
		}
		if (isset($details->annual_return->last_made_up_to)) {
			$ret_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'made_up_date', $details->annual_return->last_made_up_to);
		}
		if (isset($details->accounts->last_accounts->made_up_to)) {
			$acc_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'last_acc_madeup_date', $details->accounts->last_accounts->made_up_to);
		}
		if (isset($details->accounts->next_due)) {
			$acc_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'next_acc_due', $details->accounts->next_due);
		}
		if (isset($details->accounts->accounting_reference_date->day)) {
			$acc_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'acc_ref_day', $details->accounts->accounting_reference_date->day);
		}
		if (isset($details->accounts->accounting_reference_date->month)) {
			$acc_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'acc_ref_month', $details->accounts->accounting_reference_date->month);
		}
		if($ret_check == 1){
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'ann_ret_check', 1);
		}
		if($acc_check == 1){
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'yearend_acc_check', 1);
		}

		//$registered_office 				= Common::getRegisteredOffice($number);
		$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3,'cont_reg_addr', 'reg');
		if (isset($details->registered_office_address->address_line_1)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_addr_line1', $details->registered_office_address->address_line_1);
		}
		if (isset($details->registered_office_address->address_line_2)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_addr_line2', $details->registered_office_address->address_line_2);
		}
		if (isset($details->registered_office_address->locality)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_city', $details->registered_office_address->locality);
		}
		if (isset($details->registered_office_address->postal_code)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_postcode', $details->registered_office_address->postal_code);
		}
		if (isset($details->registered_office_address->country)) {
			$country = Country::where("country_name", "=", $details->registered_office_address->country)->select("country_id")->first();
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_country', $country['country_id']);
		}
		//print_r($arrData);die;
		$inserted = StepsFieldsClient::insert($arrData);

		$officers 	= Common::getOfficerDetails($number);//print_r($officers);die;
		if(isset($officers->items) && count($officers->items) > 0){
			foreach ($officers->items as $key => $row) {
				if(!isset($row->resigned_on)){

					$app_client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'chd'));
					if (isset($row->officer_role) && $row->officer_role != "") {
						$relationship_type = RelationshipType::where("relation_type", "=", ucwords($row->officer_role))->first();
						$rel_type = $relationship_type['relation_type_id'];
					}

					$relData['client_id'] 			 = $client_id;
					$relData['appointment_with'] 	 = $app_client_id;
					$relData['relationship_type_id'] = isset($rel_type)?$rel_type:"0";
					$relation_id = ClientRelationship::insertGetId($relData);

					/*$actData['user_id'] = $user_id;
					$actData['client_id'] = $client_id;
					$actData['acting_client_id'] = isset($app_client_id)?$app_client_id:"0";
					ClientActing::insert($actData);*/

					$getReturn = $this->insertClientDetails($relation_id, $client_id, $row, $app_client_id);
					//$this->insertClientDetails($row);
				}
				
			}
			
		}

		if($inserted){
			echo $client_id;
						
		}else{
			echo 0;
		}
		exit;
	}

	public function insertClientDetails($relation_id, $client_id, $row, $app_client_id)
	{
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];

		if(strpos($row->officer_role, 'corporate') !== false){
			$name = str_replace(" ", "+", $row->name);
			$details = Common::getSearchCompany($name);
			//echo $details->items[0]->company_number;die;

			//////////////Check the officer is exists or not/////////////
			$exists_client = StepsfieldsClient::where("field_name", "=", "business_name")->where("field_value", "=", $row->name)->first();
			//////////////Check the officer is exists or not////////////

				Client::where("client_id", "=", $app_client_id)->update(array('chd_type' => 'org'));

				if (isset($details->items[0]->company_number)) {
					$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'registration_number', $details->items[0]->company_number);
				}
				if (isset($row->name) && $row->name != "") {
					$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'business_name', $row->name);
				}
				if (isset($row->address->address_line_1) && $row->address->address_line_1 != "") {
					$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'reg_cont_addr_line1', $row->address->address_line_1);
				}
				if (isset($row->address->address_line_2) && $row->address->address_line_2 != "") {
					$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'reg_cont_addr_line2', $row->address->address_line_2);
				}
				if (isset($row->address->postal_code) && $row->address->postal_code != "") {
					$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'reg_cont_postcode', $row->address->postal_code);
				}
				if (isset($row->address->locality) && $row->address->locality != "") {
					$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'reg_cont_city', $row->address->locality);
				}
				if (isset($row->address->country) && $row->address->country != "") {
					$country = Country::where("country_name", "=", ucwords($row->address->country))->first();
					if(isset($country) && count($country) >0){
						$country = $country['country_id'];
					}else{
						$country = 0;
					}
					$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'reg_cont_country', $country);
				}

				//StepsFieldsClient::insert($arrNewData);//echo $this->last_query();die;
			//}
			
		}else{

			Client::where("client_id", "=", $app_client_id)->update(array('chd_type' => 'ind'));

			$client_name = "";
			$mname ="";
			$full_name = explode(",", $row->name);
			$half_name = explode(" ", trim($full_name[1]));

			if (isset($half_name[0]) && $half_name[0] != "") {
				$client_name.=$half_name[0]." ";
				$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'fname', $half_name[0]);
			}
			if (isset($half_name[1]) && $half_name[1] != "") {
				$client_name.=$half_name[1]." ";
				$mname.=$half_name[1]." ";
			}
			if (isset($half_name[2]) && $half_name[2] != "") {
				$client_name.=$half_name[2]." ";
				$mname.=$half_name[2]." ";
			}
			if (isset($mname) && $mname != "") {
				$arrNewData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'mname', $mname);
			}

			if (isset($full_name[0]) && $full_name[0] != "") {
				$client_name.=$full_name[0];
				$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'lname', $full_name[0]);
			}
			$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'client_name', trim($client_name));

			/*############### Address ###############*/
			if (isset($row->address->address_line_1) && $row->address->address_line_1 != "") {
				$arrNewData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'serv_addr_line1', $row->address->address_line_1);
			}
			if (isset($row->address->address_line_2) && $row->address->address_line_2 != "") {
				$arrNewData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'serv_addr_line2', $row->address->address_line_2);
			}
			if (isset($row->address->postal_code) && $row->address->postal_code != "") {
				$arrNewData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'serv_postcode', $row->address->postal_code);
			}
			if (isset($row->address->locality) && $row->address->locality != "") {
				$arrNewData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'serv_city', $row->address->locality);
			}

			//////////////Check the officer is exists or not/////////////
			$exists_client = StepsfieldsClient::where("field_name", "=", "client_name")->where("field_value", "=", trim($client_name))->first();//echo $this->last_query();die;
			//////////////Check the officer is exists or not////////////

		}

		StepsFieldsClient::insert($arrNewData);

		/*if(isset($exists_client) && count($exists_client) > 0){
			$actData['user_id'] 			= $user_id;
			$actData['client_id'] 			= $client_id;
			$actData['acting_client_id'] 	= $exists_client['client_id'];
			ClientActing::insert($actData);
			/////////////////////////////////
			Client::where("client_id", "=", $app_client_id)->delete();
			////////////////////////////////
			ClientRelationship::where('client_relationship_id', "=", $relation_id)->update(array("appointment_with" => $exists_client['client_id']));//echo $this->last_query();die;
		}else{
		
			StepsFieldsClient::insert($arrNewData);
		}*/

		
	}

	public function insertClientDetails_1($row, $app_client_id)
	{
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];

		if(strpos($row->officer_role, 'corporate') !== false){
			$name = str_replace(" ", "+", $row->name);
			$details = Common::getSearchCompany($name);

			if(isset($details->items[0]->company_number) && $details->items[0]->company_number != ""){
				$company_number = $details->items[0]->company_number;
				$this->insert_corporate_company($company_number, $app_client_id);
				//$this->import_company_details($company_number);
				return 1;
			}
			
		}else{

			$client_name = "";
			$mname ="";
			$full_name = explode(",", $row->name);
			$half_name = explode(" ", trim($full_name[1]));
			if (isset($half_name[0]) && $half_name[0] != "") {
				$client_name.=$half_name[0]." ";
				$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'fname', $half_name[0]);
			}
			if (isset($half_name[1]) && $half_name[1] != "") {
				$client_name.=$half_name[1]." ";
				$mname.=$half_name[1]." ";
			}
			if (isset($half_name[2]) && $half_name[2] != "") {
				$client_name.=$half_name[2]." ";
				$mname.=$half_name[2]." ";
			}
			$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'mname', $mname);
			if (isset($full_name[0]) && $full_name[0] != "") {
				$client_name.=$full_name[0];
				$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'lname', $full_name[0]);
			}
			$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'client_name', trim($client_name));

			/*if (isset($row->date_of_birth) && $row->date_of_birth != "") {
				$arrNewData[] = App::make('HomeController')->save_client($user_id, $app_client_id, 1, 'dob', $row->date_of_birth);
			}*/
			//print_r($arrNewData);die;
			StepsFieldsClient::insert($arrNewData);//echo $this->last_query();die;

		}
		
	}

	public function insert_corporate_company($number, $client_id)
	{
		$data 	 = array();
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];

		$details = Common::getCompanyData($number);
		//print_r($details);die;
		
		//################# If company number exists Start ##################//
		/*$client_data = StepsFieldsClient::where("field_name", "=", "registration_number")->where("field_value", "=", $details->company_number)->first();
		//echo $this->last_query();die;
		if(isset($client_data) && count($client_data) >0 ){
			$client_id = $client_data['client_id'];
			StepsFieldsClient::where("client_id", "=", $client_id)->delete();
			ClientRelationship::where("client_id", "=", $client_id)->delete();
		}else{
			$client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'org'));
		}*/
		//################# If company number exists End ##################//
		
		

		$ret_check = 0;
		$acc_check = 0;
		if (isset($details->company_name)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'business_name', $details->company_name);
		}
		if (isset($details->company_number)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'registration_number', $details->company_number);
		}
		if (isset($details->date_of_creation)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'incorporation_date', $details->date_of_creation);
		}
		if (isset($details->type)) {
			if($details->type == "ltd" || $details->type == "limited"){
				$type = 2;
			}else if($details->type == "llp"){
				$type = 1;
			}else{
				$type = "";
			}
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'business_type', $type);
		}
		if (isset($details->jurisdiction)) {
			$reg_in = RegisteredAddress::where("reg_name", "=", ucwords(str_replace("-", " ", $details->jurisdiction)))->select("reg_id")->first();
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'registered_in', $reg_in['reg_id']);
		}
		if (isset($details->sic_codes) && count($details->sic_codes) >0 ) {
			$codes_data = "";
			foreach ($details->sic_codes as $key => $value) {
				$sic_codes = SicCodesDescription::where("sic_codes", "=", $value)->first();
				$codes_data .= $sic_codes['description'].", ";
			}
			$codes_data = substr($codes_data, 0, -2);
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'business_desc', $codes_data);
		}
		if (isset($details->annual_return->next_due)) {
			$ret_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'next_ret_due', str_replace("/", "-", $details->annual_return->next_due));
		}
		if (isset($details->annual_return->last_made_up_to)) {
			$ret_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'made_up_date', $details->annual_return->last_made_up_to);
		}
		if (isset($details->accounts->last_accounts->made_up_to)) {
			$acc_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'last_acc_madeup_date', $details->accounts->last_accounts->made_up_to);
		}
		if (isset($details->accounts->next_due)) {
			$acc_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'next_acc_due', $details->accounts->next_due);
		}
		if (isset($details->accounts->accounting_reference_date->day)) {
			$acc_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'acc_ref_day', $details->accounts->accounting_reference_date->day);
		}
		if (isset($details->accounts->accounting_reference_date->month)) {
			$acc_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'acc_ref_month', $details->accounts->accounting_reference_date->month);
		}
		if($ret_check == 1){
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'ann_ret_check', 1);
		}
		if($acc_check == 1){
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'yearend_acc_check', 1);
		}

		//$registered_office 				= Common::getRegisteredOffice($number);
		$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3,'cont_reg_addr', 'reg');
		if (isset($details->registered_office_address->address_line_1)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_addr_line1', $details->registered_office_address->address_line_1);
		}
		if (isset($details->registered_office_address->address_line_2)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_addr_line2', $details->registered_office_address->address_line_2);
		}
		if (isset($details->registered_office_address->locality)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_city', $details->registered_office_address->locality);
		}
		if (isset($details->registered_office_address->postal_code)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_postcode', $details->registered_office_address->postal_code);
		}
		if (isset($details->registered_office_address->country)) {
			$country = Country::where("country_name", "=", $details->registered_office_address->country)->select("country_id")->first();
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_country', $country['country_id']);
		}
		//print_r($arrData);die;
		$inserted = StepsFieldsClient::insert($arrData);

		$officers 	= Common::getOfficerDetails($number);//print_r($officers);die;
		if(isset($officers->items) && count($officers->items) > 0){
			foreach ($officers->items as $key => $row) {
				$app_client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'chd'));
				if (isset($row->officer_role) && $row->officer_role != "") {
					$relationship_type = RelationshipType::where("relation_type", "=", ucwords($row->officer_role))->first();
					$rel_type = $relationship_type['relation_type_id'];
				}

				$relData['client_id'] 			 = $client_id;
				$relData['appointment_with'] 	 = $app_client_id;
				$relData['relationship_type_id'] = isset($rel_type)?$rel_type:"0";
				ClientRelationship::insert($relData);

				$actData['user_id'] = $user_id;
				$actData['client_id'] = $client_id;
				$actData['acting_client_id'] = isset($app_client_id)?$app_client_id:"0";
				ClientActing::insert($actData);

				$getReturn = $this->insertClientDetails($row, $app_client_id);
				
			}
			
		}
		

	}

	public function insert_individual_client($row)
	{
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];

		$client_name = "";
		$mname ="";
		$full_name = explode(",", $row->name);
		$half_name = explode(" ", trim($full_name[1]));

		$client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'chd', 'chd_type' => 'ind'));

		if (isset($half_name[0]) && $half_name[0] != "") {
			$client_name.=$half_name[0]." ";
			$arrNewData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'fname', $half_name[0]);
		}
		if (isset($half_name[1]) && $half_name[1] != "") {
			$client_name.=$half_name[1]." ";
			$mname.=$half_name[1]." ";
		}
		if (isset($half_name[2]) && $half_name[2] != "") {
			$client_name.=$half_name[2]." ";
			$mname.=$half_name[2]." ";
		}
		if (isset($mname) && $mname != "") {
			$arrNewData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'mname', $mname);
		}
		
		if (isset($full_name[0]) && $full_name[0] != "") {
			$client_name.=$full_name[0];
			$arrNewData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'lname', $full_name[0]);
		}
		$arrNewData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'client_name', trim($client_name));

		/*############### Address ###############*/
		if (isset($row->address->address_line_1) && $row->address->address_line_1 != "") {
			$arrNewData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'serv_addr_line1', $row->address->address_line_1);
		}
		if (isset($row->address->address_line_2) && $row->address->address_line_2 != "") {
			$arrNewData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'serv_addr_line2', $row->address->address_line_2);
		}
		if (isset($row->address->postal_code) && $row->address->postal_code != "") {
			$arrNewData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'serv_postcode', $row->address->postal_code);
		}
		if (isset($row->address->locality) && $row->address->locality != "") {
			$arrNewData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'serv_city', $row->address->locality);
		}

		StepsFieldsClient::insert($arrNewData);

		return $client_id;
	}

	public function goto_edit_client()
	{
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];

		$company_number = Input::get("company_number");
		$key = Input::get("key");
		$data 	= array();
		
		$officers 			= Common::getOfficerDetails($company_number);
		if(isset($officers->items[$key]) && count($officers->items[$key]) > 0){
			$officer = $officers->items[$key];

			//$insert_data[''] = $officer[''];

			if(strpos($officer->officer_role, 'corporate') !== false){
				$name 		= str_replace(" ", "+", $officer->name);
				$details 	= Common::getSearchCompany($name);
				$company_number = $details->items[0]->company_number;

				$client_id = $this->insert_org_client($company_number);
				$data['link'] = "/client/edit-org-client/".$client_id;
			}else{
				$client_id = $this->insert_individual_client($officer);
				$data['link'] = "/client/edit-ind-client/".$client_id;
			}
			
		}

		echo json_encode($data);
		exit;
	}

	public function insert_org_client($number)
	{
		//$number = Input::get("number");
		//$number = "05244480";
		$data = array();
		//$details 			= Common::getCompanyDetails($number);
		$details 			= Common::getCompanyData($number);
		//print_r($details);die;
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];

		//################# If company number exists Start ##################//
		$client_data = StepsFieldsClient::where("field_name", "=", "registration_number")->where("field_value", "=", $details->company_number)->first();
		//echo $this->last_query();die;
		if(isset($client_data) && count($client_data) >0 ){
			$client_id = $client_data['client_id'];
			$this->update_existing_client($client_id);
			
		}else{
			$client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'org'));
		}
		//################# If company number exists End ##################//
		
		

		$ret_check = 0;
		$acc_check = 0;
		if (isset($details->company_name)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'business_name', $details->company_name);
		}
		if (isset($details->company_number)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'registration_number', $details->company_number);
		}
		if (isset($details->date_of_creation)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'incorporation_date', $details->date_of_creation);
		}
		if (isset($details->type)) {
			if($details->type == "ltd" || $details->type == "limited"){
				$type = 2;
			}else if($details->type == "llp"){
				$type = 1;
			}else{
				$type = "";
			}
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'business_type', $type);
		}
		if (isset($details->jurisdiction)) {
			//$reg_in = RegisteredAddress::where("reg_name", "=", ucwords(str_replace("-", " ", $details->jurisdiction)))->select("reg_id")->first();
			$reg_in = RegisteredAddress::where("reg_name", "=", ucwords($details->jurisdiction))->select("reg_id")->first();
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'registered_in', $reg_in['reg_id']);
		}
		if (isset($details->sic_codes) && count($details->sic_codes) >0 ) {
			$codes_data = "";
			foreach ($details->sic_codes as $key => $value) {
				$sic_codes = SicCodesDescription::where("sic_codes", "=", $value)->first();
				$codes_data .= $sic_codes['description'].", ";
			}
			$codes_data = substr($codes_data, 0, -2);
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'business_desc', $codes_data);
		}
		if (isset($details->annual_return->next_due)) {
			$ret_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'next_ret_due', str_replace("/", "-", $details->annual_return->next_due));
		}
		if (isset($details->annual_return->last_made_up_to)) {
			$ret_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'made_up_date', $details->annual_return->last_made_up_to);
		}
		if (isset($details->accounts->last_accounts->made_up_to)) {
			$acc_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'last_acc_madeup_date', $details->accounts->last_accounts->made_up_to);
		}
		if (isset($details->accounts->next_due)) {
			$acc_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'next_acc_due', $details->accounts->next_due);
		}
		if (isset($details->accounts->accounting_reference_date->day)) {
			$acc_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'acc_ref_day', $details->accounts->accounting_reference_date->day);
		}
		if (isset($details->accounts->accounting_reference_date->month)) {
			$acc_check = 1;
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'acc_ref_month', $details->accounts->accounting_reference_date->month);
		}
		if($ret_check == 1){
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'ann_ret_check', 1);
		}
		if($acc_check == 1){
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 1, 'yearend_acc_check', 1);
		}

		//$registered_office 				= Common::getRegisteredOffice($number);
		$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3,'cont_reg_addr', 'reg');
		if (isset($details->registered_office_address->address_line_1)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_addr_line1', $details->registered_office_address->address_line_1);
		}
		if (isset($details->registered_office_address->address_line_2)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_addr_line2', $details->registered_office_address->address_line_2);
		}
		if (isset($details->registered_office_address->locality)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_city', $details->registered_office_address->locality);
		}
		if (isset($details->registered_office_address->postal_code)) {
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_postcode', $details->registered_office_address->postal_code);
		}
		if (isset($details->registered_office_address->country)) {
			$country = Country::where("country_name", "=", $details->registered_office_address->country)->select("country_id")->first();
			$arrData[] = App::make('HomeController')->save_client($user_id, $client_id, 3, 'reg_cont_country', $country['country_id']);
		}
		//print_r($arrData);die;
		$inserted = StepsFieldsClient::insert($arrData);

		$officers 	= Common::getOfficerDetails($number);//print_r($officers);die;
		if(isset($officers->items) && count($officers->items) > 0){
			foreach ($officers->items as $key => $row) {
				if(!isset($row->resigned_on)){

					$app_client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'chd'));
					if (isset($row->officer_role) && $row->officer_role != "") {
						$relationship_type = RelationshipType::where("relation_type", "=", ucwords($row->officer_role))->first();
						$rel_type = $relationship_type['relation_type_id'];
					}

					$relData['client_id'] 			 = $client_id;
					$relData['appointment_with'] 	 = $app_client_id;
					$relData['relationship_type_id'] = isset($rel_type)?$rel_type:"0";
					$relation_id = ClientRelationship::insertGetId($relData);

					/*$actData['user_id'] = $user_id;
					$actData['client_id'] = $client_id;
					$actData['acting_client_id'] = isset($app_client_id)?$app_client_id:"0";
					ClientActing::insert($actData);*/

					$getReturn = $this->insertClientDetails($relation_id, $client_id, $row, $app_client_id);
					//$this->insertClientDetails($row);
				}
				
			}
			
		}

		if($inserted){
			return $client_id;
						
		}else{
			return 0;
		}
		exit;
	}

}
