
 
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info" style="margin-top:15%">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $row1[0]->name;?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center" class="img-circle img-responsive"> <img src=" <?php echo base_url('uploads/'.$row1[0]->profile_pic.''); ?> " height=150 width=150>
                   <?php $attributes = array("id" => "changePicForm");
                echo form_open_multipart("Users/changePic", $attributes);?><label class="btn btn-default btn-file pull-right">
                              <span class="glyphicon glyphicon-upload"></span> Edit Image <input name="userfile" id="profilePicFile" type="file" style="display: none;" required/><span id="imagePath"></span>
                                </label>
                                <input type="submit" class="btn btn-success pull-right" id="profilePicSubmit"  value="Submit">
                          </form>
                  
                 </div>
               
    
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
                        if(sizeof($row3)){ ?>
                          <ul class="list-inline">
                          <?php foreach($row3 as $val){ ?>
                                 
                                 <li style="background:#D3D3D3;"><?php echo $val->tag_name; ?></li>
                              <?php } ?>
                          </ul>
                          <?php  }
                        else { 
                          echo "None";
                        } ?>


                        </td>
                      </tr>
                     
                    </tbody>
                  </table>                  
                  
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
                       <td><a href=<?php  echo "http://www.answerme.com/index.php/question/qdp/",$val->question_id;?>>
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
