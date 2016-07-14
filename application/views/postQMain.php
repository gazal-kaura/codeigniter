<?php
$customArray = array('title' => $title);

$this->load->view('header',$customArray);
$this->load->view('postQ');
$this->load->view('footer');

?>