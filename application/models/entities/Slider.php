<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the slider table.
	*/ 

class Slider extends Crud {

protected static $tablename = "Slider"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('date_created');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = '';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('title' => 'varchar','slider_path' => 'varchar','date_created' => 'timestamp');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','title' => '','slider_path' => 'Image','date_created' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('date_created' => 'current_timestamp()');
 // populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array('slider_path'=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'10485760','directory'=>'slider/','preserve'=>false,'max_width'=>'1600','max_height'=>'915')); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array();
static $tableAction = array('delete' => array('delete/slider','slider_path'), 'edit' => 'edit/slider');
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
 function getSlider_pathFormField($value = ''){
 	$path = ($value != '') ? base_url($value) : "";
	return '<div class="form-group">
                <span class="label-heading col-md-4">Slider Image</span>
                <div class="col-md-12">
                    <label class="custom-file">
                    	<img src="'.$path.'" style="margin-top:20px;"/>
                        <input type="file" class="custom-file-input" name="slider_path" id="slider_path">
                        <span class="custom-file-label">Choose File</span>
                    </label>
                </div>
            </div>';
} 
 function getDate_createdFormField($value = ''){
	return "";
} 

public function checkLimit(){
	$sql = "SELECT count(*) as sliderCount from slider";
	$result = $this->db->query($sql);
	return ($result->num_rows() > 0) ? $result->row()->sliderCount : 0;
}
 
}

?>
