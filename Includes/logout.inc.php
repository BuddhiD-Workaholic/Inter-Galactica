<?php

echo "
<script src='../PopupQuestion.js'></script>
<script>
deleteCookie(); //Delete set Cookies for two days
</script>
";
require_once("../DataBase/config.php");
session_start();
$id = $_SESSION['userid'];

function UpdateStatusLogOut($id, $con)
{
    $sql = "UPDATE player SET isActive = '0' WHERE email='" . $id . "'";
    $result = $con->query($sql);
    mysqli_close($con);
}

UpdateStatusLogOut( $id, $con);

session_unset();
session_destroy();

header("Location:../index.php");
exit();
