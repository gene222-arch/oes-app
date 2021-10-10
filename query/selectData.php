<?php
    $exmneId = $_SESSION['examineeSession']['exmne_id'];

    // Select Data sa nilogin nga examinee
    $selectExamineeQuery = "SELECT 
        * 
        FROM 
            examinee_tbl 
        WHERE
            exmne_id = $exmneId
    ";

    $selExmneeData = $conn->query($selectExamineeQuery)->fetch(PDO::FETCH_ASSOC);
    $examineeCourse = $selExmneeData['exmne_course'];        

    // Select and tanang exam depende sa course nga ni login 
    $selExam = $conn->query("SELECT 
        * 
        FROM 
            exam_tbl 
        WHERE 
            cou_id = $examineeCourse 
        ORDER BY 
            ex_id 
        DESC
    ");
?>