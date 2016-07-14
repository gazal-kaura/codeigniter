<?php
		$customArray = array('title' => $title,'question_id' => $question_id,'question_description' =>$question_description);
		$this->load->view('header',$customArray);
		$this->load->view('answerQuestion',$customArray);
		$this->load->view('footer');

?>