<?php 

/**
 * This is the Model that manages webApi specific request
 */
class WebApiModel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('webSessionManager');
		
		// using this to set the member so that it is included in the post array
		if ($member=getMember()) {
			$_POST['member_id']=$member->ID;
		}
	}

    function ping(){
        displayJson(true,'testing case for cors header');return;
    }

	// here is the where the api start

    private function uploadMultipleImage($fieldName){
        $dataImage = [];
        if(!empty($_FILES)){
            $count = count($_FILES[$fieldName]['name']);
            $_rootUpload = "uploads/postStatus/";
            for($i=0;$i<$count;$i++){
                if(!empty($_FILES[$fieldName]['name'][$i])){
                    $_FILES['file']['name'] = $_FILES[$fieldName]['name'][$i];
                    $_FILES['file']['type'] = $_FILES[$fieldName]['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES[$fieldName]['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES[$fieldName]['error'][$i];
                    $_FILES['file']['size'] = $_FILES[$fieldName]['size'][$i];
          
                    $config['upload_path'] = $_rootUpload; 
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['max_size'] = '5000';
                    $config['file_name'] = $_FILES[$fieldName]['name'][$i];
                    $config['encrypt_name'] = true;
           
                    $this->load->library('upload',$config);  
                    if($this->upload->do_upload('file')){
                        $uploadData = $this->upload->data();
                        $filename = $_rootUpload.$uploadData['file_name'];
                        $dataImage[] = $filename;
                    }else{
                        $error = $this->upload->display_errors("","");
                        displayJson(false,'oops, something went wrong while uploading...',$error);
                        return;
                    }
                }
            }
        }
        return $dataImage;
    }

    public function getLeftList(){
        loadClass($this->load,'coin_point');
        loadClass($this->load,'topic');
        $result = array();
        $result['topList'] = $this->coin_point->getTopList();
        $result['recentTopic'] = $this->topic->getRecentList();
        displayJson(true,'success',$result);
        return;
    }

    public function getForumTopic(){
        if(isset($_GET['task']) && $_GET['task'] != 'topicFeed'){
            displayJson(false,'something went wrong');return;   
        }
        loadClass($this->load,'topic');
        $forum_id = @$_GET['fid'];
        $start = array_key_exists('start', $_GET)?$_GET['start']:1;
        $len = array_key_exists('len', $_GET)?$_GET['len']:10;
        $searchq = array_key_exists('q', $_GET)?$_GET['q']:"";
        $result = array();
        $result['topicFeeds'] = $this->topic->getForumTopic($forum_id,$start,$len,$numOfPage,$searchq);
        $result['numOfTopicPage'] = $numOfPage;
        $result['recentTopic'] = $this->topic->getRecentList();
        $result['featuredTopic'] = $this->topic->getFeatureList();
        if(!$result){
            displayJson(false,'there seems to be no feeds available');return false;
        }
        displayJson(true,'success',$result);
        return;
    }

}

 ?>