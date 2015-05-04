<?php
// import the Intervention Image Manager Class
//use Intervention\Image\ImageManagerStatic as Image;

// configure with favored image driver (gd by default)
//Image::configure(array('driver' => 'imagick'));


//use Excel;
class PracticeDetailsController extends BaseController {
	public function php_info()
	{
		phpinfo();
	}
	
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
					$data["practice_address"]['reg_country_name']	= $country_name[0]->country_name;
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

		$viewToLoad = 'practice.practice_details';
		///////////  Start Generate and store excel file ////////////////////////////
        Excel::create('practiceDetails', function($excel) use($data, $viewToLoad) {

            // Set the title
            $excel->setTitle('MPM Practice Details');

            // Chain the setters
            $excel->setCreator('MPM')->setCompany('MPM');

            // Call them separately
            $excel->setDescription('MPM Practice Details');
			$excel->sheet('Sheetname', function($sheet) use($data, $viewToLoad) {
				$sheet->loadView($viewToLoad)->with($data);
           	})->save();
            
        });

        ///////////  End Generate and store excel file ////////////////////////////

        ///////////  Start Generate and store pdf file ////////////////////////////
        //PDF::loadFile()->save('/path-to/my_stored_file.pdf')->stream('download.pdf');
        ///////////  End Generate and store pdf file ////////////////////////////


        //echo "<pre>";print_r($data);die;
		return View::make($viewToLoad, $data);
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
			$pd_id = $postData['practice_id'];
		}else{
			$pd_id = PracticeDetail::insertGetId($pd_data);
		}

		//////////////////file upload start//////////////////
        if (Input::hasFile('practice_logo')) {
            $file = Input::file('practice_logo');
            $destinationPath = "practice_logo/";
            $Name = Input::file('practice_logo')->getClientOriginalName();
            $fileName = time().$Name;
            $result = Input::file('practice_logo')->move($destinationPath, $fileName);

            ### delete the previous image if exists ###
            $prevPath   = "practice_logo/".$postData['hidd_practice_logo'];
            if($postData['hidd_practice_logo'] != ""){
            	if( file_exists( $prevPath ) ){
                	unlink( $prevPath );
            	}
            }
            
            ### delete the previous image if exists ###

            if( $result ){
                /*Image::make($destinationPath.'thumble')->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save();*/
	
                
            }

            $logo_data['practice_logo']       = $fileName;
            PracticeDetail::where("practice_id", "=", $pd_id)->update($logo_data);

        }
        /////////////////file upload end////////////////////
			

		//$pa_data['practice_id']		= !empty($postData['practice_id'])?$postData['practice_id']:$pd_id;
		$pa_data['practice_id']		= !empty($postData['practice_id'])?$postData['practice_id']:$pd_id;
		$pa_data['type']			= "registered";
		$pa_data['attention']		= $postData['reg_attention'];
		$pa_data['street_address']	= $postData['reg_street_address'];
		$pa_data['city_id']			= $postData['hid_reg_city_id'];
		$pa_data['state_id']		= $postData['hid_reg_state_id'];
		$pa_data['zip']				= $postData['reg_zip'];
		$pa_data['country_id']		= $postData['hid_reg_country_id'];
		if(!empty($postData['reg_address_id'])){
			unset($pa_data['practice_id']);
			unset($pa_data['type']);
			PracticeAddress::where("address_id", "=", $postData['reg_address_id'])->update($pa_data);
		}else{
			$pareg_id = PracticeAddress::insertGetId($pa_data);
		}//echo $this->last_query();
		//print_r($pa_data);die;
		unset($pa_data);

		$pa_data['practice_id']		= !empty($postData['practice_id'])?$postData['practice_id']:$pd_id;
		$pa_data['type']			= "physical";
		$pa_data['attention']		= $postData['phy_attention'];
		$pa_data['street_address']	= $postData['phy_street_address'];
		$pa_data['city_id']			= $postData['hid_phy_city_id'];
		$pa_data['state_id']		= $postData['hid_phy_state_id'];
		$pa_data['zip']				= $postData['phy_zip'];
		$pa_data['country_id']		= $postData['hid_phy_country_id'];
		if(!empty($postData['phy_address_id'])){
			unset($pa_data['practice_id']);
			unset($pa_data['type']);
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
		return Redirect::to('/practice-details');
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

	/*
     * Download generated excel report
     */
	function downloadExel()
	{
		$filepath = storage_path().'/exports/practiceDetails.xls';
        $fileName = 'practiceDetails.xls';

        $headers = array(
            'Content-Description: File Transfer',
            'Content-Type: application/vnd.ms-excel',
            'Content-Disposition: attachment; filename=' . $filepath,
            'Content-Transfer-Encoding: binary',
            'Expires: 0',
            'Cache-Control: must-revalidate',
            'Pragma: public',
            'Content-Length: ' . filesize($filepath)
        );
        ob_clean();
        flush();

        return Response::download($filepath, $fileName, $headers);
		exit;
    	
	}

	/*
     * Download generated pdf report
     */
	function downloadPdf()
	{
		$pdf = PDF::loadView('PrintView', $parameter);
        return $pdf->stream("Hello.pdf");
		exit;
    	
	}

}
