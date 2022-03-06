<?php
class UserSingup
{
    private $pwd;
    private $email;
    private $name;
    private $Tel;
    private $pwdrepeat;
    private $con;

    public function __construct($con, $pwd, $email, $name, $Tel, $pwdrepeat)
    {
        $this->pwd = $pwd;
        $this->email = $email;
        $this->name = $name;
        $this->Tel = $Tel;
        $this->pwdrepeat = $pwdrepeat;
        $this->con = $con;
    }

    public function initUser()
    {
        if ($this->emptyInputSignup($this->name, $this->email, $this->pwd, $this->pwdrepeat, $this->Tel) !== false) {
            header("Location:../index.php?error=empty");
            exit();
        }
        if ($this->UidExists($this->con, $this->email) !== false) {
            header("Location:../index.php?error=uidexists");
            exit();
        }
        if ($this->pwdMatch($this->pwd, $this->pwdrepeat) !== false) {
            header("Location:../index.php?error=pwdmismatch");
            exit();
        }
        $this->createUser($this->con, $this->email, $this->name, $this->Tel, $this->pwd);
    }

    private function emptyInputSignup($name, $email, $pwd, $pwdrepeat, $Tel)
    {
        $result = false;
        if (empty($name) ||  empty($pwd) || empty($pwdrepeat) || empty($Tel) || empty($email)) {
            $result = true;
        } else {
            $result = false;
        }
        return ($result);
    }

    private function UidExists($con, $email)
    {
        $sql = "SELECT * FROM player WHERE email= ? ";
        $stmt = mysqli_stmt_init($con);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:../index.php?error=sqlerror");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
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

    //Gravtar Img API implimenation
    private function get_gravatar_url($email)
    {
        $address = strtolower(trim($email));
        $hash = md5($address);
        return 'https://www.gravatar.com/avatar/' . $hash;
    }

    private function createUser($con, $email, $name, $Tel, $pwd)
    {
        $sql = "INSERT INTO player(email,name,password,contact,Xp,level,img,isActive ) VALUES(?,?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($con);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:../index.php?error=stmtfailed");
            exit();
        }

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $Imgurl = $this->get_gravatar_url($email);
        $defa = 0;

        mysqli_stmt_bind_param($stmt, "ssssssss", $email, $name, $hashedPwd, $Tel, $defa, $defa, $Imgurl, $defa);
        mysqli_stmt_execute($stmt);


        mysqli_stmt_close($stmt);
    }

    private function pwdMatch($pwd, $pwdrepeat)
    {
        $result = false;
        if ($pwd !== $pwdrepeat) {
            $result = true;
        } else {
            $result = false;
        }
        return ($result);
    }
}
