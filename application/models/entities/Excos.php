<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the excos table.
	*/ 

class Excos extends Crud {

protected static $tablename = "Excos"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('excos_path','status','date_modified','date_created');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = '';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('name' => 'varchar','post' => 'text','dob' => 'varchar','excos_path' => 'varchar','status'=>'tinyint','date_modified' => 'timestamp','date_created' => 'timestamp');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','name' => '','post' => '','dob' => '','excos_path' => '','status'=>'','date_modified' => '','date_created' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('status'=>'1','date_modified' => 'current_timestamp()','date_created' => 'current_timestamp()');
 // populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array('excos_path'=>array('type'=>array('jpeg','jpg','png','svg'),'size'=>'1048576','directory'=>'excos/','preserve'=>false)); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array();
static $tableAction = array('delete' => array('delete/excos','excos_path'), 'edit' => 'edit/excos');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getNameFormField($value = ''){
	return "<div class='form-group'>
				<label for='name'>Name</label>
				<input type='text' name='name' id='name' value='$value' class='form-control' required />
			</div>";
} 
 function getPostFormField($value = ''){
	return "<div class='form-group'>
				<label for='post'>Post</label>
				<textarea name='post' id='post' class='form-control' required>$value</textarea>
				
			</div>";
} 
 function getDobFormField($value = ''){
	return "<div class='form-group'>
				<label for='dob'>Dob</label>
				<input type='date' name='dob' id='dob' value='$value' class='form-control' required />
			</div>";
} 
 function getExcos_pathFormField($value = ''){
	$disabled = ($value != '') ? 'disabled' : "";
 	$path=  ($value != '') ? base_url($value) : "";
	return "<div class='form-group row'>
				<span class='label-text col-md-3 col-form-label text-md-right'>Exco Image</span>
				<div class='col-md-9'>
				<label class='custom-file'>
					<img src='$path' alt='exco image' class='img-responsive' width='25%'/>
					<input type='file' name='excos_path' id='excos_path' class='custom-file-input' $disabled />
					<span class='custom-file-label'>Choose Image File</span>
				</label></div>
			</div>";
} 
 function getDate_modifiedFormField($value = ''){
	return "";
} 
 function getDate_createdFormField($value = ''){
	return "";
} 
function getStatusFormField($value=''){
	return "<div class='form-group'>
	<label class='form-checkbox'>Status</label>
	<select class='form-control' id='status' name='status' >
		<option value='1' selected='selected'>Yes</option>
		<option value='0'>No</option>
	</select>
	</div> ";

}


 
}

?>
