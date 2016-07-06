<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    
    
    
    
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">

    
    
    
  </head>

  <body>

    <div class="login-page">
  <div class="form">
    <?php $attributes = array("id" => "forgotPasswordForm");
                echo form_open_multipart("Answerme/login", $attributes);?>
      <input type="text" name="forgotPasswordEmail" id="forgotPasswordEmail" placeholder="username"/>
      <div class="alert alert-danger" role="alert" id="forgotPasswordError" hidden="true"></div>
      <button type="submit" id="forgotPasswordSubmit" >Send mail</button>      
     
    </form>
  </div>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="<?php echo base_url(); ?>js/index.js"></script>

    
    
    
  </body>
</html>
