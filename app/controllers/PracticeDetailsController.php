<?php

class PracticeDetailsController extends BaseController {
	
	public function index()
	{
		$data['title'] = "Practice Details";
		//$data['org_types'] = DB::table("organisation_types")->get();
		$data['org_types'] = OrganizationType::orderBy("name")->get();
		//print_r($data['org_types']);die;
		
		return View::make('practice.practice_details', $data);
	}

	function insertPracticeDetails(){
		$pd_data = array();
		$pa_data = array();
		$update_data = array();
		$postData = Input::all();

		/*###################*/
		$registered_address_id = 1;
		$physical_address_id = 2;
		/*###################*/

		$pd_data['display_name']			= $postData['display_name'];
		$pd_data['legal_name']				= $postData['legal_name'];
		$pd_data['registration_no']			= $postData['registration_no'];
		$pd_data['organisation_type_id']	= $postData['organisation_type_id'];
		//$pd_data['registered_address_id']	= $registered_address_id;
		//$pd_data['physical_address_id']		= $physical_address_id;
		$pd_data['telephone_no']			= $postData['tel_country_code'].$postData['tel_area_code'].$postData['tel_number'];
		$pd_data['fax_no']					= $postData['fax_country_code'].$postData['fax_area_code'].$postData['fax_number'];
		$pd_data['mobile_no']				= $postData['mob_country_code'].$postData['mob_area_code'].$postData['mob_number'];

		$pd_id = PracticeDetail::insertGetId($pd_data);

		$pa_data['practice_id']		= $pd_id;
		$pa_data['type']			= "registered";
		$pa_data['attention']		= $postData['reg_attention'];
		$pa_data['street_address']	= $postData['reg_street_address'];
		$pa_data['city_id']			= $postData['hid_reg_city_id'];
		$pa_data['state_id']		= $postData['hid_reg_state_id'];
		$pa_data['zip']				= $postData['reg_zip'];
		$pa_data['country_id']		= 1;
		$pareg_id = PracticeAddress::insertGetId($pa_data);

		$pa_data['practice_id']		= $pd_id;
		$pa_data['type']			= "physical";
		$pa_data['attention']		= $postData['phy_attention'];
		$pa_data['street_address']	= $postData['phy_street_address'];
		$pa_data['city_id']			= $postData['hid_phy_city_id'];
		$pa_data['state_id']		= $postData['hid_phy_state_id'];
		$pa_data['zip']				= $postData['phy_zip'];
		$pa_data['country_id']		= 1;
		$paphy_id = PracticeAddress::insertGetId($pa_data);

		$update_data['registered_address_id'] = $pareg_id;
		$update_data['physical_address_id'] = $paphy_id;
		PracticeDetail::where("practice_id", "=", $pd_id)->update($update_data);

		//echo $pd_id;die;
		return Redirect::to('/practice_details');
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
