Array
(
    [0] => Array
        (
            [client_id] => 2
            [cont_addr_line1] => Array
                (
                    [81] => KOLKATA
                    [82] => AIRPORT
                )

        )

    [1] => Array
        (
            [client_id] => 28
            [cont_addr_line1] => Array
                (
                    [28] => AD1
                    [29] => AD2
                )

        )

    [2] => Array
        (
            [client_id] => 29
            [cont_addr_line1] => Array
                (
                    [28] => AD1
                    [29] => AD2
                )

        )

    [3] => Array
        (
            [client_id] => 30
            [cont_addr_line1] => Array
                (
                    [28] => AD1
                    [29] => AD2
                )

        )

    [4] => Array
        (
            [client_id] => 31
            [cont_addr_line1] => Array
                (
                    [28] => AD1
                    [29] => AD2
                )

        )

    [5] => Array
        (
            [client_id] => 32
            [cont_addr_line1] => Array
                (
                    [28] => AD1
                    [29] => AD2
                )

        )
        
        
        
        	public function get_contact_address() {
		$client_data = array();

		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
		$groupUserId = $admin_s['group_users'];

		$client_ids = Client::where('type', '=', "org")->whereIn('user_id', $groupUserId)->select("client_id")->get();
		//echo $this->last_query();die;
		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
			foreach ($client_ids as $client_id) {
			 $client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
             
             
              
				$client_data[$i]['client_id'] = $client_id->client_id;
				//echo $this->last_query();die;

				if (isset($client_details) && count($client_details) > 0) {
				    $k=0;
					foreach ($client_details as $client_row) {
						if (isset($client_row['field_name']) && ($client_row['field_name'] == "res_addr_line1" || $client_row['field_name'] == "res_addr_line2")) //corres_cont_addr_line2
                        
                        
                        {
						 $client_data[$i]['cont_addr_line1'][$k] = $client_row['field_value'];
                        // $client_data[$i]['cont_addr_line2'] = $client_row['field_value'];
                          
						}
                        $k++;
					}

					
                           
				}
                $i++;
			}
		}
		//echo "<pre>";print_r($client_data);die;
		return $client_data;
	}

)





















public function get_contact_address() {
		$client_data = array();

		$admin_s = Session::get('admin_details'); // session
		$user_id = $admin_s['id']; //session user id
        
		$groupUserId = $admin_s['group_users'];

		$client_ids = Client::where('type', '=', "org")->whereIn('user_id', $groupUserId)->select("client_id")->get();
		//echo $this->last_query();die;
		$i = 0;
		if (isset($client_ids) && count($client_ids) > 0) {
			foreach ($client_ids as $client_id) {
			 $client_details = StepsFieldsClient::where('client_id', '=', $client_id->client_id)->select("field_id", "field_name", "field_value")->get();
				$client_data[$i]['client_id'] = $client_id->client_id;
				//echo $this->last_query();die;

				if (isset($client_details) && count($client_details) > 0) {
					foreach ($client_details as $client_row) {
						if (isset($client_row['field_name']) && ($client_row['field_name'] == "res_addr_line2" || $client_row['field_name'] == "res_addr_line2")) //corres_cont_addr_line2
                        
                        
                        {
                                                        
						echo  $client_data[$i]['cont_addr_line1'] = $client_row['field_value'];
                         
                          
						}
					}
                     
					$i++;
                          
				}
			}
		}
		//print_r($client_data);die;
		return $client_data;
	}