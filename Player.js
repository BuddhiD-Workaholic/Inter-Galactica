class Player {
    /**
     * This class is used to store the Player data, The constrictor accpet a JSON object and creates a Player object only using 
     * the passed PlayerData object
     * @param {*} playerData 
     */
    constructor(playerData) {
        this.id = playerData.id;
        this.name = playerData.name;
        this.email = playerData.email;
    }
}