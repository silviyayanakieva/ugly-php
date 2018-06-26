<?php
//no longer in use
	$conn=new PDO('mysql:host=localhost;dbname=scdb;charset=utf8', 'root', '');
	//$sql="SELECT * FROM `users` WHERE `username`='$username'" ;
	 $usernames=array("pivanov","gtgeorgiev","kmarinova","ivanovar","administrator"); 
	 $passwds=array(password_hash('parola', PASSWORD_DEFAULT),
					 password_hash('kalinka', PASSWORD_DEFAULT),
					 password_hash('123puhi123', PASSWORD_DEFAULT),
					 password_hash('sufmikancelariq', PASSWORD_DEFAULT),
					 password_hash('otednododevet', PASSWORD_DEFAULT)); 
	 $roles=array("lecturer","student","studAssistant","secretary","admin");
	
	 for($i=0;$i<=4;$i++)
	 {
	 $sql="INSERT INTO `users`(`username`,`password`,`role`) VALUES('$usernames[$i]','$passwds[$i]','$roles[$i]')" ;
	 $conn->query($sql);
	 }
	 
	 $sql="INSERT INTO `rooms` VALUES
				('107', 'computerlab', '30'),
				('325', 'auditorium', '200'),
				('514', 'seminar', '20')" ;
	 $conn->query($sql);
	 
	 $sql="INSERT INTO `electives` VALUES('1', 'Фрактали', '1', '5')" ;
	 $conn->query($sql);
	 
	 $sql="INSERT INTO `enrolledelectives` VALUES('1','2', '1')" ;
	 $conn->query($sql);
	
	  // $sql="SELECT * FROM `users` WHERE `username`='ivanovar'" ;
	  // $result=$conn->query($sql);
	  // $row = $result->fetch();
	  // if( password_verify('sufmikancelariq',$row['password'])) {echo "yayy";};
?>