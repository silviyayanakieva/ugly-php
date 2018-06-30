<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../style/style.css">
		<title>Student Calendar</title>
	</head>
	
	<body  class="studentbody">
	<h3 class="studentheader">Student Calendar</h3>
	
		<?php
			include "home.php"; ?>
	<a href="redirect.php"><< Начало</a>
	<h3>Информация за преподавател:</h3>
	<?php
	$lecturerid=$_GET['lecturer'];
	$conn= new PDO('mysql:host=localhost;dbname=scdb;charset=utf8','root','');
	$sql="SELECT * FROM `lecturerdata` INNER JOIN `users` ON `lecturerdata`.`lecturerID`=`users`.`userID` WHERE `lecturerID`=$lecturerid";
	$result=$conn->query($sql) or die ("Не е намерена информация");
	$row=$result->fetch();
	if(!empty($row)){
		$name=$row['names'];
		$practice=$row['practice'];
		$email=$row['email'];
		$phone=$row['phone'];
		$hours=$row['hours'];
		echo "<h4>$name</h4>";
		echo "<p>Кабинет: $practice</p>";
		echo "<p>e-mail: $email</p>";
		echo "<p>Телефон: $phone</p>";
		echo "<p>Приемно време: $hours</p>";
	}
	else {echo"Не е намерена информация!";}
	?>
			
	</body>
</html>