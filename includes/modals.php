<?php 
  require_once('./Helpers/SuggestCourseHelper.php')
?>

<!-- Modal For Add Course -->
<div class="modal fade" id="feedbacksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form class="refreshFrm" id="addFeebacks" method="post">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Submit Feedbacks</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Feedback AS</label><br>
            <?php 
               $selMe = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_id = $exmneId ")->fetch(PDO::FETCH_ASSOC);
             ?>
            <input type="radio" name="asMe" value="<?php echo $selMe['exmne_fullname']; ?>"> <?php echo $selMe['exmne_fullname']; ?> <br>
            <input type="radio" name="asMe" value="Anonymous"> Anonymous
            
          </div>
          <div class="form-group">
           <textarea name="myFeedbacks" class="form-control" rows="3" placeholder="Input your feedback here.."></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Now</button>
      </div>
    </div>
   </form>
  </div>
</div>

<!-- Modal For Add Course -->
<div class="modal fade" id="course" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form class="refreshFrm" id="addFeebacks" method="post">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SUGGESTED COURSE BASE ON YOUR SCORE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
		  <ul class="list-group">
            <?php   
                $res = SuggestCourseHelper::preferredCourse($exmneId);

                foreach ($res as $index => $text) 
				{
					if (! is_array($text)) 
					{
						?> 
							<li class="list-group-item <?= !$index ? 'active' : '' ?>">
								<?= $text ?>
							</li>
						<?php
					} 
					else 
					{
						?> 
							<ul class="list-group"> 
								<?php 
									foreach ($text as $otherRecommendation) 
									{?> 
										<li class="list-group-item">
											<?= $otherRecommendation ?>
										</li>
									<?php
									}
					}
				}
             ?>
		</ul>

          </div>
        </div>
      </div>
 
    </div>
   </form>
  </div>
</div>