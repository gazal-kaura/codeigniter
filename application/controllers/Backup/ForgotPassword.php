<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model('User_model');
		$this->load->library('session');
		$this->load->library('form_validation');
	}	
	public function index(){
		$this->load->view('forgotpassword');
	} 
	public function checkEmail(){
		$forgotPasswordEmail = $this->input->post("forgotPasswordEmail");
		if($this->User_model->validateEmail($forgotPasswordEmail)){
			echo "true";
		}
		else {
				echo "false";
		}
	}  
	public function sendMail() {

        $forgotPasswordEmail = $this->input->post('forgotPasswordEmail');
        $row = $this->User_model->getUserDetails($forgotPasswordEmail);
        if(count($row)){ 

        	$config = unserialize(EMAIL_CONFIG);
          	$this->load->library('email', $config);
          	$this->email->set_newline("\r\n");
          	$from_email = EMAIL_ADDRESS;
          	$this->email->from($from_email, HOST_NAME);
          	$this->email->to($forgotPasswordEmail);
          	$this->email->subject('Password Recovery');
			$message = "Follow the link to change your Password :";
          	$this->email->message($message.base_url()."index.php/ForgotPassword/changePassword/".$row[0]->user_id."/".md5($row[0]->password));
          	//var_dump($_POST);return ;  	
          	if($this->email->send())
				echo "true";
			else
				echo $this->email->print_debugger();
        }
        else
          echo "false";
      }


      public function changePassword($user_id,$password){		
		if($this->User_model->hasChangePasswordAccess($user_id,$password)){
			$data = array('user_id'=>$user_id);
			$this->load->view('changePassword',$data);
		}
		else {
				echo "Permission Denied";
		}
	  }  
	  public function setPassword(){
	  	$userIdChangePassword = $this->input->post('userIdChangePassword');	
	  	$newPassword = $this->input->post('newPassword');	
	  		
		if($this->User_model->changePasswordEntry($userIdChangePassword,$newPassword)){
			$this->load->view('index');
		}
		else {
				echo "Permission Denied";
		}
	  }
}
    
