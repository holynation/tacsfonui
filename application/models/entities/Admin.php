<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the admin table.
	*/ 

class Admin extends Crud {

protected static $tablename = "Admin"; 
/* this array contains the field that can be null*/ 
static $nullArray=array('middlename' ,'email' ,'phone_number' ,'address' ,'dob' ,'role_id' ,'status' );
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'email';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array('email','phone_number');
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('firstname' => 'varchar','middlename' => 'varchar','lastname' => 'varchar','email' => 'varchar','phone_number' => 'varchar','address' => 'text','dob' => 'date','role_id'=>'int','status' => 'tinyint','img_path' => 'varchar');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','firstname' => '','middlename' => '','lastname' => '','email' => '','phone_number' => '','address' => '','dob' => '','role_id'=>'','status' => '','img_path' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('status' => '1');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array("filetype","maxsize",foldertosave","preservefilename"))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array('img_path'=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'10000888','directory'=>'','preserve'=>false)); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;

static $relation=array('role'=>array( 'role_id', 'ID')
);

static $tableAction=array('enable'=>'getEnabled','delete'=>'delete/admin','edit'=>'edit/admin','profile'=>'vc/admin/profile');
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
 function getMiddlenameFormField($value = ''){
	return "<div class='form-group'>
				<label for='middlename'>Middlename</label>
				<input type='text' name='middlename' id='middlename' value='$value' class='form-control' />
			</div>";
} 
 function getLastnameFormField($value = ''){
	return "<div class='form-group'>
				<label for='lastname'>Lastname</label>
				<input type='text' name='lastname' id='lastname' value='$value' class='form-control' required />
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
				<input type='text' name='phone_number' id='phone_number' value='$value' class='form-control' />
			</div>";
} 
 function getAddressFormField($value = ''){
	return "<div class='form-group'>
				<label for='address'>Address</label>
				<textarea class='form-control' name='address' id='address exampleTextarea1' rows='2'>$value</textarea>
			</div>";
} 
 function getDobFormField($value = ''){
	return "<div class='form-group'>
				<label for='dob'>Dob</label>
				<input type='date' name='dob' id='dob' value='$value' class='form-control' />
			</div>";
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
 function getStatusFormField($value = ''){
	return "<div class='form-group'>
	<label class='form-checkbox'>Status</label>
	<select class='form-control' id='status' name='status' >
		<option value='1' selected='selected'>Yes</option>
		<option value='0'>No</option>
	</select>
	</div> ";
} 
 function getImg_pathFormField($value = ''){
 	$path=  ($value != '') ? base_url($value) : "";
	return "<div class='form-group'>
				<label for='img_path'>Upload Pic</label>
				<img src='$path' alt='admin pic' class='img-responsive' width='25%'/>
				<input type='file' name='img_path' id='img_path' value='$value' class='form-control' />
				
				
			</div>";
}

protected function getRole(){
	$query ='SELECT * FROM role WHERE id=?';
	if (!isset($this->array['role_id'])) {
		$this->load();
	}
	$id = $this->array['role_id'];
	$result = $this->db->query($query,array($id));
	$result =$result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Role.php');
	$resultObject = new Role($result[0]);
	return $resultObject;
}
public function getDasboardCount($table,$name='amount'){
	$query = "SELECT count(*) as $name from $table";
	$result = $this->db->query($query,array($this->ID));
	$row = $result->result_array();
	if($result->num_rows() > 0){
		return $row[0]["$name"];
	}else{
		return "0";
	}
}

public function getPublicationCount(){
	$count=0;
	$query = "SELECT count(*) as total from book_published";
	$result = $this->db->query($query,array($this->ID));
	$row = $result->result_array();
	if($result->num_rows() > 0){
		$count+=$row[0]["total"];
	}

	$row1 = $this->getSinglePub('chapter_in_book_published');
	if($row1 > 0){
		$count+=$row1;
	}
	
	$row2 = $this->getSinglePub('article_in_conference');
	if($row2 > 0){
		$count+=$row2;
	}
	$row3 = $this->getSinglePub('patents_copyright');
	if($row3 > 0){
		$count+=$row3;
	}
	$row4 = $this->getSinglePub('article_appear_in_journal');
	if($row4 > 0){
		$count+=$row4;
	}
	$row5 = $this->getSinglePub('accepted_books');
	if($row5 > 0){
		$count+=$row5;
	}
	$row6 = $this->getSinglePub('technical_report');
	if($row6 > 0){
		$count+=$row6;
	}

	if($count > 0){
		return $count;
	}else{
		return "0";
	}
}

public function getPublicationData($table){
	return array($this->getSinglePub($table));
}

private function getSinglePub($table){
	$count=0;
	$query = "SELECT count(*) as total from $table";
	$result = $this->db->query($query,array($this->ID));
	$row = $result->result_array();
	if($result->num_rows() > 0){
		return $row[0]["total"];
	}else{
		return 0;
	}
}
public function delete($id=null,&$db=null)
{
	$db=$this->db;
	$db->trans_begin();
	if(parent::delete($id,$db)){
		$query="delete from user where user_table_id=? and user_type='admin'";
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
