<?php require_once 'DataBase/config.php';
date_default_timezone_set("Asia/Calcutta");
session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <!-- <meta name="description" content="width=device-width,initial-scale=1.0" /> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Welcome!</title>

  <!--StyleSheet-->
  <link rel="stylesheet" href="CSS/style.css" type="text/css" />
  <link rel="shortcut icon" href="images/Icon.jpg">

  <!--Boostrap Starts
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css"> -->

  <!--FontAwsome CDN-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

  <!--Jquery CDN-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <!--Google translate-->
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


  <script>
    //ShowPassword
    function ShowPFunc(thisI) {
      var x = document.getElementById("pwd");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
      thisI.classList.toggle('fa-eye-slash');
    }
  </script>

</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <!-- Sign In FORM -->
        <div id="google_translate_element">Select a Language</div>
        <form action="Includes/login.inc.php" method="POST" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fa fa-user"></i>
            <input type="text" name="name" placeholder="Username" />
          </div>

          <div class="input-field">
            <i class="fa fa-lock"></i>
            <input type="password" name="pwd" id="pwd" placeholder="Password" />
            <!--Password Icons-->
          </div>
          <i class="far fa-eye fa-eye-slash" id="togglePassword" style="float: right;margin-left: 280px;margin-top: -43px;/* margin: -40px -34px 6px 298px; */position: relative;z-index: 2;" onclick="ShowPFunc(this)"></i>
          <div style="margin: 10px 0;">
          </div>
          <?php
          echo ('<input type="hidden" name="time" value= "' . date("H:i:sa") . '")>');
          echo ('<input type="hidden" name="date" value= "' . date("Y/m/d") . '")>'); ?>

          <input type="submit" name="submit" value="Login" class="btn solid" />
        </form>

        <!-- Sign UP FORM -->
        <form class="sign-up-form">
          <h2 class="title">About us</h2>
          <p class="aboutp" align="center">
            The Samurdhi (or Prosperity) Programme was launched in 1995. Its
            main goal was to reduce poverty in Sri Lanka through development
            based on public participation.The Programme's main goal was to
            alleviate poverty, most of its resources were distributed to
            households as food stamps, testing for eligibility based on need.
          </p>
        </form>
      </div>
    </div>
    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3><span class="las la-star-of-life"></span> Samurdhi</h3>
          <p>
            A web-based Database Management System for the Samurdhi Programme
          </p>
          <button class="btn transparent" id="sign-up-btn">About us</button>
        </div>
        <img src="Images/login.svg" class="image" alt="" />
      </div>

      <div class="panel right-panel">
        <div class="content">
          <h3>One of us?</h3>
          <p>
            Go ahead and Login with your user credentials to proceeed and
            access our website.
          </p>
          <button class="btn transparent" id="sign-in-btn">Sign in</button>
        </div>
        <img src="Images/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>
  <?php
  if (isset($_GET['error'])) {

    if ($_GET['error'] == "empty") {
      $ErrorMes = "Please Fill the inputs";
      require_once("Includes/ErrorPopup.php");
    } elseif ($_GET['error'] == "wronglogin") {

      $ErrorMes = "Your username or Password is invalid";
      require_once("Includes/ErrorPopup.php");
    } elseif ($_GET['error'] == "Invaild") {

      $ErrorMes = "Invalid User Type";
      require_once("Includes/ErrorPopup.php");
    }
  }
  if (isset($_GET['rec'])) {

    if ($_GET['rec'] == "confirm") {
      $ErrorMes = "Successfully Changed the Password.PLease Login!";
      require_once("Includes/SucessPopup.php");
    }
  }
  ?>

  <!--JavaScript-->
  <script language="JavaScript" type="text/javascript" src="JSFile.js"></script>
</body>

</html>