

                    <div class="col-md-3"></div>
                    <div class="panel panel-default col-md-4" style="margin-top:12%;">
                      <div class="panel-body">
                        <div class="row">
                          <h3 style="color:#000000"><center>All Tags:</center></h3>     
                          <ul class="list-inline">
                            
                              <?php $records=count($alltags)-1;
                              while( $records >= 0 )
                                { ?>

                              <li> <?php echo"<a href=".'"http://www.answerme.com/index.php/tags/tagInfo/'.$alltags[$records]['tag_id'].'">'.$alltags[$records]['tag_name']."</a><br>";?>
                            <?php $records--; ?>
                              </li>,
                            <?php } ?>
                          </ul> 
                      </div>                   
                    </div>
                    </div> 
                   