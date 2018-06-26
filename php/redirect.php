<?php 
	session_start();
	
	if(isset($_SESSION['userID']))
	{
		$userid=$_SESSION['userID'];
		$conn=new PDO('mysql:host=localhost;dbname=scdb;charset=utf8', 'root', '');
		$sql="SELECT * FROM `users` WHERE `userID`='$userid'" ;
		$result=$conn->query($sql) or  die("failed");
		$row=$result->fetch();						
			switch ($row['role']) {
				case "lecturer":
					header( "Location: lecturerhome.php");
					break;
				case "student":
					header("Location: studenthome.php");
					break;
				case "studAssistant":
					header(  "Location: studAssistanthome.php");
					break;
				case "secretary":
					header(  "Location: secretaryhome.php");
					break;
				case "admin":
					header(  "Location: administrationhome.php");
					break;
			}
	}		
		
?>