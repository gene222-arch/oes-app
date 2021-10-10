<?php 
session_start();

include('includes/connect.php');

if (isset($_POST['btn_login'])) {
    # code...
    $exmne_email = $_POST['exmne_email'];
    $exmne_password = $_POST['exmne_password'];

    $query = mysqli_query($conn, "select * from examinee_tbl where exmne_email='$exmne_email' && exmne_password='$exmne_password' ") or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($query);
    $count = mysqli_num_rows($query);

    if ($count>0) {
        $_SESSION['user_id']= $row['id'];
        header("location:home.php");
    }else{
        $_SESSION['error'] = "Invalid email or password";
        header("location:home.php");
    }
}

?>