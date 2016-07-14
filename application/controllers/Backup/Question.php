<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model('User_model');
		$this->load->library('session');
		$this->load->library('form_validation');
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$this->load->view('postQ');
		
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
			$newQuestionID = $this->User_model->postQues($data,$tagList);							       
			if($newQuestionID){		
				echo $newQuestionID;
			}
			else{
				echo "false";
			};
		}
	}

	//question detail page
	public function qdp($question_id,$start_of_page=1,$records_per_page=5){
		$data = array(
		        'row1' => $this->User_model->getQuesDetail($question_id,$start_of_page,$records_per_page)
		        );
		$this->load->view('qdp',$data);
	}

	public function answer($question_id){
		if(!isset($this->session->userdata['sessiondata']['user_id']))
			$this->load->view('index');
		else{
		$data = array('question_id' => $question_id);
		$this->load->view('answerQuestion',$data);
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
			if($this->User_model->postA($data)){	
			    $data = array(
			        'row1' => $this->User_model->getQuesDetail($question_id)
			        );	
			     $this->load->view('qdp',$data);
				
			}
			else{
				 $this->load->view('error');
			}
		}
	}
}