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
                  //var_dump($data1);
                  foreach($data1 as $data){
                  $question = $data['row1']['question'] ;
                  $answer = $data['row1']['answer'];
                  //var_dump($question);
                  //var_dump($answer);
                  $len2 = count($answer);                                   
                  $tagNames=explode("-|::|-", $question[0]['tag_names']);
                  $tagIDs=explode("-|::|-", $question[0]['tag_ids']); 
                

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
                              posted by <?php echo $val['name']; ?>  at: <?php  echo $val['posted_at'];?>
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
                       <h4> <a href=<?php echo "http://www.answerme.com/index.php/question/answer/",$val['question_id']; ?> >Answer</a><h4>    
                        </div>
                      </div>
                <?php if($len2!=0){ ?>
                      <div class="panel-footer">
                        <div class="row">
                                    
                          <div class="media">
                            <div class="media-body">
                              <h4 class="media-heading">
                                <?php echo $answer[0]['answer']; ?>
                                   <p style="float:right;"><?php    $answer[0]['posted_at']; ?> 
                              </h4>
                            </div>
                          </div>
                                       
                        </div>
                      </div>
                   <?php } 
                   else {?> 
                   <div class="panel-footer">
                        <div class="row">
                                    
                          <div class="media">
                            <div class="media-body">
                              <h4 class="media-heading">
                                No Answer Yet
                              </h4>
                            </div>
                          </div>
                                       
                        </div>
                      </div> 
                    <?php } ?>   
                    </div>
                  <?php }   }?>

 <?php include('footer.php'); ?>

   



       
