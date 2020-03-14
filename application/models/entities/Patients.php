<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the patients table.
	*/ 

class Patients extends Crud {

protected static $tablename = "Patients"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('date_created','status','lga_of_origin','state_of_origin');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'first_name';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('title_id'=> 'int','first_name' => 'varchar','last_name' => 'varchar','email' => 'varchar','dob' => 'varchar','gender' => 'enum','marital_status' => 'enum','address' => 'text','state_of_origin' => 'varchar','lga_of_origin' => 'varchar','phone_num' => 'varchar','img_path' => 'varchar','health_status' => 'text','status' => 'tinyint','date_created' => 'timestamp');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','title_id'=> '','first_name' => '','last_name' => '','email' => '','dob' => '','gender' => '','marital_status' => '','address' => '','state_of_origin' => '','lga_of_origin' => '','phone_num' => '','img_path' => '','health_status' => '','status' => '','date_created' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('status' => '1','date_created' => 'current_timestamp()');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array('img_path'=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'patient/','preserve'=>false,'max_width'=>'500','max_height'=>'500')); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array('title' => array('title_id','id')
);
static $tableAction = array('delete' => 'delete/patients', 'edit' => 'edit/patients','profile'=>'vc/patients/profile');
function __construct($array = array())
{
	parent::__construct($array);
}

function getTitle_idFormField($value = ''){
	$fk = array('table'=>'title','display'=>'title_name'); 
 	//change the value of this variable to array('table'=>'title','display'=>'title_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'title_name' as value from 'title' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('title', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='title_id' id='title_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='title_id'>Title</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='title_id' id='title_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
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
 function getMarital_statusFormField($value = ''){
	$arr =array('single','married','divorced','widowed','others');
	$option = buildOptionUnassoc($arr,$value);
	return "<div class='form-group'>
	<label for='gender' >Marital Status</label>
		<select  name='marital_status' id='marital_status'  class='form-control'  >
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
 function getState_of_originFormField($value = ''){
	$states = loadStates();
	$option = buildOptionUnassoc($states,$value);
	return "<div class='form-group'>
	<label for='state_of_origin' >State Of Origin</label>
		<select  name='state_of_origin' id='state_of_origin' value='$value' class='form-control autoload' data-child='lga_of_origin' data-load='lga'> 
		<option value=''>..select state...</option>
		$option
		</select>
</div> ";
} 
 function getLga_of_originFormField($value = ''){
	$option='';
	if ($value) {
		$arr=array($value);
		$option = buildOptionUnassoc($arr,$value);
	}
	return "<div class='form-group'>
	<label for='lga_of_origin' >Lga Of Origin</label>
		<select type='text' name='lga_of_origin' id='lga_of_origin' value='$value' class='form-control'  >
		<option value=''></option>
		$option
		</select>
</div> ";
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
	<img src='$path' alt='patient pic' width='200px'/>
	<label for='img_path' >Patient Image</label>
		<input type='file' name='img_path' id='img_path' value='$value' class='form-control'  />
</div> ";
} 
 function getHealth_statusFormField($value = ''){
	return "<div class='form-group'>
				<label for='health_status'>Health Status</label>
				<textarea name='health_status' id='health_status' class='form-control' required>$value</textarea>
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

protected function getTitle(){
	$query ='SELECT * FROM title WHERE id=?';
	if (!isset($this->array['title_id'])) {
		return null;
	}
	$id = $this->array['title_id'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Title.php');
	$resultObject = new Title($result[0]);
	return $resultObject;
}

protected function getAppointment(){
	$query ='SELECT * FROM appointment WHERE patients_id=?';
	if (!isset($this->array['ID'])) {
		return null;
	}
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result =$result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Appointment.php');
	$resultObjects = new Appointment($result[0]);
	return $resultObjects;
}

public function delete($id=null,&$db=null)
{
	$db=$this->db;
	$db->trans_begin();
	if(parent::delete($id,$db)){
		$query="delete from user where user_table_id=? and user_type='patients'";
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
