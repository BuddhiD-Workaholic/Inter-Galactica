<?php

$Gclient = new Google_Client();
$Gclient-> setClientId("811203755210-t5s1egd1863a5mh2dc6e53rletttv0ii.apps.googleusercontent.com");
$Gclient->setClientSecret("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");

$Gclient->setApplicationName("Inter_galactica");

$Gclient->setRedirectUri("https://inter-galactica.herokuapp.com/Includes/login.inc.php");
$Gclient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

$login_url = $Gclient->createAuthUrl();

 ?>