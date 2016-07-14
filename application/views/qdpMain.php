<?php
		if($title == "Question Detail Page")
		{
			$customArray = array('title' => $title,'row1' => $row1);	
		}
		else
		{
			$customArray = array('title' => $title,'row1' => $row1 , 'page_number' => $page_number);
		}

		$this->load->view('header',$customArray);
		$this->load->view('qdp',$customArray);
		$this->load->view('footer');

?>