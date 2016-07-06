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
                        <li><a href="#">Tags</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/profile">MyProfile</a></li>
                        <li><a href="http://www.answerme.com/index.php/question">Post a Question!</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/contact">Contact</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/logout">Logout</a></li>
                    </ul>
                </div>
              </nav>  



              <?php if(sizeof($row1['answer'])){
                      $question = $row1['question'] ;                                
                      $answers = $row1['answer'][0]; 
                      $uniqueAnswers = explode("-|::|-", $answers['answers']);
                      $tagNames=explode("-|::|-", $question[0]['tag_names']);
                      $posted_at=explode("-|::|-", $answers['answerTime']);
                      foreach($question as $val){ ?>


                      <div class="panel panel-default col-md-7">
                      <div class="panel-body">
                        <div class="row">
                          <div class="media">
                            <div class="media-left media-top">
                              <strong><img src=" <?php echo base_url('uploads/'.$val['profile_pic'].''); ?> " height=30 width=30> </strong>
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading"><?php echo $val['question_description'];?></h4>
                              posted by <?php echo $row2[0]->name; ?>  at: <?php  echo $val['posted_at'];?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                                
                          <ul class="list-inline">
                            Tags:
                            <?php foreach($tagNames as $tag){ ?>
                              <li style="background:#8DC26F;"><?php echo $tag; ?></li>
                            <?php } ?>
                          </ul>
                       <h4> <a href=<?php echo "http://www.answerme.com/index.php/question/answer/",$row1['question'][0]['question_id']; ?> >Answer</a><h4>    
                        </div>
                      </div>
                      <?php $i=0; foreach($uniqueAnswers as $uniqueAnswer){ ?>
                      <div class="panel-footer">
                        <div class="row">
                                    
                          <div class="media">
                            <div class="media-body">
                              <h4 class="media-heading">
                                <?php echo $uniqueAnswer; ?>
                                   <p style="float:right;"><?php   echo $posted_at[$i++]; ?> 
                              </h4>
                            </div>
                          </div>
                                       
                        </div>
                      </div>
                      <?php }?>                   
                    </div>
                  <?php }
                }

               else { ?>   
                      <div class="panel panel-default col-md-7">
                      <div class="panel-body">
                        <div class="row">
                          <div class="media">
                            <div class="media-left media-top">
                              <strong><<img src=" <?php echo base_url('uploads/'.$row2[0]->profile_pic.''); ?> " height=30 width=30 ></strong>
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading"><?php echo $row2[0]->question_description;?></h4>
                              posted by <?php echo $row2[0]->name; ?>  at: <?php echo $row2[0]->posted_at;?> 
                            </div>
                          </div>
                        </div>
                        <div class="row">
                                
                          <ul class="list-inline">
                            Tags:
                            <?php foreach($tagNames as $tag){ ?>
                              <li style="background:#8DC26F;"><?php echo $tag; ?></li>
                            <?php } ?>
                          </ul>  
                          <h3><a href=<?php echo "http://www.answerme.com/index.php/question/answer/",$row1['question'][0]['question_id']; ?> >Answer</a><h3> 
                        </div>
                      </div>
                      <?php foreach($uniqueAnswers as $uniqueAnswer){ ?>
                      <?php $i++; }?>                   
                    </div>
                  <?php }?>  











 <?php include('footer.php'); ?>