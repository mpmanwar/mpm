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
        
        
        $postData 		= Input::all();
       $data=array();
        //$data['title'] = 'Notes';
        //$data['heading'] = "NOTES";
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];
       
        $client_id = $postData['client_id'];
        
        $data['title']=$postData['notestitle'];
        $data['textmessage']=$postData['notesmsg'];
        $data['client_id']=$client_id;
        $data['user_id']=$user_id;
        
         $notes_id = OrgNotes::insertGetId($data);
         //print_r($data);die();
         
         return Redirect::to('/organisation-clients');
         
    
    }
    
    public function view_orgnotes(){
        
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
