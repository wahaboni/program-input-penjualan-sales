<?php 
session_start();
unset($_SESSION['userlogin.php']);
session_destroy();
header('location:index.php');
 ?>