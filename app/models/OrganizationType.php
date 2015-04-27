<?php
class OrganizationType  extends Eloquent{
	
	protected $table = 'organisation_types';
	public $timestamps = false;

	public static function getAllOrganizationTypeById( $id )
    {
        return OrganizationType::select("*")->where("organisation_id", $id)->get();
    }


}
