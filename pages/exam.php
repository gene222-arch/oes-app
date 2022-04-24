<script type="text/javascript" >
   function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
</script>
 <?php 
    $examId = $_GET['id'];
    $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id = $examId ")->fetch(PDO::FETCH_ASSOC);
    $exDisplayLimit = $selExam['ex_questlimit_display'] ?? 0;
 ?>


<div class="app-main__outer">
<div class="app-main__inner">

    <h1 class="mb-5 text-right" id="timer"></h1>
    <div class="col-md-12">
         <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <?php 
                        if (! $selExam) { ?> <h2>No Exam</h2> <?php
                        } else { ?>
                            <div>
                                <p><?= $selExam['ex_title'] ?></p>
                                <div class="page-title-subheading">
                                    <?= $selExam['ex_description'] ?>
                                </div>
                            </div>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </div>  
    </div>

    <div class="col-md-12 p-0 mb-4">
        <form method="post" id="submitAnswerFrm">
            <input type="hidden" name="exam_id" id="exam_id" value="<?= $examId ?>">
            <input type="hidden" name="examAction" id="examAction" value="" >
        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">

        <?php 
            $selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id = $examId ORDER BY rand() LIMIT $exDisplayLimit ");

            if ($selQuest->rowCount() > 0)
            {
                $i = 1;
                while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) 
                { 
                    $questId = $selQuestRow['eqt_id'];
                ?>
                    <tr>
                        <td>
                            <p><b><?php echo $i++ ; ?> . <?php echo $selQuestRow['exam_question']; ?></b></p>
                            <div class="col-md-4 float-left">
                              <div class="form-group pl-4 ">
                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch1']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" >
                               
                                <label class="form-check-label" for="invalidCheck">
                                    <?php echo $selQuestRow['exam_ch1']; ?>
                                </label>
                              </div>  

                              <div class="form-group pl-4">
                                <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch2']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" >
                               
                                <label class="form-check-label" for="invalidCheck">
                                    <?php echo $selQuestRow['exam_ch2']; ?>
                                </label>
                              </div>   
                            </div>
                            <div class="col-md-8 float-left">
                                <div class="form-group pl-4">
                                    <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch3']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" >
                                    <label class="form-check-label" for="invalidCheck">
                                        <?php echo $selQuestRow['exam_ch3']; ?>
                                    </label>
                                </div>  

                                <div class="form-group pl-4">
                                    <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch4']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck" >
                                    
                                    <label class="form-check-label" for="invalidCheck">
                                        <?php echo $selQuestRow['exam_ch4']; ?>
                                    </label>
                                </div>   

                                <div class="form-group pl-4">
                                    <input name="answer[<?php echo $questId; ?>][correct]" value="<?= 'No Naswer' ?>" class="form-check-input" type="hidden" checked>
                                </div>   
                            </div>
                        </td>
                    </tr>
    </div>
        <?php } ?>
                    <tr>
                        <td style="padding: 20px;">
                            <button type="button" class="btn btn-xlg btn-warning p-3 pl-4 pr-4" id="resetExamFrm">Reset</button>
                            <input name="submit" type="submit" value="Submit" class="btn btn-xlg btn-primary p-3 pl-4 pr-4 float-right submit-answer-btn" id="submitAnswerFrmBtn">
                        </td>
                    </tr>
        <?php } else { ?> <b>No question at this moment</b> <?php } ?>   
              </table>
        </form>
    </div>
</div>