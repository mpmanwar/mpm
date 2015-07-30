<?php
class Department  extends Eloquent{
	
	public $timestamps = false;

	public static function getAllDepartmentTypeById( $id )
    {
        return Department::select("*")->where("department_id", $id)->get();
    }


}
