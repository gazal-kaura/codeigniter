<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Answerme extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->database();
		$this->load->model('User_model');
    	}
		
	public function register()
	{


		 $config['upload_path']   = './uploads/'; 
         $config['allowed_types'] = 'gif|jpg|png'; 
         $config['max_size']      = 100; 
         $config['max_width']     = 1024; 
         $config['max_height']    = 768;  
         $this->load->library('upload', $config);
         if ( ! $this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors()); 
            echo $error;
            //redirect('Answerme/error'); 
         }
         
		 $data = array(
		        'name' => $this->input->post('name'),
		        'email' => $this->input->post('email'),
		        'password' => $this->input->post('pwd'),
			    'phone_number' => $this->input->post('ph'),			    
				);
		
		$this->User_model->insertUser($data);
		redirect('Answerme/success');
	}
}
    
