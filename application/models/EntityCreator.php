<?php
/**
* The model for performing update, insert and delete for entities
*/

class EntityCreator extends CI_Model
{
	public $outputResult = true;
	private $_rootUploadsDirectory = "uploads/";

	function __construct()
	{
		parent::__construct();
		// $this->load->model('accessControl');//for authentication authorization validation
		// $this->load->model('entities/application_log');
		$this->load->model('modelControllerDataValidator');
		$this->load->model('webSessionManager');
		$this->load->model('modelControllerCallback');
		// $this->checkPermission();
	}
	private function checkPermission(){
		return true;
		//check that the user has permission to modify
		$cookie = getPageCookie();
		if (!in_array($this->webSessionManager->getCurrentUserProp('user_type'), array('student','admin','lecturer')) && @!$this->role->canModify($cookie[0],$cookie[1])) {
		  # who the access denied page.
			if (isset($_GET['a']) && $_GET['a']) {
				displayJson(false,'you do not  have permission to perform this action');exit;
			}
		  show_operation_denied($this->load);
		}
	}

	function add($model,$filter=false,$parent=''){//the parent field is optional
		try{
			if (empty($model)) { //make sure empty value for model is not allowed.
				displayJson(false,'an error occured while processing information');
				return;

			}
			unset($_POST['MAX_FILE_SIZE']);
			// $this->log($model,"inserting $model");
			return $this->insertSingle($model,$filter);
		}
		catch(Exception $ex){
			// echo $ex->getMessage();
			$this->db->trans_rollback();
			displayJson(false,$ex->getMessage());
		}

	}


	//this function will return the last auto generated id of the last insert statement
	private function getLastInsertId(){
		return getLastInsertId($this->db);
	}
	private function DoAfterInsertion($model,$type,$data,&$db,&$message='',&$payload=array()){
		$method = 'on'.ucfirst($model).'Inserted';
		if (method_exists($this->modelControllerCallback, $method)) {
			return $this->modelControllerCallback->$method($data,$type,$db,$message,$payload);
		}
		return true;
	}

// the message variable will give the eror message if there is an error and the variable is passed
	private function validateModelData($model,$type,&$data,&$message=''){
		$method = 'validate'.ucfirst($model).'Data';
		if (method_exists($this->modelControllerDataValidator, $method)) {
			$result =$this->modelControllerDataValidator->$method($data,$type,$message);
			return $result;
		}
		return true;
	}

	private function validateModels($method,&$message){
		$arr = json_decode($jsonEncode,true);
		$keys = array_keys($arr);
		$allGood = $this->isAllModel($keys,$method,$message);
		if ($allGood) {
			return $arr;
		}
		return false;
	}

	private function isAllModel($keys,$method,$message){
		for ($i=0; $i < count($keys); $i++) {
			$model = $keys[$i];
			if (!$this->isModel($model) ) {
				$message ="$model is not a valid model";
				return false;
			}
			// if (!$this->accessControl->moduleAccess($model,$method)) {
			// 	$message="access denied";
			// 	return false;
			// }
		}
		return true;
	}

	private function  insertSingle($model){
		$this->modelCheck($model,'c');
		$message ='';
		$data = $this->input->post(null,true);
		if(!empty($_FILES)){
			$data = $this->processFormUpload($model,$data,false);
		}
		if (in_array('password', array_keys($data))) {
			$data['password']=@password_hash($data['password'], PASSWORD_DEFAULT);
		}
		$this->load->model("entities/$model");
		$parameter = $this->extractSubset($data,$model);
		$parameter = removeEmptyAssoc($parameter);

		if ($this->validateModelData($model,'insert',$parameter,$message)==false) {
			if (!$this->outputResult) {
				return false;
			}
			displayJson(false,$message);
			return;
		}

		// needed to separate them so that i can set the model param and to be use in validation
		$this->$model->setArray($parameter);
		if (!$this->validateModel($model,$message)) {
			if (!$this->outputResult) {
				return false;
			}
			displayJson(false,$message);
			return;
		}

		$message = '';
		$this->db->trans_begin();
		if($this->$model->insert($this->db,$message)){
			$inserted = $this->getLastInsertId($this->db);
			$data['LAST_INSERT_ID']= $inserted;
			if($this->DoAfterInsertion($model,'insert',$data,$this->db,$message,$payload)){
				$this->db->trans_commit();
				$message = empty($message)?'operation successfull ':$message;
				if (!$this->outputResult) {
				return true;
			}
				displayJson(true,$message,$inserted);
				// $this->log($model,"inserted new $model information");//log the activity
				return;
			}
		}
		$this->db->trans_rollback();
		$message = empty($message)?"an error occured while saving information":$message;
		if (!$this->outputResult) {
				return false;
		}
		displayJson(false,$message);
		// $this->log($model,"unable to insert $model information");
	}

	private function log($model,$description){
		$this->application_log->log($model,$description);
	}

	function update($model,$id='',$filter=false,$param=false){
		if (empty($id) || empty($model)) {
			if (!$this->outputResult) {
				return false;
			}
			displayJson(false,'an error occured while processing information');
			return;
		}
		return $this->updateSingle($model,$id,__METHOD__,$filter,$param);
	}

	private function updateSingle($model,$id,$method,$filter=false,$param=false){
		$this->modelCheck($model,'u');
		$this->load->model("entities/$model");
		$data = $param?$param:$this->input->post(null,true);
		if(!empty($_FILES)){
			$data = $this->processFormUpload($model,$data,$id);
		}
		//pass in the value needed by the model itself and discard the rest.
		$parameter = $this->extractSubset($data,$model);
		
		$this->db->trans_begin();
		$parameter['ID']=$id;
		if (!$this->validateModelData($model,'update',$parameter,$message)){
			displayJson(false,$message);
			return ;
		} 
		$this->$model->setArray($parameter);
		if ($this->$model->update($id,$this->db)) {
			$data['ID']=$id;
			if($this->DoAfterInsertion($model,'update',$data,$this->db,$message,$payload)){
				$inserted = !empty($payload) ? $payload : false;
				$this->db->trans_commit();
				$message = empty($message)?'operation successfull':$message;
				if (!$this->outputResult) {
					return true;
				}
				displayJson(true,$message,$inserted);
				return;
			}
			else{
				$this->db->trans_rollback();
				if (!$this->outputResult) {
					return false;
				}
				 displayJson(false,$message);
				return ;
			}
		}
		else{
			$this->db->trans_rollback();
			if (!$this->outputResult) {
				return false;
			}
			displayJson(false,$message);
			return ;
		}
	}

//innplement deleter where function here.
	function delete($model,$id=''){
		if (isset($_POST['ID'])) {
			$id = $_POST['ID'];
		}
		if (empty($id)) {
			return false;
		}

		$this->modelCheck($model,'d');
		$this->load->model("entities/$model");
		return $this->$model->delete($id);
		if ($this->$model->delete($id)) {
			// echo createJsonMessage('status',true,'message','information deleted successfully');
			displayJson(true,'information deleted successfully');
		}
		else{
			displayJson(false,'error occured while deleting information');
		}
	}
	
	private function modelCheck($model,$method){
		if (!$this->isModel($model)) {
			displayJson(false,'error occured while deleting information');
			exit;
		}
	}
	//this function checks if the argument id actually  a model
	private function isModel($model){
		$this->load->model("entities/$model");
		if (!empty($model) && $this->$model instanceof Crud) {
			return true;
		}
		return false;
	}
	//check that the algorithm fit and that required data are not empty
	private function validateModel($model,&$message){
		return $this->$model->validateInsert($message);
	}
		//function to extract a subset of fields from a particular field
	private function extractSubset($array, $model){
		//check that the model is instance of crud
		//take care of user upload substitute the necessary value for the username
		//dont specify username directly
		
		$result =array();
		if ($this->$model instanceof $this->crud) {
			$keys = array_keys($model::$labelArray);
			$valueKeys = array_keys($array);
			$temp =array_intersect($valueKeys, $keys);
			foreach ($temp as $value) {
				$result[$value]= $array[$value];
			}
		}
		return $result;
	}

	//this function is used to  document
	private function processFormUpload($model,$parameter,$insertType=false){
		$paramFile= $model::$documentField;
		$fields = array_keys($_FILES);
		if (empty($paramFile) || empty($_FILES)) {
			return $parameter;
		}
		foreach ($paramFile as $name => $value) {
			// $this->log($model,"uploading file $name");
			if (in_array($name, $fields)) {//if the field name is present in the fields the upload the document
				// list($type,$size,$directory) = $value;
				// list($type,$size,$directory,$preserve,@$max_width,@$max_height) = $value;
				// this is a precaution if no keys of this name are not set in the array
				$preserve=false;
				$max_width = 0;
				$max_height = 0;
				$directory="";
				extract($value);


				$method ="get".ucfirst($model)."Directory";
				$this->load->model('uploadDirectoryManager');
				if (method_exists($this->uploadDirectoryManager, $method)) {
					$dir  = $this->uploadDirectoryManager->$method($parameter);
					if ($dir===false) {
						showUploadErrorMessage($this->webSessionManager,"Error while uploading file",false);
					}
					$directory.=$dir;
				}
				$currentUpload = $this->uploadFile($model,$name,$type,$size,$directory,$message,$insertType,$preserve,$max_width,$max_height);

				if ($currentUpload==false) {
					return $parameter;				}
				// $this->log($model,"file $name uploaded successfully");
				$parameter[$name]=$message;
			}
			else{
				// $this->log($model,"error uploading file $name");
				continue;
			}
		}
		return $parameter;
	}

	private function uploadFile($model,$name,$type,$maxSize,$destination,&$message='',$insertType=false,$preserve=false,$max_width=0,$max_height=0){
		if (!$this->checkFile($name,$message)) {
			return false;
		}
		$filename=$_FILES[$name]['name'];
		$ext = strtolower(getFileExtension($filename));
		$fileSize = $_FILES[$name]['size'];
		$typeValid = is_array($type)?in_array(strtolower($ext), $type):strtolower($ext)==strtolower($type);
		if (!empty($filename) &&  $typeValid  && !empty($destination)) {
			if ($fileSize > $maxSize) {
				// $message='file too large to be saved';return false;
				$calcsize = calc_size($maxSize);
				$message = "The file you are attempting to upload is larger than the permitted size ($calcsize)";return false;
			}
			$destination=$this->_rootUploadsDirectory.$destination;
			if (!is_dir($destination)) {
				mkdir($destination,0777,true);
			}

			// using this is to check whether max_width or max_height was passed
			if(($max_width !== 0 && $max_height !== 0) || $max_width !== 0 || $max_height !== 0){
                $config['max_width'] = $max_width;
                $config['max_height'] = $max_height;
                $temp_name = $_FILES[$name]['tmp_name'];

                if (!$this->isAllowedDimensions($temp_name,$max_width,$max_height))
                {
                    // $message = 'The image you are attempting to upload doesn\'t fit into the allowed dimensions.';return false;
                    $message = "The image you are attempting to upload doesn't fit into the allowed dimensions (max_width:$max_width x max_height:$max_height).";return false;
                }
			}

			$naming= '';
			$new_name = $this->webSessionManager->getCurrentuserProp('user_table_id').'_'.uniqid()."_".date('Y-m-d').'.'.$ext;
			if($insertType){
				$getUpload = $this->getUploadID($model,$insertType,$name);
				if($getUpload === 'insert'){
					// this means inserting
					$naming = ($preserve) ? $filename : $new_name; 
				}else{
					$naming = basename($getUpload); // this means updating
				}
				
			}else{
				// this means inserting
				$naming = ($preserve) ? $filename : $new_name; 
			}
			$pos = $naming;
			$destination.=$pos;//the test should be replaced by the name of the current user.
			if(move_uploaded_file($_FILES[$name]['tmp_name'], $destination)){
				$message=$destination;
				return true;//$destination;
			}
			else{
				$message = "error while uploading file. please try again";return false;
				// exit(createJsonMessage('status',false,'message','error while uploading file. please try again'));
			}
		}
		else{
			// $message = "error while uploading file. please try again";return false;
			$message = 'error while uploading file. please try again condition not satisfy';return false;
		}
		// $message='error while uploading file. please try again';return false;
		$message = 'error while uploading file. please try again';return false;
	}

	private function isAllowedDimensions($temp,$max_width=0,$max_height=0)
	{

		if (function_exists('getimagesize'))
		{
			$D = @getimagesize($temp);

			if ($max_width > 0 && $D[0] > $max_width)
			{
				return FALSE;
			}

			if ($max_height > 0 && $D[1] > $max_height)
			{
				return FALSE;
			}

			// if ($min_width > 0 && $D[0] < $min_width)
			// {
			// 	return FALSE;
			// }

			// if ($min_height > 0 && $D[1] < $min_height)
			// {
			// 	return FALSE;
			// }
		}

		return TRUE;
	}
	private function getUploadID($model,$id,$name='')
	{
		if ($id) {
			// return $id;
			// this means that it is updating
			$query="select $name from $model where id = ?";
			$result = $this->db->query($query,array($id));
			$result=$result->result_array();
			
			// the return message 'insert' is a rare case whereby there is no media file at first
			// yet one want to add the media file through update action
			return (!empty($result[0][$name])) ? $result[0][$name] : 'insert';
		}
		else{
			// this means it is inserting
			$query="select id from $model order by id desc limit 1";
			$result = $this->db->query($query);
			$result=$result->result_array();
			if ($result) {
				return $result[0]['id'];
			}
			return 1; //if no initial record
		}

	}

	private function checkFile($name,&$message=''){
		$error = !$_FILES[$name]['name'] || $_FILES[$name]['error'];
		if ($error) {
			if ((int)$error===2) {
				$message = 'file larger than expected';
				return false;
			}
			return false;
		}
		
		if (!is_uploaded_file($_FILES[$name]['tmp_name'])) {
			$this->db->trans_rollback();
			$message='uploaded file not found';
			return false;
		}
		return true;
	}

	//function for downloading data template
	function template($model){
		//validate permission here too.
		if (empty($model)) {
			show_404();exit;
		}
		loadClass($this->load,$model);
		if (!is_subclass_of($this->$model, 'Crud')) {
			show_404();exit;
		}
		$exception = null;
		if (isset($_GET['exc'])) {
			$exception = explode('-', $_GET['exc']);
		}
		$this->$model->downloadTemplate($exception);
	}
	function export($model){
		$condition = null;
		$args  =func_get_args();
		if (count($args) > 1) {
			$method = 'export'.ucfirst($args[1]);
			if (method_exists($this, $method)) {
				$condition = $this->$method();
			}
		}
		if (empty($model)) {
			show_404();exit;
		}
		loadClass($this->load,$model);
		if (!is_subclass_of($this->$model, 'Crud')) {
			show_404();exit;
		}
		$this->$model->export($condition);
	}

}