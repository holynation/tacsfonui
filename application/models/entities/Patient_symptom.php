<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the patient_symptom table.
	*/ 

class Patient_symptom extends Crud {

protected static $tablename = "Patient_symptom"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('date_created');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = ''; // this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('appointment_id' => 'int','symptom_id' => 'int','date_created' => 'datetime');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','appointment_id' => '','symptom_id' => '','date_created' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('date_created' => 'current_timestamp()');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array(); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array('appointment' => array('appointment_id','id')
,'symptom' => array('symptom_id','id')
);
static $tableAction = array('delete' => 'delete/patient_symptom', 'edit' => 'edit/patient_symptom');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getAppointment_idFormField($value = ''){
	$fk = null; 
 	//change the value of this variable to array('table'=>'appointment','display'=>'appointment_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'appointment_name' as value from 'appointment' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('appointment', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='appointment_id' id='appointment_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='appointment_id'>Appointment Id</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='appointment_id' id='appointment_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}
 function getSymptom_idFormField($value = ''){
	$fk = null; 
 	//change the value of this variable to array('table'=>'symptom','display'=>'symptom_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'symptom_name' as value from 'symptom' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('symptom', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='symptom_id' id='symptom_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='symptom_id'>Symptom Id</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='symptom_id' id='symptom_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}
 function getDate_createdFormField($value = ''){
	return "";
} 

protected function getAppointment(){
	$query ='SELECT * FROM appointment WHERE appointment_id=?';
	if (!isset($this->array['ID'])) {
		return null;
	}
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Appointment.php');
	$resultObject = new Appointment($result[0]);
	return $resultObject;
}
 protected function getSymptom(){
	$query ='SELECT * FROM symptom WHERE symptom_id=?';
	if (!isset($this->array['ID'])) {
		return null;
	}
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Symptom.php');
	$resultObject = new Symptom($result[0]);
	return $resultObject;
}

public function processSymption($appointID,$symptomID){
	$updateQuery='';
	$appointID = $this->db->conn_id->escape_string($appointID);
	
	$updateQuery = $this->buildUpdateQuery($symptomID,$appointID);
	if(strpos($updateQuery,"done") !== false){
		$query = "update appointment set status = '0' where ID=?";
        if ($this->db->query($query,array($appointID))) {
        	return true;
        }
		
	}else{
		return false;
	}
}

private function buildUpdateQuery($update,$appointID){
	$result='';
	for($i=0; $i<count($update);$i++) {
		$symptom_id = $this->db->conn_id->escape_string($update[$i]['symptomID']);
		$param = array('appointment_id'=>$appointID,'symptom_id'=>$symptom_id);
		$ps = new Patient_symptom($param);
		if($ps->insert($this->db,$message)){
			$result = 'done';
		}else{
			$result = 'error';
		}
	}
	return $result;
}

public function getReport($id,$hash){
	$appointID = $this->db->conn_id->escape_string($id);
	$appointHash = $this->db->conn_id->escape_string($hash);
	$query = "SELECT appointment_id,first_name,last_name,img_path,phone_num,email,dob,address,gender,category_name,count(category_name) as numOfAppearance from patient_symptom join appointment on appointment_id = appointment.ID join symptom on symptom_id = symptom.ID join patients on appointment.patients_id = patients.ID where appointment_id = ? and appointment.appointment_hash = ? group by category_name";
	$result = $this->query($query, array($appointID,$appointHash));
	// $map = array('Malaria','Typhoid fever','pneumonia');
	return $result;
 
}

public function getSymptoms($id,$hash){
	$appointID = $this->db->conn_id->escape_string($id);
	$appointHash = $this->db->conn_id->escape_string($hash);
	$query = "SELECT symptom_name from patient_symptom join appointment on appointment_id = appointment.ID join symptom on symptom_id = symptom.ID where appointment_id = ? and appointment.appointment_hash = ?";
	$result = $this->query($query, array($appointID,$appointHash));
	return $result;
}

}

?>
