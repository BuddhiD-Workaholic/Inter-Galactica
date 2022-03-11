
class GameEngine {
    /**
     * Each player has their own game engine.
     * 
     * @param player
     */
    GameEngine(player) {
        thePlayer = player;
        init();
    }

    init() {
	this.counter = 0;
	this.score = 0; 
	this.theGames = new GameServer(); 
	this.current = null;
    }
    /*
     * Retrieves a game. This basic version only has two games that alternate.
     */
    nextGame() {
        try {
            current = theGames.getRandomGame();
            return current.getLocation();
        } catch (e) {
            System.out.println("Something went wrong when trying to retrieve game " + counter + "!");
            e.printStackTrace();
            return null;
        }
        //return URL String
    }

    /**
     * Checks if the parameter i is a solution to the game URL. If so, score is increased by one. 
     * @param game
     * @param i
     * @return
     */
    checkSolution(game, i) {
        if (i == current.getSolution()) {
            score++;
            return true;
        } else {
            return false;
        }
        //return boolean
    }


    /**
     * Retrieves the score. 
     * 
     * @param player
     * @return
     */
    getScore() {
        return score;
        //return int
    }

}