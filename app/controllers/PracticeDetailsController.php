<?php

class PracticeDetailsController extends BaseController {
	
	public function index()
	{
		$data['title'] = "Practice Details";
		$data['org_types'] = OrganizationType::orderBy("name")->get();
		//print_r($data['org_types']);die;
		$data["practice_details"]	= PracticeDetail::where("practice_id", "=", 1)->first();
		if(!empty($data["practice_details"]) && count($data["practice_details"]) > 0)
		{
			$data["practice_details"]['telephone_no'] 	= explode("-", $data["practice_details"]['telephone_no']);
			$data["practice_details"]['fax_no'] 		= explode("-", $data["practice_details"]['fax_no']);
			$data["practice_details"]['mobile_no'] 		= explode("-", $data["practice_details"]['mobile_no']);

			$practice_addresses	= PracticeAddress::where("practice_id", "=", $data["practice_details"]['practice_id'])->get();
			foreach($practice_addresses as $pa_row){
				$city_name = City::where("city_id", "=", $pa_row->city_id)->get();
				$state_name = State::where("state_id", "=", $pa_row->state_id)->get();
				$country_name = Country::where("country_id", "=", $pa_row->country_id)->get();
				if($pa_row->type == "registered"){
					$data["practice_address"]['reg_address_id']		= $pa_row->address_id;
					$data["practice_address"]['reg_practice_id']	= $pa_row->practice_id;
					$data["practice_address"]['reg_type']			= $pa_row->type;
					$data["practice_address"]['reg_attention']		= $pa_row->attention;
					$data["practice_address"]['reg_street_address']	= $pa_row->street_address;
					$data["practice_address"]['reg_city_id']		= $pa_row->city_id;
					$data["practice_address"]['reg_city_name']		= $city_name[0]->city_name;
					$data["practice_address"]['reg_state_id']		= $state_name[0]->state_id;
					$data["practice_address"]['reg_state_name']		= $state_name[0]->state_name;
					$data["practice_address"]['reg_zip']			= $pa_row->zip;
					$data["practice_address"]['reg_country_name']		= $country_name[0]->country_name;
				}
				if($pa_row->type == "physical"){
					$data["practice_address"]['phy_address_id']		= $pa_row->address_id;
					$data["practice_address"]['phy_practice_id']	= $pa_row->practice_id;
					$data["practice_address"]['phy_type']			= $pa_row->type;
					$data["practice_address"]['phy_attention']		= $pa_row->attention;
					$data["practice_address"]['phy_street_address']	= $pa_row->street_address;
					$data["practice_address"]['phy_city_id']		= $city_name[0]->city_id;
					$data["practice_address"]['phy_city_name']		= $city_name[0]->city_name;
					$data["practice_address"]['phy_state_id']		= $state_name[0]->state_id;
					$data["practice_address"]['phy_state_name']		= $state_name[0]->state_name;
					$data["practice_address"]['phy_zip']			= $pa_row->zip;
					$data["practice_address"]['phy_country_name']	= $country_name[0]->country_name;
				}
			}
		}
		
		//echo "<pre>";print_r($data);die;
		return View::make('practice.practice_details', $data);
	}

	function insertPracticeDetails(){
		$pd_data = array();
		$pa_data = array();
		$update_data = array();
		$postData = Input::all();

		$pd_data['display_name']			= $postData['display_name'];
		$pd_data['legal_name']				= $postData['legal_name'];
		$pd_data['registration_no']			= $postData['registration_no'];
		$pd_data['organisation_type_id']	= $postData['organisation_type_id'];
		$pd_data['telephone_no']			= $postData['tel_country_code']."-".$postData['tel_area_code']."-".$postData['tel_number'];
		$pd_data['fax_no']					= $postData['fax_country_code']."-".$postData['fax_area_code']."-".$postData['fax_number'];
		$pd_data['mobile_no']				= $postData['mob_country_code']."-".$postData['mob_area_code']."-".$postData['mob_number'];
		if(!empty($postData['practice_id'])){
			PracticeDetail::where("practice_id", "=", $postData['practice_id'])->update($pd_data);
		}else{
			$pd_id = PracticeDetail::insertGetId($pd_data);
		}
			

		$pa_data['practice_id']		= !empty($postData['practice_id'])?$postData['practice_id']:$pd_id;
		$pa_data['type']			= "registered";
		$pa_data['attention']		= $postData['reg_attention'];
		$pa_data['street_address']	= $postData['reg_street_address'];
		$pa_data['city_id']			= $postData['hid_reg_city_id'];
		$pa_data['state_id']		= $postData['hid_reg_state_id'];
		$pa_data['zip']				= $postData['reg_zip'];
		$pa_data['country_id']		= $postData['hid_reg_country_id'];
		if(!empty($postData['reg_address_id'])){
			PracticeAddress::where("address_id", "=", $postData['reg_address_id'])->update($pa_data);
		}else{
			$pareg_id = PracticeAddress::insertGetId($pa_data);
		}
		

		$pa_data['practice_id']		= !empty($postData['practice_id'])?$postData['practice_id']:$pd_id;
		$pa_data['type']			= "physical";
		$pa_data['attention']		= $postData['phy_attention'];
		$pa_data['street_address']	= $postData['phy_street_address'];
		$pa_data['city_id']			= $postData['hid_phy_city_id'];
		$pa_data['state_id']		= $postData['hid_phy_state_id'];
		$pa_data['zip']				= $postData['phy_zip'];
		$pa_data['country_id']		= $postData['hid_phy_country_id'];
		if(!empty($postData['phy_address_id'])){
			PracticeAddress::where("address_id", "=", $postData['phy_address_id'])->update($pa_data);
		}else{
			$paphy_id = PracticeAddress::insertGetId($pa_data);
		}
		
		if(empty($postData['practice_id'])){
			$update_data['registered_address_id'] 	= $pareg_id;
			$update_data['physical_address_id'] 	= $paphy_id;
			PracticeDetail::where("practice_id", "=", $pd_id)->update($update_data);
		}

		//echo $pd_id;die;
		return Redirect::to('/practice_details');
		//return Redirect::back();
	}

	function ajaxSearchByCity(){
		$value = Input::get("value");
		$data['div_id'] = Input::get("div_id");
		$data['city_lists'] = City::where("city_name", 'LIKE', $value.'%')->get();
		//echo $this->last_query();die;
		if (Request::ajax()) {            
            return View::make('search.search_city',$data);
        }else{
        	echo "You do not have permission to call this method directly.";
        }
		//echo view('search.search_city',$data);
	}

	function ajaxSearchGetState(){
		$state_id = Input::get("state_id");
		$data['state_name'] = State::where("state_id", '=', $state_id)->get();
		//print_r($data['state_name']);
		//echo $this->last_query();die;
		if (Request::ajax()) {            
            echo $data['state_name'][0]->state_name;
        }else{
        	echo "You do not have permission to call this method directly.";
        }
		//echo view('search.search_city',$data);
	}

}
