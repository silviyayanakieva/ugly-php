<?php
//creating database
try {
    $conn = new PDO("mysql:host=localhost", 'root','');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE scdb";

    $conn->exec($sql);
    echo "Database created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "\n" . $e->getMessage();
    }
	
$createtables= "CREATE TABLE `electives` (
  `electiveID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lecturerID` int(11) NOT NULL,
  `lecturername` varchar(200) NOT NULL,
  `assistantID` int(11) NOT NULL,
  `assistantname` varchar(200) NOT NULL,
  `credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `enrolledelectives` (
  `enrollment` int(11) NOT NULL,   
  `studentID` int(11) NOT NULL,
  `enrolledelectiveID` int(11) NOT NULL,
  `electivename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `roomreservation` (
  `reservationID` int(11) NOT NULL,
  `roomtype` varchar(50) NOT NULL, 
  `date` varchar(11) NOT NULL,
  `timefrom` varchar(12) NOT NULL,
  `timeto` varchar(12) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `teachernames` varchar(50) NOT NULL,
  `approved` enum('yes','no') DEFAULT 'no',
  `reviewed` enum('yes','no') DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `names` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('lecturer','student','studAssistant','secretary','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `lecturerdata` (
  `lecturerID` int(11) NOT NULL,
  `office` int(4),
  `email` varchar(50),
  `phone` varchar(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `electives`
  ADD PRIMARY KEY (`electiveID`),
  ADD KEY `lecturerID` (`lecturerID`);
  
ALTER TABLE `enrolledelectives`
  ADD KEY `studentID` (`studentID`),
  ADD KEY `enrolledelectiveID` (`enrolledelectiveID`);
  
ALTER TABLE `roomreservation`
  ADD PRIMARY KEY (`reservationID`);
 
ALTER TABLE `roomreservation`
  MODIFY `reservationID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `enrolledelectives`
  ADD PRIMARY KEY (`enrollment`);
  
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);
  
ALTER TABLE `electives`
  MODIFY `electiveID` int(11) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `enrolledelectives`
  MODIFY `enrollment` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `electives`
  ADD CONSTRAINT `electives_ibfk_1` FOREIGN KEY (`lecturerID`) REFERENCES `users` (`userID`);

ALTER TABLE `enrolledelectives`
  ADD CONSTRAINT `enrolledelectives_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `enrolledelectives_ibfk_2` FOREIGN KEY (`enrolledElectiveID`) REFERENCES `electives` (`electiveID`);
  
ALTER TABLE `lecturerdata`
  ADD CONSTRAINT `lecturerdata_ibfk_1` FOREIGN KEY (`lecturerID`) REFERENCES `users` (`userID`);  " 
;

//creating tables
	$conn = new PDO("mysql:host=localhost;dbname=scdb;charset=utf8", 'root','');
	$conn->query($createtables);

//entering data
	$usernames=array("pivanov","gtgeorgiev","kmarinova","ivanovar","administrator","mariavv","steladim","ivanovivan"); 
	$names=array("доц. Петър Иванов","Георги Георгиев","Калина Маринова","Райна Иванова","Администрация","доц. Мария Владимирова","Стела Димитрова","Иван Иванов");
	$passwds=array(password_hash('parola', PASSWORD_DEFAULT),
					 password_hash('kalinka', PASSWORD_DEFAULT),
					 password_hash('123puhi123', PASSWORD_DEFAULT),
					 password_hash('sufmikancelariq', PASSWORD_DEFAULT),
					 password_hash('otednododevet', PASSWORD_DEFAULT),
					 password_hash('smile55', PASSWORD_DEFAULT),
					 password_hash('kartof', PASSWORD_DEFAULT),
					  password_hash('ivan', PASSWORD_DEFAULT)); 
	$roles=array("lecturer","student","studAssistant","secretary","admin","lecturer","student","studAssistant");
	
	for($i=0;$i<=7;$i++)
	{
		$sql="INSERT INTO `users`(`username`,`names`,`password`,`role`) VALUES('$usernames[$i]','$names[$i]','$passwds[$i]','$roles[$i]')" ;
		$conn->query($sql);
	}
	 
	 
	 $sql="INSERT INTO `electives` VALUES('1', 'Фрактали', '1','доц. Петър Иванов', '3','Калина Маринова','5'),
											('2','Графичен дизайн','6','доц. Мария Владимирова','3','Калина Маринова','4'),
											('3','JavaScript за начинаещи','6','доц. Мария Владимирова','3','Калина Маринова','4'),
											('4','Анализ на Клифорд','1','доц. Петър Иванов','8','Иван Иванов','4')" ;
	 $conn->query($sql);
	 
	 $sql="INSERT INTO `enrolledelectives` VALUES('1','2', '1','Фрактали'),('2','2','3','JavaScript за начинаещи'),('3','7','2','Графичен дизайн'),('4','7','3','JavaScript за начинаещи'),('5','7','4','Анализ на Клифорд')" ;
	 $conn->query($sql);
	 
	 $sql="INSERT INTO `lecturerdata` VALUES('1','512', 'pivanov@university.bg','02/1234567'),('6','522','mariavv@university.bg','02/3456789')" ;
	 $conn->query($sql);
	 
	 echo "Data set";
//header("Location: ../index.php")?>