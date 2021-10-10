<?php
 session_start(); 
 include("../conn.php");
 extract($_POST);

 $exmne_id = $_SESSION['examineeSession']['exmne_id'];

$selExAttempt = $conn->query("SELECT * FROM exam_attempt WHERE exmne_id = $exmne_id AND exam_id = $exam_id");

$selAns = $conn->query("SELECT * FROM exam_answers WHERE axmne_id = $exmne_id AND exam_id = $exam_id");

if ($selExAttempt->rowCount() > 0)
{
	$res = array("res" => "alreadyTaken");
}
else if ($selAns->rowCount() > 0)
{
	$updLastAns = $conn->query("UPDATE exam_answers SET exans_status = 'old' WHERE axmne_id='$exmne_id' AND exam_id='$exam_id'  ");
	if($updLastAns)
	{
		foreach ($_REQUEST['answer'] as $key => $value) {
			 $value = $value['correct'];
		  	 $insAns = $conn->query("INSERT INTO exam_answers(axmne_id,exam_id,quest_id,exans_answer) VALUES('$exmne_id','$exam_id','$key','$value')");
		}
		if($insAns)
		{
			 $insAttempt = $conn->query("INSERT INTO exam_attempt(exmne_id,exam_id)  VALUES('$exmne_id','$exam_id') ");
			 if($insAttempt)
			 {
				 $res = array("res" => "success");
			 }
			 else
			 {
				 $res = array("res" => "failed");
			 }
		}
		else
		{
			 $res = array("res" => "failed");
		}
	}
}
else
{
		foreach ($_REQUEST['answer'] as $key => $value) {
			 $value = $value['correct'];
		  	 $insAns = $conn->query("INSERT INTO exam_answers(axmne_id,exam_id,quest_id,exans_answer) VALUES('$exmne_id','$exam_id','$key','$value')");
		}
		if ($insAns)
		{
			 $insAttempt = $conn->query("INSERT INTO exam_attempt(exmne_id,exam_id)  VALUES('$exmne_id','$exam_id') ");
			 if($insAttempt)
			 {
				 $res = array("res" => "success");
			 }
			 else
			 {
				 $res = [
					 "res" => "failed"
				 ];
			 }
		}
		else
		{
			 $res = [
				 "res" => "failed"
			 ];
		}


}

$examResultsQuery = "SELECT 
						COUNT(*) as correct_answers,
						exam_tbl.ex_questlimit_display as total_questions,
						exam_tbl.ex_questlimit_display - COUNT(*) AS incorrect_answers
					FROM 
						exam_question_tbl 
					INNER JOIN 
						exam_answers 
					ON 
						exam_question_tbl.eqt_id = exam_answers.quest_id 
					AND 
						exam_question_tbl.exam_answer = exam_answers.exans_answer 
					INNER JOIN 
						exam_tbl
					ON 
						exam_tbl.ex_id = $exam_id
					WHERE 
						exam_answers.axmne_id = $exmne_id
					AND 
						exam_answers.exam_id = $exam_id 
					AND 
						exam_answers.exans_status = 'new'
";

$examResults = $conn->query($examResultsQuery)->fetch(PDO::FETCH_OBJ);

$correctAnswers = $examResults->correct_answers;
$incorrectAnswers = $examResults->incorrect_answers;
$numberOfQuestions = $examResults->total_questions;
$average = number_format(($correctAnswers / $numberOfQuestions) * 100, 2);

$conn->query(
	"INSERT INTO
				examinee_results(examinee_id, exam_id, incorrect_answers, correct_answers, number_of_questions, average)
			VALUES
				($exmne_id, $exam_id, $incorrectAnswers, $correctAnswers, $numberOfQuestions, $average)
");



 
 

 echo json_encode($res);
 ?>


 