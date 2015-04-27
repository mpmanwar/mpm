<?php

class HomeController extends BaseController {
	
	public function db_connect(){
        if (DB::connection()->getDatabaseName())
        {
            echo "Conncted sucessfully to database : " . DB::connection()->getDatabaseName();
            die;
        }
    }

	public function hello(){
		$countries = Country::all();

		echo '<pre>';
	    print_r($countries->toArray());
	    echo '</pre>';die;

		return View::make('hello');
	}

	public function dashboard(){
		$data['title'] = "Dashboard";
		return View::make('home.dashboard', $data);
	}

}
