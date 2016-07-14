<?php
  
  $customArray = array('title' => $title,'allinfo' => $allinfo);
  $this->load->view('header',$customArray);
  $this->load->view('allTagDetail',$customArray);
  $this->load->view('footer');

  ?>