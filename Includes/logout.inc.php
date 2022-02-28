<?php
require_once("../DataBase/config.php");
session_start();
$id = $_SESSION['userid'];

function UpdateStatusLogOut($id, $con)
{
    $sql = "UPDATE Player SET isActive = 0 WHERE email='" . $id . "'";
    $result = $con->query($sql);
    mysqli_close($con);
}

UpdateStatusLogOut($type, $id, $con);

session_unset();
session_destroy();

header("Location:../index.php");
exit();
