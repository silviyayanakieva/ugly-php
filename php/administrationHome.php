<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../style/style.css">
		<title>Student Calendar</title>
	</head>
	<body class="secretarybody">
		<h3 class="secretaryheader">Student Calendar</h3>
		
		<form method="post" action="logout.php">
				<input class="secretarybutton" type="submit" name="logout" id="logoutbutton" value="Изход"/>
		</form>
			<?php
				include "home.php";
				if($_SESSION['role']!='admin') {header ("Location: ../redirect.php");}			
			?>
			
			<a href="admin/addUser.php">Добавяне на потребител >></a>
			<a href="admin/editUser.php">Редактиране на данни на потребител >></a>
			<a href="admin/addElective.php">Добавяне на избираем предмет >></a>
			<a href="admin/editElective.php">Редактиране на данни за избираем предмет >></a>
	</body>
</html>