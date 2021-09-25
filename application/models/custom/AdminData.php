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
		loadClass($this->load,'admin');
		$result['members'] = $this->admin->getDasboardCount('member','member_total');
		$result['article'] = $this->admin->getDasboardCount('article','article_total');
		$result['gallery'] = $this->admin->getDasboardCount('gallery','gallery_total');

		$result['art_data'] = $this->admin->getDashData('article');
		$result['aud_data'] = $this->admin->getDashData('audios');
		$result['vid_data'] = $this->admin->getDashData('videos');
		$result['eve_data'] = $this->admin->getDashData('events');
		$result['gal_data'] = $this->admin->getDashData('gallery');
		$jsonArray = array_merge($result['art_data'],$result['aud_data'],$result['vid_data'],$result['eve_data'],$result['gal_data']);

		$result['buildDataJson'] = json_encode($jsonArray);
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