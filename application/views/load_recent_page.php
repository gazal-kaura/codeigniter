<div class="container" style="position:absolute; top:14%; left:0%;">
  <div class="row">
    <div class="col-md-12">
      <div class="tabbable-panel">
        <div class="tabbable-line">
          <ul class="nav nav-tabs ">
          <?php
            $recentClass = "";
            $interestClass = "";
            if($tab == 1){
              $recentClass = "active";
            }else{
              $interestClass = "active";
            }
          ?>
            <li class="<?php echo $recentClass;?>">
              <a href="http://www.answerme.com/index.php/answerme/homepage/1/1">
              Recent Questions</a>
            </li>
            <li class="<?php echo $interestClass;?>">
              <a href="http://www.answerme.com/index.php/answerme/homepage/1/2">
              My Interests</a>
            </li>
            
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_default_1">
              <div class="wrapper">
                <div class="features">

                  <?php 
                  $question = $row1['allinfo']['question'] ;
                  $answer = $row1['allinfo']['answer'];                  
                  $len2 = count($row1['allinfo']['answer']);
                  $a = array();
                       
                  for($i = 0;$i<$len2;$i++){
                      array_push($a,$row1['allinfo']['answer'][$i]['question_id']);                                            
                  }
                  $i=0;
                 // var_dump($row1);
                  foreach($row1['allinfo']['question'] as $val){
                  $tagNames=explode("-|::|-", $val['tag_names']);
                  $tagIDs=explode("-|::|-", $val['tag_ids']);?>

                    <div class="panel panel-default col-md-12" style="padding-bottom:10px">
                      <div class="panel-body">
                        <div class="row">
                          <div class="media">
                          <ul class="list-inline xyz">
                            
                            <!-- using tagnames for pagination -->
                            <?php 
                            $i = 0;
                            foreach($tagNames as $tag){
                              $tagId = $tagIDs[$i];
                              $i++;
                             ?>
                              <li><a href="<?php echo base_url().'index.php/Answerme/tagInfo/'.$tagId;?>"><?php echo $tag ?></a></li>
                            <?php } ?>
                          </ul> 
                            <div class="media-left media-top">
                            <?php
                              if($val['profile_pic'] == NULL || $val['profile_pic'] == ""){
                                  $val['profile_pic'] = "default.png";
                              }
                            ?>
                              <strong><img src=" <?php echo base_url('uploads/'.$val['profile_pic'].''); ?> " height=30 width=30></strong>
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading"><a href=<?php  echo "http://www.answerme.com/index.php/question/qdp/",$val['question_id'];?>><?php  echo $val['question_description'];?></a></h4>
                              posted by <?php echo $val['name']; ?> at: <?php  echo $val['posted_at'];?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                                
                          
                          
                          <button type="button" class="btn btn-success customAlign" onclick="openQDP(<?php echo $val['question_id'];?>)">Answer</button>
                        </div>
                      </div>
                      <?php if(in_array($val['question_id'], $a)){ 

                                  $key = array_search($val['question_id'], $a);
                        ?>
                      <div class="panel-footer">
                        <div class="row">
                                    
                          <div class="media">
                            <div class="media-body">
                              <h4 class="media-heading media-heading-custom">
                                <?php $uniqueAnswer = explode("-|::|-", $answer[$key]['answers']);echo $uniqueAnswer[count($uniqueAnswer)-1]; ?> 
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
                <?php                                           
                                echo '<div>';
                                echo '<center>';
                                  for($results=1;$results<($row1['pages']+1);$results++)
                                  {
                                    echo '<B><p style="display : inline; font color : white;"><a href="http://www.answerme.com/index.php/answerme/homepage/'.$results.'">'.$results.' &nbsp &nbsp </a></B>';
                                  }
                                 echo '</center>';
                                  echo'</div>';

                            ?>

            

          </div>
        </div>
      </div>
    </div>               
  </div>
</div>
<?php
  $this->load->view('footer.php');

?>
