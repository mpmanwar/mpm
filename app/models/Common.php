<?php
class Common extends Eloquent {

	public $timestamps = false;
	
	public static function getGroupId($user_id)
	{
		$users	= User::where('user_id', '=', $user_id)->select("parent_id")->first();
    	if (isset($users) && count($users) >0 && $users['parent_id'] !=0) { 
    		$user_id = Common::getGroupId($users['parent_id']);   
		}
    	return $user_id;
	}

	public static function getUserIdByGroupId($group_id)
	{
		$groupUserId = array();
		$users = User::where("group_id", "=", $group_id)->select("user_id")->get();
		if(isset($users) && count($users) >0 ){
			foreach($users as $key=>$user_id){
				$groupUserId[$key]['user_id']	= $user_id->user_id;
			}
		}
		
		return $groupUserId;
	}

	public static function getUserAccess($user_id)
	{
		$user_access   = UserAccess::where("user_id", "=", $user_id)->where("access_id", "=", 5)->first();
        if(isset($user_access) && count($user_access) > 0){
            $return = 'Y';
        }else{
            $return = 'N';
        }

        return $return;
	}

	public static function getCompanyDetails($int)
	{
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, 'http://data.companieshouse.gov.uk/doc/company/' . $int . '.json'); 
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    curl_setopt($ch, CURLOPT_TIMEOUT, '10');
	    
	    $result = curl_exec($ch);
	    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    
	    curl_close($ch);
	    
	    switch($status)
	    {
	        case '200':
	            return json_decode($result);
	            break;
	        
	        default:
	            return false;
	            break;
	    }
	}

	public static function getDayCount($from)
	{
		$arr = explode('/', $from);
		$days = 0;
		if( $from != "" ){
			$date1 = $arr[2].'-'.$arr[1].'-'.$arr[0];
			$date2 = date("Y-m-d");
			//echo $date2;die;

			$diff = abs(strtotime($date2) - strtotime($date1));
			$days = round($diff/86400);
		}
		
		return $days;
	}

}
