<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the audios table.
	*/ 

class Audios extends Crud {

protected static $tablename = "Audios"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('uploader','status','date_created');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'title';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array('title');
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('uploader' => 'varchar','title' => 'varchar','caption' => 'text','audios_path' => 'varchar','audios_directory'=>'varchar','status' => 'tinyint','date_created' => 'timestamp');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','uploader' => '','title' => '','caption' => '','audios_path' => '','audios_directory'=>'','status' => '','date_created' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('status' => '1','date_created' => 'current_timestamp()');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array("filetype","maxsize",foldertosave","preservefilename"))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array('audios_path'=>array('type'=>array('mp3','aif','aiff','au','flac','m4a','ogg','snd','wav','w64'),'size'=>'94371840','directory'=>'audios/file/','preserve'=>false),'audios_directory'=> array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'audios/image/','preserve'=>false)); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array();
// static $tableAction = array('delete' => 'delete/audios', 'edit' => 'edit/audios');
static $tableAction = array('delete' => array('delete/audios','audios_path'), 'edit' => 'edit/audios');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getUploaderFormField($value = ''){
	$userType=$this->webSessionManager->getCurrentUserProp('user_type');
	$value = ($userType) ? $userType : 'admin';
	return "<div class='form-group'>
				<label for='uploader' class='text-hide'>Uploader</label>
				<input type='hidden' name='uploader' id='uploader' value='$value' class='form-control' />
			</div>";
} 
 function getTitleFormField($value = ''){
	return "<div class='form-group'>
				<label for='title'>Title</label>
				<input type='text' name='title' id='title' value='$value' class='form-control' required />
			</div>";
} 
 function getCaptionFormField($value = ''){
	return "<div class='form-group'>
				<label for='caption'>Audio Caption</label>
				<textarea name='caption' id='caption' class='form-control'>$value</textarea>
			</div>";
} 
 function getAudios_pathFormField($value = ''){
 	$link = base_url($value);
 	$audio = "<audio controls src='$link'>Your browser does not support the
            <code>audio</code> element.</audio>";
 	$path=  ($value != '') ? $audio : "";
 	$disabled = ($value != '') ? 'disabled' : "";
	return "<div class='form-group row'>
				<div class='ml-3'>
					$path
				</div>
				<span class='label-text col-md-3 col-form-label text-md-right'>Audio File</span>
				<div class='col-md-9'>
				<label class='custom-file'>
					<input type='file' name='audios_path' id='audios_path' class='custom-file-input' required $disabled />
					<span class='custom-file-label'>Choose Audio File</span>
				</label></div>
			</div>";
}
function getAudios_directoryFormField($value=''){
 	$disabled = ($value != '') ? 'disabled' : "";
 	$path=  ($value != '') ? base_url($value) : "";
	return "<div class='form-group row'>
				<span class='label-text col-md-3 col-form-label text-md-right'>Audio Image</span>
				<div class='col-md-9'>
				<label class='custom-file'>
					<img src='$path' alt='audio image' class='img-responsive' width='25%'/>
					<input type='file' name='audios_directory' id='audios_directory' class='custom-file-input' $disabled />
					<span class='custom-file-label'>Choose Image File</span>
				</label></div>
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

public function delete($id=null,&$db=null){
	$db=$this->db;
	$db->trans_begin();
	if(parent::delete($id,$db)){
		$query="delete from user where user_table_id=? and user_type='doctor'";
		if($this->query($query,array($id))){
			$db->trans_commit();
			return true;
		}
		else{
			$db->trans_rollback();
			return false;
		}
	}
	else{
		$db->trans_rollback();
		return false;
	}
}
 
}

?>
