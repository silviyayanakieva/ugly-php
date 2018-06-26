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
			if($_SESSION['role']!='student') {header ("Location: redirect.php");}
			
		?>
		<form method="post" action="logout.php">
				<input type="submit" name="logout" id="logoutbutton" value="Изход"/>
		</form>
			
		<form action="studenthome.php" method="get">
			<input type="radio" name="radio" value="allelectives">Списък с всички избираеми <br>
			<input type="radio" name="radio" value="enrolledelectives">Списък с избираемите, в които съм записан/а<br>
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
						$sql="SELECT * FROM `electives` INNER JOIN `enrolledelectives` ON `electives`.`electiveID`=`enrolledelectives`.`enrolledelectiveID` 
								WHERE `enrolledelectives`.`studentID`=$studentid" ;
			
						$result=$conn->query($sql);
						echo "<table> <tr> <th>Име</th> <th>Преподавател</th> <th>Асистент</th><th>Кредити</th> </tr>";
						while ($row = $result->fetch())
						{
							
							$name=$row['name'];
							$lecturername=$row['lecturername'];
							$assistant=$row['assistantname'];
							$credits=$row['credits'];
							echo"<tr><td>$name</td><td>$lecturername</td><td>$assistant</td><td>$credits</td></tr>";
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
							$assistant=$row['assistantname'];
							$credits=$row['credits'];
							echo"<tr><td>$name</td><td>$lecturername</td><td>$assistant</td><td>$credits</td></tr>";
						};
						echo"</table>";
					}
				}
			}
			?>
			
			
			<form action="studenthome.php" method="post">
				<input type="submit" name="hide" value="Скрий" />
			</form>
			
			
			<?php
			if(!empty($_POST['hide']))
			{
				header("Refresh: 0");
			}
			?>
	
</body>
</html>