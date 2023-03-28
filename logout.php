<?php 
	session_start();
	//session_unset($_SESSION['name']);
	//session_unset($_SESSION['id']);
	//session_unset($_SESSION['currency']);
	session_destroy();
	header("location:http://localhost/college/index.php");

?>