	
	<?php
			session_start();
			include "timekeeper.php";
			if(!isset($_SESSION['userID']))
			{
				header("Location: ../index.php");
			}
			$conn=new PDO('mysql:host=localhost;dbname=scdb;charset=utf8', 'root', '');
			$userid=$_SESSION['userID'];
			$sql="SELECT * FROM `users` WHERE `userID`='$userid'" ;
			
			$result=$conn->query($sql);
			$row = $result->fetch();
			$name=$row['names'];
			echo "<h4>Добре дошли, $name !</h4>";
			
			
	?>
	