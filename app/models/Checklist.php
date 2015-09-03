<?php
class Checklist extends Eloquent{
	
	public $timestamps = false;

	public static function getAllChecklistTypeById( $id )
    {
        return Checklist::select("*")->where("checklist_id", $id)->get();
    }


}
