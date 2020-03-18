<?php 
	/**
	* this class will be used to generate table using normal query and will also contain action like the other query
	* will also include paging ability
	*/
	class QueryHtmlTableModel extends CI_Model
	{
		private $defaultPagingLength =50;
		private $classname;
		public $export=false;
		protected $foreignKeyEnd='_id';
		protected $from = 'from';

		function __construct()
		{
			parent::__construct();
			$this->load->model('crud');
			$this->lang->load('table_model');
		}
		public function buildOrdinaryTable($data,$action=array(),$header=null){
			return $this->buildHtmlAndAction($data,$action,$header);
		}
		/**
		 * This method generate html table output based on the query given an the action parameter
		 * @param  [string]  $query        the query to send to the database . it must be a select query
		 * @param  [mixed]  $header       the array containing the header table
		 * @param  [array]  $queryData    the query must be a paramterized query and this represeent the array of paramter data
		 * @param  mixed $totalLength the total length of this query is passed to this variable
		 * @param  integer $lower        [if paging is used this is the starting point ]
		 * @param  [type]  $length       [this is the length of the data to be retrieved]
		 * @param  array   $actionArray  this is an associative array of associative array that contains the information needed to generate action 
		 * @return [string]                the html table string generated
		 */
		public function getHtmlTableWithQuery($query,$queryData=NULL, &$totalLength,$actionArray=array(),$header=null,$paged=true,$lower=0, $length=NULL,$parentModel=null,$excludeArray=array(),$appendForm=array()){
			if (empty($query)) {
				throw new Exception($this->lang->line('no_query'));
			}
			$limit="";
			$array = array();
			$onclause ="";
			$foreignTable = array();
			$dataQuery='';
			if ($paged) {
				$length = $length?$length:$this->defaultPagingLength;
				//use get function for the len and the start index for the sorting
				$lower = (isset($_GET['p_start'])&& is_numeric($_GET['p_start']) )?(int)$_GET['p_start']:$lower;
				$length = (isset($_GET['p_len'])&& is_numeric($_GET['p_len']) )?(int)$_GET['p_len']:$length;
				if ($length!=NULL && !$this->export) {
					$limit = " LIMIT $lower,$length ";
					// $array=array($lower,$length);
				}
			}

			//check that the query is a select query and the there an id field specified is query array is not empty
			if (!empty($actionArray) && ( strpos($query, "ID") ===false || strpos($query, " * ")===false)  && strpos(strtolower($query), "select") ===false) {
				throw new Exception($this->lang->line('no_select_query'));
			}
			$query.=$limit;
			//merge the array
			if (empty($queryData) ){
				$queryData =$array;
			}
			else{
				$queryData = array_merge($queryData,$array);
			}

			if($parentModel != null){
				$fieldList = $this->buildDataJoinQuery($query,$queryData,$parentModel,$excludeArray,$onclause,$foreignTable);
				$joinStatement = $onclause;
				$dataQuery = "select $fieldList from $parentModel $joinStatement where $parentModel.lecturer_id=? $limit";
			}else{
				$dataQuery = $query;
			}

			//add calculate found rows rule to the query

			// $query=$paged?replaceFirst("select", "select SQL_CALC_FOUND_ROWS ", $query):$query;
			$dataQuery=$paged?replaceFirst("select", "select SQL_CALC_FOUND_ROWS ", $dataQuery):$dataQuery;
			$result = $this->db->query($dataQuery,$queryData);

			if ($paged) {
				$result2 = $this->db->query("SELECT FOUND_ROWS() as totalCount");
				$result2=$result2->result_array();
				$totalLength=$result2[0]['totalCount']; 
			}
			$result = $result->result_array();
			if ($this->export) {
				$this->load->model('tableViewModel');
				$this->tableViewModel->loadExportTable('table_data',$result);
			}
			$totalLength= $totalLength?$totalLength:count($result);
			$extra ='';
			if ($paged) {
				$this->load->model('tableViewModel');
				$classname = $this->extractClassnameFromQuery($query);
				$extra =$this->tableViewModel->generatePagedFooter($totalLength,$lower,$length);
			}
			return $this->buildHtmlAndAction($result,$actionArray,$header,$appendForm).$extra;
		}

		private function buildDataJoinQuery($query,$queryData,$parentModel,$excludeArray=array(),&$onclause,&$foreignTable){
			if($query != null){
				$queryString = '';
				$data = array();
				$result = $this->db->query($query,$queryData);
				$results = $result->result_array();
				$display='';
				$foreignVal = '';
				if($result->num_rows() > 0){
					$fields = array_keys($results[0]);
					foreach($fields as $key => $val){
						if(!empty($excludeArray)){
							if(in_array($val,$excludeArray)){
								continue;
							}
						}

						if(endsWith($val,$this->foreignKeyEnd)){
							$tablename = substr($val, 0,strlen($val)-strlen($this->foreignKeyEnd));
							$tablename = strtolower($tablename);
							if (!class_exists($tablename)) {
								$this->load->model("entities/$tablename");
							}
							if (isset($tablename::$displayField)) {
								if (is_array($tablename::$displayField)) {
									$display="concat_ws(' '";
									foreach ($tablename::$displayField as $tval) {
										$display.=",".$tablename.'.'.$tval;
									}
									$display.=") as $val";
								}
								else{
									$display = strtolower($tablename::$tablename).'.'.$tablename::$displayField.' as '.$val;
									// $display =$tablename::$displayField.' as '.$val;
								}
								$foreignTable[]=$tablename;
								$temp = $parentModel.'.'.$tablename.$this->foreignKeyEnd;
								$usse = isset($tablename::$joinField)?$tablename.'.'.$tablename::$joinField :"$tablename.ID";
								$onclause.=" left join $tablename on $temp =$usse ";
							}else{
								$display = $parentModel.'.'.$val;
							}
							$val = $display;
						}else{
							$val = $parentModel.'.'.$val;
						}

						if($val == "$parentModel.date_created"){
							continue;
						}

						$data[]= $val;

					}
				}else{
					echo $this->lang->line('no_record_found');
				}

				$queryString = implode(",", $data);
				return $queryString;
			}
		}

		//function to extract classname from query
		private function extractClassnameFromQuery($query){
			$pos = strpos($query, ".ID");
			if ($pos!==false) {
				$len = strlen($query);
				$div = $pos - $len;
				$spaceIndex = strrpos(substr($query,0,$pos), ' ');
				$this->classname = trim(substr($query, $spaceIndex+1,($pos - ($spaceIndex+1))));
				if ($this->classname=='std') {
					$this->classname='student';
				}
				return;
			}
			//if .id is not present then validate the id is present and get the first string after the from keywork
			$pos = strpos($query, "ID");
			if ($pos!==false) {
				//get the index of from and then get the index of space 
				$from = stripos($query, 'from');
				$from+=strlen("from") + 1;

				$classname = substr($query,$from,strpos($query, ' ',$from) -$from);
				// echo "testing showng classname check file. $classname";exit;
				$this->classname = $classname;
			}
		}
		private function buildHtmlAndAction($data,$action,$header=null,$appendForm=array()){
			if (empty($data)) {
				return "<div class='empty-data alert alert-primary text-light'>" .$this->lang->line('no_record_found') . "</div>";	
			}
			$result = $this->openTableTag();
			$result.= $this->extractheader(empty($header)?array_keys($data[0]):$header,!empty($action),$appendForm);
			$result.= $this->buildTableBody($data,$action,$appendForm);
			$result.= $this->closeTableTag();
			return $result;
		}
		private function openTableTag(){
			return "<div class=\"box\"><div class=\"table-responsive no-padding\"><table class='table table-bordered'>\n";
		}
		private function extractheader($keys,$includeAction=true,$appendForm=array()){
			$result='<thead>';
			$emptyHeader='';
			if ($includeAction) {
				$keys[]='Action';
			}

			if(!empty($appendForm)){
				$emptyHeader = "<th></th>";
			}

			$sn = "<th>S/N</th>";
			$result.="
			<tr> $emptyHeader $sn";

			

			for ($i=0; $i < count($keys); $i++) { 
				if ($keys[$i]=='ID' ||$keys[$i]=='id' ) {
					continue;
				}
				$header =removeUnderscore($keys[$i]);
				$result.="<th>$header</th>";
			}
			$result.="</tr>
			<thead>";
			return $result;
		}

		private function buildTableBody($data,$action,$appendForm=array()){
			$result ="<tbody>";
			for ($i=0; $i < count($data); $i++) { 
				$current = $data[$i];
				$result.=$this->buildTableRow($current,$action,@$_GET['p_start']+$i,$appendForm);
			}
			$result.='</tbody>';
			return $result;
		}

		private function buildTableRow($data,$action,$index=false,$appendForm=array()){
			$result ='<tr class="append-content">';
			if(!empty($appendForm)){
				extract($appendForm);
				$id = isset($data['ID'])?$data['ID']:'';
				$otherClass = ($attrClass) ? $attrClass : '';
				$inputForm = "<label class='form-check-label'><input type='$type' class='$otherClass $class' name='".$name."[]' id='".$name."[]' value='$id' /></label>";
				$result.="<td><div class='form-check form-check-flat'>$inputForm</div></td>";
			}
			if ($index!==false) {
				$index+=1;
				$result.="<td>$index</td>";
			}
			$keys = array_keys($data);
			for ($i=0; $i < count($keys); $i++) { 
				if ($keys[$i]=='ID' || $keys[$i]=='id') {
					continue;
				}
				$current = $data[$keys[$i]];

				if (isFilePath($current)) {
					$typeExt = getMediaType($current);
					$link = base_url($current);
					if($typeExt == 'audio'){
						$fileMsg = 'Hear Audio';
						$current = "<a href='$link' target='_blank'>$fileMsg</a>";
					}else if($typeExt == 'image'){
						$fileMsg = 'View Image';
						$current = "<a href='$link' target='_blank'>$fileMsg</a>";
					}else if($typeExt == 'video'){
						$fileMsg = 'View Video';
						$current = "<a href='$link' target='_blank'>$fileMsg</a>";
					}else{
						$link = base_url($current);
						$current = "<a href='$link' target='_blank' class='btn btn-info'>Download</a>";
					}
					
				}
				if (strtolower($keys[$i])=='status') {
					$current = $data[$keys[$i]]?'Enabled':'Disabled';
				}
				if (strtolower($keys[$i])=='disability') {
					$current = $data[$keys[$i]]?'Yes':'No';
				}
				if(strpos($current,'href')){
					$current = $current;
				}else{
					$current = $current = wordwrap($current,50,"<br />\n",true);
				}
				$result.="<td>$current </td>";
			}
			$result.=empty($action)?'':$this->addTableAction($action,$data);
			$result.='</tr>';
			return $result;
		}
		private function addTableAction($action,$data){
			$result= "<td class='action-column'>
			<div class='dropdown dropdown-action'><span class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false' style='cursor:pointer;'><i class='fa fa-ellipsis-v'></i></span>
			<ul class='dropdown-menu' data-model=''> 
			";
			foreach ($action as $key => $value) {
				$critical = 0;
				$ajax=0;
				$link ='';
				$label =$key;
				$default=1;
				$this->load->model('tableActionModel');
				if (method_exists($this->tableActionModel, $value)) {
					$value = $this->tableActionModel->$value($data,$this->classname);
					$value = array_values($value);
					$key = array_shift($value);
					$label = $key;
				} 
				$id = isset($data['ID'])?$data['ID']:'';
				if (is_array($value)) {
					$link=endsWith($value[0],'=')?($value[0].$id):($value[0].'/'.$id);
					$critical =$value[1];
					$ajax =$value[2];
				}
				else{
				$criticalArray = array('delete','disable','reset password','remove');
				if (in_array(strtolower($key), $criticalArray)) {
					$critical =1;
				}
				$link = endsWith($value,'=')?($value.$id):($value.'/'.$id);
				$link = base_url($link);
				}
				$editClass='';
				if($label=='edit' || $label=='update'){
					$editClass = "data-ajax-edit='1'";
				}else if ($label == 'editor'){
					$editClass = "data-ajax-editor='1'";
				}else{
					$editClass ='';
				}
				// $editClass = ($label=='edit' ||$label=='update')?"data-ajax-edit='1'":'';
				$result.="<li data-ajax='$ajax' data-critical='$critical' $editClass ><a class='dropdown-item text-center text-capitalize'  href='$link'>$label</a></li>";
			}
			$result.= '</ul></div></td>';
			return $result;
		}

		private function closeTableTag(){
			return "</table></div></div>";
		}
	}
 ?>