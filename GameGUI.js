/**
 * Selecting different elements from the HTML DOM 
 */
const scoreEl = document.querySelector('#scoreEl');
const modalEl = document.querySelector('#modalEl');
const soundOffEl = document.querySelector('#soundOffEl');
const soundOnEl = document.querySelector('#soundOnEl');
const speakerImg = document.querySelector('#speakerImg');
const power = document.querySelector('body');
const LevelUser = document.querySelector('#LevelUser');
const XpUser = document.querySelector('#XpUser');
/**
 * Audio Files Manage with Howler functions
*/
const startGameAudio = new Audio('./audio/startGame.mp3');
const startGameAudioP2 = new Audio('./audio/startGameP2.mp3');
const endGameAudio = new Audio('./audio/endGame.mp3');
const obtainPowerUpAudio = new Audio('./audio/obtainPowerUp.mp3');
const backgroundMusicAudio = new Audio('./audio/backgroundMusic.mp3');
backgroundMusicAudio.loop = true;
//Main Volum control
Howler.volume(0.1);
checkMusicCookie(); //Checking the MUSIC Cookie, Whther the Cookie is set or not set

/**
 * Global Variable declration
*/
let GameUserData;
let GameData;
let GameEngingObj;
let currentGame;
let scoreBenchmark;
let timeeIntervel; //The ID of the Intervel 

/**
 * The bellow function get's the User details from the database by making an Ajax call 
 */
GetUserData().then(response => {
    try {
        GameUserData = JSON.parse(response);
        GetGameData(GameUserData.level);
        //make it clik-able only when the user details are loaded
        power.classList.remove('notClickable');
        console.log(GameUserData);
    } catch (e) {
        swal("SQL DB Error!", "Error: GetUserData() function; " + e, "error");
    }
});

/**
 * @param clevel
 * The bellow function get's the Game details from the GameData.json file accordiing to the user's game level by making an fetch call 
 */
async function GetGameData(clevel) {
    var result = await fetch('./GameData.json')
        .then((response) => { return response.json(); })
        .then((myJson) => {
            GameData = new Levels(myJson.Data, clevel);     //If the level changes we'll just cteate a new Level object and assign it t othe same variable
        });
    return result;
}

/**
 * The main() function is the single most important function of the game, It starts creating an GameEngine Object by passing nesessary data
 */
async function main() {
    GameEngingObj = new GameEngine(GameUserData, parseInt(GameUserData.Xp), parseInt(GameUserData.level), parseInt(GameData.CurentLevel.time_allocated), parseInt(GameData.CurentLevel.PlusScore), parseInt(GameData.CurentLevel.MinusScore));   //Player details as a object/ Score/ Lavel 
    scoreBenchmark = parseInt(GameData.UpperLevel.xp);      //UpperBound for the ProgresBar
    updateScore(GameEngingObj.score);
    gameTimer(GameEngingObj.time);
    currentGame = await GameEngingObj.nextMathImageGame();
    startGameAudioP2.play();
    ImagURLQuestion(currentGame);
}

function updateScore(score) {
    scoreEl.innerHTML = score;
    XpUser.innerHTML = "<b><i class='fa-solid fa-star'></i> XP: </b>" + score;
    Xp(score);
    UpdateXP(score);
    let ChekLeveled = GameData.getCurentLevelOb(score);
    //If the XP based level and the GameEngingObj.level arent's the same then an Ajax call is made to update the user level data
    if (ChekLeveled != GameEngingObj.level) {
        console.log("Updated_Level: " + ChekLeveled)
        UpdateLevel(ChekLeveled);
    }
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function pauseBtn() {
    power.classList.add('blurOut');
    await sleep(50);   //await for half a ms to blur the screen and popup the alert
    alert('\t Game is Paused! \n Click the "OK" Button to resume the game play!');
    power.classList.remove('blurOut');
}

function confirmLogout() {
    swal({
        title: "Do you wish to Logout?",
        text: "Your learning MATHs!. So, Why leave?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((e) => {
        if (e) {
            window.location.href = "./Includes/logout.inc.php";
        }
    });
}

function gameTimer(timeleft) {
    console.log("Time left: " + timeleft);
    //call the function here
    let timer = document.getElementById('time');
    timeeIntervel = setInterval(async function () {
        $(".timerDisplay").attr(
            "style",
            "width:" + (timeleft / GameEngingObj.time) * 100 * 2.1 + "px"
        );
        timeleft -= 1;
        timer.innerHTML = timeleft;
        if (timeleft == 0) {
            clearInterval(timeeIntervel);
            gameTimer(GameEngingObj.time);
            updateScore(GameEngingObj.NoAnswerScore());
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
})

async function ClickButton(e) {
    var result = GameEngingObj.checkSolution(e);
    if (result) {
        obtainPowerUpAudio.play();
        console.log("Correct");
        updateScore(GameEngingObj.score);
        clearInterval(timeeIntervel);
        gameTimer(GameEngingObj.time);
        currentGame = await GameEngingObj.nextMathImageGame();
        ImagURLQuestion(currentGame);
    } else {
        updateScore(GameEngingObj.score);
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
        obtainPowerUpAudio.play();
        updateScore(GameEngingObj.score);
        currentGame = await GameEngingObj.nextMathImageGame();
        ImagURLQuestion(currentGame);
    } else {
        endGameAudio.play();
        updateScore(GameEngingObj.NoAnswerScore());
        console.log("Start a new game!");
        main();
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