<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Quesans_model');
		
	}

	public function index()
	{
		$data=array('title'=>"Post a Question");
		$this->load->view('postQMain',$data);
		
	}

	//post a question
	public function postQ(){
		if(!isset($this->session->userdata['sessiondata']['user_id']))
			$this->load->view('index');
		else{
			$user_id = $this->session->userdata['sessiondata']['user_id'];
		//$tag=$this->input->post('tag');
			$tagsInput = $this->input->post('tag');
			$tags = array_unique(explode(",", $tagsInput));
			$tagList = array();
			$length = count($tags);
			for($i=0;$i<$length;$i++){
				$s= trim($tags[$i]);
				if($s!="")
					$tagList[$i]=$s;
			}
			$data = array(
					'question_description'  => $this->input->post('ques'),
			        'user_id' 				=> $user_id 		        	  
					);	
			$newQuestionID = $this->Quesans_model->postQues($data,$tagList);							       
			if($newQuestionID){		
				echo $newQuestionID;
			}
			else{
				echo "false";
			};
		}
	}

	//question detail page
	public function qdp($question_id,$start_of_page=1,$records_per_page=3){
		$data = array(
				'title'=>"Question Detail Page",
		        'row1' => $this->Quesans_model->getQuesDetail($question_id,$start_of_page,$records_per_page)
		        );
		$data['page_number'] = $start_of_page;
		$data['qid'] = $question_id;
		$this->load->view('qdpMain',$data);
	}


	//select question for answering and load answer post page
	public function answer($question_id){
		if(!isset($this->session->userdata['sessiondata']['user_id']))
			$this->load->view('index');
		else{
		$question_description=$this->Quesans_model->getQuesDescription($question_id);		
		$data = array('question_id' => $question_id,
					   'question_description' =>$question_description,
					   'title'=>"Post An Answer"
					  );
		$this->load->view('answerQuestionMain',$data);
		}
	}

	//posting an answer
	public function postA(){
		if(!isset($this->session->userdata['sessiondata']['user_id']))
			$this->load->view('index');
		else{
			$user_id = $this->session->userdata['sessiondata']['user_id'];
			$question_id=$this->input->post('question_id');
			$answer=$this->input->post('answer');
			$data = array(
					'question_id'  => $question_id,
			        'user_id' 	   => $user_id ,
			        'answer '	   => $answer      	  
					);		
			if($this->Quesans_model->postA($data)){	
			    $data = array(
			    	'title'=>"Question Detail Page",
			        'row1' => $this->Quesans_model->getQuesDetail($question_id)
			        );	
			     $this->load->view('qdpMain',$data);
				
			}
			else{
				 $data = array('title' => "Error");
				 $this->load->view('errorMain',$data);
			}
		}
	}
}