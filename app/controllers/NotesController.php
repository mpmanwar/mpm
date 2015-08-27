<?php
class NotesController extends BaseController {
	//staff notes//
	public function index(){
		$data['title'] = 'Notes';
		$data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
		$data['heading'] = "NOTES";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		
		

		//echo "<prev>".print_r($data['client_details']);die;
		return View::make('staff.notes.index', $data);
	}

	//staff notes//

    
    
    
    
    
    
    // org_notes//
    
    
    public function orgnotes(){
        
       	$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];
        $data=array();
     /*   $postData 		= Input::all();
       $data=array();
        //$data['title'] = 'Notes';
        //$data['heading'] = "NOTES";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];
       
        $client_id = $postData['client_id'];*/
        
        $notestitle = Input::get("notestitle");
         $notesmsg = Input::get("notesmsg");
        $client_id = Input::get("client_id");
        
        
        
        
        $data['title']=$notestitle;
        $data['textmessage']=$notesmsg;
        $data['client_id']=$client_id;
        $data['user_id']=$user_id;
        //$data['modified']=date("Y-m-d h:i:s");
        
        if (Request::ajax()) {
          $notes_id = OrgNotes::insertGetId($data);
        
        
        
        $data['orgdtails_notes'] = OrgNotes::where('orgnotes_id','=',$notes_id)->select("orgnotes_id","user_id","client_id","title","textmessage","created")->first();
        $user=$data['orgdtails_notes']['user_id'];
              // die();
               
        $data['user'] = User::where("user_id","=",$user)->select("fname", "lname","user_id")->first();  
        $data['inserted_id']=$notes_id;
        
        echo View::make('home.organisation.notesedit', $data);
       /*header('Content-Type: application/json; charset=utf-8');

            echo json_encode($data);
            exit;*/
        //echo $data;
        //echo $this->last_query();die();
         //print_r($data);die();
         
         //return Redirect::to('/organisation-clients');
         }
    
    }
    
    public function view_orgnotes(){
        
        $notesmsgid = Input::get("notesmsgid");
		if (Request::ajax()) {
		
        	$data['orgdtails_notes'] = OrgNotes::where('orgnotes_id','=',$notesmsgid)->select("orgnotes_id","user_id","client_id","title","textmessage","created")->first();
		  $user=$data['orgdtails_notes']['user_id'];
              // die();
               
        $data['user'] = User::where("user_id","=",$user)->select("fname", "lname","user_id")->first();  
        
        
         //echo View::make('hmrc.rsponce')->with('datares',$data['name']);
         
        echo View::make('home.organisation.notesedit', $data);
        	//echo $data;
		
        }
        
        
    }
    
    
    public function edit_orgnotes(){
        
        $data=array();
         $editnotesval = Input::get("editnotesval");
         $editnotesmsg = Input::get("editnotesmsg");
         $edited_id = Input::get("edited_id");
        $client_id = Input::get("client_id");
        
        //die();
        
        $data['title']=$editnotesval;
        $data['textmessage']=$editnotesmsg;
        $data['client_id']=$client_id;
      // $data['client_id']=date('m/d/Y h:i:s a', time());
       
        //$data['user_id']=$user_id;
        
        
        
		if (Request::ajax()) {
		
        	 
         $notes_id = OrgNotes::where("orgnotes_id","=",$edited_id)->update($data);
        
        $data['orgdtails_notes'] = OrgNotes::where('orgnotes_id','=',$edited_id)->select("orgnotes_id","user_id","client_id","title","textmessage","created")->first();
        $user=$data['orgdtails_notes']['user_id'];
              // die();
               
        $data['user'] = User::where("user_id","=",$user)->select("fname", "lname","user_id")->first();  
        
       // $data['inserted_id']=$edited_id;
        echo View::make('home.organisation.notesedit', $data);
        	//echo $data;
		
        }
         
        
         
    
    }
    
    public function deleteorg_notes(){
        
        
        
         
        $edited_id = Input::get("edited_id");
         $client_id = Input::get("client_id");
        
        if (Request::ajax()) {
		
        	 
         $notes_id = OrgNotes::where("orgnotes_id","=",$edited_id)->delete();
        
        $data['orgdtails_notes']=OrgNotes::where('client_id','=',$client_id)->select("orgnotes_id","user_id","client_id","title","textmessage","created")->orderBy('created', 'DESC')->first();
        $user=$data['orgdtails_notes']['user_id'];
              // die();
               
        $data['user'] = User::where("user_id","=",$user)->select("fname", "lname","user_id")->first();  
        
        
        echo View::make('home.organisation.notesedit', $data);
        	//echo $data;
		
        }
        
        
        
        
    }
    
    public function editmodeorg_notes(){
        
        $notesmsgid = Input::get("notesmsgid");
        
    if (Request::ajax()) {
		
        	$data['orgdtails_notes'] = OrgNotes::where('orgnotes_id','=',$notesmsgid)->select("orgnotes_id","user_id","client_id","title","textmessage","created")->first();
		  $user=$data['orgdtails_notes']['user_id'];
              // die();
               
        $data['user'] = User::where("user_id","=",$user)->select("fname", "lname","user_id")->first();  
        
        
         //echo View::make('hmrc.rsponce')->with('datares',$data['name']);
         
        echo View::make('home.organisation.notes', $data);
        	//echo $data;
		
        }
   
   
   
    }
    
    
    
    
    //

}
