<?php

class IndividualClientController extends BaseController
{

    public function insert_individual_client()
    {

        // die('indi');

        $postData = Input::all();
        $data = array();
        //	$arrData[] = array();



        //
        $arrData = array();
        $user_id = 1;
        $client_id = Client::insertGetId(array("user_id" => $user_id, 'type' => 'ind'));
            
           
          // print_r( $postData['others_check']);die();
            
          
         
        //$nationality_id = ($postData['nationality']);die();
        // $fullnationality= Title::select("title_name")->where('title_id', $nationality_id)->first();

        
//print_r($arrData);die();


        //General//
       $step_id = 1;
        if (!empty($postData['client_code'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'client_code', $postData['client_code']);

        }
        
        
        
        
       
            $title_id = $postData['title'];
          $fulltitle= Title::select("title_name")->where('title_id', $title_id)->first();
          $title= $fulltitle['title_name'];

        if (!empty($postData['title'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'name', $title . " " . $postData['fname'] .
                " " . $postData['mname'] . " " . $postData['lname']);

        }

        //print_r($arrData);die();

        if (!empty($postData['sex'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'sex', $postData['sex']);

        }
        if (!empty($postData['dob'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'dob', $postData['dob']);

        }
        if (!empty($postData['marital_status'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'marital_status', $postData['marital_status']);

        }
        if (!empty($postData['spouse_dob'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'spouse_dob', $postData['spouse_dob']);

        }
        if (!empty($postData['nationality'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'nationality', $postData['nationality']);

        }
        if (!empty($postData['occupation'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'occupation', $postData['occupation']);

        }

        //Tax//
        $step_id=2;
        if (!empty($postData['ni_number'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'ni_number', $postData['ni_number']);

        }


        if (!empty($postData['tax_reference'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'tax_reference', $postData['tax_reference']);

        }
        if (!empty($postData['tax_office_id'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'tax_office_id', $postData['tax_office_id']);

        }
        if (!empty($postData['tax_address'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'tax_address', $postData['tax_address']);

        }
        if (!empty($postData['tax_city'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'tax_city', $postData['tax_city']);

        }
        if (!empty($postData['tax_region'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'tax_region', $postData['tax_region']);

        }
        if (!empty($postData['tax_zipcode'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'tax_zipcode', $postData['tax_zipcode']);

        }
        if (!empty($postData['tax_telephone'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'tax_telephone', $postData['tax_telephone']);

        }
        if (!empty($postData['tax_region'])) {

            $arrData[] = $this->save_client($user_id,$client_id,$step_id, 'tax_region', $postData['tax_region']);

        }


        //res_address//
        $step_id=3;
        if (!empty($postData['res_address'])) {

            $arrData[] = $this->save_client($user_id, $client_id,$step_id, 'res_address', $postData['res_address']);

        }
        if (!empty($postData['res_city'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'res_city', $postData['res_city']);

        }
        if (!empty($postData['res_region'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'res_region', $postData['res_region']);

        }
        if (!empty($postData['res_zipcode'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'res_zipcode', $postData['res_zipcode']);

        }
        if (!empty($postData['res_country'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'res_country', $postData['res_country']);

        }
        if (!empty($postData['serv_address'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'serv_address', $postData['serv_address']);

        }
        if (!empty($postData['serv_city'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'serv_city', $postData['serv_city']);

        }
        if (!empty($postData['serv_region'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'serv_region', $postData['serv_region']);

        }

        if (!empty($postData['serv_zipcode'])) {

            $arrData[] = $this->save_client($user_id,$client_id,$step_id, 'serv_zipcode', $postData['serv_zipcode']);

        }
        if (!empty($postData['serv_country'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'serv_country', $postData['serv_country']);

        }
        // if(!empty($postData['serv_tele_code'])){

        //	$arrData[] = $this->save_client(1, 3, 'serv_tele_code', $postData['serv_tele_code']);

        //}
        // if(!empty($postData['serv_tele_code'])){

        //	$arrData[] = $this->save_client(1, 3, 'serv_tele_code', $postData['serv_tele_code']);

        //	}
        //if(!empty($postData['serv_mobile_code'])){

        //	$arrData[] = $this->save_client(1, 3, 'serv_mobile_code', $postData['serv_mobile_code']);

        //}
        if (!empty($postData['serv_telephone'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'telephone', $postData['serv_tele_code'] .
                " " . $postData['serv_telephone']);

        }
        if (!empty($postData['serv_mobile'])) {

            $arrData[] = $this->save_client($user_id, $client_id,$step_id, 'mobile', $postData['serv_mobile_code'] .
                " " . $postData['serv_mobile']);

        }
        if (!empty($postData['serv_email'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'serv_email', $postData['serv_email']);

        }
        if (!empty($postData['serv_website'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'serv_website', $postData['serv_website']);

        }
        if (!empty($postData['serv_skype'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'serv_skype', $postData['serv_skype']);

        }


        //others//
        $step_id=5;
if (!empty($postData['others_check'])) {
            $checkbox_list='';
            for ( $i=0; $i< count($postData['others_check']); $i++ ){
                $checkbox_list=$checkbox_list.' '.$postData['others_check'][$i];
                }
                
            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'others_check', $checkbox_list);

        }
         if (!empty($postData['resp_staff'])) {

            $arrData[] = $this->save_client($user_id,$client_id, $step_id, 'resp_staff', $postData['resp_staff']);

        }
        

        //print_r($arrData);die;
        StepsFieldsClient::insert($arrData);
        return Redirect::to('/individual/add-client');
       // return View::make('home.organisation.add_organisation_client', $data);
        //die('insert');

        //print_r($data);die;
        //print_r($postData);die;
        //return View::make('home.organisation.add_organisation_client', $data);
    }


    public function save_client($user_id, $client_id, $step_id, $field_name, $field_value)
    {

        $data = array();

        $data['user_id'] = $user_id;

        $data['client_id'] = $client_id;

        $data['step_id'] = $step_id;

        $data['field_name'] = $field_name;

        $data['field_value'] = $field_value;

        return $data;

        //OrganisationClient::insert($data);

    }


}
