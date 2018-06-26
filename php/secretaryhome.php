<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		 <title>Student Calendar</title>
	</head>
	
	<body>
	<h3>Student Calendar</h3>
	
		<?php
			include "home.php";
			if($_SESSION['role']!='secretary') {header ("Location: redirect.php");}
			
		?>
		<form method="post" action="logout.php">
				<input type="submit" name="logout" id="logoutbutton" value="Изход"/>
		</form>
			

		<h3>Заявки за зали, чакащи одобрение:</h3>
	
	<?php
				$conn=new PDO('mysql:host=localhost;dbname=scdb;charset=utf8', 'root', '');
				$sql="SELECT * FROM `roomreservation` WHERE `approved`='no'";
				$result=$conn->query($sql);
				echo"<table><tr><th>Заявка номер</th><th>Вид зала</th><th>Дата</th><th>От(час)</th><th>До(час)</th><th>Преподавател</th><th>Състояние</th></tr>";				
				while($row=$result->fetch())
				{
					$requestnumber=$row['reservationID'];
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
					$teacher=$row['teachernames'];
															
					echo"<tr><td>$requestnumber</td><td>$roomtype</td><td>$date</td><td>$timefrom</td><td>$timeto</td><td>$teacher</td><td>Чакащо</td></tr>";										
				}
				echo"</table>";								
				?>
		<h3>Назначи зала:</h3>
		<form action="secretaryhome.php" method="post">
			<label for="reservationnumber">Номер на заявка:</label>
			<input type="text" id="reservationnumber" name="reservationnumber">
			<label for="assignedroom">Назначена зала:</label>
			<input type="text" name="assignedroom" id="assignedroom"><br>
			<label for="approved">Одобрено:</label><br>	
			<input type="radio" name="approved" value="yes">Да<br>
			<input type="radio" name="approved" value="no">Не<br>
			<input type="submit" value="Обнови заявлението">
		</form>
		
		<?php
			if($_POST)
			{
				$conn=new PDO('mysql:host=localhost;dbname=scdb;charset=utf8', 'root', '');				
				$reservationnumber=$_POST['reservationnumber'];
				$sql="SELECT * FROM `roomreservation` WHERE `reservationID`='$reservationnumber'";
				$result=$conn->query($sql);
				$row=$result->fetch();
				$assignedroom=$row['roomtype'];
				
				if(!empty($_POST['assignedroom']))
				{
					$assignedroom=$_POST['assignedroom'];
				}
				$approved='no';
				$reviewed='yes';
				if($_POST['approved']=='yes')
				{
					$approved='yes';
				}
				
				$sql="UPDATE `roomreservation`
					SET `reviewed` = '$reviewed', `approved` = '$approved', `roomtype`='$assignedroom'
					WHERE `reservationID`='$reservationnumber'";
					
				$conn->query($sql) or die('Неуспешнa промяна на заявка заявка! Опитайте отново.');
				//header("Location: secretaryhome.php");
			}
		
		?>
	</body>
</html>