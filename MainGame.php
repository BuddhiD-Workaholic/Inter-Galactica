<?php require_once 'DataBase/config.php';
session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userTY'] == "GP")) {
    if ((time() - $_SESSION["TimeOut"]) > 900) { // 15Minutes = 900Secs (15*60)
        header("Location: ./Includes/logout.inc.php?error=sesssionExp");
    }
    $_SESSION["TimeOut"] = time();
    echo "<script src='Cookie.js'></script>
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
    <link rel="stylesheet" href="CSS/main.css" />
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

<body>
    <div class="container-fluid">

        <div class="rightSi">
            <!-- <span>
            <i> Time: </i>
            <div class="containerY">
                <div class="timerDisplay"></div>
            </div> 
        </span> -->
            <div class="row">
                <span>Time Left: <i id="time">0</i></span>
            </div>
        </div>

        <div class="leftSi">
            <!-- <span>
            <i> Score: </i>
            <div class="containerY">
                <div class="score"></div>
            </div>
        </span> -->
            <div class="row">
                <span>Score: <i id="scoreEl">0</i></span>
            </div>
        </div>

        <div class="gameboy">
            <div class="screen-cont">
                <div class="power power-on"></div>
                <div class="screen">
                    <div class="header">DOT MATRIX WITH STEREO SOUND</div>
                    <img class="imgVW" id="mainImg" src="" alt="Loading...!">
                    <div class="animated-text">Nintendo<div class="copy">®</div>
                    </div>
                </div>
            </div>
            <div class="controls-cont">
                <div class="btn-direction">
                    <div class="vertical"></div>
                    <div class="horizontal"></div>
                </div>
                <div class="Ebuttonclass">
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 0 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 1 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 2 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 3 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 4 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 5 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 6 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 7 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 8 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerHTML)" class="ButtonPress"> 9 </button>
                    &nbsp;
                </div>
                <div class="btn-AB" id=""></div>
                <div class="btn-AB" id=""></div>
                <button class="btn-start-select" onclick="pauseBtn()"></button>
                <span class="textBtn-select">Pause Game</span>
                <button style="left: 28.6vw;" id="soundOffEl" class="btn-start-select">On</button>
                <button style="left: 28.6vw;" id="soundOnEl" class="btn-start-select noun">Off</button>
                <span style="left: 28.6vw;" class="textBtn-select">Game Sound</span>
                <div id="speakerImg" class="speakers noun"></div>
            </div>
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
    </div>
    <!--GreenSock JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
    <!--Howler JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js" integrity="sha512-6+YN/9o9BWrk6wSfGxQGpt3EUK6XeHi6yeHV+TYD2GR0Sj/cggRpXr1BrAQf0as6XslxomMUxXp2vIl+fv0QRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--JS Class-->
    <script src='./Cookie.js'></script>
    <script src='./MathQuetion.js'></script>
    <script src='./MathImage.js'></script>
    <script src='./GameEngine.js'></script>
    <script src='./Game.js'></script>

    <!--Main JS-->
    <script src="./AjaxFunctions.js"></script>
    <script src="./GameGUI.js"></script>
    <script src="./index.js"></script>

</body>

</html>