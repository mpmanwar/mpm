<?php

class AdminController extends BaseController
{

    public function signup()
    {
        $data['title'] = "Sign Up";
        $data['coun'] 		= Country::where("country_id", "!=", 1)->orderBy('country_name')->get();
       // $data['coun'] 		= Country::select('country_name')->get();
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
                Session::flash('message', 'You have successfully registered');
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
                $arr['first_name']=$admin->first_name;
                $arr['last_name']=$admin->last_name;
                $arr['practice_name']=$admin->practice_name;
                $arr['email_address']=$admin->email_address;
                $arr['phone']=$admin->phone;
                $arr['website']=$admin->website;
                $arr['country']=$admin->country;
                 
       
                 
                 //echo $admin['first_name'];die();
                 
               // print_r( $admin);
               //die();
                //echo $this->last_query();die;
                if (isset($arr) && count($arr) >0 ) {
                    
                    
                    Session::put('admin_details', $arr);
                    
                    
                      //$admin_s =  Session::get('admin_details');
                      //echo "Name :".$admin_s->first_name;
                      //print_r($admin_s);die;
                     
                      
                      
                     
                     //print"<pre>"; print_r($admin_s);die();
                      
                      //echo json_encode($admin);die();
                     
                     
                    
                  // echo "<pre>";print_r(Session::get('admin_details'));die();
                   
                    
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
    
    
    public function forgot_password(){
        
        return View::make('admin/password');
        
    }
    
    public function password_send(){
        
        
         $usr_data = array();
         $postData = Input::all();
         
         $usr_data['email']=$postData['userid'];
         
         
         //print_r($postData['userid']);die();
         $admin = Admin::where('email_address',$usr_data['email'])->first();
      
        
         if ($admin){
            //die('if');
            $usr_data['newpass'] = str_random(8);
            
            $data = array(
			
			'password' => md5($usr_data['newpass']),
            );
            
            //print_r($data);die();
            
            Admin::where('email_address', '=', $usr_data['email'])->update($data);
            
            //print_r($usr_data['newpass']);die();
         
            $this->send_mail($usr_data);
            Session::flash('message', 'The new password has been sent to your email.');
           	return Redirect::to('/forgot-password');
            
         }else{
            //die('else');
            	Session::flash('message_error', 'Your username/password doesn`t match');
                return Redirect::to('/forgot-password');
            //die('else');
         }
         
        
    }
    
    
    
    private function send_mail($data)
	{
	   
       		Mail::send('emails.password_admin', $data, function($message) use ($data) {
            $message->from('anwar.khan@appsbee.com', 'MPM');
            
            $message->to($data['email'])->subject("Welcome to MPM");
            
            
        });
	}
    public function adminprofile(){
       // die('fsfs');
       	$data['title'] = "Profile";
        return View::make('admin/profile',$data);
    
}
 public function change_password(){
    die(' public function');
 }
 
 
  public function new_pass(){
    
      $postData = Input::all();
      
      
      
     
         print_r($postData);
    die('change_pass');
    //return View::make('admin/change_password');
    
 }

}


/*
 public function password_send(){
        
        
          //$hash       = random_string('alnum', 5);
         	$usr_data = array();
         $postData = Input::all();
         
         $usr_data['email']=$postData['userid'];
         
         
         //print_r($postData['userid']);die();
         $admin = Admin::where('email_address',$usr_data['email'])->first();
      
        
         if ($admin){
            //die('if');
            $usr_data['newpass'] = str_random(8);
            //print_r($usr_data['newpass']);die();
         
            $this->send_mail($usr_data);
            Session::flash('message', 'The new password has been sent to your email.');
           	return Redirect::to('/forgot-password');
            
         }else{
            //die('else');
            	Session::flash('message_error', 'Your username/password doesn`t match');
                return Redirect::to('/forgot-password');
            //die('else');
         }
         
        
    }
    
*/
