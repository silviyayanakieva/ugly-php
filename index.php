<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style/login.css">
		<title>Вход в системата</title>
	</head>

	<body>
	
		<?php
			session_start();
			if(isset($_SESSION['userID']))
			{
				$userid=$_SESSION['userID'];
				$conn=new PDO('mysql:host=localhost;dbname=scdb;charset=utf8', 'root', '');
				$sql="SELECT * FROM `users` WHERE `userID`='$userid'" ;
				$result=$conn->query($sql) or  die("failed");
			
				$row = $result->fetch();
				switch ($row['role']) {
							case "lecturer":
								header( "Location: php/lecturerhome.php");
								break;
							case "student":
								header("Location: php/studenthome.php");
								break;
							case "studAssistant":
								header(  "Location: php/studAssistanthome.php");
								break;
							case "secretary":
								header(  "Location: php/secretaryhome.php");
								break;
							case "admin":
								header(  "Location: php/administrationhome.php");
								break;
						}
			}
			else
			{
				session_destroy();
			}
		?>
		<h3 align="center">Student Calendar</h3>
		<h3 align="center">Вход в информационната система:</h3>
	
		<form method="post" action="index.php">
		
			<label for="usrnm"> Потребителско име:</label>
				<input type="text" id="usrnm" name="usrname"><br>			
			<label for="pswd"> Парола:</label>
				<input type="password" id="pswd" name="passwd" >
			
			<input class="button" type="submit" value="Вход" onclick="logcheck()">
		</form>
		
		<script> 
		function logcheck(){
			var un=document.getElementById("usrnm").value;
			var pw=document.getElementById("pswd").value;
			if(un==""||pw=="")
			{
				alert("Грешно потребителско име или парола!");
			}
		}
		
		</script>
		
		<?php
			if ($_POST){
					$username=$_POST['usrname'];
					$password=$_POST['passwd'];
					$error='';
								
					$conn=new PDO('mysql:host=localhost;dbname=scdb;charset=utf8', 'root', '');
					$sql="SELECT * FROM `users` WHERE `username`='$username'" ;
					$result=$conn->query($sql) or  die("failed");
				
					$row = $result->fetch();
						if(password_verify($password, $row['password']))
						{
							session_start();
							$userid=$row['userID'];
							$_SESSION['userID']=$userid;
							$_SESSION['names']=$row['names'];
							$_SESSION['role']=$row['role'];
							$_SESSION['last_active']=time();
							switch ($row['role']) {
										case "lecturer":
											header( "Location: php/lecturerhome.php");
											break;
										case "student":
											header("Location: php/studenthome.php");
											break;
										case "studAssistant":
											header(  "Location: php/studAssistanthome.php");
											break;
										case "secretary":
											header(  "Location: php/secretaryhome.php");
											break;
										case "admin":
											header(  "Location: php/administrationhome.php");
											break;
									}
									
						}
						else
						{ 
							
							echo '<p align="center">Грешно потребителско име или парола!</p>';
						}
						
				}
		?>
		</body>
</html>
	
	





