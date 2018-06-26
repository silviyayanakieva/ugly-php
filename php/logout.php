<?php
session_start();
if($_POST)
{
	unset($_SESSION["userID"]);
	unset($_SESSION["names"]);
	session_destroy();
	header("Location: ../index.php");
	
}
?>