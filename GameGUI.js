/**
 * Selecting different elements
 */
const scoreEl = document.querySelector('#scoreEl');
const modalEl = document.querySelector('#modalEl');
const bigScoreEl = document.querySelector('#bigScoreEl');
const soundOffEl = document.querySelector('#soundOffEl');
const soundOnEl = document.querySelector('#soundOnEl');
const speakerImg = document.querySelector('#speakerImg');

/**
 * Audio Files Manage with Howler functions
*/
const startGameAudio = new Audio('./audio/startGame.mp3');
const endGameAudio = new Audio('./audio/endGame.mp3');
const obtainPowerUpAudio = new Howl({ src: ['./audio/obtainPowerUp.mp3'] });
const backgroundMusicAudio = new Audio('./audio/backgroundMusic.mp3');
backgroundMusicAudio.loop = true;
//Main Volum control
Howler.volume(0.1);
checkMusicCookie(); //Checking the MUSIC Cookie

/**
 * Main Function
*/

let GameEngingObj;
let currentGame;
let scoreBenchmark;
let timeeIntervel; //The ID of the Intervel 

async function main() {
    bigScoreEl.innerHTML = 0;
    GameEngingObj = new GameEngine(null, 0, 2);   //Player details as a object/ Score/ Lavel 
    scoreBenchmark = 1000;      //UpperBound for the ProgresBar
    gameTimer(GameEngingObj.time);
    currentGame = await GameEngingObj.nextMathImageGame();
    updateScore(GameEngingObj.score);
    ImagURLQuestion(currentGame);
}

function updateScore(score) {
    scoreEl.innerHTML = score;
    bigScoreEl.innerHTML = score;
    Xp(score);
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function pauseBtn() {
    const power = document.querySelector('body');
    power.classList.add('blurOut');
    Howler.mute(true);
    backgroundMusicAudio.volume = 0;
    await sleep(50);   //await for half a ms to blur the screen and popup the alert
    alert('\t Game is Paused! \n Click the Button to resume the game play!');
    backgroundMusicAudio.volume = 1;
    Howler.mute(false);
    power.classList.remove('blurOut');
}

function gameTimer(timeleft) {
    console.log(timeleft);
    //call the function here
    let timer = document.getElementById('time');
    timeeIntervel = setInterval(async function () {
        timeleft -= 1;
        timer.innerHTML = timeleft;
        if (timeleft == 0) {
            clearInterval(timeeIntervel);
            gameTimer(GameEngingObj.time);
            currentGame = await GameEngingObj.nextMathImageGame();
            ImagURLQuestion(currentGame);
        }
    }, 1000);
}

/**
 * Mouse Events
 */
const startGameBtn = document.querySelector('#startGameBtn')
startGameBtn.addEventListener('click', () => {
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
    main();
    var time = GameEngingObj.getTime();
})

async function ClickButton(e) {
    var result = GameEngingObj.checkSolution(e);
    if (result) {
        console.log("Correct");
        updateScore(GameEngingObj.score);
        clearInterval(timeeIntervel);
        gameTimer(GameEngingObj.time);
        currentGame = await GameEngingObj.nextMathImageGame();
        ImagURLQuestion(currentGame);
    } else {
        endGameAudio.play();
        clearInterval(timeeIntervel);
        swal("We are Sorry!", "Your answer was incorrect!", "error").then(response => {
            MathQuestion();
        });
    }
}

function ImagURLQuestion(URL) {
    var img = document.getElementById("mainImg");
    img.src = URL;
}

async function MathQuestion() {
    var result = await GameEngingObj.nextMathQuetionGame("This is the quetion");
    if (result) {
        updateScore(GameEngingObj.score);
        currentGame = await GameEngingObj.nextMathImageGame();
        ImagURLQuestion(currentGame);
    } else {
        endGameAudio.play();
        //swal("We are Sorry!", "Your answer was incorrect!", "error").then(response => {
        console.log("Start a new game!");
        main();
        // });
    }
}

/** 
 * Sound controll
 */
soundOffEl.addEventListener('click', () => {
    Howler.mute(true);
    backgroundMusicAudio.volume = 0;
    soundOnEl.style.display = 'block';
    soundOffEl.style.display = 'none';
    speakerImg.classList.add('noun');
    setMusicCookie();
})

soundOnEl.addEventListener('click', () => {
    Howler.mute(false);
    backgroundMusicAudio.volume = 1;
    soundOnEl.style.display = 'none';
    soundOffEl.style.display = 'block';
    speakerImg.classList.remove('noun');
    deleteMusicCookie();
})

/**
* Progress bar 
* https://www.w3schools.com/w3css/tryit.asp?filename=tryw3css_progressbar_labels_js
*/

function Xp(score, UpperBound) {
    $(".score").attr(
        "style",
        "width:" + (score / scoreBenchmark) * 100 * 1.5 + "px"
    );
}
/* <div class="containerY">
<div class="score"></div>
</div> */

function Time(score, UpperBound) {
    $(".timerDisplay").attr(
        "style",
        "width:" + (score / scoreBenchmark) * 100 * 1.5 + "px"
    );
}
/* <div class="containerY">
<div class="timerDisplay"></div>
</div> */