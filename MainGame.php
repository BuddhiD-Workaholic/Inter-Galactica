<?php require_once 'DataBase/config.php';
session_start();
if (isset($_SESSION['userid'])) {
  if ($_SESSION['userTY'] == "GP") {
  } else {
    echo "1";
  }
} else {
  echo "2";
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
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
  <style>
    .main {
      background: black;
      overflow: hidden;
    }
  </style>
</head>

<body>

<div class="fixed text-white text-sm ml-2 mt-1 select-none">
    <span>Score: </span><span id="scoreEl">0</span> <br>
    <button id="PPause" style="background-color: white; color: black;" onclick="scene.active=false;">Play/Pause</button>
  </div>

  <div class="main">
  <svg id="soundOffEl" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fixed right-0 top-0 mt-2 mr-2 cursor-pointer z-10" viewBox="0 0 20 20" fill="white">
    <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd" />
  </svg>

  <svg id="soundOnEl" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fixed right-0 top-0 mt-2 mr-2 cursor-pointer z-10 hidden" viewBox="0 0 20 20" fill="white">
    <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM12.293 7.293a1 1 0 011.414 0L15 8.586l1.293-1.293a1 1 0 111.414 1.414L16.414 10l1.293 1.293a1 1 0 01-1.414 1.414L15 11.414l-1.293 1.293a1 1 0 01-1.414-1.414L13.586 10l-1.293-1.293a1 1 0 010-1.414z" clip-rule="evenodd" />
  </svg>

  <div class="fixed inset-0 flex items-center justify-center" id="modalEl">
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
  <canvas></canvas>
  </div>
  <!--GreenSock JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>

  <!--Howler JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js" integrity="sha512-6+YN/9o9BWrk6wSfGxQGpt3EUK6XeHi6yeHV+TYD2GR0Sj/cggRpXr1BrAQf0as6XslxomMUxXp2vIl+fv0QRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!--Main JS-->
  <script type="module" src="main.js"></script>
</body>

</html>