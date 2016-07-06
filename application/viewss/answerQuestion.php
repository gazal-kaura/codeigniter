<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>postAnswer</title>              
        <!--link rel="stylesheet" href="css/style.css"-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      
    
  </head>

  <body>
      <?php include('template.php'); ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="http://www.answerme.com/index.php/answerme/homepage">Home</a></li>
                        <li><a href="#">Tags</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/profile">MyProfile</a></li>
                        <li><a href="http://www.answerme.com/index.php/question">Post a Question!</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/contact">Contact</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/logout">Logout</a></li>
                    </ul>
                </div>

            </div>
    
  </div>
</nav>  

    <div class="postQuestion-page">
  <div class="form">
    <?php $attributes = array("id" => "answerForm");
                echo form_open_multipart("question/postA", $attributes);?>
      <img src="<?php echo base_url(); ?>/images/images.jpg" class="img"> 
      <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">        
      <textarea rows="4" cols="31" resize="none" name="answer" id="answer" placeholder="answer" required ></textarea>
      <div class="alert alert-danger" role="alert" id="errorQ" hidden="true"></div>
      <button type="submit" id="ansSubmit">post</button>
      
    </form>
  </div>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="<?php echo base_url(); ?>js/index.js"></script>

    
    
    
  </body>
</html>

