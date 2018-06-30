<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../style/style.css">
		<title>Student Calendar</title>
	</head>
	
	<body class="lecturerbody">

	<h3  class="lecturerheader">Student Calendar</h3>
	<form method="post" action="logout.php">
				<input class="lecturerbutton"type="submit" name="logout" id="logoutbutton" value="Изход"/>
	</form>
		<?php
			include "home.php";
			if($_SESSION['role']!='lecturer') {header ("Location: redirect.php");}
			
		?>
		
		
		<form action="lecturerhome.php" method="get">
			<h5>Покажи:</h5>
			<input type="radio" name="radio" value="allstudents">Списък със студенти, записали водени от мен избираеми <br>
			<input type="radio" name="radio" value="allelectives">Списък с водени от мен избираеми  <br>
			<input class="lecturerbutton" type="submit" name="submit" value="Покажи" />
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
						echo "<table> <tr> <th>Избираема</th> <th>Асистент</th> <th>Кредити</th> </tr>";
						while ($row = $result->fetch())
						{							
							$name=$row['name'];
							$assistant=$row['assistantname'];
							$credits=$row['credits'];

							echo"<tr><td>$name</td><td>$assistant</td><td>$credits</td></tr>";
						};
						echo"</table>";
					}
				}
			}
			?>
			
			<form action="lecturerHome.php" method="post">
				<input class="lecturerbutton" type="submit" name="hide" value="Скрий" />
			</form>

			
			<?php
			if(!empty($_POST['hide']))
			{
				header("Refresh: 0");
			}
			?>
			
			<a href="reservation.php">Запазване на зала за занятия >></a>
			<a href="reservationStatus.php">Преглед на състоянието на подадените заявки>></a>
	
</body>
</html>