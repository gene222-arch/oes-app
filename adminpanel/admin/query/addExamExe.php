<?php 
 include("../../../conn.php");

 extract($_POST);

 $selCourse = $conn->query("SELECT * FROM exam_tbl WHERE ex_title='$examTitle' ");

 if($courseSelected == "0")
 {
 	$res = array("res" => "noSelectedCourse");
 }
 else if($timeLimit == "0")
 {
 	$res = array("res" => "noSelectedTime");
 }
 else if($examQuestDipLimit == "" && $examQuestDipLimit == null)
 {
 	$res = array("res" => "noDisplayLimit");
 }
 else
 {

	$createExamQuery = 
		"INSERT INTO 
			exam_tbl(cou_id, ex_title, ex_time_limit, ex_questlimit_display, ex_description) 
		VALUES
			('$courseSelected', '$examTitle', '$timeLimit', '$examQuestDipLimit', '$examDesc')
	";
    
	$insExam = $conn->query($createExamQuery);

	$res = !$insExam
		? [ "res" => "Failed", "examTitle" => $examTitle ]
		: [ "res" => "Success", "examTitle" => $examTitle ];
 }




 echo json_encode($res);
 ?>