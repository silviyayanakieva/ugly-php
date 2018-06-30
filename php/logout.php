<?php
session_start();
if($_POST)
{
	unset($_SESSION['userID']);
	unset($_SESSION['names']);
	unset($_SESSION['last_active']);
	session_destroy();
	header("Location: ../index.php");
	
}
?>