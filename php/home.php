	
	<?php
			session_start();
			
			$conn=new PDO('mysql:host=localhost;dbname=scdb;charset=utf8', 'root', '');
			$userid=$_SESSION['userID'];
			$sql="SELECT * FROM `users` WHERE `userID`='$userid'" ;
			
			$result=$conn->query($sql);
			$row = $result->fetch();
			$name=$row['names'];
			echo "<h5>Добре дошли, $name !</h5>";
			
			
	?>
	