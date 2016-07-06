<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>QuestionDetailPage</title>              
        <!--link rel="stylesheet" href="css/style.css"-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/homepage.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/exp.css">
      
    
  </head>

  <body>
      <?php include('template.php'); ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="http://www.answerme.com/index.php/answerme/homepage">Home</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/showAllTags">Tags</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/profile">MyProfile</a></li>
                        <li><a href="http://www.answerme.com/index.php/question">Post a Question!</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/contact">Contact</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/logout">Logout</a></li>
                    </ul>
                </div>
              </nav>  

                   <?php

                      $question = $row1['question'] ;                                
                      
                      $tagNames=explode("-|::|-", $question[0]['tag_names']); ?>

              <?php  

                      foreach($question as $val){ 
                      $tagIDs=explode("-|::|-", $val['tag_ids']);
                      $tagNames=explode("-|::|-", $val['tag_names']);?>

                      <div class="panel panel-default col-md-12">
                      <div class="panel-body">
                        <div class="row">
                          <div class="media">
                            <div class="media-left media-top">
                              <strong><img src=" <?php echo base_url('uploads/'.$val['profile_pic'].''); ?> " height=30 width=30> </strong>
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading"><?php echo $val['question_description'];?></h4>
                              posted by <?php echo $val['name']; ?>  at: <?php  echo $val['posted_at'];?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                                
                          <ul class="list-inline">
                            Tags:
                            <?php $i=0; foreach($tagNames as $tag){   $tagId = $tagIDs[$i];
                              $i++;?>
                              <li><a href="<?php echo base_url().'index.php/Answerme/tagInfo/'.$tagId;?>"><?php echo $tag; ?></a></li>
                            <?php } ?>
                          </ul>
                       <h4> <button type="button" class="btn btn-success customAlign" onclick="openQDP(<?php echo $val['question_id'];?>)">Answer</button><h4>    
                        </div>
                      </div>
                      <?php  if(sizeof($row1['answer'])){
                      $answers = $row1['answer'];

                      foreach($answers as $uniqueAnswer){ //var_dump($uniqueAnswer);?>
                      <div class="panel-footer">
                        <div class="row">
                                    
                          <div class="media">
                            <div class="media-body">
                              <h4 class="media-heading">
                                <?php echo $uniqueAnswer['answer']; ?>
                                   <p style="float:right;"><?php   echo $uniqueAnswer['posted_at']; ?> 
                              </h4>
                            </div>
                          </div>
                                       
                        </div>
                      </div>
                      <?php } }?>  
                 
                    </div>
                    <?php                                           
                                echo '<div style="background-color : white">';
                                echo '<center>';
                                  for($results=1;$results<($row1['pages']+1);$results++)
                                  {
                                    echo '<p style="display : inline;"><a href="http://www.answerme.com/index.php/answerme/question/qdp/'.$results.'">'.$results.' &nbsp &nbsp </a>';
                                  }
                                 echo '</center>';
                                  echo'</div>';

                    ?>
                    <?php } ?>

                  


 <?php include('footer.php'); ?>