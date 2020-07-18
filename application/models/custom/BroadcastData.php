<?php 
/**
* This is the class that manages all information and data retrieval needed by the student section of this application.
*/
class BroadcastData extends CI_Model
{
	private $public;
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Africa/Lagos");
	}

	public function loadHomeInfo()
	{
		#get the iformatin for
		$result = array();
		loadClass($this->load,'events');
		loadClass($this->load,'audios');
		loadClass($this->load,'gallery');
		loadClass($this->load,'article');
		$date = date('Y-m-d');
		$whereParam = " where cast(start as date) >= $date order by start desc limit 1 ";
		$eventResult = $this->events->getEvents($whereParam);
		if(!$eventResult){
			$result['currentEvents'] = $this->events->getEvents(" order by ID desc limit 1");
		}else{
			$result['currentEvents'] = $eventResult;
		}
		$result['extraAudios'] = $this->audios->allNonObject($totalRow,false,0,7,"order by date_created desc");
		$result['audios'] = $this->audios->allNonObject($totalRow,false,0,6,'order by date_created desc');
		$result['events'] = $this->events->getEvents(" order by start desc limit 8");
		$result['galleries'] = $this->gallery->allNonObject($totalRow,false,0,8," where display_type = 'home' order by ID desc");
		$result['articles'] = $this->article->allNonObject($totalRow,false,0,8,"order by date_created desc");
		return $result;
	}

}
