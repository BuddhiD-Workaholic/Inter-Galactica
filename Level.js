class Levels {
    /**
     * Constructor accpegts the JSON object from the JSON file and store it alongiside with the User levelcoming from the SQL server
     * @param {*} JSONData 
     * @param {*} CLevel 
     */
    constructor(JSONData, CLevel) {
        this.CurentLevel = JSONData[CLevel - 1];
        this.getOtherLevels(JSONData, CLevel);
    }

    /**
     * Is used to initilaize the other user levels by using the Curent level
     * @param {*} JSONData 
     * @param {*} CLevel 
     */
    getOtherLevels(JSONData, CLevel) {
        if (CLevel != 1) {
            this.BelowLevel = JSONData[CLevel - 2];
        } else {
            this.BelowLevel = JSONData[CLevel - 1];
        }
        if (CLevel != 9) {
            this.UpperLevel = JSONData[CLevel];
        } else {
            this.UpperLevel = JSONData[CLevel - 1];
        }
    }

    /**
     * This function is used to get the User level according to the XP of the player, This function is run everytime the player's XP get updated to 
     * identify the user level
     * @param {*} score 
     * @returns the user level accrording to the Game steings defined within the JSON file
     */
    getCurentLevelOb(score) {
        if (score <= this.BelowLevel.xp) {
            return this.BelowLevel.Lv;
        } else if (score >= this.CurentLevel.xp) {
            return this.UpperLevel.Lv;
        } else if ((score > this.BelowLevel.xp) && (score < this.CurentLevel.xp)) {
            return this.CurentLevel.Lv;
        }
    }
}