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
			
			<h3>Редактиране на данни за избираем предмет </h3>
			<form method="post" action="editElective.php">
				
			</form>
			<h2>TO DO</h2>
	</body>
</html>