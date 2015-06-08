<?php

class ClientController extends BaseController {
	public function edit_client($client_id)
	{
		$data['title'] = "Edit Client";
        $data['heading'] = "";
        $admin_s = Session::get('admin_details'); // session
        $user_id = $admin_s['id'];

        $data['rel_types'] = RelationshipType::where("show_status", "=", "individual")->orderBy("relation_type_id")->get();
        $data['marital_status'] = MaritalStatus::orderBy("marital_status_id")->get();
        $data['titles'] = Title::orderBy("title_id")->get();


        $data['tax_office'] = TaxOfficeAddress::select("parent_id", "office_id",
            "office_name")->get();
        $data['tax_office_by_id'] = TaxOfficeAddress::where("office_id", "=", 1)->first();
        $data['steps'] = Step::orderBy("step_id")->get();
        $data['responsible_staff'] = User::select('fname', 'lname', 'user_id')->get();
        $data['countries'] = Country::where("country_id", "!=", 1)->orderBy('country_name')->
            get();
        $data['field_types'] = FieldType::get();

        $i = 0;
        $client_details = StepsFieldsClient::where('client_id', '=', $client_id)->
            select("field_id", "field_name", "field_value")->get();
        $client_data[$i]['client_id'] = $client_id;
        $appointment_name = ClientRelationship::where('client_id', '=', $client_id)->
            select("appointment_with")->first();

        $relation_name = StepsFieldsClient::where('client_id', '=', $appointment_name['appointment_with'])->
            where('field_name', '=', "business_name")->select("field_value")->first();


        if (isset($client_details) && count($client_details) > 0) {
            foreach ($client_details as $client_row) {
                //get staff name start
                if (!empty($client_row['field_name']) && $client_row['field_name'] ==
                    "resp_staff") {
                    $staff_name = User::where('user_id', '=', $client_row->field_value)->select("fname",
                        "lname")->first();
                    //echo $this->last_query();die;
                    $client_data[$i]['staff_name'] = strtoupper(substr($staff_name['fname'], 0, 1)) .
                        " " . strtoupper(substr($staff_name['lname'], 0, 1));
                }
                //get staff name end

                //get business name start
                if (!empty($relation_name['field_value'])) {
                    $client_data[$i]['business_name'] = $relation_name['field_value'];
                }

                //get business name end
				if (isset($client_row['field_name']) && $client_row['field_name'] ==
                    "business_type") {
                    $business_type = OrganisationType::where('organisation_id', '=', $client_row->
                        field_value)->first();
                    $client_data[$i][$client_row['field_name']] = $business_type['name'];
                } else {
                    $client_data[$i][$client_row['field_name']] = $client_row->field_value;
                }

            }

            $i++;
        }
        $data['client_details'] = $client_data;

        $data['client_fields'] = ClientField::where("field_type", "=", "ind")->first();

        
        $data['name'] = StepsFieldsClient::select('field_value')->where("client_id",
            "=", $client_id)->where("field_name", "=", 'name')->first();
        $value = $data['name']['field_value'];

		$value = explode(" ", $data['name']['field_value']);

		$data['name_id'] = Title::select('title_id')->where("title_name","=",$value[0])->first();
        
        $value=  $data['name']['field_value'];

        return View::make('home.individual.edit_individual_client', $data);
   
   	}

	public function get_country_code() {
		$country_id = Input::get("country_id");
		$country_code = Country::where("country_id", $country_id)->select("phone_code")->first();
		echo $country_code['phone_code'];
	}

	public function delete_user_field() {
		$field_id = Input::get("field_id");
		$affectedRows = StepsFieldsAddedUser::where('field_id', '=', $field_id)->delete();
		echo $affectedRows;
	}

	public function delete_section() {
		$step_id = Input::get("step_id");
		$affected = Step::where('step_id', '=', $step_id)->delete();
		if ($affected) {
			$affectedRows = StepsFieldsAddedUser::where('step_id', '=', $step_id)->delete();
			echo $affectedRows;
		}

	}

	public function delete_individual_client() {
		$client_delete_id = Input::get("client_delete_id");
		//print_r($client_delete_id);die;
		foreach ($client_delete_id as $client_id) {
			Client::where('client_id', '=', $client_id)->delete();
			StepsFieldsClient::where('client_id', '=', $client_id)->delete();
		}
	}

	public function search_tax_address() {
		$field_type = Input::get("field_type");
		$data = array();
		if (Request::ajax()) {
			if ($field_type == "I") {
				$data = TaxOfficeAddress::where("parent_id", "==", "0")->select("office_id", "office_name")->get();
			} elseif ($field_type == "C") {
				$data = CorporationTaxOffice::select("corp_tax_id as office_id", "office_name")->get();
			}
		}
		echo json_encode($data);
		exit;
	}

	public function add_business_type() {
		$session_data = Session::get('admin_details');
		
		$data['name'] 			= Input::get("org_name");
		$data['client_type'] 	= Input::get("client_type");
		$data['user_id'] 		= $session_data['id'];
		$data['status'] 		= "new";
		OrganisationType::insert($data);
		return Redirect::to('/organisation/add-client');
	}

	public function delete_org_name() {
		$field_id = Input::get("field_id");
		if (Request::ajax()) {
			$data = OrganisationType::where("organisation_id", "=", $field_id)->delete();
			echo $data;
		}
	}

	public function add_vat_scheme() {
		$session_data = Session::get('admin_details');

		$data['vat_scheme_name'] 	= Input::get("vat_scheme_name");
		$data['user_id'] 			= $session_data['id'];
		$data['status'] 			= "new";
		VatScheme::insert($data);
		return Redirect::to('/organisation/add-client');
	}

	public function delete_vat_scheme() {
		$field_id = Input::get("field_id");
		if (Request::ajax()) {
			$data = VatScheme::where("vat_scheme_id", "=", $field_id)->delete();
			echo $data;
		}
	}

	public function get_oldcont_address() {
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		$client_id = Input::get("client_id");
		$client_data = array();
		if (Request::ajax()) {
			$client_ids = Client::whereIn("user_id", $groupUserId)->where('type', '=', "org")->where('client_id', '=', $client_id)->where('user_id', '=', $user_id)->select("client_id")->get();
			//echo $this->last_query();die;
			$i = 0;
			if (isset($client_ids) && count($client_ids) > 0) {
				foreach ($client_ids as $client_id) {
					$client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
					$client_data[$i]['client_id'] = $client_id->client_id;

					if (isset($client_details) && count($client_details) > 0) {
						foreach ($client_details as $client_row) {
							$client_data[$i][$client_row['field_name']] = $client_row['field_value'];
						}

						$i++;
					}
				}
			}
		}
		echo json_encode($client_data);
		exit;
	}

	public function add_services() {
		$session_data = Session::get('admin_details');

		$data['service_name'] = Input::get("service_name");
		$data['user_id'] 			= $session_data['id'];
		$data['status'] 			= "new";
		Service::insert($data);
		return Redirect::to('/organisation/add-client');
	}

	public function delete_services() {
		$field_id = Input::get("field_id");
		if (Request::ajax()) {
			$data = Service::where("service_id", "=", $field_id)->delete();
			echo $data;
		}
	}

	public function insert_section() {
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		$data['title'] 			= Input::get("subsec_name");
		$data['parent_id'] 		= Input::get("parent_id");
		$data['user_id'] 		= $user_id;
		$data['short_code'] 	= strtolower(Input::get("subsec_name"));
		$data['status'] 		= "new";
		$data['client_type'] 	= Input::get("client_type");
		if (Request::ajax()) {
			Step::insert($data);
			$steps = Step::whereIn("user_id", $groupUserId)->where("client_type", "=", $data['client_type'])->where("parent_id", "=", $data['parent_id'])->where("status", "=", "new")->get();
			echo json_encode($steps);
		}
	}

	public function get_subsection() {
		$admin_s = Session::get('admin_details');
		$groupUserId = $admin_s['group_users'];

		$step_id 		= Input::get("step_id");
		$client_type 	= Input::get("client_type");
		
		if (Request::ajax()) {
			$steps = Step::whereIn("user_id", $groupUserId)->where("client_type", "=", $client_type)->where("parent_id", "=", $step_id)->get();
			//echo $this->last_query();die;
			echo json_encode($steps);
		}
	}

	public function archive_client() {
		$clients_id = Input::get("client_id");
		//print_r($clients_id);die;
		foreach ($clients_id as $client_id) {
			Client::where('client_id', '=', $client_id)->update(array("is_archive"=>"Y"));
			//echo $this->last_query();die;
		}
	}

}
