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

if ($FuntionName == "GetUserDetails") {
    $email = $_SESSION['userid'];
    $sql1 = "SELECT id, name, email, Xp, level FROM `player` WHERE email= '" . $email . "'";
    $results = mysqli_query($con, $sql1);
    if (mysqli_num_rows($results) > 0) {
        $rowArray = mysqli_fetch_assoc($results);
        $JSONFormat = json_encode($rowArray);
        echo $JSONFormat;
    } else {
        echo "Error";
    }
} else if ($FuntionName == "GetGameDetails") {
    echo "Error";
}
