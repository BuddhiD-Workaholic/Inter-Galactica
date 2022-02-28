<?php
$userName = "b93b20a22592dc";
$Password = "21c4228d";
$hostName = "us-cdbr-east-05.cleardb.net";
$dbName = "heroku_764a5db4e5102c2";
$con = mysqli_connect($hostName, $userName, $Password, $dbName); 
	if (!$con) {
  		die("Sorry, Connection failed: " . mysqli_connect_error());
	}
?>

