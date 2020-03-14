<?php 
	/**
	* This class contains  the method for performing extra action performed
	*/
	class ModelControllerCallback extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('webSessionManager');
			$this->load->helper('string');
			// $this->load->library('hash_created');
		}

		public function onDoctorInserted($data,$type,&$db,&$message)
		{
			//remember to remove the file if an error occured here
			//the user type should be doctor
			loadClass($this->load,'user');
			if ($type=='insert') {
				// this is to update an already user in the user table
					$param = array('user_type'=>'doctor','username'=>$data['email'],'password'=>md5(strtolower($data['first_name'])),'user_table_id'=>$data['LAST_INSERT_ID']);
					$std = new User($param);
					if ($std->insert($db,$message)) {
						return true;
					}
				echo "$message";exit;
				return false;
			}
			return true;
		}

		public function onAdminInserted($data,$type,&$db,&$message)
		{
			//remember to remove the file if an error occured here
			//the user type should be admin
			loadClass($this->load,'user');
			if ($type=='insert') {
				$param = array('user_type'=>'admin','username'=>$data['email'],'password'=>md5(strtolower($data['firstname'])),'user_table_id'=>$data['LAST_INSERT_ID']);
				$std = new User($param);
				if ($std->insert($db,$message)) {
					return true;
				}
				return false;
			}
			return true;
		}

			
	}

 ?>