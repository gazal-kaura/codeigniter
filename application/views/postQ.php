<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>postQuestion</title>              
        <!--link rel="stylesheet" href="css/style.css"-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/homepage.css">
         <link rel="stylesheet" href="<?php echo base_url(); ?>css/exp.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      
    
  </head>

  <body>
      <?php include('template.php'); ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="http://www.answerme.com/index.php/answerme/homepage">Home</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/showAllTags">Tags</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/profile">MyProfile</a></li>
                        <li  class="active"><a href="http://www.answerme.com/index.php/question">Post a Question!</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/contact">Contact</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/logout">Logout</a></li>
                    </ul>
                </div>

            </div>
    
  </div>
</nav>  

    <div class="postQuestion-page">
  <div class="form">
    <?php $attributes = array("id" => "quesForm");
                echo form_open_multipart("question/qdp", $attributes);?>
      <img src="<?php echo base_url(); ?>/images/images.jpg" class="img">         
      <input type="text" name="tag"  autocomplete = "off" id="tag" placeholder="Enter comma separated tags" required/> 
      <div class="alert alert-danger" role="alert" id="errorT" hidden="true"></div>     
      <textarea rows="4" cols="31" resize="none" name="ques" id="ques" placeholder="question" required ></textarea>
      <div class="alert alert-danger" role="alert" id="errorQ" hidden="true"></div>
      <button type="submit" id="quesSubmit">post</button>
      
    </form>
  </div>
</div>
    </body>  
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

     
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/index.js"></script>
<script type="text/javascript" src="//use.typekit.net/qqh1pgl.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">
  bindAutoSuggst1();
</script>
</html>    

