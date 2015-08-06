<?php
class JobsStep extends Eloquent {

	public $timestamps = false;

	public static function getAllJobSteps()
	{
		$step_data = array();
		$JobStep	= JobsStep::orderBy("shorting_id")->get();
		if(isset($JobStep) && count($JobStep) >0){
			foreach ($JobStep as $key => $row) {
				$step_data[$key]['step_id'] 	= $row['step_id'];
				$step_data[$key]['user_id'] 	= $row['user_id'];
				$step_data[$key]['job_id'] 		= $row['job_id'];
				$step_data[$key]['shorting_id'] = $row['shorting_id'];
				$step_data[$key]['short_code'] 	= $row['short_code'];
				$step_data[$key]['title'] 		= $row['title'];
				$step_data[$key]['status'] 		= $row['status'];
				$step_data[$key]['step_type'] 	= $row['step_type'];
				$step_data[$key]['created'] 	= $row['created'];
			}
		}
		return $step_data;
	}

}
