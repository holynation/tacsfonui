<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the member table.
	*/ 

class Member extends Crud {

protected static $tablename = "Member"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('middlename','status','date_created');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'email';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array('email');
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('firstname' => 'varchar','lastname' => 'varchar','middlename' => 'varchar','email' => 'varchar','phone_number' => 'varchar','member_path'=>'varchar','status' => 'tinyint','date_created' => 'timestamp');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','firstname' => '','lastname' => '','middlename' => '','email' => '','phone_number' => '','member_path'=>'','status' => '','date_created' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('status' => '1','date_created' => 'current_timestamp()');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array("filetype","maxsize",foldertosave","preservefilename"))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array(); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array();
static $tableAction = array('delete' => 'delete/member', 'edit' => 'edit/member');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getFirstnameFormField($value = ''){
	return "<div class='form-group'>
				<label for='firstname'>Firstname</label>
				<input type='text' name='firstname' id='firstname' value='$value' class='form-control' required />
			</div>";
} 
 function getLastnameFormField($value = ''){
	return "<div class='form-group'>
				<label for='lastname'>Lastname</label>
				<input type='text' name='lastname' id='lastname' value='$value' class='form-control' required />
			</div>";
} 
 function getMiddlenameFormField($value = ''){
	return "<div class='form-group'>
				<label for='middlename'>Middlename</label>
				<input type='text' name='middlename' id='middlename' value='$value' class='form-control' />
			</div>";
} 
 function getEmailFormField($value = ''){
	return "<div class='form-group'>
				<label for='email'>Email</label>
				<input type='text' name='email' id='email' value='$value' class='form-control' required />
			</div>";
} 
 function getPhone_numberFormField($value = ''){
	return "<div class='form-group'>
				<label for='phone_number'>Phone Number</label>
				<input type='text' name='phone_number' id='phone_number' value='$value' class='form-control' required />
			</div>";
}
 function getmember_pathFormField($value = ''){
 	$path=  ($value != '') ? base_url($value) : "";
	return "<div class='form-group'>
				<label for='member_path'>Member Pic</label>
				<img src='$path' alt='member pic' class='img-responsive' width='25%'/>
				<input type='file' name='member_path' id='member_path' value='$value' class='form-control' />		
			</div>";
}
 function getStatusFormField($value = ''){
	return "<div class='form-group'>
	<label class='form-checkbox'>Status</label>
	<select class='form-control' id='status' name='status' >
		<option value='1'>Yes</option>
		<option value='0' selected='selected'>No</option>
	</select>
	</div> ";
} 
 function getDate_createdFormField($value = ''){
	return "";
} 


 
}

?>
