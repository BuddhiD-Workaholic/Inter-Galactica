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
    } catch (e) {
        swal("SQL DB Error!", "Error: GetUserData() function; " + e, "error");
    }
});

/**
 * The main() function is the single most important function of the game, It starts creating an GameEngine Object by passing nesessary data
 */
async function main() {
    GameEngingObj = new GameEngine(GameUserData, parseInt(GameUserData.Xp), parseInt(GameUserData.level), parseInt(GameData.CurentLevel.time_allocated), parseInt(GameData.CurentLevel.PlusScore), parseInt(GameData.CurentLevel.MinusScore));   //Player details as a object/ Score/ Lavel 
    updateScore(GameEngingObj.score);
    clearInterval(timeeIntervel);
    gameTimer(GameEngingObj.time);
    currentGame = await GameEngingObj.nextMathImageGame();
    startGameAudioP2.play();
    ImagURLQuestion(currentGame);
}

function updateScore(score) {
    scoreEl.innerHTML = score;
    XpUser.innerHTML = "<b><i class='fa-solid fa-star'></i> XP: </b>" + score;
    GameEngingObj.Xp(parseInt(GameData.UpperLevel.xp));
    GameEngingObj.UpdateXP(score);
    let ChekLeveled = GameData.getCurentLevelOb(score); //If the XP based level and the GameEngingObj.level arent's the same then an Ajax call is made to update the user level data
    if (ChekLeveled != GameEngingObj.level) {
        console.log("Updated_Level: " + ChekLeveled);
        LevelUser.innerHTML = "<b><i class='fa-solid fa-star'></i> Level: </b>" + ChekLeveled;
        GameEngingObj.UpdateLevel(ChekLeveled);
        GetGameData(ChekLeveled);
        GameUserData.Xp = score;
        GameUserData.level = ChekLeveled;
        main();
    }
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function pauseBtn() {
    power.classList.add('blurOut');
    await sleep(50);   //await for half a MS to blur the screen and popup the JS alert
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
            endGameAudio.play();
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
        GameUserData.Xp = GameEngingObj.NoAnswerScore();
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