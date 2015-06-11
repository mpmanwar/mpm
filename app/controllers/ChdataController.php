<?php
class ChdataController extends BaseController {
	
	public function index()
	{
		$data 			= array();
		$details_data 	= array();
		$data['heading'] 	= "CH DATA";
		$data['title'] 		= "Ch Data";
		
		$numbers = CompanyNumber::orderBy("cn_id")->get();
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
		$details 	= Common::getCompanyDetails($number);

		$data['details']	= $details->primaryTopic;
		//print_r($data['details']);die;
		return View::make("ch_data.chdata_details", $data);
	}

}
