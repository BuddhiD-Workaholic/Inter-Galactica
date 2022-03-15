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
//Main Volum control
Howler.volume(0.1);

/**
 * Main Function
 */

let GameEngingObj;
let currentGame;

async function main() {
    bigScoreEl.innerHTML = 0;
    GameEngingObj = new GameEngine(null, 0, 2);   //Player details as a object/ Score/ Lavel 
    currentGame = await GameEngingObj.nextMathImageGame();
    ImagURLQuestion(currentGame);
}

function updateScore(score) {
    scoreEl.innerHTML = score;
    bigScoreEl.innerHTML = score;
}

/**
 * Mouse Events
 */

const startGameBtn = document.querySelector('#startGameBtn')
startGameBtn.addEventListener('click', () => {
    main();
    // startGameAudio.play();
    // backgroundMusicAudio.play();
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
    //main();
    //startGameAudio.play();
    //endGameAudio.play()
})

async function ClickButton(e) {
    var result = GameEngingObj.checkSolution(e);
    if (result) {
        console.log("Correct");
        updateScore(GameEngingObj.score);
        currentGame = await GameEngingObj.nextMathImageGame();
        ImagURLQuestion(currentGame);
    } else {
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
    var result = await GameEngingObj.nextMathQuetionGame(10, "This is the quetion");
    if (result) {
        updateScore(GameEngingObj.score);
    } else {
        swal("We are Sorry!", "Your answer was incorrect!", "error").then(response => {
            console.log("Start a new game!");
            main();
        });
    }
}
