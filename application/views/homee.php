<div class="container" style="position:absolute; top:14%; left:0%;">
  <div class="row">
    <div class="col-md-12">
      <div class="tabbable-panel">
        <div class="tabbable-line">
          <ul class="nav nav-tabs ">
            <li class="active">
              <a href="#tab_default_1" data-toggle="tab">
              Recent Questions</a>
            </li>
            <li>
              <a href="#tab_default_2" data-toggle="tab">
              My Interests</a>
            </li>
            
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_default_1">
              <div class="wrapper">
                <div class="features">

                  <?php 
                  $question = $row1['question'] ;
                  $answer = $row1['answer'];                  
                  $len2 = count($answer);
                  $a = array();                   
                  $tagNames=explode("-|::|-", $question[0]['tag_names']);
                  $tagIDs=explode("-|::|-", $question[0]['tag_ids']); 
                  //var_dump($row1);                
                  for($i = 0;$i<$len2;$i++){
                      array_push($a,$answer[$i]['question_id']);                                            
                  }
                  $i=0;
                 //var_dump($row2);
                  foreach($question as $val){?>


                    <div class="panel panel-default col-md-7">
                      <div class="panel-body">
                        <div class="row">
                          <div class="media">
                            <div class="media-left media-top">
                              <strong><img src=" <?php echo base_url('uploads/'.$val['profile_pic'].''); ?> " height=30 width=30></strong>
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading"><a href=<?php  echo "http://www.answerme.com/index.php/question/qdp/",$val['question_id'];?>><?php  echo $val['question_description'];?></a></h4>
                              posted by <?php echo $val['name']; ?> at: <?php  echo $val['posted_at'];?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                                
                          <ul class="list-inline">
                            Tags:
                            <?php $tagNo=0; foreach($tagNames as $tag){ ?>
                              <li style="background:#8DC26F;"><a href="<?php echo base_url("index.php/answerme/tagInfo/".$tagIDs[$tagNo++]);?>"><?php echo $tag; ?></a></li>
                            <?php } ?>
                          </ul> 
                          <h4> <a href=<?php echo "http://www.answerme.com/index.php/question/answer/",$row1['question'][0]['question_id']; ?> >Answer</a><h4> 
                        </div>
                      </div>
                      <?php if(in_array($val['question_id'], $a)){ 

                                  $key = array_search($val['question_id'], $a);
                        ?>
                      <div class="panel-footer">
                        <div class="row">
                                    
                          <div class="media">
                            <div class="media-body">
                              <h4 class="media-heading">
                                <?php $uniqueAnswer = explode("-|::|-", $answer[$key]['answers']);echo $uniqueAnswer[0]; ?> 
                              </h4>
                            </div>
                          </div>
                                       
                        </div>
                      </div>





                      <?php $i++; }?>                   
                    </div>
                  <?php }?>
                </div>
              </div>
            </div>
           

            <div class="tab-pane" id="tab_default_2">
              <div class="wrapper">
                <div class="features">
                  <?php 
                    $question = $row2['question'] ;
                    $answer = $row2['answer'];                  
                    $len2 = count($answer);
                    $a = array();                  
                    for($i = 0;$i<$len2;$i++){
                        array_push($a,$answer[$i]['question_id']);                      
                    }
                    $i=0;
                     foreach($question as $val){?>


                    <div class="panel panel-default col-md-7">
                      <div class="panel-body">
                        <div class="row">
                          <div class="media">
                            <div class="media-left media-top">
                              <strong><img src=" <?php echo base_url('uploads/'.$val['profile_pic'].''); ?> " height=30 width=30></strong>
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading"><a href=<?php  echo "http://www.answerme.com/index.php/question/qdp/",$val['question_id'];?>><?php  echo $val['question_description'];?></a></h4>
                              posted by <?php echo $val['name']; ?> at: <?php  echo $val['posted_at'];?>
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
                        </div>
                      </div>
                      <?php if(in_array($val['question_id'], $a)){
                        $key = array_search($val['question_id'], $a);
                        ?>
                      <div class="panel-footer">
                        <div class="row">
                                    
                          <div class="media">
                            <div class="media-body">
                              <h4 class="media-heading">
                                <?php $uniqueAnswer = explode("-|::|-", $answer[$key]['answers']);echo $uniqueAnswer[0]; ?> 
                              </h4>
                            </div>
                          </div>
                                       
                        </div>
                      </div>




                      
                      <?php $i++; }?>                   
                    </div>
                    <?php }?>
                </div>
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>