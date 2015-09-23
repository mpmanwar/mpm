<?php
class Checklist extends Eloquent{
	
	public $timestamps = false;

	public static function getAllChecklistTypeById( $id )
    {
        return Checklist::select("*")->where("checklist_id", $id)->get();
    }

    public static function get_checklist_by_client_id( $client_id )
    {
    	$data = array();
    	$session 		= Session::get('admin_details');
        $groupUserId 	= $session['group_users'];
        $details = Checklist::whereIn("user_id", $groupUserId)->where("client_id", $client_id)->get();
        if(isset($details) && count($details) >0){
        	foreach ($details as $key => $value) {
        		$data[$key]['checklist_id'] = $value->checklist_id;
        		$data[$key]['user_id'] 		= $value->user_id;
        		$data[$key]['client_id'] 	= $value->client_id;
        		$data[$key]['name'] 		= $value->name;
        		$data[$key]['status'] 		= $value->status;
        	}
        }
        return $data;
    }

    public static function get_checklist()
    {
    	$data = array();
    	$session 		= Session::get('admin_details');
        $groupUserId 	= $session['group_users'];
        $details = Checklist::whereIn("user_id", $groupUserId)->get();
        if(isset($details) && count($details) >0){
        	foreach ($details as $key => $value) {
        		$data[$key]['checklist_id'] = $value->checklist_id;
        		$data[$key]['user_id'] 		= $value->user_id;
        		$data[$key]['client_id'] 	= $value->client_id;
        		$data[$key]['name'] 		= $value->name;
        		$data[$key]['status'] 		= $value->status;
        	}
        }
        return $data;
    }


}
