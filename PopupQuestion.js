function setCookie(exdays) {
    const d = new Date();
    console.log(getDate(d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000)));
    document.cookie = "Cookeis=XYZ-" + Math.random() + "-ABC-" + d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000) + ";path=/";
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
    document.cookie = 'Cookeis=;path=/';
}

function checkCookie() {
    let user = getCookie("Cookeis");
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
        let url = "https://math-api-app.herokuapp.com/getmath/"+hashCookie;
        const resp = await axios.get(url);
        return resp.data;
    } catch (err) {
        console.log(err);
        return (err);
    }
}

async function MATHQuestion(time, titile) {

    if (checkCookie()) {
        var cookie = (getCookie("Cookeis"));
        var encryptedAES = CryptoJS.AES.encrypt(cookie, "27b509240c6979d2a69181340d83a18c1cf98d10972694159d24f2c5b46eec04");
        console.log(encryptedAES.toString());
        console.log(encodeURIComponent(encryptedAES.toString()));
    } else {
        window.onload("./Includes/logout.inc.php")
    }

    getMATHQuetions(encodeURIComponent(encryptedAES.toString())).then(response => {
        const question = response.MathAPI.question;
        const answer = Math.round(response.MathAPI.answer);
        console.log(answer)
        swal({
            title: `${titile}`,
            text: `Your Quetions is: ${question}`,
            content: "input",
            timer: time,
        }).then((value) => {
            if (value == answer) {
                swal("Good job!", "Your answer is Correct!", "success");
            } else if (value == null) {
                swal("We are Sorry!", "Your time is Up!", "error");
            } else {
                swal("We are Sorry!", "Your answer is Wrong!", "error");
            }
        });
    })
}
