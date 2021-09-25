<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the events table.
	*/ 

class Events extends Crud {

protected static $tablename = "Events"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('description','events_path','end');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = '';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('title' => 'varchar','start' => 'datetime','end' => 'datetime','description' => 'text','events_path' => 'varchar');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','title' => '','start' => '','end' => '','description' => '','events_path' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array();
 // populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array('events_path'=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'events/','preserve'=>false)); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array();
static $tableAction = array('edit'=> 'edit/events','delete' => array('delete/events','events_path'));
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getTitleFormField($value = ''){
	return "<div class='form-group'>
				<label for='title'>Title</label>
				<input type='text' name='title' id='title' value='$value' class='form-control' required />
			</div>";
} 
 function getStartFormField($value = ''){
	return "<div class='form-group'>
				<label for='start'>Start</label>
				<input type='text' name='start' id='start' value='$value' class='form-control' required />
			</div>";
} 
 function getEndFormField($value = ''){
	return "<div class='form-group'>
				<label for='end'>End</label>
				<input type='text' name='end' id='end' value='$value' class='form-control' required />
			</div>";
} 
 function getDescriptionFormField($value = ''){
	return "<div class='form-group'>
				<label for='description'>Description</label>
				<textarea name='description' id='description' class='form-control' required>$value</textarea>
			</div>";
} 
 function getEvents_pathFormField($value = ''){
	$path=  ($value != '') ? base_url($value) : "";
	return "<div class='form-group'>
	<img src='$path' alt='event pic' width='200px'/>
	<label for='events_path' >Event Image</label>
		<input type='file' name='events_path' id='events_path' value='$value' class='form-control'  />
</div> ";
} 

public function getEvents($param=null){
	$param = ($param) ? " $param " : "";
	$query = "select * from events $param";
	$result = $this->query($query);
	if(!$result){
		return false;
	}
	return $result;
}
 
}

?>
