<?php
	
	$customArray = array('title' => $title);
	
	$this->load->view('header',$customArray);

	$this->load->view('load_recent_page');
	$this->load->view('footer');
?>