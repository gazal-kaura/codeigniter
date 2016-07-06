<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Answerme extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model('User_model');
		$this->load->library('session');
		$this->load->library('form_validation');
	}
	

	public function index()
	{
		if(isset($this->session->userdata['sessiondata']['user_id']))
			$this->homepage();
		else
			$this->load->view('index');
	}

    


	public function abcd(){

		$result = $this->User_model->validateEmail($this->input->post('email'));			
		echo $result;

	}

	public function login(){		
		$email = $this->input->post('email');
		$password = $this->input->post('pwd');
		       
		if($this->User_model->checkUser($email,$password)){
			$sessiondata = array(
               		'user_id' => $this->User_model->getid($email),
                 	'email' => $email
               );
           $this->session->set_userdata('sessiondata',$sessiondata);
			echo "true";
		}
		else{
			echo "false";
		}
	}


	public function signup()
	{
		$this->load->view('signup');
	}

	public function error()
	{
		$this->load->view('error');
	}

	public function success()
	{
		$this->load->view('success');
	}

	public function homepage($start_of_page=1,$tab_called=1)
	{
		if(!isset($this->session->userdata['sessiondata']['user_id']))
			$this->load->view('index');
		else{
			$user_id = $this->session->userdata['sessiondata']['user_id'];

			if($tab_called == 1){
					$data = array(
			        	'row1'  => $this->User_model->recentQ($start_of_page),
					);	
			}else{
					$data = array(
			        	'row1'	=> $this->User_model->myInterest($user_id,$start_of_page)
					);	
			}
			
		
			$this->load->view('homepage',$data);
			$data['tab'] = $tab_called;
		    if($tab_called == 1)
		      $this->load->view('load_recent_page',$data);
		    else
		      $this->load->view('load_recent_page',$data);
		}
	}

	public function validateLogin()
  	{
	  	if(!isset($this->session->userdata['sessiondata']['user_id'])){
  			redirect("/Answerme");
	  	}
 	} 


public function contact()
	{
		$this->load->view('contact');
	}


public function logout()
	{		
   		$this->session->unset_userdata('user_id');
   		$this->session->unset_userdata('email');
        session_destroy();
		$this->load->view('index');
	}



public function profile()
	{
		if(!isset($this->session->userdata['sessiondata']['user_id']))
			$this->load->view('index');
		else{
			$user_id = $this->session->userdata['sessiondata']['user_id'];
			$data = array(
		        'row1' => $this->User_model->profile($user_id),
		        'row2' => $this->User_model->getQues($user_id),
		        'row3'=> $this->User_model->getUserTags($user_id)		        		    
				);	
	
			$this->load->view('profile',$data);
		}
	}

public function register()
	{


		 $config['upload_path']   = './uploads/'; 
         $config['allowed_types'] = 'gif|jpg|png'; 
         $config['max_size']      = 100; 
         $config['max_width']     = 1024; 
         $config['max_height']    = 768;           
         if ( ! is_dir($config['upload_path'])) {
            die("The Upload Folder Does not exists");
         }
         $this->load->library('upload', $config);
         $this->upload->initialize($config);
         
         if ( ! $this->upload->do_upload('userfile')) {              
            var_dump($this->upload->data());           

         }
         $upload_data=$this->upload->data();
         $file_name=$upload_data['file_name'];

		 $data = array(
		        'name' => $this->input->post('name'),
		        'email' => $this->input->post('email'),
		        'password' => md5($this->input->post('pwd')),
			    'phone_number' => $this->input->post('ph'),	
			    'profile_pic'  => $file_name		    
				);
		$this->User_model->insertUser($data);

		redirect('Answerme/index');
	}

	public function changePic(){
		$config['upload_path']   = './uploads/'; 
         $config['allowed_types'] = 'gif|jpg|png'; 
         $config['max_size']      = 100; 
         $config['max_width']     = 1024; 
         $config['max_height']    = 768;           
         if ( ! is_dir($config['upload_path'])) {
            die("The Upload Folder Does not exists");
         }
         $this->load->library('upload', $config);
         $this->upload->initialize($config);
         
         if ( ! $this->upload->do_upload('userfile')) {              
            var_dump($this->upload->data());           

         }
         $upload_data=$this->upload->data();
         $user_id = $this->session->userdata['sessiondata']['user_id'];
         $file_name=$upload_data['file_name'];
         $data = array(
         		'user_id'	   => $user_id,
			    'profile_pic'  => $file_name		    
				);
		$this->User_model->insertPic($data);

		redirect('Answerme/profile');

}

     public function showAllTags()
     {
		$alltags=$this->User_model->getAllTags();
    	$data= array('alltags' => $alltags);
    	$this->load->view('view_alltags',$data);
		
	}

    public function search()
	{
		$question=$this->input->post('question');
		$Tokens=explode(" ",$question);
		//var_dump($Tokens);
		$qid=array();
		    foreach($Tokens as $a)
		    {
		      $a=strtolower($a);
		      $tid=$this->User_model->tagExist($a);
		      $tagID=$tid[0]['tag_id'];
		      //var_dump($tid);
		      if(! $tid==0)
		      {
		        $questionID=$this->User_model->getQuesFromTag($tagID);
		       // var_dump($questionID);
		       foreach($questionID as $ques)
		        {
		          if(array_key_exists($ques['question_id'],$qid))
		            $qid[$ques['question_id']]=$qid[$ques['question_id']]+1;
		          else
		            $qid[$ques['question_id']]=1;
		          //var_dump($qid[$ques['question_id']]);
		        }
		      } 
   			}
    arsort($qid);
    $qid=array_keys($qid);
    $data1=array();
    foreach($qid as $a)
    {
      $data = array(
		        'row1' => $this->User_model->getQuesDetail($a),
		        'row2' => $this->User_model->getQuesDescription($a)
		        );
       array_push($data1,$data);

		
    }
    //var_dump($data1);
    $passingData = array('data1'=>$data1);
    $this->load->view('searchResult',$passingData);
   }

     public function tagInfo($tagid=1,$start_of_page=1,$number_of_records_per_page=5)
     {
     	$this->validateLogin();
		$data=$this->User_model->getTagInfo($tagid,$start_of_page,$number_of_records_per_page);
 		$returnall=array('allinfo' => $data);
		//echo count($returnall['allinfo']);
		$this->load->view('allTagDetail',$returnall);		
	}
         public function followTag($tgn)
		{
		$this->User_model->addFollower($tgn);
		$this->tagInfo($tgn);
		}
  public function unFollowTag($tgn)
		{
		$this->User_model->removeFollower($tgn);
		$this->tagInfo($tgn);
		}

	
	public function autoSuggestor(){
		$suggestion  = $this->input->get('term');
		$data = $this->User_model->getSuggestions1($suggestion);
		echo json_encode($data);

	}	 





}
    
