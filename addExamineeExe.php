<?php
include_once('conn.php');

if (isset($_POST['btn_examinee'])) {
    # exmne_fullname...
    $exmne_fullname = $_POST['exmne_fullname'];
    $exmne_birthdate = $_POST['exmne_birthdate'];
    $exmne_gender = $_POST['exmne_gender'];
    $exmne_course = $_POST['exmne_course'];
    $exmne_year_level = $_POST['exmne_year_level'];
    $exmne_email = $_POST['exmne_email'];
    $exmne_password = $_POST['exmne_password'];
    
                $query = $conn->query("insert into examinee_tbl (exmne_fullname, exmne_birthdate,exmne_gender, exmne_course, exmne_year_level,exmne_email,exmne_password) values('$exmne_fullname','$exmne_birthdate','$exmne_gender','$exmne_course','$exmne_year_level','$exmne_email','$exmne_password') ");
            
                header("location:index.php");
 } 
else{
    echo "nothing";
}
?>