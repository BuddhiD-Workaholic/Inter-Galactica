/**
 * The GetUserData() function makes an asynchronous request to the AjaxGetdata.php file and wait for the output to get 
 * recived and then return the user data as a JSON string
 * @returns the user data coming from the SQL Server 
 */
async function GetUserData() {
    let Fucname = "GetUserDetails";
    let result = await $.post("Includes/AjaxGetdata.php", {
        FuntionName: Fucname
    }, function (data) {
        return (data);
    });
    return result;
}

/**
 * GetGameData(level) function makes an asynchronous request to the GameData.json file and wait for the output to get 
 * recived and then return the user data as a JSON string, The JSON file is used to store the Game data becuase it's way faster, and simply the Admin
 * can chnage the game details within the JSON file
 * @param {*} level 
 * @returns the Game data corespond to a particular user's Level 
 */
async function GetGameData(level) {
    var result = await fetch('./GameData.json')
        .then((response) => {
            return response.json();
        })
        .then((myJson) => {
            console.log(myJson.Data[level - 1]);
            return myJson.Data[level - 1];
        });
    return result;
}

/**
 * Update User XP by making a Ajax fetch request to the PHP 
 * @param {*} xp 
 * @return the status of the request
 */
async function UpdateXP(xp) {
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
async function UpdateLevel(level) {
    let Fucname = "UpdateLevel";
    let result = $.post("Includes/AjaxUpdate.php", {
        level: level,
        FuntionName: Fucname
    }, function (data) {
        return (data);
    });
}