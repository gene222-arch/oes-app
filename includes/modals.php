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
               $examinee = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_id = '$exmneId' ")->fetch(PDO::FETCH_OBJ);

               $selectedTrack = $conn->query("SELECT * FROM course_tbl  WHERE cou_id = '$examinee->exmne_course' ")
                ->fetch(PDO::FETCH_OBJ)
                ->cou_name;

             ?>
            <input type="radio" name="asMe" value="<?php echo $examinee->exmne_fullname; ?>"> <?php echo $examinee->exmne_fullname; ?> <br>
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
				$result = SuggestCourseHelper::preferredStrand($exmneId, $selectedTrack);
				
				$strand = $result['preferred'];
				$preferred = $result['preferredTrack']
			?>
				<span class="badge badge-info">Preferred</span>
				<li class="list-group-item d-flex justify-content-between align-items-center mb-4">
					<?= $preferred['strand'] ?>
					<span class="badge badge-primary badge-pill"><?= $preferred['grade'] ?></span>
				</li>

				<ul class="list-group">
					<?php 
						foreach ($result['grades'] as $strand_ => $grade) {
						?>
							<li class="list-group-item d-flex justify-content-between align-items-center">
								<?= strtoupper($strand_) ?>
								<?= $strand_ === strtolower($strand) ? '<span class="badge badge-danger">Preferred</span>' : '' ?>
								<span class="badge badge-primary badge-pill"><?= $grade ?></span>
							</li>
						<?php
						}
					?>
				</ul>
          </ul>
          </div>
        </div>
      </div>
 
    </div>
   </form>
  </div>
</div>