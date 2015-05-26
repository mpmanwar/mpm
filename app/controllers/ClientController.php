<?php

class ClientController extends BaseController
{
    public function get_country_code()
    {
        $country_id     = Input::get("country_id");
        $country_code   = Country::where("country_id", $country_id)->select("phone_code")->first();
        echo $country_code['phone_code'];
    }

    public function delete_user_field()
    {
        $field_id     = Input::get("field_id");
        $affectedRows = StepsFieldsAddedUser::where('field_id', '=', $field_id)->delete();
        echo $affectedRows;
    }

    public function delete_individual_client()
    {
        $client_delete_id     = Input::get("client_delete_id");
        //print_r($client_delete_id);die;
        foreach($client_delete_id as $client_id){
            Client::where('client_id', '=', $client_id)->delete();
            StepsFieldsClient::where('client_id', '=', $client_id)->delete();
        }
    }

}
