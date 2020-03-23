<?php 
/**
* this class help save the configuration needed by the form in order to use a single file for all the form code.
* you only need to include the configuration data that matters. the default value will be substituted for other configuration value that does not have a key  for a particular entity.
*/
class FormConfig extends CI_Model
{
	private  $insertConfig;
	private $updateConfig;
	public $currentRole;
	
	function __construct($currentRole=false)
	{
		$this->currentRole=$currentRole;
		if ($currentRole) {
			$this->buildInsertConfig();
			$this->buildUpdateConfig();
		}
		
	}
	private function alternateAction(){
		$action = array();
		$userType = $this->webSessionManager->getCurrentUserProp('user_type');
		if($userType == 'member'){
			$action = array('edit' => 'edit/member','profile' => 'vc/member/profile');
		}else{
			$action = array('enable'=>'getEnabled','edit' => 'edit/member','delete' => 'delete/member','profile'=>'vc/member/profile');
		}
		return $action;
	}

	/**
	 * this is the function to change when an entry for a particular entitiy needed to be addded. this is only necessary for entities that has a custom configuration for the form.Each of the key for the form model append insert option is included. This option inculde:
	 * form_name the value to set as the name and as the id of the form. The value will be overridden by the default value if the value if false.
	 * has_upload this field is used to determine if the form should include a form upload section for the table form list
	 * hidden this  are the field that should be pre-filled. This must contain an associative array where the key of the array is the field and the value is the value to be pre-filled on the value.
	 * showStatus field is used to show the status flag on the form. once the value is true the status field will be visible on the form and false otherwise.
	 * exclude contains the list of entities field name that should not be shown in the form. The filed for this form will not be display on the form.
	 * submit_label is the label that is going to be displayed on the submit button
	 * 	table_exclude is the list of field that should be removed when displaying the table.
	 * table_action contains an associative arrays action to be displayed on the action table and the link to perform the action.
	 * the query paramete is used to specify a query for getting the data out of the entity
	 * upload_param contains the name of the function to be called to perform
	 * 
	 */ 
	private function buildInsertConfig()
	{
		$this->insertConfig= array
		(
			'member'=>array
			(
				'exclude' => array(),
				'table_exclude'=>array('img_path','status'),
				'table_action' => $this->alternateAction(),
				'submit_label' => 'Save',
				'table_title' => 'Member Table',
				// 'search'=>array('first_name','last_name','email'),
				'show_status' => true,
				'query' => 'select distinct member.ID,firstname,lastname,email,phone_number,path,member.status from member'
			),
			'admin'=>array
			(
				'table_title' => 'Admin Table',
				'show_status' => true
			),
			'role'=>array(
				'query'=>'select * from role where ID<>1'
			),
			'audios' =>array(
				// 'has_upload' => false
			),
			'gallery' => array(
				'show_add' => false,
				'extra_link' => 'vc/admin/gallery',
			),
			'events' => array(
				'show_add' => false,
				'extra_link' => 'vc/admin/events',
				'extra_value' => 'Add'
			)
		//add new entry to this array
		);
	}

	private function getFilter($tablename)
	{
		$result= array(
			
		);

		if (array_key_exists($tablename, $result)) {
			return $result[$tablename];
		}
		return false;
	}
	/**
	 * This is the configuration for the edit form of the entities.
	 * exclude take an array of fields in the entities that should be removed from the form.
	 */
	private function buildUpdateConfig()
	{
		$this->updateConfig= array
		(
		'member'=>array
			(
				'exclude'=>array('')		
			),
		//add new entry to this array
		);
	}
	function getInsertConfig($entities)
	{
		if (array_key_exists($entities, $this->insertConfig)) {
			$result=$this->insertConfig[$entities];
			if (($fil=$this->getFilter($entities))) {
				$result['filter']=$fil;
			}
			return $result;
		}
		if (($fil=$this->getFilter($entities))) {
			return array('filter'=>$fil);
		}
		return false;
	}

	function getUpdateConfig($entities)
	{
		if (array_key_exists($entities, $this->updateConfig)) {
			$result=$this->updateConfig[$entities];
			if (($fil=$this->getFilter($entities))) {
				$result['filter']=$fil;
			}
			return $result;
		}
		if (($fil=$this->getFilter($entities))) {
			return array('filter'=>$fil);
		}
		return false;
	}
}
 ?>