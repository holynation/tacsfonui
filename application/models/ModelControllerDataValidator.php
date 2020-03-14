<?php 

/**
* The controller that validate forms that should be inserted into a table based on the request url.
each method wil have the structure validate[modelname]Data
*/
class ModelControllerDataValidator extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('webSessionManager');
	}

	public function validateDoctor_scheduleData(&$data,$type,&$message)
	{
		
		if(isset($data['available_days']) && !empty($data['available_days'])){
			$workDays = $data['available_days'];
			$dayJoin='';
			sort($workDays);
			$count = count($workDays);
			foreach($workDays as $key => $val){
				$dayJoin.= $val;
				if(($key+1) != $count){
					$dayJoin.= ",";
				}
			}
			$data['available_days'] = $dayJoin;
		}
		return true;
	}
}
 ?>