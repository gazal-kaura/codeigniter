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
    <?php $attributes = array("id" => "myForm1");
                echo form_open_multipart("Answerme/login", $attributes);?>
      <input type="text" name="email" id="email" placeholder="username"/>
      <button type="submit">Send mail</button>
     
    </form>
  </div>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="<?php echo base_url(); ?>js/index.js"></script>

    
    
    
  </body>
</html>
<script type="text/javascript">
xyz();
</script>