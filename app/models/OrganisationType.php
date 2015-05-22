<?php
class OrganisationType  extends Eloquent{
	
	public $timestamps = false;

	public static function getAllOrganizationTypeById( $id )
    {
        return OrganizationType::select("*")->where("organisation_id", $id)->get();
    }


}
