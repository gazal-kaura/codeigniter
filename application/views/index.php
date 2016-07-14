<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">   
  </head>

  <body>

    <div class="login-page">
  <div class="form">
    <?php $attributes = array("id" => "loginForm");
                echo form_open_multipart("Answerme/homepage", $attributes);?>
      <img src="<?php echo base_url(); ?>/images/images.jpg" class="img">         
      <input type="text" name="email" id="email" placeholder="username" required/>
      <input type="password" name="pwd" id="pwd" placeholder="password" required/>
      <div class="alert alert-danger" role="alert" id="error" hidden="true"></div>
      <button type="submit" class="btn btn-success customAlign" id="loginSubmit">login</button>
      <!--button type="button" class="btn btn-success customAlign" id="loginSubmit">Login</button-->
      <p class="message">Not registered? <a href="http://www.answerme.com/index.php/users/signup">Create an account</a></p>
      
       <p class="message"><a href="http://www.answerme.com/index.php/ForgotPassword">Forgot password? </a></p>
    </form>
  </div>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="<?php echo base_url(); ?>js/index.js"></script>

    
    
    
  </body>
</html>

