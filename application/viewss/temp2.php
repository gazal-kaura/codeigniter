<div class="container" style="position:absolute; top:14%; left:0%;">
    <div class="row">
    <div class="col-md-12">

        <div class="wrapper">
                        <div class="features">
                              <?php  
                              
                              //var_dump($row1);
                              if(sizeof($row1['answer'])){
                                  $question = $row1['question'] ;                                
                                  $answers = $row1['answer'][0]; 

                                  $uniqueAnswers = explode("-|::|-", $answers['answers']);
                                  $tagNames=explode("-|::|-", $question[0]['tag_names']);
                                  $posted_at=explode("-|::|-", $answers['answerTime']);

                              foreach($question as $val){ ?>
                              <div>
                                <div id="quest">
                                  <h3><?php echo $val['question_description'];?></h3>
                                 
                                  <div class="comments"> <?php echo $val['posted_at'];?> </div>
                                  <p class="meta">
                                    <strong><img src=" <?php echo base_url('uploads/'.$val['profile_pic'].''); ?> " height=30 width=30>By <?php echo $row2[0]->name; ?> </strong>

                                  </p>
                                  <p>Tags:
                                    <?php foreach($tagNames as $tag){
                                    echo $tag;
                                  }?>
                                  <?php $i=0;
                                  foreach($uniqueAnswers as $uniqueAnswer){ ?>
                                  <div class="thumbnail" style="background-color:white;"></div>
                                  <div><?php
                                         
                                          echo $uniqueAnswer; 
                                          echo $posted_at[$i++];
                                  ?></div>
                  
                                  <?php }?>
                                </div>
                                <a href=<?php echo "http://www.answerme.com/index.php/question/answer/",$row1['question'][0]['question_id']; ?> style="position:absolute;left:10%;top:59%;">Answer</a>
                              </div>
                             
  

                            <?php }
                            } 

                              else
                              { ?>
                              <div>
                                <div id="quest">
                                  <h3><?php echo $row2[0]->question_description;?></h3>
                                  <div class="comments"> <?php echo $row2[0]->posted_at;?> </div>
                                  <p >
                                    <strong><img src=" <?php echo base_url('uploads/'.$row2[0]->profile_pic.''); ?> " height=30 width=30 > By  <?php echo $row2[0]->name; ?> </strong>
                                 
                                  </p>
                                   <p>Tags:
                                    <?php foreach($tagNames as $tag){
                                    echo $tag;
                                  }?>
                                  <div class="thumbnail" style="background-color:white;"></div>
                                </div>
                                <a href=<?php echo "http://www.answerme.com/index.php/question/answer/",$row1['question'][0]['question_id']; ?> style="position:absolute;left:10%;top:59%;">Answer</a>
                              </div>
                        
                          <?php }?>
                          
                        </div>
          </div>


  </div>  
  </div>
</div>

