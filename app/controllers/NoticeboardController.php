<?php
//opcache_reset ();
//Cache::forget('user_list');

class NoticeboardController extends BaseController {
    
    public function notice_board()
    {
        //die('NoticeboardController');
        	$data['heading'] = "Notice BOARD";
		$data['title'] = "Notice Board";
        
        
        
       //$data['user'] = User::select()->get();
        
        
        $data['user']= User::select("fname", "lname")->get();
        $arr = array();
        foreach($data['user'] as $key=>$val){
            
                $arr[$key]['fname'] = $this->getInitials($data['user'][$key]->fname);
                $arr[$key]['lname'] = $this->getInitials($data['user'][$key]->lname);
            
        }
        
        $data['username'] = $arr;
        
        
        
        
        return View::make('notice.noticeboard',$data);
       
    }
   public function getInitials($name) {
      $init = '';
      $name = explode(' ', $name);
      foreach ($name as $part) $init .= strtoupper(substr($part,0,1));
      return $init;
    }

    public function index_template() {
        
        //die('gjkgkgk');
        
        $data['heading'] = "Notice BOARD";
		$data['title'] = "Notice Board";
        //$data['practice_logo'] = "Notice BOARD";
        //$data['practice_name'] = "Notice BOARD";
        $session = Session::get('admin_details');
        $groupUserId = $session['group_users'];
        //$data['admin_name'] = "Notice BOARD";
        $data['user_id'] 			= $session['id'];

        
        $data['user']= User::select("fname", "lname")->get();
        $arr = array();
        foreach($data['user'] as $key=>$val){
            
                $arr[$key]['fname'] = $this->getInitials($data['user'][$key]->fname);
                $arr[$key]['lname'] = $this->getInitials($data['user'][$key]->lname);
            
        }
        
        $data['username'] = $arr;
        
        return View::make('notice.noticeboard',$data);
         //echo '<pre>';
         //print_r($data['user'][0]->fname);
         //die();
        
        
    }
    
    
    
    
    
    public function insert_noticeboard(){
        
        $postData = Input::all();
        echo "<pre>";print_r($postData);die();
        
    }
    
   public function notice_template(){
    
    $tmpl_data = array();
		$postData = Input::all();
        
        
        
        
        $session = Session::get('admin_details');
        $tmpl_data['user_id'] 			= $session['id'];
        
        $tmpl_data['typecatagory'] 	= $postData['typecatagory'];
        $tmpl_data['message'] 			= $postData['add_message'];
        
        $tmpl_data['message_subject'] 			= $postData['message_subject'];
        
        
        $tmpl_data['created'] 			= date("Y-m-d H:i:s");
        echo "<pre>";print_r($tmpl_data);die();
        
        
        
        
        $file = Input::file('add_file');
        $destinationPath = "uploads/noticeTemplates/";
    
   }
    
    
}
