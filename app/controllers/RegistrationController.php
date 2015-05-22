<?php

class RegistrationController extends BaseController
{

    public function registration()
    {
        
      
        $data['coun'] 		= Country::select('country_name')->get();
         
          //$countries= Country::select('country_name')->get();
        
        return View::make('register/signup',$data);
        
        
        

    }


    public function signup()
    {
        //die('sign');
        $data['title'] = "Register";
        if ($this->isPostRequest()) {


            $postData = Input::all();
            $messages = array(
                //'fname.required' => 'Please enter your first_name',
               
                //'email_address.required' => 'Please enter your username',
               
                'password.required' => 'You have to set a password',
                'confirmation_password.required' =>
                    'You have to set a confirmation_password',
                //'confirmation_password.matchpassword' => 'The two passwords does not match', // this is for the custom validatio that we have written
              
                );
                
                //print_r($messages);die();
            $rules = array(
               // 'email_address' => 'required|email_address',
                // 'fname' => 'required|alpha|min:5',
                //'lname' => 'required|alpha|min:5',

                'password' => 'required|min:5',
                'confirmation_password' => 'required|same:password',
                // 'phone' => 'required',
                );
            $validator = Validator::make($postData, $rules, $messages);

            if ($validator->fails()) {
               // die('if');
                //Session::flash('message', 'password doesnot match and password should be 5 digit)');
                return Redirect::to('/user-registration')->withErrors($validator)->withInput();
            } else {

               // die('else');
                $insert_data['first_name'] = $postData['fname'];

                $insert_data['last_name'] = $postData['lname'];

                $insert_data['practice_name'] = $postData['practicename'];

                $insert_data['email_address'] = $postData['email'];

                $insert_data['password'] = $postData['password'];


                $insert_data['phone'] = $postData['phone'];

                $insert_data['website'] = $postData['website'];

                $insert_data['country'] = $postData['country'];

                //print_r($insert_data);die();
                $db = DB::table('registrations')->insert($insert_data);

                Session::flash('message', 'Data successfully saved');
            }
                 return Redirect::to('/user-registration');
               //return View::make('register/signup', $data);
             //return View::make('register/register', $data);
           


        }
    }

    public function login()
    {
        //die('reg');
        $data['title'] = "Login";
        return View::make('register/login', $data);

    }


    public function log()
    {
        // die('log');


        $data['title'] = "Login";
        if ($this->isPostRequest()) {

            $postData = Input::all();
            $messages = array(
                "userid.required" => "Please enter your userid",
                "password.required" => "Please enter your password",
                );
            //print_r($messages);die();

            $rules = array(
                "userid" => "required",
                "password" => "required",
                );
            // print_r($rules);die();
            $validator = Validator::make($postData, $rules, $messages);

            if ($validator->fails()) {
                //die('if');
                //Session::flash('message', 'Please enter your userid/password ');
                return Redirect::to('/user-login')->withErrors($validator)->withInput();
            } else {
                //die('else');
                $user = DB::table('registrations')->where('email_address', $postData['userid'])->
                    where('password', $postData['password'])->get();
                //print_r($user);die();

                if (isset($user[0]->email_address) && $user[0]->email_address != "") {
                    Session::push('session_user', $user[0]);
                    $value = Session::get('session_user');

                    $data['title'] = "Dashboard";
                    // die('data');
                    return Redirect::to('/');
                } else {
                    //die('else');
                    //return Redirect::to('/user-login');
                    Session::flash('message', 'Your username/password doesn`t match');
                }
            }
        }
       // $data['title'] = "Login";
       return Redirect::to('/user-login');
        //return View::make('register/login', $data);

    }
    
    public function countries(){
        
       //die('countries');
       
                  
           $countries= Country::select('country_name')->get();
            
            
             foreach($countries as $eachCoun){

                   echo $dt = $eachCoun->country_name;

                    }
                   // print_r($dt);
           
                
        die();
           
           
    }


    /*

    {
    //die('log');
    $postData = Input::all();

    $data = array();

    $userid = $postData['userid'];
    $password = $postData['password'];


    $user = Registration::where('password', '=', $password)->Where('email_address',
    '=', $userid)->get();
    
    $session = Session::put('key', $user);
    
    // print_r($session);


    if ($session) {
    
    die('if');
    
    $data['title'] = "Dashboard";
    return View::make('home.dashboard', $data);

    } else {
    
    die('else');
    
    $data['title'] = "Login";
    return View::make('register/login', $data);


    }
    die();

    }
    */

    /* old reg

    //die('sign');
    $postData = Input::all();
    $data = array();
    //print_r ($postData);die();

    $data['first_name'] = $postData['fname'];

    $data['last_name'] = $postData['lname'];

    $data['practice_name'] = $postData['practicename'];

    $data['email_address'] = $postData['email'];

    $data['password'] = $postData['password'];


    $data['phone'] = $postData['phone'];

    $data['website'] = $postData['website'];

    $data['country'] = $postData['country'];

    Registration::insert($data);

    
    $data['title'] = "Login";
    return View::make('register/login', $data);
    //print_r($data);
    //die();

    */


}
