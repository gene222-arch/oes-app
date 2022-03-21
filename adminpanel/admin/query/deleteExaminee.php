<?php 
include("../../../conn.php");

if (isset($_POST['deleteExaminee']))
{
    $id = $_GET['examineeID'];

    $delExam = $conn->query("DELETE FROM examinee_tbl WHERE exmne_id = '$id'");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}