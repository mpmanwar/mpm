<?php
class ChdataController extends BaseController {
	
	public function index()
	{//phpinfo();die;
		$data = array();
		$numbers = CompanyNumber::orderBy("cn_id")->get();
		if(isset($numbers) && count($numbers) >0 ){
			foreach ($numbers as $key => $row) {
				$data[$key]['details'] = $this->getCompanyDetails($row->number);
				print_r($data[$key]['details']);die;
			}
		}

		//print_r($data);
	}

	public function getCompanyDetails($int)
	{
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, 'http://data.companieshouse.gov.uk/doc/company/' . $int . '.json'); 
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    curl_setopt($ch, CURLOPT_TIMEOUT, '10');
	    
	    $result = curl_exec($ch);
	    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    
	    curl_close($ch);
	    
	    switch($status)
	    {
	        case '200':
	            return json_decode($result);
	            break;
	        
	        default:
	            return false;
	            break;
	    }
	}

}
