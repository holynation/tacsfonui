<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the events table.
	*/ 

class Events extends Crud {

protected static $tablename = "Events"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('end_time','events_path','short_note','date_created','status');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'end_time';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('title' => 'varchar','event_date' => 'varchar','start_time' => 'varchar','end_time' => 'varchar','location' => 'varchar','events_path' => 'varchar','short_note' => 'text','status' => 'tinyint','date_created' => 'timestamp');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','title' => '','event_date' => '','start_time' => '','end_time' => '','location' => '','events_path' => '','short_note' => '','status' => '','date_created' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('status' => '1','date_created' => 'current_timestamp()');
 // populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array('events_path'=>array('type'=>array('gif','jpeg','jpg','png'),'size'=>'10485760','directory'=>'events/','preserve'=>false)); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array();
static $tableAction = array('delete' => array('delete/events','events_path'), 'edit' => 'edit/events');
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
 function getEvent_dateFormField($value = ''){
	return "<div class='form-group'>
				<label for='event_date'>Event Date</label>
				<div>
                    <div class='input-group'>
                        <input type='text' class='form-control' name='event_date' id='event_date' placeholder='mm/dd/yyyy' data-provide='datepicker' data-date-autoclose='true'>

                        <div class='input-group-append'>
                            <span class='input-group-text'><i class='mdi mdi-calendar'></i></span>
                        </div>
                    </div>
                </div>
			</div>";
} 
 function getStart_timeFormField($value = ''){
	return "<div class='form-group'>
				<label for='start_time'>Start Time</label>
				<input type='text' name='start_time' id='start_time' value='$value' class='form-control' required />
			</div>";
} 
 function getEnd_timeFormField($value = ''){
	return "<div class='form-group'>
				<label for='end_time'>End Time</label>
				<input type='text' name='end_time' id='end_time' value='$value' class='form-control' required />
			</div>";
} 
 function getLocationFormField($value = ''){
	return "<div class='form-group'>
				<label for='location'>Location</label>
				<input type='text' name='location' id='location' value='$value' class='form-control' required />
			</div>";
} 
 function getEvents_pathFormField($value = ''){
	return "<div class='form-group'>
				<label for='events_path'>Events Image</label>
				<input type='text' name='events_path' id='events_path' value='$value' class='form-control' required />
			</div>";
} 
 function getShort_noteFormField($value = ''){
	return "<div class='form-group'>
				<label for='short_note'>Short Note</label>
				<input type='text' name='short_note' id='short_note' value='$value' class='form-control' required />
			</div>";
} 
function getStatusFormField($value=''){
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
