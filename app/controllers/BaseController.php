<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
    public function __construct() {       
        View::share('left_class', "collapse-left");
        View::share('right_class', "strech");
    }

	protected function setupLayout(){
        if ( ! is_null($this->layout)){
            $this->layout = View::make($this->layout);
        }
    }
    
    protected function isPostRequest(){
        //return Input::server('REQUEST_METHOD') === "POST";
        return Request::isMethod('POST');
    }
    
    function last_query() {
        $queries = DB::getQueryLog();
        $sql = end($queries);

        if( ! empty($sql['bindings']))
        {
            $pdo = DB::getPdo();
            foreach($sql['bindings'] as $binding)
            {
                $sql['query'] = preg_replace('/\?/', $pdo->quote($binding), $sql['query'], 1);
            }
        }   

        return $sql['query'];
    }

}
