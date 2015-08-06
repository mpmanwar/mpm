<?php
class JobStatus extends Eloquent {

	public $timestamps = false;

	public static function getAllJobStatus()
	{
		$status_data = array();
		$JobStatus	= JobStatus::get();
		if(isset($JobStatus) && count($JobStatus) >0){
			foreach ($JobStatus as $key => $row) {
				$status_data[$key]['job_status_id'] = $row['job_status_id'];
				$status_data[$key]['client_id'] = $row['client_id'];
				$status_data[$key]['service_id'] = $row['service_id'];
				$status_data[$key]['status_id'] = $row['status_id'];
			}
		}
		return $status_data;
	}

	public static function getJobStatusByServiceId($service_id)
	{
		$status_data = array();
		$JobStatus	= JobStatus::where("service_id", "=", $service_id)->get();
		if(isset($JobStatus) && count($JobStatus) >0){
			foreach ($JobStatus as $key => $row) {
				$status_data[$key]['job_status_id'] = $row['job_status_id'];
				$status_data[$key]['client_id'] = $row['client_id'];
				$status_data[$key]['service_id'] = $row['service_id'];
				$status_data[$key]['status_id'] = $row['status_id'];
			}
		}
		return $status_data;
	}

	public static function getJobStatusByStatusId($service_id, $status_id)
	{
		$status_data = array();
		$JobStatus	= JobStatus::where("service_id","=",$service_id)->where("status_id","=",$status_id)->get();
		if(isset($JobStatus) && count($JobStatus) >0){
			foreach ($JobStatus as $key => $row) {
				$status_data[$key]['job_status_id'] = $row['job_status_id'];
				$status_data[$key]['client_id'] = $row['client_id'];
				$status_data[$key]['service_id'] = $row['service_id'];
				$status_data[$key]['status_id'] = $row['status_id'];
			}
		}
		return $status_data;
	}
	

	
}
