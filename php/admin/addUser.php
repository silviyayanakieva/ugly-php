<html>
	<head>
		<meta charset="utf-8" />
				<link rel="stylesheet" type="text/css" href="../../style/style.css">
		<title>Student Calendar</title>
	</head>
	<body class="secretarybody">
		<h3 class="secretaryheader">Student Calendar</h3>
		
			<?php
				include "../home.php";
				if($_SESSION['role']!='admin') {header ("Location: ../redirect.php");}
				
			?>
			<form method="post" action="../logout.php">
				<input class="secretarybutton" type="submit" name="logout" id="logoutbutton" value="Изход"/>
			</form>
			<a href="../redirect.php">Начало</a>
			<h3>Добавяне на потребител </h3>
			<form method="post" action="addUser.php">
				<label for="username">Потребителско име:</label>
					<input type="text" name="username" id="username"><br>
				<label for="names">(титла) Имена:</label>
					<input type="text" name="names" id="names"><br>
				<label for="password">Парола: </label>
					<input type="text" name="password" id="password"><br>
				<label for="role">Роля:</label>
				<select name="role">
				    <option value="lecturer">Лектор</option>
				    <option value="student">Студент</option>
				    <option value="studAssistant">Студент-асистет</option>
				    <option value="secretary">Секретар</option>
				</select><br>
				<input class="secretarybutton" type="submit" value="Добави">
			</form>
	</body>
</html>

<?php

	if($_POST)
	{
		$username=$_POST['username'];
		$names=$_POST['names'];
		$password=$_POST['password'];
		$passwordhash=password_hash($password,PASSWORD_DEFAULT);
		$role=$_POST['role'];
		
		$conn=new PDO("mysql:host=localhost;dbname=scdb;charset=utf8",'root','');		
		$sql="INSERT INTO `users`(`username`,`names`,`password`,`role`) 
				VALUES ('$username','$names','$passwordhash','$role')";
				$conn->query($sql) or die("Неуспешно въведен потребител");
		
	}
?>