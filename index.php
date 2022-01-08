<?php 
session_start();
if(isset($_SESSION['examineeSession']['examineenakalogin']) == true) header("location:home.php");

 ?>
  <style>
     body {
        background-image: url("./login-ui/images/kapayapaan.jpg");
        background-repeat: no-repeat;
        width: 100%;
        background-size: cover;
        height: 80vh;
        backdrop-filter: blur(3px);
     }
  </style>

<?php 

include("login-ui/index.php");


 ?>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/sweetalert.js"></script>