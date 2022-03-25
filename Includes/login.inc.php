<?php
require_once("../DataBase/config.php");

require_once('./GoogleAPI/vendor/autoload.php');
require_once("./GoogleController.php");

require_once('./FacebookSDK/autoload.php');
require_once("./FacebookController.php");

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
		header("Location: ../index.php?error=sqlerror");
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
	$login = new UserLogin($con, $username, $pwd);
	$login->initUser();
} else if (isset($_GET['code'])) {
	echo "hey";
	
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
			header("Location: ../index.php?error=exception");
		}
	} else {
		header("Location: ../index.php?error=error");
	}
} else if (!isset($_SESSION['facebook_access_token'])) {

	$_SESSION['facebook_access_token'] = (string) $accessToken;
	$oAuth2Client = $fb->getOAuth2Client();
	$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
	$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
	$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

	if (isset($_GET['code'])) {
		header('Location: ../index.php?error=wronglogin');
	}
	try {
		$fb_response = $fb->get('/me?fields=name,first_name,last_name,email');
		$fb_response_picture = $fb->get('/me/picture?redirect=false&height=200');

		$fb_user = $fb_response->getGraphUser();
		$email = $fb_user->getProperty('email');

		$uidExists = UidExists($con, $email);
		if ($uidExists === false) {
			header("Location: ../index.php?error=wronglogin");
		}
		session_start();
		$_SESSION["userid"] = $uidExists['email'];
		$_SESSION["userTY"] = "GP";
		$_SESSION["TimeOut"] = time(); //Last login timestamp
		UpdateStatusLogIn($uidExists['email'], $con);
		header("Location:../MainGame.php");
	} catch (Facebook\Exceptions\FacebookResponseException $e) {
		echo 'Facebook API Error: ' . $e->getMessage();
		session_destroy();
		header("Location:../index.php?error=wronglogin");
	} catch (Facebook\Exceptions\FacebookSDKException $e) {
		echo 'Facebook SDK Error: ' . $e->getMessage();
		header("Location:../index.php?error=wronglogin");
	}
} else {
	header("Location:../index.php?error=empty");
}
