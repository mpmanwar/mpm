<?php

class HomeController extends BaseController {
	
	public function db_connect(){
        if (DB::connection()->getDatabaseName())
        {
            echo "Conncted sucessfully to database : " . DB::connection()->getDatabaseName();
            die;
        }
    }

	public function dashboard(){
		$data['title'] = "Dashboard";
		return View::make('home.dashboard', $data);
	}

	public function individual_clients(){
		$data['title'] = "Individual Clients List";
		return View::make('home.individual.individual_client', $data);
	}

	public function organisation_clients(){
		$data['title'] = "Organisation Clients List";
		return View::make('home.organisation.organisation_client', $data);
	}

	public function add_individual_client(){
		$data['title'] = "Add Individual Client";
		$data['rel_types'] = RelationshipType::orderBy("relation_type_id")->get();
		$data['marital_status'] = MaritalStatus::orderBy("marital_status_id")->get();
		$data['titles'] = Title::orderBy("title_id")->get();
		return View::make('home.individual.add_individual_client', $data);
	}

	public function add_organisation_client(){
		$data['title'] = "Add Organisation Client";
		return View::make('home.organisation.add_organisation_client', $data);
	}

	public function insert_individual_client(){
		
		$postData = Input::all();
		print_r($postData);die;
		return View::make('home.organisation.add_organisation_client', $data);
	}

}
