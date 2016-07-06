<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>HomePage</title>              
        <!--link rel="stylesheet" href="css/style.css"-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/homepage.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      
    
  </head>

  <body>
      <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div id="cd-logo">
                    <img src="<?php echo base_url();?>images/images.jpg" width = "170px" height="50" alt="Logo">
                </div>
                </div>
    <div class="collapse navbar-collapse" id="1">
    <div id="custom-search-input">
                <div class="input-group col-md-10">
                    <input type="text" class="form-control input-lg" placeholder="Search" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/postQ">Post a Question!!</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>

            </div>
    
  </div>
</nav>  
  </body>        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/index.js"></script>
</html>    
