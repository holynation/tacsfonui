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

	public function validateSliderData(&$data,$type,&$message)
	{
		if(isset($data)){
			return true;
		}
	}

	public function validateExcosData(&$data,$type,&$message){
		if($type == 'insert'){
			if($data['dob']) {
				$data['dob'] = formatToDateOnly($data['dob']);
			}
		}
		return true;
	}
}
 ?>