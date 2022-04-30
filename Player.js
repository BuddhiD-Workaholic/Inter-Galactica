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

    /**
    * Update User XP by making a Ajax fetch request to the PHP 
    * @param {*} xp 
    * @return the status of the request
    */
    async UpdateXP(xp) {
        let Fucname = "UpdateXP";
        let result = $.post("Includes/AjaxUpdate.php", {
            xp: xp,
            FuntionName: Fucname
        }, function (data) {
            return (data);
        });
    }

    /**
     * Update User Level by making a Ajax fetch request to the PHP 
     * @param {*} level 
     * @return the status of the request
     */
    async UpdateLevel(level) {
        let Fucname = "UpdateLevel";
        let result = $.post("Includes/AjaxUpdate.php", {
            level: level,
            FuntionName: Fucname
        }, function (data) {
            return (data);
        });
    }

}