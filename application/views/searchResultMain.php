<?php
$customArray = array('title' => $title,'data1' => $data1);
$this->load->view('header',$customArray);
$this->load->view('searchResult',$customArray);
$this->load->view('footer');
?>