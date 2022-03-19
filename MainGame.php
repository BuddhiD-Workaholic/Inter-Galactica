<?php require_once 'DataBase/config.php';
session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userTY'] == "GP")) {
  if ((time() - $_SESSION["TimeOut"]) > 900) { // 15Minutes = 900Secs (15*60)
    header("Location: ./Includes/logout.inc.php");
  }
  $_SESSION["TimeOut"] = time();
  echo "<script src='PopupQuestion.js'></script>
			<script>setCookie(1);</script>";
} else {
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="shortcut icon" href="Images/Icon.jpg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inter Galactica</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, user-scalable=no, shrink-to-fit=no" />
  <!-- TailWindCSS
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" /> -->

  <!--Boostrap Starts -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!--StyleSheet-->
  <link rel="stylesheet" href="CSS/Dashboard.css" type="text/css" />
  <link rel="stylesheet" href="CSS/Game.css" type="text/css" />
  <link rel="shortcut icon" href="Images/Icon.jpg">

  <!--FontAwsome CDN-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

  <!--Jquery CDN-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!--Google translate-->
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <!--SweetAlert CDN-->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!--Axios CDN-->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  <!--Crypto-JS CDN-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js" integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body ng-app="rxApp">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <button class="nav-link" id="leaderboard">Leader Board</button>
        </li>
        <li class="nav-item">

        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <?php require_once './UserProfile.php'; ?>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container-fluid">
    <?php require_once './Leaderboard.php'; ?>
    <div style="display: inline;" class="asearch-wrapper">
      <i class="XVY"> Xp:</i>
      <div class="containerY">
        <div class="xp"></div>
      </div>
      <i class="XVY"> Score:</i>
      <div class="containerX">
        <div class="score"></div>
      </div>
    </div>

    <span>Score: </span><span id="scoreEl">0</span>
    <br />
    <span>Time: </span><span id="time">0</span>


    <div id="main" class="main">
      <svg id="soundOffEl" xmlns="http://www.w3.org/2000/svg" class="VolumButton" viewBox="0 0 20 20" fill="white">
        <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd" />
      </svg>
      <svg id="soundOnEl" xmlns="http://www.w3.org/2000/svg" class="VolumButton noun" viewBox="0 0 20 20" fill="white">
        <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM12.293 7.293a1 1 0 011.414 0L15 8.586l1.293-1.293a1 1 0 111.414 1.414L16.414 10l1.293 1.293a1 1 0 01-1.414 1.414L15 11.414l-1.293 1.293a1 1 0 01-1.414-1.414L13.586 10l-1.293-1.293a1 1 0 010-1.414z" clip-rule="evenodd" />
      </svg>
    </div>

    <div class="row">
      <div class="col-sm-1"></div>
      <img class="d-flex img-fluid justify-content-center" id="mainImg" src="" id="canvas" alt="">
      <div class="col-sm-1"></div>
    </div>

    <div class="row" class="buttonclass">
      <div class="col-sm-2"></div>
      <div class="d-flex justify-content-center">
        <button id="N0" class="btn btn-primary" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 0 </button> &nbsp;
        <button id="N1" class="btn btn-primary" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 1 </button> &nbsp;
        <button id="N2" class="btn btn-primary" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 2 </button> &nbsp;
        <button id="N3" class="btn btn-primary" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 3 </button> &nbsp;
        <button id="N4" class="btn btn-primary" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 4 </button> &nbsp;
        <button id="N5" class="btn btn-primary" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 5 </button> &nbsp;
        <button id="N6" class="btn btn-primary" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 6 </button> &nbsp;
        <button id="N7" class="btn btn-primary" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 7 </button> &nbsp;
        <button id="N8" class="btn btn-primary" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 8 </button> &nbsp;
        <button id="N9" class="btn btn-primary" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 9 </button> &nbsp;
      </div>
      <div class="col-sm-2"></div>
    </div>

    <div class="mainDIV" id="modalEl">
      <div id="whiteModalEl" class="modelDiv">
        <h1 class="h1Div" id="bigScoreEl">0</h1>
        <p class="PDiv">Points</p>
        <div>
          <button class="buttonDiv" id="startGameBtn"> Start Game </button>
        </div>
      </div>
    </div>
  </div>

  <!--GreenSock JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
  <!--Howler JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js" integrity="sha512-6+YN/9o9BWrk6wSfGxQGpt3EUK6XeHi6yeHV+TYD2GR0Sj/cggRpXr1BrAQf0as6XslxomMUxXp2vIl+fv0QRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!--JS Class-->
  <script src='./PopupQuestion.js'></script>
  <script src='./MathQuetion.js'></script>
  <script src='./MathImage.js'></script>
  <script src='./GameEngine.js'></script>
  <script src='./Game.js'></script>

  <!--Main JS-->
  <script src="./GameGUI.js"></script>
  <script src="./index.js"></script>
</body>

</html>