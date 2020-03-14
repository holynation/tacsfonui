<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the doctor table.
	*/ 

class Doctor extends Crud {

protected static $tablename = "Doctor"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('img_path','status','date_created');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'gender';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('first_name' => 'varchar','last_name' => 'varchar','email' => 'varchar','dob' => 'varchar','gender' => 'enum','address' => 'text','phone_num' => 'varchar','img_path' => 'varchar','status' => 'tinyint','role_id'=>'int','date_created' => 'timestamp');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','first_name' => '','last_name' => '','email' => '','dob' => '','gender' => '','address' => '','phone_num' => '','img_path' => '','status' => '','role_id'=>'','date_created' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('status' => '1','date_created' => 'current_timestamp()');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array('img_path'=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'doctor/','preserve'=>false)); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array();
static $tableAction = array('delete' => 'delete/doctor', 'edit' => 'edit/doctor','profile'=>'vc/doctor/profile');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getFirst_nameFormField($value = ''){
	return "<div class='form-group'>
				<label for='first_name'>First Name</label>
				<input type='text' name='first_name' id='first_name' value='$value' class='form-control' required />
			</div>";
} 
 function getLast_nameFormField($value = ''){
	return "<div class='form-group'>
				<label for='last_name'>Last Name</label>
				<input type='text' name='last_name' id='last_name' value='$value' class='form-control' required />
			</div>";
} 
 function getEmailFormField($value = ''){
	return "<div class='form-group'>
				<label for='email'>Email</label>
				<input type='text' name='email' id='email' value='$value' class='form-control' required />
			</div>";
} 
 function getDobFormField($value = ''){
	return "<div class='form-group'>
				<label for='dob'>Dob</label>
				<input type='date' name='dob' id='dob' value='$value' class='form-control' required />
			</div>";
} 
 function getGenderFormField($value = ''){
	$arr =array('Male','Female');
	$option = buildOptionUnassoc($arr,$value);
	return "<div class='form-group'>
	<label for='gender' >Gender</label>
		<select  name='gender' id='gender'  class='form-control'  >
		$option
		</select>
</div> ";
} 
 function getAddressFormField($value = ''){
	return "<div class='form-group'>
				<label for='address'>Address</label>
				<input type='text' name='address' id='address' value='$value' class='form-control' required />
			</div>";
} 
 function getPhone_numFormField($value = ''){
	return "<div class='form-group'>
				<label for='phone_num'>Phone Num</label>
				<input type='text' name='phone_num' id='phone_num' value='$value' class='form-control' required />
			</div>";
} 
 function getImg_pathFormField($value = ''){
	$path=  ($value != '') ? base_url($value) : "";
	return "<div class='form-group'>
	<img src='$path' alt='doctor pic' width='200px'/>
	<label for='img_path' >Dcotor Image</label>
		<input type='file' name='img_path' id='img_path' value='$value' class='form-control'  />
</div> ";
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
function getRole_idFormField($value=''){
	$fk= array('table'=>'role','display'=>'role_title'); 

	if (is_null($fk)) {
		return $result="<input type='hidden' value='$value' name='role_id' id='role_id' class='form-control' />
			";
	}
	if (is_array($fk)) {
		$result ="<div class='form-group'>
		<label for='role_id'>Role</label>";
		$option = $this->loadOption($fk,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='role_id' id='role_id' class='form-control'>
			$option
		</select>";
	}
	$result.="</div>";
	return  $result;

}
 function getDate_createdFormField($value = ''){
	return "";
}

protected function getEducation_info(){
	$query ='SELECT * FROM education_info WHERE doctor_id=?';
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result =$result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Education_info.php');
	$resultObjects = new Education_info($result[0]);
	return $resultObjects;
}

protected function getExperience_info(){
	$query ='SELECT * FROM experience_info WHERE doctor_id=?';
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result =$result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Experience_info.php');
	$resultObjects = new Experience_info($result[0]);
	return $resultObjects;
}

public function delete($id=null,&$db=null)
{
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

public function getDoctorIdOption($value=''){
	if($this->webSessionManager->getCurrentUserProp('user_type') == 'admin'):
		loadClass($this->load,'admin');
      $this->admin->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
      $this->admin->load();

	$query = "select id,concat_ws(' ',first_name,' ',last_name) as value from doctor";
	$result ="<div class='form-group'>
		<label for='doctor_id'>Doctor </label>";
		$option = buildOptionFromQuery($this->db,$query,null,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='doctor_id' id='doctor_id' class='form-control' required>
		<option value=''>..choose....</option>
					$option
				</select>";
	$result.="</div>";
	return $result;
	else:
		loadClass($this->load,'doctor');
      	$this->doctor->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
      	$this->doctor->load();
		// i can only do this because the dcotor have been loaded using $this->load method in the viewController
		$id = ($this->array['ID'])? $this->array['ID'] : null;
		$value = ($id)? $id : $value;
		return $result = "<input type='hidden' name='doctor_id' id='doctor_id' value='$value' class='form-control' />";
	endif;
}

public function getDoctor()
{
	$query  = "SELECT * from doctor";
	$result = $this->query($query);
	if(!$result){
		return false;
	}
	return $result;
}



 
}

?>
