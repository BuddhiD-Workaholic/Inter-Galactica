<?php
require_once '../DataBase/config.php';

session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userTY'] == "GP")) {
    if ((time() - $_SESSION["TimeOut"]) > 900) { // 15Minutes = 900Secs (15*60)
        header("Location: ./logout.inc.php?error=sesssionExp");
    }
    $_SESSION["TimeOut"] = time();
} else {
    header("Location: ../index.php");
}

$FuntionName = $_POST["FuntionName"];
$email = $_SESSION['userid'];

if ($FuntionName == "UpdateXP") {
    $xp = $_POST['xp'];
    $sql1 = "UPDATE `player` SET xp='" . $xp . "' Where email='" . $email . "'";
    if (mysqli_query($con, $sql1) > 0) {
        echo "1";
    } else {
        echo "0";
    }
} else if ($FuntionName == "UpdateLevel") {
    $level = $_POST['level'];

    $sql2 = "UPDATE `player` SET level='" . $level . "' Where email='" . $email . "'";
    if (mysqli_query($con, $sql2) > 0) {
        echo "1";
    } else {
        echo "0";
    }
}
