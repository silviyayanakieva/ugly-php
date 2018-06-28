<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../style/style.css">
		<title>Student Calendar</title>
	</head>
	
	<body  class="lecturerbody">
	<h3 class="lecturerheader">Student Calendar</h3>
	
		<?php include "home.php";?>
		<form method="post" action="logout.php">
				<input class="lecturerbutton" type="submit" name="logout" id="logoutbutton" value="Изход"/>
		</form>
		
		<a href="redirect.php"><< Начало</a>
		
		<h5>Състояние на заявките за зала за занятия</h5>
		
		
		<?php
			
				$userid=$_SESSION['userID'];
				$names=$_SESSION['names'];
				$conn=new PDO('mysql:host=localhost;dbname=scdb;charset=utf8', 'root', '');
				$sql="SELECT * FROM `roomreservation` WHERE `teacherID`='$userid'";
				$result=$conn->query($sql);
				echo"<table><tr><th>Зала</th><th>Дата</th><th>От(час)</th><th>До(час)</th><th>Одобрена</th></tr>";
				while($row=$result->fetch())
				{
					$roomtype='';
					if($row['roomtype']=='auditorium')
					{
					 $roomtype='Лекционна'; 
					 }
					elseif($row['roomtype']=='computer')
					{
					 $roomtype='Комп. кабинет'; 
					 }
					elseif($row['roomtype']=='seminar')
					{
					 $roomtype='Семинарна'; 
					 }
					 else
					 {
						$roomtype=$row['roomtype']; 
					 }
					 
					
					$date=$row['date'];
					$timefrom=$row['timefrom'];
					$timeto=$row['timeto'];
					$approved=$row['approved'];		
					
					
					if($approved=='yes')
					{
						echo"<tr><td>$roomtype</td><td>$date</td><td>$timefrom</td><td>$timeto</td><td>Да - зала $roomtype</td></tr>";
					}
					if($approved=='no')
					{
						echo"<tr><td>$roomtype</td><td>$date</td><td>$timefrom</td><td>$timeto</td><td>Не</td></tr>";
					}
					
				}
				echo"</table>";
			
		?>
		
	</body>
</html>