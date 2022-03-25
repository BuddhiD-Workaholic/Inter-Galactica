<?php
define('APP_ID', '3182494142077947');
define('APP_SECRET', 'aba175aafbf23209d6ba91f72eccbb73');
define('API_VERSION', 'v2.5');
define('FB_BASE_URL', 'https://inter-galactica.herokuapp.com/Includes/login.inc.php');

define('BASE_URL', 'https://inter-galactica.herokuapp.com/Includes/login.inc.php');

if (!session_id()) {
    session_start();
}

// Call Facebook API
$fb = new Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => API_VERSION,
]);

// Get redirect login helper
$fb_helper = $fb->getRedirectLoginHelper();

// Try to get access token
try {
    if (isset($_SESSION['facebook_access_token'])) {
        $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $fb_helper->getAccessToken();
    }
} catch (FacebookResponseException $e) {
    echo 'Facebook API Error: ' . $e->getMessage();
    exit;
} catch (FacebookSDKException $e) {
    echo 'Facebook SDK Error: ' . $e->getMessage();
    exit;
}

$Fblogin_url = $fb_helper->getLoginUrl(FB_BASE_URL);