<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'cricketx');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(ISSET($_POST['save'])){
		$pname = $_POST['player-name'];
		$code = "dvvd";
 
 
		mysqli_query($link, "INSERT INTO `player_details` VALUES('', '$pname', 1,'$code')") ;//or die(mysqli_error());
 
 
		header("location: playerinfo.php");
	}
?>