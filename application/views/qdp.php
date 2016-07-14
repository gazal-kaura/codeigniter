                 
                <body style="margin-bottom : -35%">

                   <?php
                      $question = $row1['question'] ;                                 
                      $tagNames=explode("-|::|-", $question[0]['tag_names']); ?>
                   <?php  
                      foreach($question as $val){ 
                      $tagIDs=explode("-|::|-", $val['tag_ids']);
                      $tagNames=explode("-|::|-", $val['tag_names']);?>

                      <div class="panel panel-default col-md-12" style="margin-top:5%;">
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
                              <li><a href="<?php echo base_url().'index.php/Tags/tagInfo/'.$tagId;?>"><?php echo $tag; ?></a></li>
                            <?php } ?>
                          </ul>
                       <h4> <button type="button" class="btn btn-success customAlign" onclick="openQDP(<?php echo $val['question_id'];?>)">Answer</button><h4>    
                        </div>
                      </div>
                      <?php  if(sizeof($row1['answer'])){
                      $answers = $row1['answer'];
                      ?>
                      <div class="panel-footer">

                        <?php $i=1;$j=count($answers);
                        foreach($answers as $uniqueAnswer){ ?>
                        <div class="row">           
                          <div class="media">
                            <div class="media-body">
                              <div class="media-heading ">
                               <?php $i++; echo $uniqueAnswer['answer']; ?>
                                <br> <br> <img src=" <?php echo base_url('uploads/'.$uniqueAnswer['profile_pic'].''); ?> " height=30 width=30>
                                    <?php echo $uniqueAnswer['name']; ?>  <br>  <p style=""><?php   echo $uniqueAnswer['posted_at']; ?> 
                                  </div>
                              </div>
                            </div>
                          </div> 
                          <?php if ($i<=$j){?>
                            <hr id="block">  <?php } ?>          
                          <?php } }?>
                        </div>   
                    </div>
                    <?php       echo '<br><br><br>';                                        
                                echo '<div style="background-color : white ; margin-bottom:-2%;margin-top : 40%">';
                                echo '<center>';
                                  for($results=1;$results<($row1['pages']+1);$results++)
                                  {
                                    echo '<p style="display : inline;"><a href="http://www.answerme.com/index.php/question/qdp/'.$qid."/".$results.'">';
                                    if($results == $page_number)
                                      {
                                          echo'<U><MARK style = "background-color : #b3b3ff">';
                                      }

                                    echo $results;
                                    if($results == $page_number)
                                              echo '</U></MARK>';
                                     echo '&nbsp &nbsp </a></p>';
                                  }
                                 echo '</center>';
                                  echo'</div><br><br><br>';
                    ?>
                    <?php } ?>
                   <br><br>
</body>
