<?php
require_once("../DataBase/config.php");

if (isset($_POST['submit'])) {
	$username = $_POST['Uname'];
	$pwd = $_POST['pwd'];

	function emptyInputLogin($username, $pwd)
	{
		$result;
		if (empty($username) || empty($pwd)) {
			$result = true;
		} else {
			$result = false;
		}
		return ($result);
	}

	function UpdateStatusLogIn($id, $con)
	{
		$sql = "UPDATE player SET isActive = 1 WHERE email='" . $id . "'";
		$result = $con->query($sql);
		mysqli_close($con);
	}

	function UidExists($con, $username)
	{
		$sql = "SELECT * FROM player WHERE email= ?";
		$stmt = mysqli_stmt_init($con);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location:../index.php?error=sqlerror");
			exit();
		}
		mysqli_stmt_bind_param($stmt, "s", $username);
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

	function loginFun($con, $username, $pwd)
	{
		$uidExists = UidExists($con, $username);
		if ($uidExists === false) {
			header("Location:../index.php?error=wronglogin");
			exit();
		}

		$pwdHashed = $uidExists['password'];
		$checkPwd = password_verify($pwd, $pwdHashed);

		if ($checkPwd == true) {
			session_start();
			$_SESSION["userid"] = $uidExists['email'];
			$_SESSION["userTY"] = "GP";
			UpdateStatusLogIn($uidExists['email'], $con);
			header("Location:../MainGame.php");
			exit();
		}
		if ($checkPwd == false) {
			header("Location:../index.php?error=wronglogin");
			exit();
		}
	}

	if (emptyInputLogin($username, $pwd) !== false) {
		header("Location:../index.php?error=empty");
		exit();
	} else {
		loginFun($con, $username, $pwd);
	}
} else {
	header("Location:../index.php");
}
