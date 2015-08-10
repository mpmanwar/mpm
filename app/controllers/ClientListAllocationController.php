<?php
class ClientListAllocationController extends BaseController {
	
	public function index($service_id, $client_type){
		$client_type = base64_decode($client_type);
		$data['client_type'] 	= $client_type;
		$data['service_id']		= $service_id;
		//echo $client_type;die;
		$data['title'] = 'Client List Allocation';
		$data['previous_page'] = '<a href="/settings-dashboard">Settings</a>';
		$data['heading'] = "CLIENT LIST ALLOCATION";

		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		if (empty($user_id)) {
			return Redirect::to('/');
		}

		$data['staff_details'] 	= User::whereIn("user_id", $groupUserId)->where("client_id", "=", 0)->select("user_id", "fname", "lname")->get();
		$data['old_services'] 	= Service::where("status", "=", "old")->orderBy("service_name")->get();
		$data['new_services'] 	= Service::where("status", "=", "new")->whereIn("user_id", $groupUserId)->orderBy("service_name")->get();

		if($data['client_type'] == "org"){
			if($data['service_id'] == 0){
				$data['org_client_details'] = array();
			}else{
				$data['org_client_details'] 	=   Client::getAllOrgClientDetails();
			}
			
		}else{
			$data['ind_client_details'] 	=   Client::getAllIndClientDetails();
		}

		//echo "<prev>".print_r($data['org_client_details']);die;
		return View::make('settings.client_list_allication.index', $data);
	}


	public function search_allocation_clients()
	{
		$admin_s = Session::get('admin_details');
		$user_id = $admin_s['id'];
		$groupUserId = $admin_s['group_users'];

		$data = array();
		$data['client_type'] 	= Input::get("client_type");
		$data['service_id']		= Input::get("service_id");

		if($data['client_type'] == "org"){
			$data['org_client_details'] 	=   Client::getAllOrgClientDetails();
		}else{
			$data['ind_client_details'] 	=   Client::getAllIndClientDetails();
		}
		$data['staff_details'] 	= User::whereIn("user_id", $groupUserId)->where("client_id", "=", 0)->select("user_id", "fname", "lname")->get();

		//echo View::make("settings.client_list_allication.ajax_org_allocation", $data);

		echo View::make("settings.client_list_allication.search_allocation_list", $data);
	}

	public function allocationClientsByService()
	{
		$client_type = base64_encode(Input::get('type'));
		if(Input::get('type') == "org"){
			$service_id = Input::get("org_service_id");
		}else{
			$service_id = Input::get("ind_service_id");
		}
		return Redirect::to('/client-list-allocation/'.$service_id.'/'.$client_type);
	}

	public function save_bulk_allocation()
	{
		$insrtdata = array();
		$staff_id		= Input::get("staff_id");
		$column			= Input::get("column");
		$service_id		= Input::get("service_id");
		$client_type	= Input::get("client_type");
		$client_array	= Input::get("client_array");

		if(isset($client_array) && count($client_array) >0){
			foreach ($client_array as $client_id) {
				$list = ClientListAllocation::where("client_id", "=", $client_id)->where("service_id", "=", $service_id)->first();
				if(isset($list) && count($list) >0){
					$updateData['staff_id'.$column] = $staff_id;
					ClientListAllocation::where("client_allocation_id", "=", $list['client_allocation_id'])->update($updateData);
				}else{
					$allocData[] = array(
						'client_type' 		=> $client_type,
						'client_id' 		=> $client_id,
						'service_id' 		=> $service_id,
						'staff_id'.$column 	=> $staff_id,
					);
				}
				
			}
			if(isset($allocData) && count($allocData) >0){
				ClientListAllocation::insert($allocData);
			}
			
		}
		echo 1;

	}

	public function save_manual_staff()
	{
		$insrtdata = array();
		$staff_id		= Input::get("staff_id");
		$column			= Input::get("column");
		$service_id		= Input::get("service_id");
		$client_type	= Input::get("client_type");
		$client_id		= Input::get("client_id");

		$list = ClientListAllocation::where("client_id", "=", $client_id)->where("service_id", "=", $service_id)->first();
		if(isset($list) && count($list) >0){
			$updateData['staff_id'.$column] = $staff_id;
			ClientListAllocation::where("client_allocation_id", "=", $list['client_allocation_id'])->update($updateData);
		}else{
			$allocData[] = array(
				'client_type' 		=> $client_type,
				'client_id' 		=> $client_id,
				'service_id' 		=> $service_id,
				'staff_id'.$column 	=> $staff_id,
			);
			ClientListAllocation::insert($allocData);
		}

		echo 1;

	}

	public function edit_service_id()
	{
		$action_type	= Input::get("action_type");
		$service_id		= Input::get("service_id");
		$client_id		= Input::get("client_id");
		if($action_type == "add"){
			$servData[] = array(
				'client_id' 		=> $client_id,
				'service_id' 		=> $service_id,
			);
			ClientService::insert($servData);
		}else{
			ClientService::where("client_id", "=", $client_id)->where("service_id", "=", $service_id)->delete();
		}
		echo 1;
	}



	
    

}
