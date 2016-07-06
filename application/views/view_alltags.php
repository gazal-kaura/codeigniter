<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>TagsPage</title>              
        <!--link rel="stylesheet" href="css/style.css"-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/homepage.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/exp.css">
      
    
  </head>

  <body>
      <?php include('template.php'); ?>
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="http://www.answerme.com/index.php/answerme/homepage">Home</a></li>
                      <li class="active"><a href="http://www.answerme.com/index.php/answerme/showAllTags">Tags</a></li>
                      <li><a href="http://www.answerme.com/index.php/answerme/profile">MyProfile</a></li>
                      <li><a href="http://www.answerme.com/index.php/question">Post a Question!</a></li>
                      <li><a href="http://www.answerme.com/index.php/answerme/contact">Contact</a></li>
                      <li><a href="http://www.answerme.com/index.php/answerme/logout">Logout</a></li>
                    </ul>
                </div>
              </nav> 



                    <div class="col-md-3"></div>
                    <div class="panel panel-default col-md-4">
                      <div class="panel-body">
                        <div class="row">
                                
                          <ul class="list-inline">
                            <h3 style="color:#000000"><center>All Tags:</center><h3>
                              <?php $records=count($alltags)-1;
                              while( $records >= 0 )
                                { ?>

                              <li> <?php echo"<a href=".'"http://www.answerme.com/index.php/answerme/tagInfo/'.$alltags[$records]['tag_id'].'">'.$alltags[$records]['tag_name']."<br>";?>
                            <?php $records--; ?>
                              </li>
                            <?php } ?>
                          </ul> 
                      </div>                   
                    </div> 
                   </div>             
<?php include('footer.php'); ?>
                   