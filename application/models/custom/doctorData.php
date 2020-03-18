<?php 
/**
* This is the class that manages all information and data retrieval needed by the student section of this application.
*/
class DoctorData extends CI_Model
{
	private $doctor;
	function __construct()
	{
		parent::__construct();
	}

	public function loadDashboardInfo()
	{
		#get the iformatin for 
		//get the information needed
		loadClass($this->load,'level');
		$result = array();
		$result['program']=@$this->student->program->program_name;
		$session = $this->webSessionManager->getCurrentSession();
		$sss = $this->webSessionManager->getCurrentSessionSemester();
		loadClass($this->load,'session_semester');
		$this->session_semester->ID=$sss;
		$result['cSession']=@$this->session_semester->academic_session->session_name;
		$result['cSemester']=@$this->session_semester->semester->semester_name;
		$result['regCourse']=$this->student->getRegisteredCourseCount($session);
		$result['regUnit']=$this->student->getTotalUnitCount($session)?$this->student->getTotalUnitCount($session):0;
		//get the level of courses registered by session spent by the student
		$tempLevel = $this->student->getLevelAt($session);
		$level = new Level(array('ID'=>$tempLevel));$level->load();
		$result['level']=$level;
		$result['unitHistory']=$this->student->getUnitHistory();
		loadClass($this->load,'request_notification');
		loadClass($this->load,'complaint_notification');
		$result['complaintNotification']=$this->complaint_notification->hasNewComplaint();
		$result['requestNotification']=$this->request_notification->hasNewResponse();
		return $result;
	}

}
