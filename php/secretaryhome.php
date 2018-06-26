<!DOCTYPE html>
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
			

		<h3>Заявки за зали, чакащи одобрение:</h3>
	
	<?php
				$conn=new PDO('mysql:host=localhost;dbname=scdb;charset=utf8', 'root', '');
				$sql="SELECT * FROM `roomreservation` WHERE `approved`='no'";
				$result=$conn->query($sql);
				echo"<table><tr><th>Заявка номер</th><th>Зала</th><th>Дата</th><th>От(час)</th><th>До(час)</th><th>Действие</th></tr>";				
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
					$approved=$row['approved'];	
					$secretaryhome="secretaryhome.php";
					$method="post";
					$hidden="hidden";
					$request="request";
					$submit="submit";
					
															
						echo"<tr><td>$requestnumber</td><td>$roomtype</td><td>$date</td><td>$timefrom</td><td>$timeto</td>
						<td><form action='$secretaryhome' method='$method'><input type='$hidden' value='$requestnumber' name='$request'><input type='$submit' value='Обработи'></form></td></tr>";										
				}
				echo"</table>";
				?>
				
</body>
</html>