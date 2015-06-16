<?php
class ChdataController extends BaseController {
	
	public function index()
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
		if( isset($details) && count($details) >0 ){
			$all_details = StepsFieldsClient::where("client_id", "=", $details['client_id'])->where("step_id", "=", 1)->get();
			foreach ($all_details as $key => $value) {
				if(isset($value->field_name) && $value->field_name == "registered_in"){
					$array['registered_in'] = $value->field_value;
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

		$officers 			= Common::getOfficerDetails($number);
		
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

	public function import_from_ch()
	{
		$data['title'] = "Import from CH";
		$data['heading'] = "";

		return View::make("ch_data.import_from_ch", $data);
	}

	public function search_company()
	{
		$company = array();
		$value = str_replace(" ", "+", Input::get("value"));
		//$value = "Alexander+Rosse";
		$compamy_details	= Common::getSearchCompany($value);
		if(isset($compamy_details->items) && count($compamy_details->items) >0 )
		{
			foreach ($compamy_details->items as $key => $value) {
				$company[$key]['company_name'] 		= $value->title;
				$company[$key]['company_number'] 	= $value->description_values->company_number;
			}
		}
		$data['company_details'] 	= $company;
		//print_r($data);die;

		echo View::make("ch_data.ajax_company_search_result", $data);
	}

	public function company_details()
	{
		$number = Input::get("number");
		$data 		= array();
		$data['officers']	= array();
		
		$details 			= Common::getCompanyDetails($number);
		$registered_office 	= Common::getRegisteredOffice($number);
		$officers 			= Common::getOfficerDetails($number);
		if(isset($officers->items) && count($officers->items) > 0){
			$data['officers']	= $officers->items;
		}

		$data['details']			= $details->primaryTopic;
		
		$data['registered_office']	= $registered_office;
		$data['nature_of_business']	= $this->getSicDescription($details->primaryTopic->SICCodes->SicText);

		echo View::make("ch_data.ajax_company_details", $data);
		
	}

}
