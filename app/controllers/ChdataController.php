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

		$data['details']			= $details->primaryTopic;
		$data['officers']			= $officers->items;
		$data['filling_history']	= $filling_history->items;
		$data['registered_office']	= $registered_office;
		//print_r($data['officers']);die;
		return View::make("ch_data.chdata_details", $data);
	}

	public function officers_details()
	{
		$number = Input::get("number");
		$key 	= Input::get("key");
		$data = array();
		$off_data = array();

		$officers 			= Common::getOfficerDetails($number);
		
		$off_data['date_of_birth'] 			= isset($officers->items[$key]->date_of_birth)?$officers->items[0]->date_of_birth:"";
		$off_data['nationality'] 			= isset($officers->items[$key]->nationality)?$officers->items[0]->nationality:"";
		$off_data['officer_role'] 			= isset($officers->items[$key]->officer_role)?$officers->items[0]->officer_role:"";
		$off_data['name'] 					= isset($officers->items[$key]->name)?$officers->items[0]->name:"";
		$off_data['occupation'] 			= isset($officers->items[$key]->occupation)?$officers->items[0]->occupation:"";
		$off_data['appointed_on'] 			= isset($officers->items[$key]->appointed_on)?$officers->items[0]->appointed_on:"";
		$off_data['country_of_residence'] 	= isset($officers->items[$key]->country_of_residence)?$officers->items[0]->country_of_residence:"";
		$off_data['address'] 				= isset($officers->items[$key]->address)?$officers->items[0]->address:"";
		$off_data['links'] 					= isset($officers->items[$key]->links)?$officers->items[0]->links:"";

		$data['officers'] = $off_data;

		echo View::make("ch_data.ajax_officer_details", $data);
		
	}

}
