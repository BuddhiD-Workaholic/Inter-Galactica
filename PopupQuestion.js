function setCookie(exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = "CookeisAPIS=XYZ-" + Math.random() + "-ABC-" + d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000) + ";" + expires + ";path=/;";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function deleteCookie() {
    document.cookie = 'CookeisAPIS=;path=/;';
}

function checkCookie() {
    let user = getCookie("CookeisAPIS");
    if (user != "") {
        return true;
    } else {
        return false;
    }
}


/**
 * Math API class 
 */
const getMATHQuetions = async (hashCookie) => {
    try {
        let url = "https://math-api-app.herokuapp.com/getmathRandom/" + hashCookie;
        const resp = await axios.get(url);
        return resp.data;
    } catch (err) {
        console.log(err);
        return (err);
    }
}

/**
 * Math Image API class 
 */
const getImageQuetions = async (hashCookie) => {
    try {
        let url = "https://math-api-app.herokuapp.com/getmathImg/" + hashCookie;
        const resp = await axios.get(url);
        return resp.data;
    } catch (err) {
        console.log(err);
        return (err);
    }
}

async function MATHQuestion(time, titile) {
    if (checkCookie()) {
        var cookie = (getCookie("CookeisAPIS"));
        var encryptedAES = CryptoJS.AES.encrypt(cookie, "27b509240c6979d2a69181340d83a18c1cf98d10972694159d24f2c5b46eec04");
    } else {
        location.href = "./Includes/logout.inc.php";
    }

    getMATHQuetions(encodeURIComponent(encryptedAES.toString())).then(response => {
        let question = response.MathAPI.question;
        let answer = Math.round(response.MathAPI.answer);
        console.log(answer)
        swal({
            title: `${titile}`,
            text: `Your Quetions is: ${question}`,
            content: "input",
        }).then((value) => {
            if (value == answer) {
                swal("Good job!", "Your answer is Correct!", "success");
            } else {
                swal("We are Sorry!", "Your answer is Wrong!", "error");
            }
        });
    })
}

async function MATHImage() {
    if (checkCookie()) {
        var cookie = (getCookie("CookeisAPIS"));
        var encryptedAES = CryptoJS.AES.encrypt(cookie, "27b509240c6979d2a69181340d83a18c1cf98d10972694159d24f2c5b46eec04");
    } else {
        location.href = "./Includes/logout.inc.php";
    }

    getImageQuetions(encodeURIComponent(encryptedAES.toString())).then(response => {
        console.log(response);
        let Srcquestion = response.MathAPI.location;
        let answer = response.MathAPI.solution;
        console.log(answer);
    })
}