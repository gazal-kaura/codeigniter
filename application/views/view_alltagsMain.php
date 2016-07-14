<?php

  $customArray = array('title' => $title , 'alltags' => $alltags);
  $this->load->view('header',$customArray);
  $this->load->view('view_alltags',$customArray);
  $this->load->view('footer');

?>