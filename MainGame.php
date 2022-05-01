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

    <!--StyleSheet-->
    <link rel="stylesheet" href="CSS/Dashboard.css" type="text/css" />
    <link rel="stylesheet" href="CSS/Game.css" type="text/css" />
    <link rel="stylesheet" href="CSS/main.css" />
    <link rel="shortcut icon" href="Images/Icon.jpg">

    <!--Axios CDN-->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!--FontAwsome CDN-->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--Jquery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--Google Translate-->
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!--SweetAlert CDN-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--Crypto-JS CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js" integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="notClickable">
    <div class="container-fluid">

        <div class="rightSi">
            <div class="textContainer">
                <span class="textConi">Time Left: <br><i id="time">0</i> Sec</span>
                <div class="containerY">
                    <div class="timerDisplay"></div>
                </div>
            </div>
            <div style="margin-top: 1.4rem; padding:1rem !important" class="textContainer">
                <div class="Prfilescard">
                    <?php
                    $sqlQ1 = "SELECT * FROM `player` WHERE email='" . $_SESSION["userid"] . "'";
                    $results1 = mysqli_query($con, $sqlQ1);
                    if (mysqli_num_rows($results1) > 0) {
                        while ($rowW = mysqli_fetch_assoc($results1)) {
                            echo '<img src="' . $rowW['img'] . '" alt="Error Loading the Image" class="avatar">';
                            echo ' <h3 style="margin-bottom: 18px;">' . $rowW['name'] . '</h3>';
                            echo '<div style="margin-top: 0px;">';
                            echo ' <p class="TEXTp"><b><i class="fa-solid fa-circle-envelope"></i> Email: </b>' . $rowW['email'] . '</p>
        <p class="TEXTp"><b><i class="fa-solid fa-circle-phone"></i> TP Number: </b>' . $rowW['contact'] . '</p>
        <p id="LevelUser" class="TEXTp"><b><i class="fa-solid fa-star"></i> Level: </b>' . $rowW['level'] . '</p>
        <p id="XpUser" class="TEXTp"><b><i class="fa-solid fa-star"></i> XP: </b>' . $rowW['Xp'] . '</p>';
                            echo ' </div>';
                        }
                    } else {
                        echo "Error!, Please Contact the Developer via: https://github.com/BuddhiD-Workaholic";
                    }
                    ?>
                    <p><button class="abutton" onclick="confirmLogout()"><i class="las la-sign-out-alt"></i>Log out</button></p>
                </div>
            </div>
        </div>

        <div class="leftSi">
            <div class="textContainer">
                <span class="textConi">Score: <br><i id="scoreEl">0</i> XP</span>
                <div class="containerY">
                    <div class="score"></div>
                </div>
            </div>
            <div style="margin-top: 1.4rem;" class="textContainer">
                <div class="rest">
                    <!--Leader board Starts-->
                    <?php
                    $sqlQ2 = "SELECT * FROM `player` ORDER By Xp DESC LIMIT 5";
                    $results2 = mysqli_query($con, $sqlQ2);
                    if (mysqli_num_rows($results2) > 0) {
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($results2)) {
                            echo '<div class="others flex">
        <div class="rank">
          <i class="fas fa-caret-up"></i>
          <p class="num">' . $count++ . '</p>
        </div>
        <div class="info flex">
          <img src="' . $row['img'] . '" alt="Error" class="p_img">
          <p class="link">Level:' . $row['level'] . '</p>
          <p class="points">XP: ' . $row['Xp'] . '</p>
        </div>
      </div>';
                        }
                    } else {
                        echo "<div class='title'>No Players available!</div><div class='sub_title'>&nbsp;</div>";
                    }
                    ?>
                    <!--Leader board Ends-->
                </div>
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
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerText)" class="ButtonPress"> 0 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerText)" class="ButtonPress"> 1 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerText)" class="ButtonPress"> 2 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerText)" class="ButtonPress"> 3 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerText)" class="ButtonPress"> 4 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerText)" class="ButtonPress"> 5 </button> <br />
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerText)" class="ButtonPress"> 6 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerText)" class="ButtonPress"> 7 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerText)" class="ButtonPress"> 8 </button>
                    &nbsp;
                    <button id="N0" class="button-54" onclick="ClickButton(this.innerText)" class="ButtonPress"> 9 </button>
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
                <p class="PDiv"><img style="width: 100%; margin:0px" src="./Images/3470042-rg.png" alt=""></p>
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
    <script src="./Level.js"></script>
    <script src='./MathQuetion.js'></script>
    <script src='./MathImage.js'></script>
    <script src="./Player.js"></script>
    <script src='./GameEngine.js'></script>
    <script src='./Game.js'></script>

    <!--Main JS-->
    <script src="./AjaxFunctions.js"></script>
    <script src="./GameGUI.js"></script>
    <script src="./index.js"></script>
</body>

</html>