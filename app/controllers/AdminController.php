<?php

class AdminController extends BaseController
{

    public function signup()
    {
        $data['title'] = "Sign Up";
        $data['coun'] 		= Country::select('country_name')->get();
        return View::make('admin/signup',$data);
    }


    public function signup_process()
    {
        //die('sign');
        if ($this->isPostRequest()) {
            $postData = Input::all();
            $messages = array(
                'fname.required'        => 'Please enter your first name',
                'email.required'        => 'Please enter your email/username',
                'password.required'     => 'Please enter your password',
                'confirmation_password.required'        => 'Please enter confirmation password',
                'confirmation_password.matchpassword'   => "confirmation password doesn't match"
            );
                
            //print_r($messages);die();
            $rules = array(
                'fname'         => 'required|alpha',
                'lname'         => 'required|alpha',
                'email' => 'required|email',
                'password'      => 'required',
                'confirmation_password' => 'required|same:password',
                'phone' => 'required'
                );
            $validator = Validator::make($postData, $rules, $messages);

            if ($validator->fails()) {
               return Redirect::to('/admin-signup')->withErrors($validator)->withInput();
            } else {
                $insert_data['first_name']      = $postData['fname'];
                $insert_data['last_name']       = $postData['lname'];
                $insert_data['practice_name']   = $postData['practicename'];
                $insert_data['email_address']   = $postData['email'];
                $insert_data['password']        = md5($postData['password']);
                $insert_data['phone']           = $postData['phone'];
                $insert_data['website']         = $postData['website'];
                $insert_data['country']         = $postData['country'];

                Admin::insert($insert_data);
                Session::flash('message', 'Yuo have successfully registered');
            }
                
            return Redirect::to('/admin-signup');
        }
    }

    public function login()
    {
        $data['title'] = "Login";
        return View::make('admin/login', $data);

    }


    public function login_process()
    {
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
                return Redirect::to('/')->withErrors($validator)->withInput();
            } else {
                $admin = Admin::where('email_address', $postData['userid'])->where('password', md5($postData['password']))->first();
                //echo $this->last_query();die;
                if (isset($admin) && count($admin) >0 ) {
                    Session::push('admin_details', $admin);
                    return Redirect::to('/dashboard');
                } else {
                    Session::flash('message', 'Your username/password doesn`t match');
                }
            }
        }
       
       return Redirect::to('/');
        
    }

    public function logout()
    {
        $value = Session::get('admin_details');
        //print_r($value);
        Session::forget('admin_details');
        //print_r($value);die;
        return Redirect::to('/');
    }


}
