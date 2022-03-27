/**
 * Main class where the games are coming from. 
 * Basic functionality
 */
class GameEngine {
    /**
     * Each player has their own game engine.
     * 
     * @param player
     */
    constructor(player, score, level) {
        this.thePlayer = player;
        this.score = score;
        this.level = level;
        this.init(this.score);
        this.time = this.getTime();
    }

    init(score) {
        this.score = score;
        this.time = this.getTime();
        this.MathImagesObj = new MathImages();
        this.MathQuetionsObj = new MathQuetions();
        this.current = null;
    }

    /*
     * Retrieves a game (Image from the API). This basic version only has two games that alternate.
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
    * Retrieves a game (Image from the API). This basic version only has two games that alternate.
    */
    async nextMathQuetionGame(titile) {
        try {
            var result = await this.MathQuetionsObj.MATHQuestion(10, titile)
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
     * @return
     */
    checkSolution(i) {
        if (i == this.current.getSolution()) {
            this.score = this.score + this.MathImagesObj.fixscore;
            return true;
        } else {
            return false;
        }
        //return boolean
    }

    /**
    * @param i
    * @return the time
    */

    getTime() {
        let time = 14;
        let i = this.level;
        return (time - i);
        //return int
    }

    /**
     * Retrieves the score. 
     * 
     * @param player
     * @return
     */
    getScore() {
        return this.score;
    }

}