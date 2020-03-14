<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the appointment table.
	*/ 

class Appointment extends Crud {

protected static $tablename = "Appointment"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('status','date_created');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'appointment_hash';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('appointment_hash' => 'varchar','patients_id' => 'int','doctor_id' => 'int','appoint_date' => 'varchar','appoint_time' => 'varchar','status' => 'tinyint','date_created' => 'datetime');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','appointment_hash' => 'Appointment ID','patients_id' => '','doctor_id' => '','appoint_date' => '','appoint_time' => '','status' => '','date_created' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('date_created' => 'current_timestamp()');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array(); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array('patients' => array('patients_id','id')
,'doctor' => array('doctor_id','id')
);
static $tableAction = array('delete' => 'delete/appointment', 'edit' => 'edit/appointment','questioning'=>array('vc/admin/diagnose','appointment_hash'),'report' => array('vc/admin/report','appointment_hash'));
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getAppointment_hashFormField($value = ''){
	$hash = "APT-" . rand(1,100);
	$value = ($value != '') ? $value : $hash;
	return "<div class='form-group'>
				<label for='appointment_hash'>Appointment ID</label>
				<input type='text' name='appointment_hash' id='appointment_hash' value='$value' class='form-control' readonly='off'/>
			</div>";
} 
 function getPatients_idFormField($value = ''){
	$query = "select id,concat_ws(' ',first_name,' ',last_name) as value from patients";
 	$result ="<div class='form-group'>
		<label for='patients_id'>Patient</label>";
		$option = buildOptionFromQuery($this->db,$query,null,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='patients_id' id='patients_id' class='form-control' required>
		<option value=''>..choose....</option>
					$option
				</select>";
	$result.="</div>";
	return $result;
}
 function getDoctor_idFormField($value = ''){
	return getDoctorOption($value);
}
 function getAppoint_dateFormField($value = ''){
	return "<div class='form-group'>
				<label for='appoint_date'>Appoint Date</label>
				<div class='cal-icon'>
				<input type='text' name='appoint_date' id='appoint_date' value='$value' class='form-control datetimepicker' required /></div>
			</div>";
} 
 function getAppoint_timeFormField($value = ''){
	return "<div class='form-group'>
				<label for='appoint_time'>Appoint Time</label>
				<div class='time-icon'>
				<input type='text' name='appoint_time' id='appoint_time' value='$value' class='form-control' required /></div>
			</div>";
} 
 function getStatusFormField($value = ''){
	return "<div class='form-group'>
	<label class='form-checkbox'>Status</label>
	<select class='form-control' id='status' name='status'>
		<option value='1' selected='selected'>Yes</option>
		<option value='0'>No</option>
	</select>
	</div> ";
} 
 function getDate_createdFormField($value = ''){
	return "";
} 

protected function getPatients(){
	$query ='SELECT * FROM patients WHERE ID=?';
	if (!isset($this->array['ID'])) {
		return null;
	}
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Patients.php');
	$resultObject = new Patients($result[0]);
	return $resultObject;
}
 protected function getDoctor(){
	$query ='SELECT * FROM doctor WHERE doctor_id = ?';
	if (!isset($this->array['doctor_id'])) {
		return null;
	}
	$id = $this->array['doctor_id'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Doctor.php');
	$resultObject = new Doctor($result[0]);
	return $resultObject;
}

public function getAppoint($where = '',$limit='10')
{
	$query = "SELECT * from appointment $where limit $limit";
	$result = $this->db->query($query);
	if(!$result){
		return false;
	}
	return $result->result();
}

 
}

?>
