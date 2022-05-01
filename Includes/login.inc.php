<?php
require_once("../DataBase/config.php");

function UpdateStatusLogIn($id, $con)
{
	$sql = "UPDATE player SET isActive = '1' WHERE email='" . $id . "'";
	$result = $con->query($sql);
	mysqli_close($con);
}

function UidExists($con, $username)
{
	$sql = "SELECT * FROM player WHERE email= ?";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../index.php?error=sqlerror&E=" . mysqli_error($con));
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

//User Login with Email 
if (isset($_POST['submit'])) {
	$username = $_POST['Uname'];
	$pwd = $_POST['pwd'];

	require_once("./UserLogin.classes.php");
	/**
	 * Creating a Object from the class UserLogin which gonna contain all the information the user inserterd when Login in	 
	 */
	$login = new UserLogin($con, $username, $pwd);
	$login->initUser();
} else if (isset($_GET['code'])) {
	//User Login with Google Signup SDK 
	require_once('./GoogleAPI/vendor/autoload.php');
	require_once("./GoogleController.php");
	session_start();
	$guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));
	$Gclient->setHttpClient($guzzleClient);
	$toke = $Gclient->fetchAccessTokenWithAuthCode($_GET['code']);

	if (!isset($token["error"]) && ($token["error"] != "invalid_grant")) {
		try {
			$oAuth = new Google_Service_Oauth2($Gclient);
			$userData = $oAuth->userinfo_v2_me->get();
			$email = $userData['email'];

			$uidExists = UidExists($con, $email);
			if ($uidExists === false) {
				header("Location: ../index.php?error=wronglogin");
			}
			session_start();
			$_SESSION["userid"] = $uidExists['email'];
			$_SESSION["userTY"] = "GP";
			$_SESSION["TimeOut"] = time(); //Last login timestamp
			UpdateStatusLogIn($uidExists['email'], $con);
			header("Location: ../MainGame.php");
		} catch (Exception $e) {
			header("Location: ../index.php?error=exception&E=" . $e);
		}
	} else {
		header("Location: ../index.php?error=error");
	}
} else {
	header("Location:../index.php?error=empty");
}
