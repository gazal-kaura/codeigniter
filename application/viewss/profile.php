<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>MyProfile</title>              
        <!--link rel="stylesheet" href="css/style.css"-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/homepage.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      
    
  </head>

  <body>
      <?php include('template.php'); ?>
                    <ul class="nav navbar-nav navbar-right">
                    <li><a href="http://www.answerme.com/index.php/answerme/homepage">Home</a></li>
                    <li><a href="#">Tags</a></li>
                    <li class="active"><a href="http://www.answerme.com/index.php/answerme/profile">MyProfile</a></li>
                    <li><a href="http://www.answerme.com/index.php/question">Post a Question!</a></li>
                    <li><a href="http://www.answerme.com/index.php/answerme/contact">Contact</a></li>
                    <li><a href="http://www.answerme.com/index.php/answerme/logout">Logout</a></li>
                    </ul>
                </div>

            </div>
    
  </div>
</nav>  
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $row1[0]->name;?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center" class="img-circle img-responsive"> <img src=" <?php echo base_url('uploads/'.$row1[0]->profile_pic.''); ?> " height=150 width=150> </div>
                
                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Email:</td>
                        <td><?php echo $row1[0]->email;?></td>
                      </tr>
                      <tr>
                        <td>Phone number:</td>
                        <td><?php echo $row1[0]->phone_number;?></td>
                      </tr>
                      <tr>
                        <td>Tags followed:</td>
                        <td><?php 
                        if(sizeof($row3)){
                          foreach($row3 as $val){ 
                                echo $val->tag_name;
                              }
                            }
                        else {
                          echo "None";
                        } ?>   



                        </td>
                      </tr>
                     
                    </tbody>
                  </table>                  
                  
                  <!--a href="#" class="btn btn-primary">My Sales Performance</a-->
                  <!-- href="#" class="btn btn-primary">Team Sales Performance</a-->
                </div>

                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <th>Questions posted by me:</th>
                        <th>Number of answers:</th>
                      </tr>                      
                      <?php 
                        if(sizeof($row2)){
                          foreach($row2 as $val){ ?>
                      <tr>
                       <td>
                        <?php echo $val->question_description; ?>
                       </td>
                        <td><?php echo $val->answerCount;?></td>
                      </tr>
                      <?php 
                          }
                        }
                        else{ ?>
                           <tr>
                       <td>
                        <?php echo "0"; ?>
                       </td>
                        <td><?php echo "0";?></td>
                      </tr>
                        <?php } 
                      ?>
                     
                    </tbody>
                  </table>    
                </div> 





              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

 <?php include('footer.php'); ?>