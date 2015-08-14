<?php
class User extends Eloquent {

	public $timestamps = false;
	public static function getStaffNameById($staff_id)
	{
		$details = User::where("user_id", "=", $staff_id)->select("fname", "lname")->first();
		$name = "";
		if(!empty($details['fname'])){
			$name.=$details['fname'];
		}
		if(!empty($details['lname'])){
			$name.=" ".$details['lname'];
		}
		return $name;
	}
}
