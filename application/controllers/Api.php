<?php 
	/**
	* This class like other controller for handling api
	*/
	class Api extends CI_Controller
	{
		function __construct()
		{
			echo "got here";exit;
			parent::__construct();
			$this->load->model('crud');
			$this->load->model('webSessionManager');
			$this->load->helper('string');
	    	$this->load->helper('array');
	    	$this->load->model('entities/user');

	    	// using this to know if request was coming from react client
			if(strpos(@$_SERVER['PATH_INFO'], 'api') !== FALSE || strpos(@$_SERVER['ORIG_PATH_INFO'], 'api') !== FALSE){
				header("Content-Type:application/json");
			}
		}

		/********************************************
		| using this for react js controller
	    *********************************************/

	    // TODO: thinking of add the jwt for authentication in this react application for security purposes

	    private function validateWebApiAccess($value='')
		{
			loadClass($this->load,'member');
			$id = $this->webSessionManager->getCurrentUserProp('user_table_id');
			$temp  = new Member(array('ID'=>$id));
			if (!$temp->load() || !$temp->status) {
				return false;
			}
			$ttemp=(object)$temp->toArray();
			$_SERVER['current_user']=$ttemp;
			return $this->webSessionManager->isSessionActive();
		}


	    public function webpi($entity)
		{
			echo "got here";exit;
			// if (!$this->validateWebApiAccess()) {
			// 	http_response_code(405);
			// 	displayJson(false,'denied');
			// 	redirect('/auth/login');
			// 	return;
			// }
			$dictionary = getEntityTranslation();
			$method = array_key_exists($entity, $dictionary)?$dictionary[$entity]:$entity;
			$entities = listEntities($this->db);
			$args = array_slice(func_get_args(),1);
			// this check if the method is equivalent to any entity model to get it equiv result
			if (in_array($method, $entities)) {
				$this->load->model('entityModel');
				$this->entityModel->process($method,$args);
				return;
			}
			//define the set of methods in another model called WebApiMOdel
			$this->load->model('webApiModel');
			if (method_exists($this->webApiModel, $entity)) {
				$this->webApiModel->$entity($args);
				return;
			}else{
				//method no dey exist for this place 00
				http_response_code(405);
				displayJson(false,'denied');
				return;
			}
			
		}
	}
 ?>