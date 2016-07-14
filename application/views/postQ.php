
  <body>
      
    <div class="postQuestion-page" style="margin-top:120px">
  <div class="form">
    <?php $attributes = array("id" => "quesForm");
                echo form_open_multipart("question/qdp", $attributes);?>
      <img src="<?php echo base_url(); ?>/images/images.jpg" class="img">         
      <input type="text" name="tag"  autocomplete = "off" id="tag" placeholder="Enter comma separated tags" required/> 
      <div class="alert alert-danger" role="alert" id="errorT" hidden="true"></div>     
      <textarea rows="8" cols="50" resize="none" name="ques" id="ques" placeholder="question" required ></textarea>
      <div class="alert alert-danger" role="alert" id="errorQ" hidden="true"></div>
       <div><button type="button" class="btn btn-success customAlign" id="quesSubmit">Post</button>

      
    </form>
  </div>
</div>
    </body>  
  
