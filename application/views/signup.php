<!DOCTYPE html>



  <head>
  
    <meta charset="UTF-8">
    <title>SignUp Form</title>     
    <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
	      
  </head>
<div class="signup-page">
<div class="form" id="myForm1">

<?php $attributes = array("id" => "myForm");
                echo form_open_multipart("Answerme/register", $attributes);?>


 		<img src="<?php echo base_url(); ?>/images/images.jpg" class="img" >
		<input type="text" placeholder="Name" id="name" name="name" value="<?php echo set_value('name'); ?>"/>
		<input type="text" placeholder="Email" name="email" id="email"  value="<?php echo set_value('email'); ?>" />
			
		<p id="emailv" class="errormessage"></p>
		
	   <input type="password" placeholder="password" name="pwd" id="pwd" value="<?php echo set_value('pwd'); ?>" />
		<input type="password" placeholder="Confirm password" name="cpwd" id="cpwd" value="<?php echo set_value('cpwd'); ?>"/>
		
		<p id="cpwv" class="errormessage"></p>
		 
		<input type="text" placeholder="Phone" name="ph" id="ph" value="<?php echo set_value('ph'); ?>"/>
		<p id="phonev" class="errormessage"></p>
			
         <input type = "file" name = "userfile" required/> 


	<!--button type="submit" onclick="return validateForm()" name="but" value="but">SignUp</button-->
	<input type="button" class="ptanai" style=" background: #4CAF50;" id="signupSubmit" value="SignUp" >
		
	</div>	
	</div>
<?php echo form_close(); ?>
 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 <script src="<?php echo base_url('js/index.js'); ?>"></script>

</body>
</HTML>
