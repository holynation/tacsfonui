<?php 
/**
* This is the class that manages all information and data retrieval needed by the student section of this application.
*/
class PatientsData extends CI_Model
{
	private $student;
	function __construct()
	{
		parent::__construct();
	}

	public function setStudent($student)
	{
		$this->student=$student;
	}

}
