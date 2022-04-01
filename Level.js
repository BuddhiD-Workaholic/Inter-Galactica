class Levels {
    constructor(JSONData, CLevel) {
        this.CurentLevel = JSONData[CLevel - 1];
        this.getOtherLevels(JSONData, CLevel);
    }

    getOtherLevels(JSONData, CLevel) {
        if (CLevel != 1) {
            this.BelowLevel = JSONData[CLevel - 2];
        } else {
            this.BelowLevel = JSONData[CLevel - 1];
        }
        console.log("Below: " + JSON.stringify(this.BelowLevel));
        console.log("Current: " + JSON.stringify(this.CurentLevel));
        if (CLevel != 9) {
            this.UpperLevel = JSONData[CLevel];
        } else {
            this.UpperLevel = JSONData[CLevel - 1];
        }
        console.log("Upper: " + JSON.stringify(this.UpperLevel));
    }

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