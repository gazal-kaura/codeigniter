  <div class="answerQuestion-page">
  <div class="form">
    <?php $attributes = array("id" => "answerForm");
                echo form_open_multipart("question/postA", $attributes);?>
       <div class="panel panel-default col-md-12" style="margin-top:5%;">
          <div class="panel-body">
             <div class="row"><h4><?php echo $question_description[0]->question_description ;?><center>
             </h4>
                  <div class="media">
                    <div class="media-left media-top">
                      <strong><img src=" <?php echo base_url('uploads/'.$question_description[0]->profile_pic.''); ?> " height=30 width=30></strong>
                    </div>
                    <div class="media-body">
                    posted by <?php echo $question_description[0]->name; ?> at: <?php  echo $question_description[0]->posted_at;?>
                    </div>
                  </div>
            </div>
          </div>
        </div>      
      <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">        
      <textarea rows="8" cols="170" resize="none" name="answer" id="answer" placeholder="Please type your answer here" required ></textarea>
      <div class="alert alert-danger" role="alert" id="errorA" hidden="true"></div>
      <div><button type="button" class="btn btn-success customAlign" id="ansSubmit">Answer</button>
      </div>
    </form>
  </div>
</div>
</body>


