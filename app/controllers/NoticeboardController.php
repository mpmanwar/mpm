<?php
//opcache_reset ();
//Cache::forget('user_list');

class NoticeboardController extends BaseController {
    
    public function notice_board()
    {
        //die('NoticeboardController');
        	$data['heading'] = "Notice BOARD";
		$data['title'] = "Notice Board";
        
       $data['user'] = User::select()->get();
        
        
        
        
        
        
        return View::make('notice.noticeboard',$data);
       
    }
    
    public function insert_noticeboard(){
        
        $postData = Input::all();
        echo "<pre>";print_r($postData);die();
        
    }
    
    
}
