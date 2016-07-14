<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Change Password Form</title>

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
 
  </head>

  <body>

    <div class="login-page">
  <div class="form">
    <?php $attributes = array("id" => "changePasswordForm");
                echo form_open_multipart("ForgotPassword/setPassword", $attributes);?>
      <img src="<?php echo base_url(); ?>/images/images.jpg" class="img">         
      
      <input type="password" placeholder="Password" name="newPassword" id="newPassword" value="<?php echo set_value('pwd'); ?>" />
      <input type="password" placeholder="Confirm password" name="cnewPassword" id="cnewPassword" />
      <div id="error"></div>
      <input type="hidden" name="userIdChangePassword" id="userIdChangePassword" value="<?php echo $user_id;?>"/>
      <div class="alert alert-danger" role="alert" id="error" hidden="true"></div>
      <button type="submit" id="changePasswordSubmit">change</button>
    </form>
  </div>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="<?php echo base_url(); ?>js/index.js"></script>

    
    
    
  </body>
</html>

