<?php
class Position  extends Eloquent{
	
	public $timestamps = false;

	public static function getAllPositionTypeById( $id )
    {
        return Position::select("*")->where("position_id", $id)->get();
    }


}
