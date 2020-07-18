<?php 
/**
|	Helper class for generating the right directory for the upload process 
|	based on the model the entity is using.
|	Thus, it is useful for dynamic naming of directory for a model
*/
class UploadDirectoryManager extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function getAdminDirectory($parameter){
		$result = "admin/";
		return $result;
	}
}
 ?>