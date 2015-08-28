<?php
class CronJobController extends BaseController
{
    public function jobs_email_client()
    {
        $service_id = 9;
        $details = JobsAutosendEmail::get();
        if(isset($details) && count($details) > 0){
            foreach ($details as $key => $value) {
                $service_id     = $value->service_id;
                $group_id       = Common::getGroupId($value->user_id);
                $groupUserId    = Common::getUserIdByGroupId($group_id);
                $client_details = StepsFieldsClient::whereIn("user_id", $groupUserId)->where('field_name', '=', "next_ret_due")->get();
                //echo $this->last_query();die;
                $auto_send = JobsAutosendEmail::getJobsAutosendEmailByServiceId($service_id);
                if(isset($client_details) && count($client_details) >0){
                    foreach ($client_details as $key => $client_value) {
                        $client_id = $client_value->client_id;
                        $crons = JobsCronjob::getJobsCronjobDetails($client_id, $service_id);

                    }
                }
            }
        }
    }




}
