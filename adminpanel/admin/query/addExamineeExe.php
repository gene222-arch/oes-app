<?php
include 'conn.php';

if (isset($_POST['btn_examinee'])) {
    # exmne_fullname...
    $exmne_fullname = $_POST['exmne_fullname'];
    $exmne_birthdate = $_POST['exmne_birthdate'];
    $exmne_gender = $_POST['exmne_gender'];
    $exmne_course = $_POST['exmne_course'];
    $exmne_year_level = $_POST['exmne_year_level'];
    
                $query = $conn->query("insert into examinee_tbl (exmne_fullname, exmne_birthdate,exmne_gender, exmne_course, exmne_course, exmne_year_level) values('$exmne_fullname','$exmne_birthdate','$exmne_gender','$exmne_course','$exmne_year_level') ");
            
                header("location:index.php");
 } 
else{
    echo "nothing";
}
?>