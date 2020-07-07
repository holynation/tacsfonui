<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Broadcast extends CI_Controller {

	function __construct(){
		parent::__construct();
	    $this->load->helper('string');
	    $this->load->helper('array');
	    $this->load->model('webSessionManager');
	    $this->load->model('custom/broadcastData','broadcast');
	}
	public function index()
	{
		$this->load->helper('string');
		$this->home();
	}

	public function home(){
		$data = array();
		$data = array_merge($data,$this->broadcast->loadHomeInfo());
		$this->load->view('broadcast/home',$data);
	}

	public function about(){
		$data = array();
		$this->load->view('broadcast/about',$data);
	}

	public function contact(){
		$data = array();
		if (isset($_POST["email"]) && isset($_POST["name"]) && isset($_POST["message"])) {
			$name  = $_POST["name"];
			$email = $_POST["email"];
			$mobile   = $_POST["mobile"];
			$msg   = $_POST["message"];
			$to    = "admin@tacsfonui.org";
		    $subject = "$name sent you a message via TACSFON UI"; /* <= Change the Subject If you want */
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= "From: ".$name." <".$email.">\r\n"."Reply-To: ".$email."\r\n" ;
			$msg     = "From: $name<br/> Email: $email <br/> Mobile: $mobile <br/>Message: $msg";
		   	$mail =  mail($to, $subject, $msg, $headers);
		  	if($mail){
				$this->webSessionManager->setFlashMessage('contactMsg',"Thank you, your message has been received. We would get back to you as soon as possible...");
				$data['message'] = true;
			}
			else{
				$this->webSessionManager->setFlashMessage('contactMsg',"There seems to be an error. Please try again later...");
				$data['message'] = false;
			}
		}
		$this->load->view('broadcast/contact',$data);
	}

	public function events(){
		$data = array();
		loadClass($this->load,'events');
		$data['events'] = $this->events->getEvents(" order by start desc limit 10");
		$this->load->view('broadcast/events',$data);
	}

	public function audio($id=null){
		$data = array();
		loadClass($this->load,'audios');
		$where='';
		$param = 'many';
		if(!is_null($id)){
			$param = 'single';
			$where = " where ID = '$id'";
			$data['extraAudios'] = $this->audios->allNonObject($totalRow,false,0,7,"order by date_created desc");
		}
		$data['param'] = $param;
		$data['audios'] = $this->audios->allNonObject($totalRow,false,0,20," $where order by date_created desc");
		$this->load->view('broadcast/audio',$data);
	}

	public function login(){
		$this->load->view('login');
	}

	// 2BB3C0
	#1B2223
}
