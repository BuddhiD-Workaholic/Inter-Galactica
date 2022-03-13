/**
 * Selecting different elements
 */
const scoreEl = document.querySelector('#scoreEl');
const modalEl = document.querySelector('#modalEl');
const bigScoreEl = document.querySelector('#bigScoreEl');
const soundOffEl = document.querySelector('#soundOffEl');
const soundOnEl = document.querySelector('#soundOnEl');
/**
 * Audio Files Manage with Howler functions
*/
const startGameAudio = new Audio('./audio/startGame.mp3');
const endGameAudio = new Audio('./audio/endGame.mp3');
const obtainPowerUpAudio = new Howl({ src: ['./audio/obtainPowerUp.mp3'] });
const backgroundMusicAudio = new Audio('./audio/backgroundMusic.mp3');
backgroundMusicAudio.loop = true;
Howler.volume(0.1);


function init() {
  bigScoreEl.innerHTML = 100;
  Xp();
  Health();
}


/**
 * Mouse Events
 */


const element = document.querySelector('#main');
element.addEventListener('click', ({ clientX, clientY }) => {

})

const startGameBtn = document.querySelector('#startGameBtn')
startGameBtn.addEventListener('click', () => {
  init();
  startGameAudio.play();
  backgroundMusicAudio.play();
  gsap.to('#whiteModalEl', {
    opacity: 0,
    scale: 0.75,
    duration: 0.25,
    ease: 'expo.in',
    onComplete: () => {
      modalEl.style.display = 'none'
    }
  })
})

addEventListener('resize', () => {
  init();
  startGameAudio.play();
  //      endGameAudio.play()
})

addEventListener('keydown', ({ keyCode }) => {
})

//Sounds
soundOffEl.addEventListener('click', () => {
  Howler.mute(true);
  backgroundMusicAudio.volume = 0;
  soundOnEl.style.display = 'block';
  soundOffEl.style.display = 'none';
})

soundOnEl.addEventListener('click', () => {
  Howler.mute(false);
  backgroundMusicAudio.volume = 1;
  soundOnEl.style.display = 'none';
  soundOffEl.style.display = 'block';
})

const leaderboard = document.querySelector('#leaderboard');
const popupV3 = document.querySelector('#popupV3');
leaderboard.addEventListener('click', () => {
  if ($(".cardX").hasClass("noun")) {
    $(".cardX").removeClass("noun");
  } else {
    $(".cardX").addClass("noun");
  }
})

/**
 * Progress bar 
 * https://www.w3schools.com/w3css/tryit.asp?filename=tryw3css_progressbar_labels_js
 * 
 */

var scoreBenchmark = 100;
// var score = 75;

function Health() {
  $(".score").attr(
    "style",
    "height:" + (75 / scoreBenchmark) * 100 * 1.5 + "px"
  );
}

function Xp() {
  $(".xp").attr(
    "style",
    "height:" + (10 / scoreBenchmark) * 100 * 1.5 + "px"
  );
}