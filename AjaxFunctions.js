async function GetUserData() {
    let Fucname = "GetUserDetails";
    let result = await $.post("Includes/AjaxGetdata.php", {
        FuntionName: Fucname
    }, function (data) {
        //console.log(data);
        return (data);
    });
    return result;
}

async function GetGameData(level) {
    let Fucname = "GetGameDetails";
    let result = await $.post("Includes/AjaxGetdata.php", {
        level: level,
        FuntionName: Fucname
    }, function (data) {
        //console.log(data);
        return (data);
    });
    return result;
}

async function UpdateXP(xp) {
    let Fucname = "UpdateXP";
    let result = $.post("Includes/AjaxUpdate.php", {
        xp: xp,
        FuntionName: Fucname
    }, function (data) {
        console.log("Xp Updated");
        return (data);
    });
}

async function UpdateLevel(level) {
    let Fucname = "UpdateLevel";
    let result =  $.post("Includes/AjaxUpdate.php", {
        level: level,
        FuntionName: Fucname
    }, function (data) {
        console.log("Level Updated");
        return (data);
    });
}