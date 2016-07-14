<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Quesans_model');		
	
	}
	
	//redirect to login page
	public function index()
	{
		if(isset($this->session->userdata['sessiondata']['user_id']))
			redirect(base_url('index.php/Answerme/homepage'));
		else
			$this->load->view('index');
	}


    

	//see if email id already exists
	public function validateEmail(){//abcd

		$result = $this->User_model->validateEmail($this->input->post('email'));			
		echo $result;

	}


	//login page
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

	//load signup page
	public function signup()
	{
		$this->load->view('signup');
	}

	//see if user is logged in
	public function validateLogin()
  	{
	  	if(!isset($this->session->userdata['sessiondata']['user_id'])){
  			redirect("/Answerme");
	  	}
 	} 

 	//display admin contact
	public function contact()
	{
		$data=array('title'=>"Contact");
		$this->load->view('contactMain',$data);
	}

	//logout
	public function logout(){		
   		$this->session->unset_userdata('user_id');
   		$this->session->unset_userdata('email');
        session_destroy();
		$this->load->view('index');
	}

	//display user profile
    public function profile(){
		if(!isset($this->session->userdata['sessiondata']['user_id']))
			$this->load->view('index');
		else{
			$user_id = $this->session->userdata['sessiondata']['user_id'];
			$data = array(
				'title'=>"My Profile",
		        'row1' => $this->User_model->profile($user_id),
		        'row2' => $this->Quesans_model->getQues($user_id),
		        'row3'=> $this->User_model->getUserTags($user_id)		        		    
				);	
			$this->load->view('profileMain',$data);
		}
	}

	//register a new user
	public function register(){
		if(($_FILES['userfile']['name'])!=''){
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
            $error = array('error' => $this->upload->display_errors());
			die($error['error']);          
         }
         $upload_data=$this->upload->data();
         $file_name=$upload_data['file_name'];
     	}
     	else{
     		$file_name = "default.png";
     	}
		 $data = array(
		        'name' => $this->input->post('name'),
		        'email' => $this->input->post('email'),
		        'password' => md5($this->input->post('pwd')),
			    'phone_number' => $this->input->post('ph'),	
			    'profile_pic'  => $file_name		    
				);
		$this->User_model->insertUser($data);
		redirect('Users/index');
	}

    //change profile pic of user
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
			    'profile_pic'  => $file_name		    
				);
		$this->User_model->editUser($data,$user_id);
		redirect('Users/profile');

    }
}
    
