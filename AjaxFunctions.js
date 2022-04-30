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
async function GetGameData(clevel) {
    var result = await fetch('./GameData.json')
        .then((response) => {
            return response.json();
        })
        .then((myJson) => {
            GameData = new Levels(myJson.Data, clevel);     //If the level changes we'll just cteate a new Level object and assign it t othe same variable
        });
    return result;
}