<?php

class UserLogin
{
    private $username;
    private $pwd;
    private $con;

    public function __construct($con, $username, $pwd)
    {
        $this->username = $username;
        $this->pwd = $pwd;
        $this->con = $con;
    }

    public function initUser()
    {
        if ($this->emptyInputLogin($this->username, $this->pwd) == true) {
            header("Location: ../index.php?error=empty");
            exit();
        } else {
            $this->loginFun($this->con, $this->username, $this->pwd);
        }
    }

    private function emptyInputLogin($username, $pwd)
    {
        $result = false;
        if (empty($username) || empty($pwd)) {
            $result = true;
        } else {
            $result = false;
        }
        return ($result);
    }

    private function UpdateStatusLogIn($id, $con)
    {
        $sql = "UPDATE player SET isActive = '1' WHERE email='" . $id . "'";
        $result = $con->query($sql);
        mysqli_close($con);
    }

    private function UidExists($con, $username)
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

    private function loginFun($con, $username, $pwd)
    {
        $uidExists = $this->UidExists($con, $username);
        if ($uidExists === false) {
            header("Location: ../index.php?error=wronglogin");
        }

        $pwdHashed = $uidExists['password'];
        $checkPwd = password_verify($pwd, $pwdHashed);

        if ($checkPwd == true) {
            session_start();
            $_SESSION["userid"] = $uidExists['email'];
            $_SESSION["userTY"] = "GP";
            $_SESSION["TimeOut"] = time(); //Last login timestamp
            $this->UpdateStatusLogIn($uidExists['email'], $con);
            header("Location: ../MainGame.php");
        } else {
            header("Location: ../index.php?error=wronglogin");
        }
    }
}
