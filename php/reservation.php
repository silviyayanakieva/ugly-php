<html>
	<head>
		<meta charset="utf-8" />
		 <title>Student Calendar</title>
	</head>
	
	<body>
	<h3>Student Calendar</h3>
	
		<?php include "home.php";?>
		<form method="post" action="logout.php">
				<input type="submit" name="logout" id="logoutbutton" value="Изход"/>
		</form>
		<a href="redirect.php">Начало</a>
		
		<h5>Запазване на зала за занятия</h5>
		
		<form method="post" action="reservation.php">
			<select name="roomtype">
			  <option value="auditorium">Лекционна</option>
			  <option value="seminar">Семинарна</option>
			  <option value="computer">Компютърен кабинет</option>
			</select>
			<label for="date">Дата:</label>
			<input type="date" name="date" id="date">
			<label for="timefrom">От (чч:мм):</label>
			<input type="text" name="timefrom" id="timefrom">
			<label for="timeto">До (чч:мм):</label>
			<input type="text"name="timeto" id="timeto">
			<input type="submit" value="Изпрати заявка">
		</form>
		
		<?php
			if($_POST)
			{
				$userid=$_SESSION['userID'];
				$names=$_SESSION['names'];
				$conn=new PDO('mysql:host=localhost;dbname=scdb;charset=utf8', 'root', '');
				
				$roomtype=$_POST['roomtype'];
				$date=$_POST['date'];
				$timefrom=$_POST['timefrom'];
				$timeto=$_POST['timeto'];
				$approved="no";
				$reviewed="no";
				$sql="INSERT INTO `roomreservation`(`roomtype`,`date`,`timefrom`,`timeto`,`teacherID`,`teachernames`,`approved`,`reviewed`)
				VALUES('$roomtype','$date','$timefrom','$timeto','$userid','$names','$approved','$reviewed')";
				$conn->query($sql) or die('Неуспешно подадена заявка! Опитайте отново.');
			}
		?>
		
	</body>
</html>