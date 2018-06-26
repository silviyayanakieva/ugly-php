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
			
		<form action="lecturerhome.php" method="get">
			<input type="radio" name="radio" value="allstudents">Списък със студенти, записали водени от мен избираеми <br>
			<input type="radio" name="radio" value="allelectives">Списък с избираеми, водени от мен  <br>
			<input type="submit" name="submit" value="Покажи" />
		</form>
	<?php
			if (isset($_GET['submit'])) {
				if(isset($_GET['radio']))
				{
					
					$lecturerid=$_SESSION['userID'];
					$selectedoption=$_GET['radio'];
					$conn=new PDO('mysql:host=localhost;dbname=scdb;charset=utf8', 'root', '');
					if($_GET['radio']=='allstudents')
					{
						$sql="SELECT * FROM `users` INNER JOIN `enrolledelectives` ON `enrolledelectives`.`studentID`=`users`.`userID` WHERE `enrolledelectives`.`enrolledelectiveID`IN (SELECT `electiveID` FROM `electives` WHERE `lecturerID`=$lecturerid)" ;
			
						$result=$conn->query($sql);
						echo "<table> <tr> <th>Име на студент</th> <th>Факултетен номер</th> <th>Избираема</th> </tr>";
						while ($row = $result->fetch())
						{							
							$name=$row['names'];
							$studentid=$row['studentID'];
							$elective=$row['electivename'];
							echo"<tr><td>$name</td><td>$studentid</td><td>$elective</td></tr>";
						};
						echo"</table>";
					}
					if($_GET['radio']=='allelectives')
					{
						$sql="SELECT * FROM `electives` WHERE `lecturerID`=$lecturerid" ;
			
						$result=$conn->query($sql);
						echo "<table> <tr> <th>Избираема</th> <th>Кредити</th> </tr>";
						while ($row = $result->fetch())
						{							
							$name=$row['name'];
							$credits=$row['credits'];

							echo"<tr><td>$name</td><td>$credits</td></tr>";
						};
						echo"</table>";
					}
				}
			}
			?>
			
			<form action="lecturerhome.php" method="post">
				<input type="submit" name="hide" value="Скрий" />
			</form>
			
			<?php
			if(!empty($_POST['hide']))
			{
				header("Refresh: 0");
			}
			?>
			
			<a href="reservation.php">Запазване на зала за занятия >></a>
			<a href="reservationstatus.php">Преглед на състоянието на подадените заявки>></a>
	
</body>
</html>