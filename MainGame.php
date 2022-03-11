<?php require_once 'DataBase/config.php';
session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userTY'] == "GP")) {
  if ((time() - $_SESSION["TimeOut"]) > 900) { // 15Minutes = 900Secs (15*60)
    header("Location: ./Includes/logout.inc.php");
  }
  $_SESSION["TimeOut"] = time();
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

  <!--StyleSheet-->
  <link rel="stylesheet" href="CSS/Dashboard.css" type="text/css" />
  <link rel="stylesheet" href="CSS/Game.css" type="text/css" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="shortcut icon" href="Images/Icon.jpg">

  <!--FontAwsome CDN-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

  <!--Jquery CDN-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <!--Google translate-->
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <!--SweetAlert CDN-->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <style>

  </style>
</head>

<body>

  <!--Header Starts-->
  <div class="main-content">
    <header>
      <h2>
        <div for="nav-toggle">
          <img style="position: fixed;top: 0;right: 0;bottom: 0;left: 0; " src="Images/scoreboard.png" alt="Error">
        </div>
      </h2>
      <!-- searchwrapper Starts-->
      <div style="display: inline;" class="asearch-wrapper">
        <span>Helth</span>
        <div style="width:20%" class="w3-light-grey">
          <div id="myBar" class="w3-container w3-green" style="width:20%">20%</div>
        </div>
        <span>Xp</span>
        <div style="width:20%" class="w3-light-grey">
          <div id="myBar" class="w3-container w3-green" style="width:20%">20%</div>
        </div>
      </div>
      <!-- searchwrapper ENDs-->
      <div class="user-wrapper">
        <div class="notification">
          <div class="notifications">
            <span>Score: </span><span id="scoreEl">0</span>
          </div>
        </div>
        <div class="notification">
          <div class="notBtn" href="#">
            <img src="Images/user.png" width="38px" height="38px" alt="Error" />
            <div>
            </div>
            <div class="box">
              <div class="display">
                <div class="cont">
                  <div class="sec">
                    <div class="txt-profile" s>
                      <img src="Images/user.png" width="38px" height="38px" alt="Error" />
                      <div class="txt-profiletxt">
                        <h4><?php echo ""; ?></h4>
                        <small>Player</small>
                      </div>
                    </div>
                  </div>
                  <div class="sec">
                    <div class="txt">
                      <a href="EmpUserprofile.php"><i class="las la-user"></i></i>View Profile</a>
                    </div>
                  </div>
                  <div class="sec">
                    <div class="txt">
                      <a href="./Includes/logout.inc.php"><i class="las la-sign-out-alt"></i></i>Log out</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </a>
        </div>
      </div>
    </header>
  </div>
  <!--Header Ends-->

  <div id="main" class="main">
    <svg id="soundOffEl" xmlns="http://www.w3.org/2000/svg" class="VolumButton" viewBox="0 0 20 20" fill="white">
      <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd" />
    </svg>

    <svg id="soundOnEl" xmlns="http://www.w3.org/2000/svg" class="VolumButton noun" viewBox="0 0 20 20" fill="white">
      <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM12.293 7.293a1 1 0 011.414 0L15 8.586l1.293-1.293a1 1 0 111.414 1.414L16.414 10l1.293 1.293a1 1 0 01-1.414 1.414L15 11.414l-1.293 1.293a1 1 0 01-1.414-1.414L13.586 10l-1.293-1.293a1 1 0 010-1.414z" clip-rule="evenodd" />
    </svg>
    <canvas id="canvas"></canvas>
  </div>

  <div class="buttonclass">
    <button id="N0" class="ButtonPress"> 00 </button>
    <button id="N1" class="ButtonPress"> 01 </button>
    <button id="N2" class="ButtonPress"> 02 </button>
    <button id="N3" class="ButtonPress"> 03 </button>
    <button id="N4" class="ButtonPress"> 04 </button>
    <button id="N5" class="ButtonPress"> 05 </button>
    <button id="N6" class="ButtonPress"> 06 </button>
    <button id="N7" class="ButtonPress"> 07 </button>
    <button id="N8" class="ButtonPress"> 08 </button>
    <button id="N9" class="ButtonPress"> 09 </button>
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

  <!--GreenSock JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
  <!--Howler JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js" integrity="sha512-6+YN/9o9BWrk6wSfGxQGpt3EUK6XeHi6yeHV+TYD2GR0Sj/cggRpXr1BrAQf0as6XslxomMUxXp2vIl+fv0QRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!--JS Class-->
  <script src="Player.js"></script>
  <script src="Particles.js"></script>
  <script src="Projectile.js"></script>
  <script src="Enemy.js"></script>
  <!--Main JS-->
  <script src="index.js"></script>
</body>

</html>