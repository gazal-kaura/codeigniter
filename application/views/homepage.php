<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>HomePage</title>              
        <!--link rel="stylesheet" href="css/style.css"-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/homepage.css">
         <link rel="stylesheet" href="<?php echo base_url(); ?>css/exp.css">
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
                <a href="http://www.answerme.com/index.php/answerme/homepage">    <img src="<?php echo base_url();?>images/images.jpg" width = "170px" height="50" alt="Logo"></a>
                </div>
                </div>
    <div class="collapse navbar-collapse" id="1">
    <div id="custom-search-input">
                <div class="input-group col-md-10">
                     <?php $attributes = array("id" => "searchForm");
                      echo form_open_multipart("Answerme/search", $attributes);?>
                      <div class="input-group" style="margin-top:8px;">
                    <input type="text" class="form-control" id="searchbar" class="searchbar" name="question" placeholder="Search" />
                    <div class="input-group-btn">
                    <button class="btn btn-success" id="searchSubmit" type="submit"><i class="glyphicon glyphicon-search" ></i></button>
                    </div>
                  </div>
                  </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="http://www.answerme.com/index.php/answerme/homepage">Home</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/showAllTags">Tags</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/profile">MyProfile</a></li>
                        <li><a href="http://www.answerme.com/index.php/question">Post a Question!</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/contact">Contact</a></li>
                        <li><a href="http://www.answerme.com/index.php/answerme/logout">Logout</a></li>
                    </ul>
                </div>

            </div>
    
  </div>
</nav>
<?php// include('home.php'); ?>
<br>
<br>
<br>
<br>



























  </body>        
</html>    
