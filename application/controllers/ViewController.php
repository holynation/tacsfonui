<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ViewController extends CI_Controller{

//field definition section
  private $needId= array();

  private $needMethod=array();
  private $errorMessage; // the error message currently produced from this cal if it is set, it can be used to produce relevant error to the user.
  private $access = array();
  private $schoolData;

  function __construct(){
		parent::__construct();
		$this->load->model("modelFormBuilder");
		$this->load->model("tableViewModel");
    $this->load->helper('string');
    $this->load->helper('array');
    $this->load->model('webSessionManager');
    $this->load->model('queryHtmlTableModel');
    // $this->load->library('hash_created');
    if (!$this->webSessionManager->isSessionActive()) {
      header("Location:".base_url());exit;
    }
	}

// bootsrapping functions 
  public function view($model,$page='index',$third='',$fourth=''){
    if ( !(file_exists("application/views/$model/") && file_exists("application/views/$model/$page".'.php')))
    {
      show_404();
    }

    // this number is the default arg that ID is the last arg i.e 3 = id
    $defaultArgNum =4; 
    $tempTitle = removeUnderscore($model);
    $title = $page=='index'?$tempTitle:ucfirst($page)." $tempTitle";
    //$schoolName = empty($this->session->userdata('schoolName'))?//till the school name getter is added
    $data['id'] = ($fourth == '') ? $third : $fourth;
    if (func_num_args() > $defaultArgNum) {
      $args = func_get_args();
      $this->loadExtraArgs($data,$args,$defaultArgNum);
    }

    // if ($this->webSessionManager->getCurrentUserProp('user_type')=='admin') {
    //   //check for the permission for the admin here
    // }

    $exceptions = array();//pages that does not need active session
    if (!in_array($page, $exceptions)) {
      if (!$this->webSessionManager->isSessionActive()) {
        redirect(base_url());exit;
      }
    }

    //get the name of the school set on the system
    $data['school']=$this->schoolData;
    if (method_exists($this, $model)) {
      $this->$model($page,$data);
    }
    $methodName = $model.ucfirst($page);

    if (method_exists($this, $model.ucfirst($page))) {
      $this->$methodName($data);
    }

    $data['model'] = $page;
    $data['message']=$this->session->flashdata('message');
    sendPageCookie($model,$page);

    return $this->load->view("$model/$page", $data);
  }

  private function admin($page,&$data)
  {
    $role_id=$this->webSessionManager->getCurrentUserProp('role_id');
    if (!$role_id) {
      show_404();
    }


    $this->load->model('custom/adminData');
    $role=false;
    if ($this->webSessionManager->getCurrentUserProp('user_type')=='member') {
      loadClass($this->load,'member');
      $this->member->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
      $this->member->load();
      $data['member']=$this->member;
      $role = $data['member']->role;
    }else {
      loadClass($this->load,'admin');
      $this->admin->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
      $this->admin->load();
      $data['admin']=$this->admin;
      $role = $this->admin->role;
    }
    $data['currentRole']=$role;
    if (!$role) {
      show_404();exit;
    }
    $path ='vc/admin/'.$page;

    // this approach is use so as to allow this page pass through using a page that is already permitted
    if($page=='permission') {
      $path ='vc/add/role';
    }

    if($page == 'create'){
      $path = 'vc/create/events';
    }

    // end the permitted page already loaded
    if (!$role->canView($path)) {
      show_access_denied();exit;
    }


    $sidebarContent=$this->adminData->getCanViewPages($role);
    // print_r($sidebarContent);exit;
    $data['canView']=$sidebarContent;

  }

  private function adminDashboard(&$data)
  {
   $data = array_merge($data,$this->adminData->loadDashboardData());
  }

  private function adminPermission(&$data)
  {
    if (!isset($data['id']) || !$data['id'] || $data['id']==1) {
      show_404();exit;
    }
    $newRole = new Role(array('ID'=>$data['id']));
    $newRole->load();
    $data['role']=$newRole;
    $data['allPages']=$this->adminData->getAdminSidebar();
    $sidebarContent=$this->adminData->getCanViewPages($data['role']);
    // print_r($sidebarContent);exit;
    $data['permitPages']=$sidebarContent;
    $data['allStates']=$data['role']->getPermissionArray();
  }

  private function adminProfile(&$data)
  {
    loadClass($this->load,'admin');
    $admin = new Admin();
    $admin->ID=$this->webSessionManager->getCurrentUserProp('user_table_id');
    $admin->load();
    $data['memberCount'] = $this->admin->getDasboardCount('member','member_total');
    $data['admin']=$admin;
  }

  private function patients($page,&$data){
    $this->load->model('custom/patientsData');
    loadClass($this->load,'patients');
    $id = $this->webSessionManager->getCurrentUserProp('user_table_id');
    $this->patients = new Patients(array('ID'=>$id));
    $this->patients->load();
    $data['patients'] = $this->patients;
  }

  private function patientsProfile(&$data){
    if ($this->webSessionManager->getCurrentUserProp('user_type')=='admin') {
      $this->admin('profile',$data);
      if (!isset($data['id']) || !$data['id']) {
        show_404();exit;
      }
      $patients = new Patients(array('ID'=>$data['id']));
      if (!$patients->load()) {
        show_404();exit;
      }
      $data['patients']=$patients;
      $data['extra']=true;
    }
  }

  //function for loading edit page for general application
  function edit($model,$id){
    $userType=$this->webSessionManager->getCurrentUserProp('user_type');
    if($userType == 'admin'){
      loadClass($this->load,'admin');
      $this->admin->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
      $this->admin->load();
      $role = $this->admin->role;
      $role->checkWritePermission();
    }else{
      $role = true;
    }
    
    $ref = @$_SERVER['HTTP_REFERER'];
    if ($ref&&!startsWith($ref,base_url())) {
      show_404();
    }
    $this->webSessionManager->setFlashMessage('prev',$ref);
    $exceptionList= array('user');//array('user','applicant','student','staff');
    if (empty($id) || in_array($model, $exceptionList)) {
      show_404();exit;
    }
    $this->load->model('formConfig');
    $formConfig = new formConfig($role);
    $configData=$formConfig->getUpdateConfig($model);
    $exclude = ($configData && array_key_exists('exclude', $configData))?$configData['exclude']:array();
     $formContent= $this->modelFormBuilder->start($model.'_edit')
        ->appendUpdateForm($model,true,$id,$exclude,'')
        ->addSubmitLink(null,false)
        ->appendSubmitButton('Update','btn btn-success')
        ->build();
        echo createJsonMessage('status',true,'message',$formContent);exit;
  }

  function extra($model,$id,$_1){
    $role = true;

    $userType=$this->webSessionManager->getCurrentUserProp('user_type');
    if ($userType=='lecturer') {
      loadClass($this->load,'lecturer');
      $this->lecturer->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
      $this->lecturer->load();
    }
    else{
      loadClass($this->load,'admin');
      $this->admin->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
      $this->admin->load();
    }

    $ref = @$_SERVER['HTTP_REFERER'];
    if ($ref&&!startsWith($ref,base_url())) {
      show_404();
    }

    $this->webSessionManager->setFlashMessage('prev',$ref);
    $exceptionList= array('user');//array('user','applicant','student','staff');
    if (empty($id) || in_array($model, $exceptionList)) {
      show_404();exit;
    }
    // this is to set the form id of the original form
    $extraParam = array(
        'extra_model' => $id,
        'extra_id'    => $_1
    );
    // $this->webSessionManager->setContent('extra_id',$id);
    $this->webSessionManager->setArrayContent($extraParam);
    $this->load->model('formConfig');
    $formConfig = new formConfig($role);
    $configData=$formConfig->getUpdateConfig($model);
    $exclude = ($configData && array_key_exists('exclude', $configData))?$configData['exclude']:array();
    $hidden = ($configData && array_key_exists('hidden', $configData))?$configData['hidden']:array();
    $showStatus = ($configData && array_key_exists('show_status', $configData))?$configData['show_status']:false;
    $submitLabel = ($configData && array_key_exists('submit_label', $configData))?$configData['submit_label']:"Save";

     $formContent= $this->modelFormBuilder->start($model.'_table')
        ->appendInsertForm($model,true,$hidden,'',$showStatus,$exclude)
        ->addSubmitLink()
        ->appendSubmitButton($submitLabel,'btn btn-success')
        ->build();
        echo createJsonMessage('status',true,'message',$formContent);exit;
  } 

  // this method is for creation of form either in single or combine based on the page desire
  public function create($model,$type='add'){
    if(!empty($type)){
      if($type=='single'){ // this is the single page
        $this->add($model,'create');
      }else{ // this is the combine page
        $this->add($model,'add');
      }
    }
    return "please specify a type to be created (single or combine)";
  }

  private function add($model,$type)
  {

    $role_id=$this->webSessionManager->getCurrentUserProp('role_id');
    $userType=$this->webSessionManager->getCurrentUserProp('user_type');
    if($userType == 'admin'){
      if (!$role_id) {
        show_404();
      }
    }

    $role =false;
    if ($userType=='member') {
      loadClass($this->load,'member');
      $this->member->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
      $this->member->load();
      $role = $this->member->role;
      $data['member']=$this->member;
    }
    else{
      loadClass($this->load,'admin');
      $this->admin->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
      $this->admin->load();
      $role = $this->admin->role;
      $data['admin']=$this->admin;
      $data['currentRole']=$role;
      $path ="vc/$type/".$model;

      $excludePage = array('create');
      if(in_array($model, $excludePage)){
        if (!$role->canView($path)) {
          show_access_denied($this->load);exit;
        }
      }
      
    }

    if (!$this->webSessionManager->isSessionActive()) {
      header("Location:".base_url());exit;
    }
    if ($model==false) {
      show_404();
    }

    if($userType == 'admin'){
      $this->load->model('custom/adminData');
      $sidebarContent=$this->adminData->getCanViewPages($role);
      $data['canView']=$sidebarContent;
    }

    loadClass($this->load,$model);
    $test = new $model();
    $this->load->model('Crud');
    $this->load->model('modelFormBuilder');
    if (!is_subclass_of($test ,'Crud')) {
      show_404();exit;
    }
    $this->load->model('formConfig');
    $formConfig = new formConfig($role);
    $data['configData']=$formConfig->getInsertConfig($model);
    $data['model']=$model;
    $this->load->view("$type",$data);
  }

  function changePassword()
  {
    if(isset($_POST) && count($_POST) > 0 && !empty($_POST)){
      $curr_password = trim($_POST['current_password']);
      $new = trim($_POST['password']);
      $confirm = trim($_POST['confirm_password']);

      if (!isNotEmpty($curr_password,$new,$confirm)) {
        echo createJsonMessage('status',false,'message',"empty field detected.please fill all required field and try again");
        return;
      }
      
      $id= ($_POST['userID'] != '') ? $_POST['userID'] : $this->webSessionManager->getCurrentUserProp('ID');
      $this->load->model('entities/user');
      if($this->user->find($id)){
        $check = md5(trim($curr_password)) == $this->user->data()[0]['password'];
        // $check = $this->hash_created->decode_password(trim($curr_password), $this->user->data()[0]['password']);
        if(!$check){
          echo createJsonMessage('status',false,'message','your current password is not correct.','flagAction',false);
          return;
        }
      }

      if ($new !==$confirm) {
        echo createJsonMessage('status',false,'message','new password does not match with the confirmation password','flagAction',false);exit;
      }
      $new = md5($new);
      // $new = $this->hash_created->encode_password($new);
        $query = "update user set password = '$new' where ID=?";
        if ($this->db->query($query,array($id))) {
          $arr['status']=true;
          $arr['message']= 'operation successfull';
          $arr['flagAction'] = true;
          echo json_encode($arr);
          return;
        }
        else{
          $arr['status']=false;
          $arr['message']= 'error occured during operation...';
          $arr['flagAction'] = false;
          echo json_encode($arr);
          return;
        }
    }
    return false;
  }

}

?>
