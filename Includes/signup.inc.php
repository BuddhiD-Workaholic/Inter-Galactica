<?php

if (isset($_POST['submit'])) {

	$name = $_POST['name'];
	$email = $_POST['email'];
	$Tel = $_POST['contact'];
	$pwd = $_POST['pwd'];
	$pwdrepeat = $_POST['pwdc'];

	require_once("../DataBase/config.php");
	require_once("./UserSingup.classes.php");

	$signup = new UserSingup($con, $pwd, $email, $name, $Tel, $pwdrepeat);
	$signup->initUser();

	header("Location:../index.php?error=none");
} else {
	header("Location:../index");
}
