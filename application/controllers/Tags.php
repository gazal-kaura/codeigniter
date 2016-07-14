<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Quesans_model');	
	}
	
	//show all tags of website
     public function showAllTags()
     {
		$alltags=$this->Quesans_model->getAllTags();
    	$data= array('alltags' => $alltags,
    				 'title'=>"All Tags"
    				 );
    	$this->load->view('view_alltagsMain',$data);
		
	}

   //see if user is logged in
   public function validateLogin()
  	{
	  	if(!isset($this->session->userdata['sessiondata']['user_id'])){
  			redirect("/Answerme");
	  	}
 	} 

 	//get information of a particular tag
     public function tagInfo($tagid=1,$start_of_page=1,$number_of_records_per_page=5)
     {
     	$this->validateLogin();
		$data=$this->Quesans_model->getTagInfo($tagid,$start_of_page,$number_of_records_per_page);
 		$returnall=array('allinfo' => $data,
 						 'title'=>"Tag Detail Page",'tag_id' => $tagid , 'page_number' => $start_of_page);
 		//echo "<pre>";
        // print_r($returnall);
 	//	echo "</pre>";
		$this->load->view('allTagDetailMain',$returnall);		
	}
       
       //follow a tag  
    public function followTag($tgn)
	{
		$this->Quesans_model->addFollower($tgn);
		redirect(base_url("/index.php/tags/tagInfo/".$tgn));
	}

	//unfollow a tag
  	public function unFollowTag($tgn)
		{
		$this->Quesans_model->removeFollower($tgn);
		redirect(base_url("/index.php/tags/tagInfo/".$tgn));
		}
}
    
