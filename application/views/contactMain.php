<?php
  
  $customArray = array('title' => $title);
  $this->load->view('header',$customArray);
  $this->load->view('contact');
  $this->load->view('footer');

  ?>