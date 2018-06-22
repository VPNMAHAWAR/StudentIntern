<?php session_start(); 
 session_destroy();
 unset($_SESSION['User']);
 unset($_SESSION['Username']);
 header("location:index.php");
 exit;
?>
