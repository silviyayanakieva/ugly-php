<html>
	<head>
		<meta charset="utf-8" />
				<link rel="stylesheet" type="text/css" href="../../style/style.css">
		<title>Student Calendar</title>
	</head>
	<body class="secretarybody">
		<h3 class="secretaryheader">Student Calendar</h3>
		
			<?php
				include "../home.php";
				if($_SESSION['role']!='admin') {header ("Location: ../redirect.php");}	
				
			?>
			<form method="post" action="../logout.php">
				<input class="secretarybutton" type="submit" name="logout" id="logoutbutton" value="Изход"/>
			</form>
			<a href="../redirect.php"> <<Начало</a>
			<h3>Добавяне на избираем предмет </h3>
			<form method="post" action="addElective.php">
				<label for="electivename">Име на избираемия предмет:</label>
					<input type="text" name="electivename" id="electivename"><br>
				<label for="lecturerid">ID на преподавател:</label>
					<input type="text" name="lecturerid" id="lecturerid"><br>
				<label for="assistantid">ID на асистент:</label>
					<input type="text" name="assistantid" id="assistantid"><br>
				<label for="credits">Брой кредити:</label>
					<input type="text" name="credits" id="credits"><br>
				<input class="secretarybutton" type="submit" value="Добави" onclick="message()"><br>
				<script>
					function message(){
						var name=document.getElementById("electivename").value;
						var lectid=document.getElementById("lecturerid").value;
						var assistid=document.getElementById("assistantid").value;
						var credits=document.getElementById("credits").value;
						if(name==""||lectid==""||assistid==""||credits=="")
						{
							alert("Всички полета са задължителни!");
						}
						else
						{
							alert("Избираемата е записана!");
						}
				
					}
				</script>
			</form>

	</body>
</html>

<?php

	if($_POST)
	{
		$electivename=$_POST['electivename'];
		$lecturerid=$_POST['lecturerid'];
		$assistantid=$_POST['assistantid'];
		$credits=$_POST['credits'];
		
		$conn=new PDO("mysql:host=localhost;dbname=scdb;charset=utf8",'root','');
		
		if($lecturerid!=""){
			$sql="SELECT * from `users` WHERE `userID`=$lecturerid";
			$result=$conn->query($sql);
			$row=$result->fetch();
			$lecturername=$row['names'];
		}
		if($assistantid!=""){
			$sql="SELECT * from `users` WHERE `userID`=$assistantid";
			$result=$conn->query($sql);
			$row=$result->fetch();
			$assistantname=$row['names'];
		}
		
		if($assistantid!=""&&$lecturerid!=""){	
			$sql="INSERT INTO `electives`(`name`,`lecturerID`,`lecturername`,`assistantID`,`assistantname`) 
				VALUES ('$electivename','$lecturerid','$lecturername','$assistantid','$assistantname')";
				$conn->query($sql) or die("Неуспешно въведена избираема");
		}
	}
?>