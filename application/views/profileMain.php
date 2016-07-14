 <?php
  
  $customArray = array('title' => $title , 'row1' => $row1 , 'row2' => $row2 , 'row3' => $row3);
  $this->load->view('header',$customArray);
  $this->load->view('profile',$customArray);
  $this->load->view('footer');

  ?>