<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../style/style.css">
		<title>Student Calendar</title>
	</head>
	
	<body  class="studentbody">
	<h3 class="studentheader">Student Calendar</h3>
	
		<form method="post" action="logout.php">
				<input class="studentbutton" type="submit" name="logout" id="logoutbutton" value="Изход"/>
		</form>
		
		<?php
			include "home.php";
			if($_SESSION['role']!='student') {header ("Location: redirect.php");}
			
		?>
		
			
		<form action="studentHome.php" method="get">
		<h5>Покажи: </h5>
			<input type="radio" name="radio" value="allelectives">Списък с всички избираеми <br>
			<input type="radio" name="radio" value="enrolledelectives">Списък с избираемите, в които съм записан/а<br>
			<input class="studentbutton" type="submit" name="submit" value="Покажи" />
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
						$sql="SELECT * FROM `electives` INNER JOIN `enrolledelectives` ON `electives`.`electiveID`=`enrolledelectives`.`enrolledelectiveID` 
								WHERE `enrolledelectives`.`studentID`=$studentid" ;
			
						$result=$conn->query($sql);
						echo "<table> <tr> <th>Име</th> <th>Преподавател</th> <th>Асистент</th><th>Кредити</th> </tr>";
						while ($row = $result->fetch())
						{
							
							$name=$row['name'];
							$lecturername=$row['lecturername'];
							$lecturerid=$row['lecturerID'];
							$assistant=$row['assistantname'];
							$credits=$row['credits'];
							$link="lecturerInfo.php?lecturer=".$lecturerid;
							echo "<tr><td>$name</td><td><a href=$link>$lecturername</a></td><td>$assistant</td><td>$credits</td></tr>";
							//
						};
						echo"</table>";
					}
					if($_GET['radio']=='allelectives')
					{
						$sql="SELECT * FROM `electives`" ;
			
						$result=$conn->query($sql);
						echo "<table> <tr> <th>Име</th> <th>Преподавател</th> <th>Асистент</th> <th>Кредити</th> </tr>";
						while ($row = $result->fetch())
						{
							
							$name=$row['name'];
							$lecturername=$row['lecturername'];
							$lecturerid=$row['lecturerID'];
							$assistant=$row['assistantname'];
							$credits=$row['credits'];
							$link="lecturerInfo.php?lecturer=".$lecturerid;
							echo"<tr><td>$name</td><td><a href=$link>$lecturername</a></td><td>$assistant</td><td>$credits</td></tr>";
						};
						echo"</table>";
					}
				}
			}
			?>
			
			
			<form action="studentHome.php" method="post">
				<input class="studentbutton" type="submit" name="hide" value="Скрий" />
			</form>
			
			
			<?php
			if(!empty($_POST['hide']))
			{
				header("Refresh: 0");
			}
			?>
	
	</body>
</html>