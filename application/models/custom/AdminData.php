<?php 
/**
* This is the class that manages all information and data retrieval needed by the admin section of this application.
*/
class AdminData extends CI_Model
{
	private $admin;
	function __construct()
	{
		parent::__construct();
		$this->loadAdmin();
	}

	private function loadAdmin()
	{
		$id = $this->webSessionManager->getCurrentUserProp('user_table_id');
		loadClass($this->load,'admin');
		$this->admin = new Admin(array('ID'=>$id));
		$this->admin->load();
	}

	public function loadDashboardData()
	{
		$result = array();
		// loadClass($this->load,'doctor');
		// loadClass($this->load,'patients');
		// loadClass($this->load,'appointment');
		// $where='';
		// $doctorID='';
		// $whereAppoint = '';
		// if($this->webSessionManager->getCurrentUserProp('user_type') == 'doctor'){
		// 	$doctorID = $this->webSessionManager->getCurrentUserProp('user_table_id');
		// 	$where = " and doctor_id = '$doctorID'";
		// 	$whereAppoint = "where doctor_id = '$doctorID'";
		// }
		// $result['countData']=array('doctor'=>$this->doctor->totalCount(),'patients'=>$this->patients->totalCount(),'appointAttend'=>$this->appointment->totalCount("where status = '0' $where"),'appointPend'=>$this->appointment->totalCount("where status = '1' $where"));
		// $result['appointment'] = $this->appointment->getAppoint($whereAppoint,'5');
		// $result['doctors'] = $this->doctor->getDoctor();

		return $result;
	}

	public function getAdminSidebar()
	{
		loadClass($this->load,'role');
		$role = new Role();
		return $role->getModules();
	}
	public function getCanViewPages($role)
	{
		$result =array();
		$allPages =$this->getAdminSidebar();
		$permissions = $role->getPermissionArray();
		foreach ($allPages as $module => $pages) {
			$has = $this->hasModule($permissions,$pages,$inter);
			$allowedModule =$this->getAllowedModules($inter,$pages['children']);
			$allPages[$module]['children']=$allowedModule;
			$allPages[$module]['state']=$has;
		}
		return $allPages;
	}

	private function getAllowedModules($includesPermission,$children)
	{
		$result = $children;
		$result=array();
		foreach ($children as $key=>$child) {
			if (in_array($child, $includesPermission)) {
				$result[$key]=$child;
			}
		}
		return $result;
	}

	private function hasModule($permission,$module,&$res)
	{
		$res =array_intersect(array_keys($permission), array_values($module['children']));
		if (count($res)==count($module['children'])) {
			return 2;
		}
		if (count($res)==0) {
			return 0;
		}
		else{
			return 1;
		}

	}

}

 ?>