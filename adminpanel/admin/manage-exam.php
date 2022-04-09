<?php 
	session_start();
	include("./../../conn.php");

	if(! isset($_SESSION['admin']['adminnakalogin']) == true) 
	{
		header("location:index.php");
	}

	$exId = $_GET['id'];

	$selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id = $exId");
	$selExamRow = $selExam->fetch(PDO::FETCH_ASSOC);
	$courseId = $selExamRow['cou_id'];

	$query = "SELECT 
			cou_name AS courseName 
		FROM 
			course_tbl 
		WHERE 
			cou_id = $courseId 
	";

	$selCourse = $conn
		->query($query)
		->fetch(PDO::FETCH_ASSOC);
	?>

	<?php include("includes/header.php"); ?>      
	<?php include("includes/sidebar.php"); ?>
	<?php include("includes/modals.php"); ?>

<div class="app-main">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
	<div class="app-main__outer">
		<div class="app-main__inner">
			<div class="app-page-title">
				<div class="page-title-wrapper">
					<div class="page-title-heading">
						<div> MANAGE EXAM
							<div class="page-title-subheading">
							Add Question for <?php echo $selExamRow['ex_title']; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<form action="./query/importQuestions.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="exam_id" value="<?= $exId ?>">
				<div class="row justify-content-end">
					<div class="col-5">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Upload</span>
							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="excel" id="inputGroupFile01">
								<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
							</div>
						</div>
					</div>
					<div class="col-1">
						<button class="btn btn-info" type="submit">Import</button>
					</div>
				</div>
			</form>
			<div class="col-md-12">
				<div id="refreshData">
					<div class="row">
						<div class="col-md-6">
							<div class="main-card mb-3 card">
								<div class="card-header">
									<i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Exam Information
								</div>
								<div class="card-body">
								<form method="post" id="updateExamFrm">
									<div class="form-group">
										<label>Preferred Track</label>
										<select class="form-control" name="courseId" required>
										<?php 
											$selAllCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id DESC");

											while ($selAllCourseRow = $selAllCourse->fetch(PDO::FETCH_ASSOC)) 
											{ ?>
											<option value="<?= $selAllCourseRow['cou_id'] ?>" <?= $selAllCourseRow['cou_id'] == $courseId ? 'selected' : '' ?>>
												<?= $selAllCourseRow['cou_name'] ?>
											</option>
											<?php 
											}
										?>
										</select>
									</div>

									<div class="form-group">
										<label>Exam Title</label>
										<input type="hidden" name="examId" value="<?php echo $selExamRow['ex_id']; ?>">
										<input type="" name="examTitle" class="form-control" required value="<?php echo $selExamRow['ex_title']; ?>">
									</div>  
									

									<div class="form-group">
										<label>Exam Description</label>
										<input type="" name="examDesc" class="form-control" required value="<?php echo $selExamRow['ex_description']; ?>">
									</div>  

									

									<div class="form-group">
										<label>Display limit</label>
										<input type="number" name="examQuestDipLimit" class="form-control" value="<?php echo $selExamRow['ex_questlimit_display']; ?>"> 
									</div>

									<div class="form-group" align="right">
										<button type="submit" class="btn btn-primary btn-lg">Update</button>
									</div> 
								</form>                           
								</div>
							</div>
						
						</div>
						<div class="col-md-6">
							<?php 
								$selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$exId' ORDER BY eqt_id desc");
							?>
							<div class="main-card mb-3 card">
								<div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Exam Question's 
									<span class="badge badge-pill badge-primary ml-2">
									<?php echo $selQuest->rowCount(); ?>
									</span>
									<div class="btn-actions-pane-right">
										<button class="btn btn-sm btn-primary " data-toggle="modal" data-target="#modalForAddQuestion">Add Question</button>
									</div>
								</div>
								<div class="card-body" >
									<div class="scroll-area-sm" style="min-height: 400px;">
									<div class="scrollbar-container">

									<?php 
									
									if($selQuest->rowCount() > 0)
									{  ?>
										<div class="table-responsive">
											<table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
												<thead>
												<tr>
													<th class="text-left pl-1">Preferred Track</th>
													<th class="text-center" width="20%">Action</th>
												</tr>
												</thead>
												<tbody>
												<?php 
													
													if($selQuest->rowCount() > 0)
													{
													$i = 1;
													while ($selQuestionRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
														<tr>
																<td >
																	<b><?php echo $i++ ; ?> .) <?php echo $selQuestionRow['exam_question']; ?></b><br>
																	<?php 
																	// Choice A
																	if($selQuestionRow['exam_ch1'] == $selQuestionRow['exam_answer'])
																	{ ?>
																		<span class="pl-4 text-success">A - <?php echo  $selQuestionRow['exam_ch1']; ?></span><br>
																	<?php }
																	else
																	{ ?>
																		<span class="pl-4">A - <?php echo $selQuestionRow['exam_ch1']; ?></span><br>
																	<?php }

																	// Choice B
																	if($selQuestionRow['exam_ch2'] == $selQuestionRow['exam_answer'])
																	{ ?>
																		<span class="pl-4 text-success">B - <?php echo $selQuestionRow['exam_ch2']; ?></span><br>
																	<?php }
																	else
																	{ ?>
																		<span class="pl-4">B - <?php echo $selQuestionRow['exam_ch2']; ?></span><br>
																	<?php }

																	// Choice C
																	if($selQuestionRow['exam_ch3'] == $selQuestionRow['exam_answer'])
																	{ ?>
																		<span class="pl-4 text-success">C - <?php echo $selQuestionRow['exam_ch3']; ?></span><br>
																	<?php }
																	else
																	{ ?>
																		<span class="pl-4">C - <?php echo $selQuestionRow['exam_ch3']; ?></span><br>
																	<?php }

																	// Choice D
																	if($selQuestionRow['exam_ch4'] == $selQuestionRow['exam_answer'])
																	{ ?>
																		<span class="pl-4 text-success">D - <?php echo $selQuestionRow['exam_ch4']; ?></span><br>
																	<?php }
																	else
																	{ ?>
																		<span class="pl-4">D - <?php echo $selQuestionRow['exam_ch4']; ?></span><br>
																	<?php }

																	?>
																	
																</td>
																<td class="text-center">
																<button type="button" id="deleteQuestion" data-id='<?php echo $selQuestionRow['eqt_id']; ?>'  class="btn btn-danger btn-sm">Delete</button>
																</td>
															</tr>
													<?php }
													}
													else
													{ ?>
														<tr>
														<td colspan="2">
															<h3 class="p-3">No Preferred Track Found</h3>
														</td>
														</tr>
													<?php }
												?>
												</tbody>
											</table>
										</div>
									<?php }
									else
									{ ?>
										<h4 class="text-primary">No question found...</h4>
										<?php
									}
									?>
									</div>
									</div>


								</div>
								
							</div>
						</div>
					</div>  
				</div> 
			</div>
			
		</div>
	</div>
</div>
		
			

<?php include("includes/footer.php"); ?>
