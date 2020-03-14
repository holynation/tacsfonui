<?php 
/**
* 
*/
class Auth extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('entities/user');
		$this->load->model('webSessionManager');
		// $this->load->library('hash_created');
	}

	public function login($data = ''){
		$this->load->view('login', $data );
	}

	public function web(){
		$isAjax =  isset($_POST['isajax']);
		if(isset($_POST) && count($_POST) > 0 && !empty($_POST)){
			$email = $this->input->post('email',true);
			$password = $this->input->post('password',true);

			if (!isNotEmpty($email,$password)) {
				echo createJsonMessage('status',false,'message',"please fill all required field and try again");
				return;
			}
			
			$find = $this->user->find($email);
			$checkPass = md5(trim($password)) == $this->user->data()[0]['password'];
			// $checkPass = $this->hash_created->decode_password(trim($password), $this->user->data()[0]['password']);
			if($checkPass){
				$array = array('username'=>$email,'password'=>md5($password),'status'=>1);
				$user = $this->user->getWhere($array,$count,0,null,false," order by field('user_type','admin','member')");
				if($user == false) {	
					if ($isAjax) {
						$arr['status']=false;
						$arr['message']= "invalid username or password";
						echo  json_encode($arr);
						return;
					}
					else{
						redirect(base_url());
					}
				}
				else{
					$user = $user[0];
					$baseurl = base_url();
					$this->webSessionManager->saveCurrentUser($user,true);
					$baseurl.=$this->getUserPage($user);
					if ($isAjax) {
						$arr['status']=true;
						$arr['message']= $baseurl;
						// echo $baseurl;exit;
						echo  json_encode($arr);
						return;
					}else{
						redirect($baseurl);exit;
					}
				}
			}else{
				$arr['status']=false;
				$arr['message'] = 'invalid username or password';
				echo json_encode($arr);exit;
			}
		}

		$this->login();
	}

	private function getUserPage($user){
		$link= array('member'=>'vc/member/dashboard','admin'=>'vc/admin/dashboard');
		$roleName = $user->user_type;
		return $link[$roleName];
	}

	public function logout1(){
		$this->user->logout();
		redirect('/welcome/','refresh');
	}

	public function logout(){
		$link ='';
		$base = base_url();
		$this->webSessionManager->logout();
		$path = $base.$link;
		header("location:$path");exit;
	}

}
 ?>