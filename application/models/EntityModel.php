<?php
/**
 * The class that managers entity related data generally
 */
class EntityModel extends CI_Model
{
	private $listSpecial;
	private $uploadedFolderName = 'uploads';
	function __construct()
	{
		parent::__construct();
		$this->defaultLenght = 100;
		$this->listSpecial= array('product');
	}

	//process all the crud operations
	public function process($entity,$args)
	{
		try {
			if (!$args) {
				#this handles /entity GET, will get list of entities and POST will insert a new one
				if ($_SERVER['REQUEST_METHOD']=='GET') {
					$param = $_GET;
					$result =$this->list($entity,$param);
					displayJson(true,'success',$result);
				}
				elseif ($_SERVER['REQUEST_METHOD']=='POST') {
					$values = $_POST;
					//check if the item allows processing of array element
					if (($member=getMember())) {
						$values['member_id']=$member->ID;
						$_POST['member_id']=$member->ID;
					}
					$result = $this->insert($entity,$values);
					// displayJson(true,'success',$result);
				}
				return;
			}

			if (count($args)==1) {
				# this handles entity detail view  and update
				if (is_numeric($args[0])) {
					if ($_SERVER['REQUEST_METHOD']=='GET') {
						$param = $_GET;
						$id = $args[0];
						$result =$this->detail($entity,$id,$param);
						displayJson(true,'success',$result);
					}
					elseif ($_SERVER['REQUEST_METHOD']=='POST') {
						$values = $_POST;
						$id = $args[0];
						$this->update($entity,$id,$values);
						displayJson(true,'success');
					}
					return;
				}
				else{
					if (strtolower($args[0])=='bulk_upload') {
						$message ='';
						$this->processBulkUpload($entity,$message);
						// displayJson()
						return;
					}
				}
				return;
			}

			if (count($args)==2 && is_numeric($args[1])) {
				if ($_SERVER['REQUEST_METHOD']=='POST') {
					if (strtolower($args[0])=='delete') {
						$id=$args[1];
						if($this->delete($entity,$id)){
							displayJson(true,'success');
							return;
						}
						displayJson(false,'unable to perform the operation');
						return;
					}
					
					//handle the issue with the status
					if (strtolower($args[0])=='disable' || strtolower($args[0])=='enable') {
						$operation = $args[0];
						$id = $args[1];
						$status = false;
						if ($operation=='disable') {
							$status =$this->disable($entity,$id);
						} else {
							$status =$this->enable($entity,$id);
						}
						displayJson($status,$status?'success':'unable to delete item');
						
					}
					
				}
				return;
			}
			http_response_code(404);
			displayJson(false,'resource not found');
			return;
		} catch (Exception $e) {
			displayJson(false,$e->getMessage());
		}

	}

	private function validateHeader($entity,$header)
	{
		loadClass($this->load,$entity);
		return $entity::$bulkUploadField==$header;
	}

	private function processBulkUpload($entity)
	{
		loadClass($this->load,$entity);
		$message = 'success';
		$content = $this->loadUploadedFileContent($message);
		if (!$content) {
			displayJson(false,'not uploaded content found');
			return false;
		}
		$content = trim($content);
		$array = stringToCsv($content);
		$header = array_shift($array);
		if (!$this->validateHeader($entity,$header)) {
			$message='column does not match, please check the column template and try again';
			displayJson(false,$message);
			return false;
		}
		$result = $this->$entity->bulkUpload($header,$array,$message);
		displayJson($result,$message);
	}

	private function loadUploadedFileContent(&$message){
		$filename = 'upload_form';
		// if (isset($_POST['submit'])) {
		$status = $this->checkFile($filename,$message);
		if (!$status) {
			return false;
		}
		if(!endsWith($_FILES[$filename]['name'],'.csv')){
				$messag = "invalid file format";
				return false;
			}
			$path = $_FILES[$filename]['tmp_name'];
			$content = file_get_contents($path);
			return $content;
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

	private function delete($entity,$id)
	{
		loadClass($this->load,$entity);
		return $this->$entity->delete($id);
	}

	private function detail($entity,$id,$param)
	{
		$this->load->model('entityDetails');
		$methodName = 'get'.ucfirst($entity).'Details';
		if (method_exists($this->entityDetails, $methodName)) {
			$result = $this->entityDetails->$methodName($id);
			return $result;
		}
		loadClass($this->load,$entity);
		$this->$entity->ID=$id;
		$res=$this->$entity->load();
		$result= $this->$entity->toArray();
		return $result;

	}

	public function disable($model,$id){
		$this->load->model("entities/$model");
		//check that model is actually a subclass
		if ( !(empty($id)===false && is_subclass_of($this->$model,'Crud' ))) {
			return false;
		}
		return $this->$model->disable($id);

	}

	public function enable($model,$id){
		$this->load->model("entities/$model");
		//check that model is actually a subclass
		if ( !(empty($id)===false && is_subclass_of($this->$model,'Crud' ))) {
			return false;
		}
		return $this->$model->enable($id);
	}

	private function update($entity,$id,$param)
	{
		$this->load->model('entityCreator');
		loadClass($this->load,$entity);
		$this->entityCreator->update($entity,$id,true,$param);
		exit;
	}

	private function insert($entity,$param)
	{
		$this->load->model('entityCreator');
		$this->entityCreator->add($entity,$param);
	}

	// implementing the crud operation for list:view, update, detail,delete


	private function buildQueryString($entity,$query)
	{
		$this->load->model('formConfig');
		$config = $this->formConfig->getInsertConfig($entity);
		if (!$config) {
			return '';
		}
		$list= array_key_exists('search', $config)?$config['search']:false;
		if (!$list) {
			//use all the fields here then
			loadClass($this->load,$entity);
			$list = array_keys($entity::labelArray);
		}
		$result='';
		$isFirst = true;
		$query = $this->db->conn_id->escape_string($query);
		foreach ($list as  $value) {
			if (!$isFirst) {
				$result.=' or ';
			}
			$isFirst =false;
			$result.="$value like '%$query%'";
		}
		return $result;
	}

	private function list($entity,$param)
	{
		# get the parameter for paging
		$start = array_key_exists('start', $_GET)?$param['start']:0;
		$len = array_key_exists('len', $_GET)?$param['len']:$this->defaultLenght;
		$q = array_key_exists('q', $param)?$param['q']:false;
		//the parameter to include structure
		$addStructure = (array_key_exists('st', $param) && $param['st'])?$param['st']:false;
		// $filter = array_key_exists('f', array) add a generic way of performing filter here
		$filterList=$param;
		if ($q) {
			unset($filterList['q']);
		}
		unset($filterList['st']);
		unset($filterList['start']);
		unset($filterList['len']);
		//perform some form of validation here to know what needs to be include in the list
		//and also how to perform 
		$member=false;

		$filterList = $this->validateFilters($entity,$filterList);
		$this->load->model("entities/$entity");
		if (($member=getMember())!=false) {
			$labels = array_keys($entity::$labelArray);
			if (in_array($entity, $labels)) {
				$filterList['member_id']=$member->ID;
			}
			
		}
		
		$result = null;
		$totalLength=0;
		$toReturn = array();
		$resolveForeign = $member?false:true;
		if ($q) {
			$queryString= $this->buildQueryString($entity,$q);
			$tempR = $this->$entity->allListFiltered($filterList,$totalLength,$start,$len,$resolveForeign,' order by ID desc ',$queryString);
			$toReturn['table_data']=$tempR[0];
			$toReturn['paging']=$tempR[1]; 
		}
		else{
			$tempR = $this->$entity->allListFiltered($filterList,$totalLength,$start,$len,$resolveForeign,' order by ID desc ');
			$toReturn['table_data']=$tempR[0];
			$toReturn['paging']=$tempR[1]; 
		}
		if ($member) {
			$result= array();
			$result['totalLength']=$toReturn['paging'];
			if (method_exists($this->$entity, 'APIList')) {
				
				$temp= $this->$entity->APIList($toReturn['table_data'],$member,$param);
				$result['content']=$temp;
				return $result;
			}
			$result['content']=$toReturn['table_data'];
			return $result;
		}
		//now add the filter information
		$this->load->model('formConfig');
		$filters = $this->formConfig->getInsertConfig($entity);
		$filterContent = $this->getFilterContent($filters);
		$toReturn['filter_structure']=$filterContent;
		if ($addStructure) {
			$structure = getStructure($this,$entity);
			$toReturn['structure']=$structure;
			$temp = getBulkUploadFields($this,$entity);
			if ($temp) {
				$toReturn['bulk_structure']= $temp;

			}
		}
		return $toReturn;

	}

	private function validateFilters($entity,$filters)
	{
		if (!$filters) {
			return  [];
		}
		$this->load->model('formConfig');
		$filterSettings = $this->formConfig->getInsertConfig($entity);
		if (!$filterSettings) {
			return [];
		}

		$result = array();
		foreach ($filters as $key => $value) {
			if (!$value) {
				continue;
			}
			$realKey = $this->getRealKey($key,$filterSettings);
			if (!$realKey) {
				continue;
			}
			$result[$realKey]=$value;
		}
		return $result;


	}

	private function getRealKey($key,$filterSettings)
	{
		//check if there is 
		$result = false;
		foreach ($filterSettings['filter'] as $value) {
			if ($value['filter_display']==$key || $value['filter_label']==$key) {
				return 	$value['filter_label'];
			}
		}
		return $result;
	}

	private function getFilterContent($filters)
	{
		$result = array();
		if (!$filters) {
			return $result;
		}
		if (!array_key_exists('filter', $filters)) {
			return $filters;
		}
		$mainFilter  = $filters['filter'];
		$tempFilter = array();
		foreach ($mainFilter as $filterItem) {
			$temp = array();
			$temp['title']=$filterItem['filter_display']?$filterItem['filter_display']:$filterItem['filter_label'];
			$temp['name']=$filterItem['filter_label'];
			if (array_key_exists('select_items', $filterItem)) {
				$temp['filter_item']=$filterItem['select_items'];
			}
			else{
				$temp['filter_item']=$this->getSelectItemFromQuery($filterItem['preload_query']);
			}
			$tempFilter[]=$temp;
		}
		if (array_key_exists('search', $filters)) {
			$result['search']=$filters['search'];
		}
		$result['filters']=$tempFilter;
		return $result;
		//now convert the sql to real data to be user
	}


	private function getSelectItemFromQuery($query)
	{
		if (!$query) {
			return [];
		}
		$result = $this->db->query($query);
		$result = $result->result_array();
		return $result;
	}
	
	private function getAllDirectRelation($label,$relations)
	{
		$result = array();
		foreach ($relations as $key => $value) {
			if ($value[0]==$label) {
				$result[$key]=$value[1];
			}
		}
		return $result;
	}


}
?>