    <div style="color:white; float:left; margin-left:15px;margin-top:5%;">
    	<span style="font-size:24px;color:black;">
    		<?php  echo $allinfo['currentTagName'];?>
    	</span>	
		<?php 
		if($allinfo['follow']){ ?>
		  <a href="http://www.answerme.com/index.php/Tags/unFollowTag/<?php echo $allinfo['currentTag'];?>"><button>Unfollow</button></a>
		<?php }else{ ?>
		  <a href="http://www.answerme.com/index.php/Tags/followTag/<?php echo $allinfo['currentTag']; ?>"><button>Follow</button></a>
		<?php } ?>  
    <div>
<label  style="color:black;">Number of followers: <?php echo $allinfo['followed_by'];?> </label>
</div> 
  </div>
  
<br><br><br>
<?php 
for($results=0; $results<count($allinfo)-5 ; $results++)
{
$tags=explode("-|::|-", $allinfo[$results]['tags']['tag_names']); 
$tagIDs=explode("-|::|-", $allinfo[$results]['tags']['tag_ids']); 
 ?>
                    <div class="panel panel-default col-md-12" style="padding-bottom:5%;">
                      <div class="panel-body">
                        <div class="row">
                        	 <ul class="list-inline">
                            <?php 
                            $tagNo=0; foreach($tags as $tag){ ?>
                              <li><a href="<?php echo base_url("index.php/Tags/tagInfo/".$tagIDs[$tagNo++]);?>"><?php echo $tag; ?></a></li>
                            <?php } ?>
                          </ul> 
                          <div class="media">
                            <div class="media-left media-top">
                              <strong><img src=" <?php echo base_url('uploads/'.$allinfo[$results]['profile_pic'].''); ?> " height=30 width=30></strong>
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading"><a href=<?php  echo "http://www.answerme.com/index.php/question/qdp/",$allinfo[$results]['question_id'];?>><?php  echo $allinfo[$results]['question_description'];?></a></h4>
                               <h4> <button type="button" class="btn btn-success customAlign" onclick="openQDP(<?php echo $allinfo[$results]['question_id'];?>)">Answer</button><h4>
                              posted by <?php echo $allinfo[$results]['name']; ?> at: <?php  echo $allinfo[$results]['posted_at'];?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                        </div>
                      </div>
                      <div class="panel-footer">
                        <div class="row">            
                          <div class="media">
                            <div class="media-body">
                              <h4 class="media-heading">
                                <?php  echo $allinfo[$results]['answer']['answer'];?>
                              </h4>
                            </div>
                          </div>            
                        </div>
                      </div>                 
                    </div>
<?php }  ?>


<?php       echo '<br><br><br>';                                        
                                echo '<div style="background-color : white ; margin-bottom:-5px">';
                                echo '<center>';
                                  for($results=1;$results<$allinfo['pages']+1;$results++)
                                  {
                                    echo '<p style="display : inline;"><a href="http://www.answerme.com/index.php/tags/tagInfo/'.$tag_id."/".$results.'">';
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
                    <?php  ?>
                   <br>