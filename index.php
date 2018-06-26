<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		 <title>Вход в системата</title>
	</head>

	<body>
	
		<h3>Вход в информационната система:</h3>
	
		<form method="post" action="index.php">
		
			<label> Потребителско име:
				<input type="text" name="usrname">
			</label>
			<label> Парола:
				<input type="password" name="passwd" >
			</label>
			<button> Влез </button>
		</form>
		
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
							echo "Грешно потребителско име или парола!";
						}
				}
		?>
		</body>
</html>
	
	





