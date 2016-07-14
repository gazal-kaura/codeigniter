<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Answerme extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Quesans_model');
	}
	

	//A function to load the login page.
	public function index()
	{
		redirect(base_url('index.php/Users'));
	}

	//A function to load homepage, start of page denotes the page number which is called and the tab called is a variable to check if it is the recent tab which is clicked or the my interest tab.
	public function homepage($start_of_page=1,$tab_called=1)
	{
		
		if(!isset($this->session->userdata['sessiondata']['user_id']))
			$this->load->view('index');
		else{
			$user_id = $this->session->userdata['sessiondata']['user_id'];

			if($tab_called == 1){
					$data = array(
			        	'row1'  => $this->Quesans_model->recentQ($start_of_page),
					);	
			}else{
					$data = array(
			        	'row1'	=> $this->Quesans_model->myInterest($user_id,$start_of_page)
					);	
			}
			$data['tab'] = $tab_called;
			$data['page_number'] = $start_of_page;
			if($tab_called == 1){
				$data['title'] = "Recent Questions";
			}else{
				$data['title'] = "My Interests";
			}
		      $this->load->view('homepagemain',$data);
		}
	}

	//search a tag
    public function search()
	{
		$question=$this->input->post('question');
		$Tokens=explode(" ",$question);
		//var_dump($Tokens);
		$qid=array();
		    foreach($Tokens as $a)
		    {
		      $a=strtolower($a);
		      $tid=$this->Quesans_model->tagExist($a);
		      $tagID=$tid[0]['tag_id'];
		      //var_dump($tid);
		      if(! $tid==0)
		      {
		        $questionID=$this->Quesans_model->getQuesFromTag($tagID);
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
		        'row1' => $this->Quesans_model->getQuesDetail($a),
		        'row2' => $this->Quesans_model->getQuesDescription($a)
		        );
       array_push($data1,$data);
    }
    $passingData = array('data1'=>$data1,
    					 'title'=>"Search Result"
    					 );
    $this->load->view('searchResultMain',$passingData);
   }

  	//auto suggester for tags.The data is received using jquery ui.
	public function autoSuggestor(){
		$suggestion  = $this->input->get('term');
		$data = $this->User_model->getSuggestions1($suggestion);
		echo json_encode($data);

	}	 
}
    
