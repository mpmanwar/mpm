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
        
        $admin_s = Session::get('admin_details');
//echo $admin_s['user_type'];die;
        //print_r($admin_s);die;
        if(isset($admin_s) && count($admin_s) >0 ){
            View::share('id', $admin_s['id']);
            View::share('user_type', $admin_s['user_type']);
            View::share('admin_name', $admin_s['first_name']." ".$admin_s['last_name']);
            $practice_details   = PracticeDetail::where("practice_id", "=", $admin_s['id'])->first();
            View::share('practice_name', $practice_details['display_name']);
            if (File::exists("practice_logo/".$practice_details['practice_logo']) && $practice_details['practice_logo'] != ""){
                $practice_logo = "<img src='/practice_logo/".$practice_details['practice_logo']."' class='browse_img' width='40'>";
            }else{
                $practice_logo = "";
            }
            View::share('practice_logo', $practice_logo);

            $user_access   = UserAccess::where("user_id", "=", $admin_s['id'])->where("access_id", "=", 5)->first();
            if(isset($user_access) && count($user_access) > 0){
                View::share('manage_user', 'Y');
            }else{
                View::share('manage_user', 'N');
            }


        }

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
