<?php session_start();
	if (!isset($_SESSION['User']) && !isset($_SESSION['Username'])) {
		$check = false;
	}
	else {
		$type = $_SESSION['User'];
  		$email = $_SESSION['Username'];
  		$id = $_SESSION['id'];
  		$check = true;
  		// echo 'true';
	}
?>