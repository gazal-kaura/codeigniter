  <div class="container" style="position:absolute; top:14%; left:0%;">
  <div class="row">
    <div class="col-md-12">
      <div class="tabbable-panel">
        <div class="tabbable-line">
          <ul class="nav nav-tabs ">
            <li>
              <a href="http://www.answerme.com/index.php/answerme/homepage/1/1" data-toggle="tab">
              Recent Questions</a>
            </li>
            <li class="active">
              <a href="#tab_default_2" data-toggle="tab">
              My Interests</a>
            </li>
            
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_default_1">
              <div class="wrapper">
                <div class="features">

                  <?php 
                  $question = $row2['allinfo']['question'] ;
                  $answer = $row2['allinfo']['answer'];                  
                  $len2 = count($row2['allinfo']['answer']);
                  $a = array();              
                  for($i = 0;$i<$len2;$i++){
                      array_push($a,$row2['allinfo']['answer'][$i]['question_id']);                             }
                  $i=0;
                 // var_dump($row1);
                  foreach($row2['allinfo']['question'] as $val){
                    $tagNames=explode("-|::|-", $val['tag_names']);
                    $tagIDs=explode("-|::|-", $val['tag_ids']);?>?>


                    <div class="panel panel-default col-md-12">
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
                        <? echo $row2['allinfo']['questions'][0]['tag_names'] ; ?>
                        <div class="row">
                                
                          <ul class="list-inline">
                            <?php 
                            $i = 0;
                            foreach($tagNames as $tag){
                              $tagId = $tagIDs[$i];
                              $i++;
                             ?>
                              <li><a href="<?php echo base_url().'index.php/Tags/tagInfo/'.$tagId;?>">
                    
                              <?php echo $tag ?></li>
                            <?php } ?>
                          </ul> 
                          <h4> <button type="button" class="btn btn-success customAlign" onclick="openQDP(<?php echo $val['question_id'];?>)">Answer</button><h4> 
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
                <?php                                           
                                echo '<div style="background-color : black">';
                                echo '<center>';
                                  for($results=1;$results<($row2['pages']+1);$results++)
                                  {
                                    echo '<p style="display : inline;"><a href="http://www.answerme.com/index.php/answerme/homepage/'.$results.'/2">'.$results.' &nbsp &nbsp </a>';
                                  }
                                 echo '</center>';
                                  echo'</div>';

                            ?>

            

          </div>
        </div>
      </div>
    </div>               
  </div>


<?php
  $this->load->view('footer.php');

?>
