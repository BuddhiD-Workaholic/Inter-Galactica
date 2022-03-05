<?php require_once 'DataBase/config.php';
session_start();
if (isset($_SESSION['userid'])) {
  if ($_SESSION['userTY'] == "GP") {
  } else {
    header("Location: index.php");
  }
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
  <!--TailWindCSS-->
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />

  <!--StyleSheet-->
  <link rel="stylesheet" href="CSS/Dashboard.css" type="text/css" />
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
    .main {
      margin: 0;
      background: black;
      overflow: hidden;
      height: 38rem;
    }

    header {
      position: inherit !important;
      left: 0px !important;
      width: 100% !important;
    }
  </style>
</head>

<body>

  <!--Header Starts-->
  <header>
    <h2>
      Dashboard
    </h2>
    <div class="user-wrapper">
      <div class="notification">
        <div class="notifications">
          <!--Here-->
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
                      <h4><?php  ?></h4>
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
  <!--Header Ends-->

  <div class=" text-white text-sm ml-2 select-none z-10">
    <button id="PPause" style="background-color: white; color: black;" onclick="scene.active=false;">Play/Pause</button>
  </div>

  <div class=" text-black text-sm ml-2 mt-1 select-none">
    <span>Score: </span><span id="scoreEl">0</span>
  </div>

  <div id="main" class="main">
    <svg id="soundOffEl" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 right-0 mt-2 mr-2 cursor-pointer z-10" viewBox="0 0 20 20" fill="white">
      <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd" />
    </svg>

    <svg id="soundOnEl" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 right-0 mt-2 mr-2 cursor-pointer z-10 hidden" viewBox="0 0 20 20" fill="white">
      <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM12.293 7.293a1 1 0 011.414 0L15 8.586l1.293-1.293a1 1 0 111.414 1.414L16.414 10l1.293 1.293a1 1 0 01-1.414 1.414L15 11.414l-1.293 1.293a1 1 0 01-1.414-1.414L13.586 10l-1.293-1.293a1 1 0 010-1.414z" clip-rule="evenodd" />
    </svg>
    <canvas></canvas>
  </div>

  <div class="fixed inset-0 flex z-20 items-center justify-center" id="modalEl">
    <div id="whiteModalEl" class="bg-white max-w-md w-full p-6 text-center">
      <h1 class="text-4xl font-bold leading-none" id="bigScoreEl">0</h1>
      <p class="text-sm text-gray-700 mb-4">Points</p>
      <div>
        <button class="bg-blue-500 text-white w-full py-3 rounded-full text-sm" id="startGameBtn">
          Start Game
        </button>
      </div>
    </div>
  </div>

  <!--GreenSock JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
  <!--Howler JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js" integrity="sha512-6+YN/9o9BWrk6wSfGxQGpt3EUK6XeHi6yeHV+TYD2GR0Sj/cggRpXr1BrAQf0as6XslxomMUxXp2vIl+fv0QRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!--Main JS-->
  <script type="module" src="main.js"></script>

</body>

</html>