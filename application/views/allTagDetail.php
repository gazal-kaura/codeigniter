<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>TagDetailPage</title>              
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








    <div style="color:white; float:left; margin-left:10px;">
    	<span style="font-size:24px;color:black;">
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $allinfo['currentTagName'];?>
    	</span>	
		<?php 
		if($allinfo['follow']){?>
		  <a href="http://www.answerme.com/index.php/answerme/unFollowTag/<?php echo $allinfo['currentTag'];?>"><button>Unfollow</button></a>
		<?php }else{ ?>
		  <a href="http://www.answerme.com/index.php/answerme/followTag/<?php echo $allinfo['currentTag']; ?>"><button>Follow</button></a>
		<?php } ?>
			
  </div>
<br><br><br>
<?php 
//echo count($allinfo);
for($results=0; $results<count($allinfo)-4 ; $results++)
{
$tags=explode("-|::|-", $allinfo[$results]['tags']['tag_names']); 
$tagIDs=explode("-|::|-", $allinfo[$results]['tags']['tag_ids']); 
//var_dump($tags);

 ?>

                    <div class="panel panel-default col-md-12">
                      <div class="panel-body">
                        <div class="row">
                        	 <ul class="list-inline">
                            <?php 
                            $tagNo=0; foreach($tags as $tag){ ?>
                              <li><a href="<?php echo base_url("index.php/answerme/tagInfo/".$tagIDs[$tagNo++]);?>"><?php echo $tag; ?></a></li>
                            <?php } ?>
                          </ul> 
                          <div class="media">
                            <div class="media-left media-top">
                              <strong><img src=" <?php echo base_url('uploads/'.$allinfo[$results]['profile_pic'].''); ?> " height=30 width=30></strong>
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading"><a href=<?php  echo "http://www.answerme.com/index.php/question/qdp/",$allinfo[$results]['question_id'];?>><?php  echo $allinfo[$results]['question_description'];?></a></h4>
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
<?php } ?>