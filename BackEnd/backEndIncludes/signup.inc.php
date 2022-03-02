<?php

if (isset($_POST['submit'])) {

	$name = $_POST['name'];
	$email = $_POST['email'];
	$Tel = $_POST['contact'];
	$pwd = $_POST['pwd'];
	$pwdrepeat = $_POST['pwdc'];

	require_once("../DataBase/config.php");

	function emptyInputSignup($name, $email, $pwd, $pwdrepeat, $Tel)
	{
		$result; //Define return value
		if (empty($name) ||  empty($pwd) || empty($pwdrepeat) || empty($Tel) || empty($email)) {
			$result = true;
		} else {
			$result = false;
		}

		return ($result);
	}

	function UidExists($con, $email)
	{
		$sql = "SELECT * FROM player WHERE email= ? ";
		$stmt = mysqli_stmt_init($con);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location:../index.php?error=sqlerror");
			exit();
		}
		mysqli_stmt_bind_param($stmt, "s", $email);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		if ($row = mysqli_fetch_assoc($resultData)) {
			return ($row);
		} else {
			$resultData = false;
			return ($resultData);
		}
		mysqli_stmt_close($stmt);
	}

	//Gravtar Img API implimenation
	function get_gravatar_url($email)
	{
		$address = strtolower(trim($email));
		$hash = md5($address);
		return 'https://www.gravatar.com/avatar/' . $hash;
	}

	function createUser($con, $email, $name, $Tel, $pwd)
	{
		$sql = "INSERT INTO player(email,name,password,contact,Xp,level,img,isActive ) VALUES(?,?,?,?,?,?,?,?)";
		$stmt = mysqli_stmt_init($con);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location:../index.php?error=stmtfailed");
			exit();
		}

		$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
		$Imgurl = get_gravatar_url($email);
		$defa = 0;

		mysqli_stmt_bind_param($stmt, "ssssssss", $email, $name, $hashedPwd, $Tel, $defa, $defa, $Imgurl, $defa);
		mysqli_stmt_execute($stmt);


		mysqli_stmt_close($stmt);

		header("Location:../index.php?error=none");
		exit();
	}

	if (emptyInputSignup($name, $email, $pwd, $pwdrepeat, $Tel) !== false) {
		header("Location:../index.php?error=empty");
		exit();
	}

	if (UidExists($con, $email) !== false) {
		header("Location:../index.php?error=uidexists");
		exit();
	}
	createUser($con, $email, $name, $Tel, $pwd);
} else {
	header("Location:../index");
}
