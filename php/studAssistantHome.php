<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../style/style.css">
		<title>Student Calendar</title>
	</head>
	
	<body  class="studentbody">
	<h3 class="studentheader">Student Calendar</h3>
	
		<?php
			include "home.php";
			if($_SESSION['role']!='studAssistant') {header ("Location: redirect.php");}
		?>
		<form method="post" action="logout.php">
				<input type="submit" name="logout" id="logoutbutton" value="Изход"/>
		</form>
			
		<form action="studAssistantHome.php" method="get">
			<h5>Покажи: </h5>
			<input type="radio" name="radio" value="allelectives">Списък с всички избираеми <br>
			<input type="radio" name="radio" value="enrolledelectives">Списък с избираемите, в които съм записан/а<br>
			<input type="radio" name="radio" value="assisting">Списък с избираемите, в които съм асистент<br>
			<input type="submit" name="submit" value="Покажи" />
		</form>

			<?php
			if (isset($_GET['submit'])) {
				if(isset($_GET['radio']))
				{
					
					$studentid=$_SESSION['userID'];
					$selectedoption=$_GET['radio'];
					$conn=new PDO('mysql:host=localhost;dbname=scdb;charset=utf8', 'root', '');
					if($_GET['radio']=='enrolledelectives')
					{
						$sql="SELECT * FROM `electives` INNER JOIN `enrolledelectives` ON `electives`.`electiveID`=`enrolledelectives`.`enrolledElectiveID` 
								WHERE `enrolledelectives`.`studentID`=$studentid" ;
								
						$result=$conn->query($sql);
						echo "<table> <tr> <th>Име</th> <th>Преподавател</th> <th>Кредити</th> </tr>";
						while ($row = $result->fetch())
						{
							
							$name=$row['name'];
							$lecturername=$row['lecturername'];
							$credits=$row['credits'];
							$link="lecturerInfo.php?lecturer=".$lecturerid;
							echo"<tr><td>$name</td><td><a href=$link>$lecturername</a></td><td>$credits</td></tr>";
						};
						echo"</table>";
					}
					if($_GET['radio']=='allelectives')
					{
						$sql="SELECT * FROM `electives`" ;
			
						$result=$conn->query($sql);
						echo "<table> <tr> <th>Име</th> <th>Преподавател</th> <th>Кредити</th> </tr>";
						while ($row = $result->fetch())
						{
							
							$name=$row['name'];
							$lecturername=$row['lecturername'];
							$lecturerid=$row['lecturerID'];
							$credits=$row['credits'];
							$link="lecturerInfo.php?lecturer=".$lecturerid;
							echo"<tr><td>$name</td><td><a href=$link>$lecturername</a></td><td>$credits</td></tr>";
						};
						echo"</table>";
					}
					if($_GET['radio']=='assisting')
					{
						$sql="SELECT * FROM `electives` WHERE `assistantID`=$studentid" ;
			
						$result=$conn->query($sql);
						echo "<table> <tr> <th>Име</th> <th>Преподавател</th> <th>Кредити</th> </tr>";
						while ($row = $result->fetch())
						{
							$name=$row['name'];
							$lecturername=$row['lecturername'];
							$lecturerid=$row['lecturerID'];
							$credits=$row['credits'];
							$link="lecturerInfo.php?lecturer=".$lecturerid;
							echo"<tr><td>$name</td><td><a href=$link>$lecturername</a></td><td>$credits</td></tr>";
						};
						echo"</table>";
					}
				}
			}
			?>
			
			<form action="studAssistantHome.php" method="post">
				<input type="submit" name="hide" value="Скрий" />
			</form>
			
			<?php
			if(!empty($_POST['hide']))
			{
				header("Refresh: 0");
			}
			?>
			
			<a href="reservation.php">Запазване на зала за занятия >></a>
	
</body>
</html>