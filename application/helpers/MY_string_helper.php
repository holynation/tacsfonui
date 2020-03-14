<?php 

	function getTitlePage($page = ''){
		return ($page != '') ? "Adeoyo Maternity Teaching Hospital | $page" : 'Adeoyo Maternity Teaching Hospital';
	}
	function isSessionActive(){
   		$obj = &get_instance();
   		$userid = $obj->session->userdata('ID');
   		if (!empty($userid) && $obj->session->userdata('user_type') !== null) {
   			return true;
   		}
   		else{
   			return false;
   		}
   	}
	function removeUnderscore($fieldname){
		$result = '';
		if (empty($fieldname)) {
			return $result;
		}
		$list = explode("_", $fieldname);
		
		for ($i=0; $i < count($list); $i++) { 
			$current= ucfirst($list[$i]);
			$result.=$i==0?$current:" $current";
		}
		return $result;
	}
	function combineForInQuery($array)
	{
		if (!$array) {
			return "('')";
		}
		$result='';
		foreach ($array as $value) {
			$result.=$result?",'$value'":"'$value'";
		}
		return "($result)";
	}
	function getDoctorOption($value=''){
		$obj = &get_instance();
		loadClass($obj->load,'doctor');
		return $obj->doctor->getDoctorIdOption($value);
	}
	function getInfo($model='',$needle){
		$obj = &get_instance();
		loadClass($obj->load, $model);
		$array = array('ID'=>$needle);
		return $obj->$model->getWhere($array,$count,0,1,false);
	}
	//this function returns the json encoded string based on the key pair paremter saved on it.
	function createJsonMessage(){
		$argNum = func_num_args();
		if ($argNum % 2!=0) {
			throw new Exception('argument must be a key-pair and therefore argument length must be even');
		}
		$argument = func_get_args();
		$result= array();
		for ($i=0; $i < count($argument); $i+=2) { 
			$key = $argument[$i];
			$value = $argument[$i+1];
			$result[$key]=$value;
		}
		return json_encode($result);
	}

	//the function to get the currently logged on use from the sessions
	/**
	 * check that non of the given paramter is empty
	 * @return boolean [description]
	 */
	function isNotEmpty(){
		$args = func_get_args();
		for ($i=0; $i < count($args); $i++) { 
			if (empty($args[$i])) {
				return false;
			}
		}
		return true;
	}
//function to build csv file into a mutidimentaional array
	function stringToCsv($string){
		$result = array();
		$lines = explode("\n", trim($string));
		for ($i=0; $i < count($lines); $i++) { 
			$current  = $lines[$i];
			$result[]=str_getcsv(trim($current));
		}
		return $result;
	}

	function array2csv($array,$header=false){
		$content='';
		if ($array) {
			$content = strtoupper(implode(',', $header?$header:array_keys($array[0])))."\n";
		}
		foreach ($array as $value) {
		 $content.=implode(',', $value)."\n";
		}
		return $content;
	}

	function endsWith($string, $end){
		$temp = substr($string, strlen($string)-strlen($end));
		return $end == $temp;
	}

	//function migrated from  crud.php
	function extractDbField($dbType){
		$index =strpos($dbType, '(');
		if ($index) {
			return substr($dbType, 0,$index);
		}
		return $dbType;
	}

	function extractDbTypeLength($dbType){
		$index =strpos($dbType, '(');
		if ($index) {
			$len = strlen($dbType)-($index+2);
			return substr($dbType, $index+1,$len);
		}
		return '';
	}

	function getPhpType($dbType){
		$type=array('varchar'=>'string','text'=>'string','int'=>'integer','year'=>'integer','real'=>'double','float'=>'float','double'=>'double','timestamp'=>'date','date'=>'date','datetime'=>'date','time'=>'time','varbinary'=>'byte_array','blob'=>'byte_array','boolean'=>'boolean','tinyint'=>'boolean','bit'=>'boolean');
		$dbType = extractDbField($dbType);
		$dbType = strtolower($dbType);
		return $type[$dbType];
	}

	// this get the first letter in a string
	function getFirstString($str){
	    if($str){
	        return strtolower(substr($str, 0, 1));
	    }
	    return false;
	}

	//function to format mobile number
	function format_phone($country = 'nig', $phone) {
	  $function = 'format_phone_' . $country;
	  if(function_exists($function)) {
	    return $function($phone);
	  }
	  return $phone;
	}

	function format_phone_nig($phone) {
	  // note: making sure we have something
	  if(!isset($phone)) { return ''; }
	  // note: strip out everything but numbers 
	  $phone = preg_replace("/[^0-9]/", "", $phone);
	  $length = strlen($phone);
	  switch($length) {
	  case 7:
	    return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
	  break;
	  case 10:
	   return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
	  break;
	  case 11:
	  return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "+( 234 ) $2-$3-$4", $phone);
	  break;
	  default:
	    return $phone;
	  break;
	  }
	}

	//function to build select option from array object with id and value key
	function buildOption($array,$val=''){
		if (empty($array)) {
			return '';
		}
		$result ='';
		for ($i=0; $i < count($array); $i++) { 
			$current = $array[$i];
			$id = $current['id'];
			$value = $current['value'];
			$selected = $val==$id?"selected='selected'":'';
			$result.="<option value='$id' $selected>$value</option> \n";
		}
		return $result;
	}
	function getRoleIdByName($db,$name){
		$query = "select id from role where role_name=?";
		$result = $db->query($query,array($name));
		$result = $result->result_array();
		return $result[0]['id'];
	}
	function buildOptionFromQuery($db,$query,$data=null,$val=''){
		$result = $db->query($query,$data);
		$result = $result->result_array();
		if ($result==false) {
			return '';
		}
		return buildOption($result,$val);
	}
	function getDataResultComplaint($db,$query,$data=null){
		$result = $db->query($query,$data);
		$result = $result->result();
		if($result == false){
			return false;
		}
		return $result;
	}
	//function to buiild select option from an array of numerical keys
	function buildOptionUnassoc($array,$val=''){
		if (empty($array) || !is_array($array)) {
			return '';
		}
		$val = trim($val);
		$result = '';
		foreach ($array as $key => $value) {
			$current = ucfirst(trim($value));
			$selected = $val==$current?"selected='selected'":'';
			$result.="<option $selected >$current</option>";
		} 
			
		return $result;
	}

	//function to tell if a string start with another string
	function startsWith($str,$sub){
		$len = strlen($sub);
		$temp = substr($str, 0,$len);
		return $temp ===$sub;
	}

	function showUploadErrorMessage($webSessionManager,$message,$isSuccess=true,$ajax=false){
		if ($ajax) {
			echo $message;exit;
		}
		$referer = $_SERVER['HTTP_REFERER'];
		$base = base_url();
		if (startsWith($referer,$base)) {
			$webSessionManager->setFlashMessage('flash_status',$isSuccess);
			$webSessionManager->setFlashMessage('message',$message);
			header("location:$referer");
			exit;
		}
		echo $message;exit;
	}
	function loadClass($load,$classname){
		if (!class_exists(ucfirst($classname))) {
			$load->model("entities/$classname");
		}
	}

	//function to covert to local time reading
	function localTimeRead($dateTime){
		$date = date_create($dateTime);
		return date_format($date, 'G:ia');
	}

	// function to get date difference
	function getDateDifference($first,$second){
		$interval = date_diff(date_create($first),date_create($second));
		return $interval;
	}

	//function to get is first function is greater than the second
	function isDateGreater($first,$second){
		$interval = getDateDifference($first,$second);
		return $interval->invert;
	}

	//function to format a date
	function dateFormatter($posted){
 		if($posted){
 			$date = strftime("%d %B, %Y", strtotime($posted));
 		    return $date;
 		}
 		return false;	
 	}
 	function emptyDate($date){
 		if(substr($date,0,10) == '0000-00-00'){
			return true;
		}
 	}

	// function to calculate time ago
	function timeAgo($time_ago){
        $cur_time = time();
        $time_elapsed = $cur_time - strtotime($time_ago);
        $seconds = $time_elapsed ;
        $minutes = round($time_elapsed / 60 );
        $hours = round($time_elapsed / 3600);
        $days = round($time_elapsed / 86400 );
        $weeks = round($time_elapsed / 604800);
        $months = round($time_elapsed / 2600640 );
        $years = round($time_elapsed / 31207680 ); 

        if($seconds <= 60){
         	return  "$seconds seconds ago";
        }
        else if($minutes <=60){
            if($minutes==1){
             	return  "one minute ago";
            }
            else{
             	return  "$minutes minutes ago";
            }
        }
        else if($hours <=24){
            if($hours==1){
             	return  "an hour ago";
            }
            else{
             	return  "$hours hours ago";
            }
        }
        else if($days <= 7){
            if($days==1){
             	return  "yesterday";
            }
            else{
             	return  "$days days ago";
            }
        }
        else if($weeks <= 4.3){
            if($weeks==1){
             	return  "a week ago";
            }
            else{
             	return  "$weeks weeks ago";
            }
        }
        else if($months <=12){
            if($months==1){
             	return  "a month ago";
            }
            else{
             	return  "$months months ago";
            }
        }
        else{
            if($years==1){
             	return  "one year ago";
            }
            else{
             	return  "$years years ago";
            }
        }
	}

	function calc_size($file_size){
		$_size = '';
 		$kb = 1024;
		$mb = 1048576;
 		$gb = 1073741824;

		if(empty($file_size)){
		  	return '' ;
		}

	 	else if($file_size < $kb ) {
	 		return $_size . "B";

	 	}elseif($file_size > $kb AND $file_size < $mb ) {
	 		$_size = round($file_size/$kb, 2);
	 		return $_size . "KB";

	 	}elseif($file_size >= $mb AND $file_size < $gb) {
	 		$_size = round($file_size/$mb, 2);
	 		return $_size . "MB";

	 	}else if($file_size >= $gb ) {
	 		$_size = round($file_size/$gb, 2);
	 		return $_size . "GB";
	 	}else{
	 		return NULL;
	 	}
	 }

	// function to send download request of a file to the browser
	function sendDownload($content,$header,$filename){
		$content = trim($content);
		$header = trim($header);
		$filename = trim($filename);
		header("Content-Type:$header");
		header("Content-disposition: attachment;filename=$filename");
		echo $content; exit;
	}

	//function to generate inc number
	function generateInc($db,$pos,$format){
		$pos2= $pos + strpos($format, ')',$pos);
		$n = (int)substr($format, $pos+4,$pos2);
		$query = "select ID from applicant order by ID desc limit 1";
		$result = $db->query($query);
		$value = 0;
		if ($result->num_rows > 0) {
			$result = $result->result_array();
			$value =$result[0]['ID'];
		}
		$value++;
		return padNumber($n,$value);
	}
	function padNumber($n,$value){
		$value = ''+$value; //convert the type to string
		$prevLen= strlen($value);
		// if ($prevLen > $n) {
		// 	throw new Exception("Error occur while processing");
			
		// }
		$num = $n -$prevLen;
		for ($i=0; $i < $num; $i++) { 
			$value='0'.$value;
		}
		return $value;
	}
	function getFileExtension($filename){
		$index = strripos($filename, '.',-1);//start from the back
		if ($index === -1) {
			return '';
		}
		return substr($filename, $index+1);
	}
	//function to determine if a string is a file path
	function isFilePath($str){
		$recognisedExtension = array('doc','docx','pdf','ppt','pptx','xls','xlsx','txt','csv','jpg','png','jpeg','gif','ico');
		$extension = getFileExtension($str);
		return (startsWith($str,'uploads') && strpos($str, '/') && in_array($extension, $recognisedExtension)) ;
	}

	//function to pad a string by a number of zeros
	function padwithZeros($str,$len){
		$str.='';
		$count = $len - strlen($str);
		for ($i=0; $i < $count; $i++) { 
			$str='0'.$str;
		}
		return $str;
	}
	function generatePassword(){
		return randStrGen(10);
	}
	function randStrGen($len){
	    $result = "";
	    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
	    $charArray = str_split($chars);
	    for($i = 0; $i < $len; $i++){
		    $randItem = array_rand($charArray);
		    $ra = mt_rand(0,10);
		    $result .= "".$ra>5?$charArray[$randItem]:strtoupper($charArray[$randItem]);
	    }
	    return $result;
	}

	function appBuildName($key = 'cookie'){
		$result = array('cookie' => 'edu_cv', 'userType' => 'cv');
		return $result[$key];
	}

	//function to get the recent page cookie information
	function getPageCookie(){
		$result = array();
		$cookie = appBuildName('cookie');
		if (isset($_COOKIE[$cookie])) {
			$content = $_COOKIE[$cookie];
			$result = explode('-', $content);
		}
		return $result;
	}

	//function to save the page cookie
	function sendPageCookie($module,$page){
		$cookie = appBuildName('cookie');
		$content = $module.'-'.$page;
		setcookie($cookie,$content,0,'/','',false,true);
	}
	function show_access_denied(){
		include_once('application/views/access_denied.php');exit;
	}

	function show_operation_denied($loader){
		$loader->view('operation_denied');
	}
	//function to replace the first occurrence of a string
	function replaceFirst($toReplace,$replacement,$string){
		$pos = stripos($string, $toReplace);
		if ($pos===false) {
			return $string;
		}
		$len = strlen($toReplace);
		return substr_replace($string, $replacement, $pos,$len);
	}