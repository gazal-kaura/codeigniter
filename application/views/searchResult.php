                  <br><br><br>
<body>
                  <?php 
                  if(sizeof($data1)){
                  foreach($data1 as $data){
                  $question = $data['row1']['question'] ;
                  $answer = $data['row1']['answer'];
                  //var_dump($question);
                  //var_dump($answer);
                  $len2 = count($answer);                                   
                  
                

                  foreach($question as $val){ 
                    $tagNames=explode("-|::|-", $val['tag_names']);
                  $tagIDs=explode("-|::|-", $val['tag_ids']); ?>


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
                           
                            <?php $i=0; foreach($tagNames as $tag){
                              $tagId = $tagIDs[$i];
                              $i++;
                             ?> 
                              <li><a href="<?php echo base_url().'index.php/Tags/tagInfo/'.$tagId;?>"><?php echo $tag; ?></a></li>
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
                  <?php }   }}

                  else {?> <center><h3>No results found<h3></center>
                  <?php }?>
<div>
<br><br><br>
</body>
 

   



       
