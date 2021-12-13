<?php
session_start();
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

    $currentYear = (int) date('Y');
    $exmnBirthYear = (int) explode('-', $exmne_birthdate)[0];

    if ($currentYear < $exmnBirthYear) 
    {
        $_SESSION['exmne_fullname'] = $exmne_fullname;
        $_SESSION['exmne_birthdate'] = $exmne_birthdate;
        $_SESSION['exmne_gender'] = $exmne_gender;
        $_SESSION['exmne_course'] = $exmne_course;
        $_SESSION['exmne_year_level'] = $exmne_year_level;
        $_SESSION['exmne_email'] = $exmne_email;
        $_SESSION['exmne_password'] = $exmne_password;
        $_SESSION['exmne_birthdate_error'] = 'Invalid date';
        header("location:register.php");
    }
   
    if ($exmnBirthYear <= $currentYear)
    {
        unset($_SESSION['exmne_fullname']);
        unset($_SESSION['exmne_birthdate']);
        unset($_SESSION['exmne_gender']);
        unset($_SESSION['exmne_course']);
        unset($_SESSION['exmne_year_level']);
        unset($_SESSION['exmne_email']);
        unset($_SESSION['exmne_password']);
        unset($_SESSION['exmne_birthdate_error']); 
        $query = $conn->query("insert into examinee_tbl (exmne_fullname, exmne_birthdate,exmne_gender, exmne_course, exmne_year_level,exmne_email,exmne_password) values('$exmne_fullname','$exmne_birthdate','$exmne_gender','$exmne_course','$exmne_year_level','$exmne_email','$exmne_password') ");

        header("location:index.php");
    }
 } 
else{
    echo "nothing";
}
?>