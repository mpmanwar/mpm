<?php

class HomeController extends BaseController {
	
	public function db_connect(){
        if (DB::connection()->getDatabaseName())
        {
            echo "conncted sucessfully to database : " . DB::connection()->getDatabaseName();
            die;
        }
    }

	public function index(){
		$countries = Country::all();
		print_r($countries);die;
		return View::make('index');
	}

	public function hello(){
		return View::make('hello');
	}

}
