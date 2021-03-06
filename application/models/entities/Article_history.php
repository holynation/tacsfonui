<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the article_history table.
	*/ 

class Article_history extends Crud {

protected static $tablename = "Article_history"; 
/* this array contains the field that can be null*/ 
static $nullArray = array();
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = '';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('article_id' => 'int','approval_status' => 'tinyint','user_id' => 'int','user_type' => 'varchar','date_approved' => 'timestamp','date_created' => 'timestamp');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','article_id' => '','approval_status' => '','user_id' => '','user_type' => '','date_approved' => '','date_created' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('approval_status' => '0','date_approved' => 'current_timestamp()','date_created' => 'current_timestamp()');
 // populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array(); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array('article' => array('article_id','id')
,'user' => array('user_id','id')
);
static $tableAction = array('delete' => 'delete/article_history', 'edit' => 'edit/article_history');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getArticle_idFormField($value = ''){
	$fk = null; 
 	//change the value of this variable to array('table'=>'article','display'=>'article_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'article_name' as value from 'article' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('article', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='article_id' id='article_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='article_id'>Article Id</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='article_id' id='article_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}
 function getApproval_statusFormField($value = ''){
	return "<div class='form-group'>
				<label for='approval_status'>Approval Status</label>
				<input type='text' name='approval_status' id='approval_status' value='$value' class='form-control' required />
			</div>";
} 
 function getUser_idFormField($value = ''){
	$fk = null; 
 	//change the value of this variable to array('table'=>'user','display'=>'user_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'user_name' as value from 'user' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('user', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='user_id' id='user_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='user_id'>User Id</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='user_id' id='user_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}
 function getUser_typeFormField($value = ''){
	return "<div class='form-group'>
				<label for='user_type'>User Type</label>
				<input type='text' name='user_type' id='user_type' value='$value' class='form-control' required />
			</div>";
} 
 function getDate_approvedFormField($value = ''){
	return "<div class='form-group'>
				<label for='date_approved'>Date Approved</label>
				<input type='text' name='date_approved' id='date_approved' value='$value' class='form-control' required />
			</div>";
} 
 function getDate_createdFormField($value = ''){
	return "<div class='form-group'>
				<label for='date_created'>Date Created</label>
				<input type='text' name='date_created' id='date_created' value='$value' class='form-control' required />
			</div>";
} 

protected function getArticle(){
	$query ='SELECT * FROM article WHERE id=?';
	if (!isset($this->array['ID'])) {
		return null;
	}
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Article.php');
	$resultObject = new Article($result[0]);
	return $resultObject;
}
 protected function getUser(){
	$query ='SELECT * FROM user WHERE id=?';
	if (!isset($this->array['ID'])) {
		return null;
	}
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('User.php');
	$resultObject = new User($result[0]);
	return $resultObject;
}

 
}

?>
