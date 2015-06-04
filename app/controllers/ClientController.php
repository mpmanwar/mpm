<?php

class ClientController extends BaseController {
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
		$data['name'] = Input::get("org_name");
		$data['type'] = 1;
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
		$data['vat_scheme_name'] = Input::get("vat_scheme_name");
		$data['type'] = 1;
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

		$client_id = Input::get("client_id");

		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id

		//$user_id = 1;
		$client_data = array();
		if (Request::ajax()) {
			$client_ids = Client::where('type', '=', "org")->where('client_id', '=', $client_id)->where('user_id', '=', $user_id)->select("client_id")->get();
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
		$data['service_name'] = Input::get("service_name");
		$data['service_type'] = 1;
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
		$data['title'] 		= Input::get("subsec_name");
		$data['parent_id'] 	= Input::get("parent_id");
		$data['short_code'] = strtolower(Input::get("subsec_name"));
		$data['status'] 	= "new";
		if (Request::ajax()) {
			$data = Step::insert($data);
			$steps = Step::where("status", "=", "new")->get();
			echo json_encode($steps);
		}
	}

}
