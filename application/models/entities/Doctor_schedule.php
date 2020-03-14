<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the doctor_schedule table.
	*/ 

class Doctor_schedule extends Crud {

protected static $tablename = "Doctor_schedule"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('date_created','status');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'available_days';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('doctor_id' => 'int','available_days' => 'varchar','start_time' => 'varchar','end_time' => 'varchar','status' => 'tinyint','date_created' => 'datetime');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','doctor_id' => '','available_days' => '','start_time' => '','end_time' => '','status' => '','date_created' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('status' => '1','date_created' => 'current_timestamp()');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array(); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array('doctor' => array('doctor_id','id')
);
static $tableAction = array('delete' => 'delete/doctor_schedule', 'edit' => 'edit/doctor_schedule');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getDoctor_idFormField($value = ''){
	return getDoctorOption($value);
}
 function getAvailable_daysFormField($value = ''){
	return "<div class='form-group'>
				<label for='available_days'>Available Days</label>
				<select class='form-control select' name='available_days[]' id='available_days[]' multiple>
					<option>Select Days</option>
					<option value='Sunday'>Sunday</option>
					<option value='Monday'>Monday</option>
					<option value='Tuesday'>Tuesday</option>
					<option value='Wednesday'>Wednesday</option>
					<option value='Thursday'>Thursday</option>
					<option value='Friday'>Friday</option>
					<option value='Saturday'>Saturday</option>
				</select>
			</div>";
} 
 function getStart_timeFormField($value = ''){
	return "<div class='form-group'>
				<label for='start_time'>Start Time</label>
				<div class='time-icon'>
				<input type='text' name='start_time' id='start_time' value='$value' class='form-control' required />
				</div>
			</div>";
} 
 function getEnd_timeFormField($value = ''){
	return "<div class='form-group'>
				<label for='end_time'>End Time</label>
				<div class='time-icon'>
				<input type='text' name='end_time' id='end_time' value='$value' class='form-control' required />
				</div>
			</div>";
} 
 function getStatusFormField($value = ''){
	return "<div class='form-group'>
				<label for='status'>Status</label>
				<input type='text' name='status' id='status' value='$value' class='form-control' required />
			</div>";
} 
 function getDate_createdFormField($value = ''){
	return "";
} 

protected function getDoctor(){
	$query ='SELECT * FROM doctor WHERE id=?';
	if (!isset($this->array['ID'])) {
		return null;
	}
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Doctor.php');
	$resultObject = new Doctor($result[0]);
	return $resultObject;
}

 
}

?>
