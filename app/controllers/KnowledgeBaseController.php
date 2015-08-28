<?php
class KnowledgeBaseController extends BaseController {
	//staff notes//
	public function index(){
		$data['title'] = 'Knowledge Base';
		//$data['previous_page'] = '<a href="/staff-profile">Staff Profile</a>';
		$data['heading'] = "KNOWLEDGE BASE";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}
        
        $data['staffprof_notes']=Knowledgebase::where("user_id","=",$user_id)->select("knowledgebase_id","user_id","title","textmessage","created")->orderBy('created', 'DESC')->first();
        
        $data['knowledge_notes']=Knowledgebase::where("user_id","=",$user_id)->select("knowledgebase_id","user_id","title","textmessage","created")->orderBy('created', 'DESC')->get();
        
        
      //$data['staffprof_notes']=Knowledgebase::where("user_id","=",$user_id)->select("knowledgebase_id","user_id","title","textmessage","created")->orderBy('created', 'DESC')->first();
        
        
        
        
        $data['user'] = User::where("user_id","=",$user_id)->select("fname", "lname","user_id")->first();   
		
		

		//echo "<prev>".print_r($data['staffprof_notes']);die;
		return View::make('knowledgebase.index', $data);
	}
    
    public function knowledgebase_notesinsert(){
        
        
        
       	$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];
        $data=array();
     
        $notestitle = Input::get("notestitle");
         $notesmsg = Input::get("notesmsg");
       
        
        $data['title']=$notestitle;
        $data['textmessage']=$notesmsg;
        
        $data['user_id']=$user_id;
        //$data['modified']=date("Y-m-d h:i:s");
        
        if (Request::ajax()) {
          $notes_id = Knowledgebase::insertGetId($data);
        
        
        
        $data['knowledge_notes'] = Knowledgebase::where('knowledgebase_id','=',$notes_id)->select("knowledgebase_id","user_id","title","textmessage","created")->first();
        $user=$data['knowledge_notes']['user_id'];
              // die();
               
        $data['user'] = User::where("user_id","=",$user)->select("fname", "lname","user_id")->first();  
        $data['inserted_id']=$notes_id;
        
        echo View::make('knowledgebase.notesedit', $data);
       
         }
    
    
    }
    
    /*public function editmodekbase_notes(){
        
        
        $notesmsgid = Input::get("notesmsgid");
		if (Request::ajax()) {
		
        	$data['staffprof_notes'] = Knowledgebase::where('knowledgebase_id','=',$notesmsgid)->select("knowledgebase_id","user_id","title","textmessage","created")->first();
		  $user=$data['staffprof_notes']['user_id'];
              // die();
               
        $data['user'] = User::where("user_id","=",$user)->select("fname", "lname","user_id")->first();  
        
        
         //echo View::make('hmrc.rsponce')->with('datares',$data['name']);
         
        echo View::make('staff.notes.notesedit', $data);
        	//echo $data;
		
        }    
        
        
        
    }
    */
    
    

}
