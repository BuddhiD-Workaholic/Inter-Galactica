/**
 * Main class where the games are coming from. 
 * Basic functionality using Singelton Design pattern 
 * And Facade deisgn patter is used --> Creating Object inside class, and By calling one function it calls multip functions with-in and reducing down the complxity
 */
class GameEngine extends Player {
    /**
     * The constructor allows to define the Player deatils as well as game details, Each player has their own game engine.
     * @param {*} player 
     * @param {*} score 
     * @param {*} level 
     * @param {*} time 
     * @param {*} PlusScore 
     * @param {*} MinusScore 
     */
    constructor(player, score, level, time, PlusScore, MinusScore) {
        super(player);
        this.level = level;
        this.time = time;
        this.init(score, PlusScore, MinusScore);
    }

    /**
     * init function is used to initialize the player score and to create Objects from the Game's two aspects
     * which are the MathImage and the Math Quetion The curent variable is created to hold the curent game object to later 
     * @param {*} score 
     * @param {*} PlusScore 
     * @param {*} MinusScore 
     */
    init(score, PlusScore, MinusScore) {
        this.score = score;
        this.MathImagesObj = new MathImages(PlusScore, MinusScore);
        this.MathQuetionsObj = new MathQuetions();
        this.current = null;
    }

    /*
     * Retrieves a game (Randomly generated Image from the API). This basic version only has two games that alternate.
     * The function creates a Game object to store the the Curent Game details
     */
    async nextMathImageGame() {
        try {
            var result = await this.MathImagesObj.MATHImage();
            this.current = new Game(result.MathAPI.location, result.MathAPI.solution);
            return result.MathAPI.location;
        } catch (e) {
            swal("Something went wrong!", "when trying to retrieve game! " + e, "warning");
            return null;
        }
        //return URL String
    }

    /*
    * Retrieves a game (Randomly generated Math quetion from the API). This basic version only has two games that alternate.
    * @param {*} titile 
    */
    async nextMathQuetionGame(titile) {
        try {
            var result = await this.MathQuetionsObj.MATHQuestion(Math.round(this.time / 3), titile)
            if (result) {
                console.log("Game Engine: " + result);
                this.score = this.score + this.MathQuetionsObj.fixscore;
                return true;
            } else {
                console.log("Game Engine: " + result);
                return false;
            }
        } catch (e) {
            swal("Something went wrong!", "when trying to retrieve game! " + e, "warning");
            return null;
        }
        //return URL String
    }

    /**
     * Checks if the parameter i is a solution to the game URL. If so, score is increased by one. 
     * @param i
     * @return boolean whether the Solution to the answer is corect or wrong depending on the answer given by the user
     */
    checkSolution(i) {
        if (i == this.current.getSolution()) {
            this.score = parseFloat(this.score + this.MathImagesObj.fixscore);
            return true;
        } else {
            this.score = parseFloat(this.score - this.MathImagesObj.fixMinusScore);
            return false;
        }
        //return boolean
    }

    /**
    * @return the Score a player get's if he or she was unabled to get the answer for a math quetion within the given time
    */
    NoAnswerScore() {
        this.score = this.score - this.MathImagesObj.fixMinusScore;
        return this.score;
    }

    /**
    * @return the time
    */
    getTime() {
        return this.time;
    }

    /**
     * Retrieves the score. 
     * @return the score 
     */
    getScore() {
        return this.score;
    }

    /**
    * Progress bar 
    * https://www.w3schools.com/w3css/tryit.asp?filename=tryw3css_progressbar_labels_js
    */
    Xp(scoreBenchmark) {
        $(".score").attr(
            "style",
            "width:" + (this.score / scoreBenchmark) * 100 * 1.5 + "px"
        );
    }
}