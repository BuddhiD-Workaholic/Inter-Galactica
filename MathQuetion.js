/**
 * Math Quetion API class 
 */
class MathQuetions {
    /**
     * The ocnstructor initlaize the MathQuetions Objects, fixscore to 10
     * Which remains as a fix score from player to another
     */
    constructor() {
        this.fixscore = 10;
    }

    /**
     * This functions represent an async function used to call the API hosted on Heokru
     * The function wait for the API response and Axios library functions are used to handle the API requests
     * @param {*} hashCookie 
     * @returns 
     */
    getMATHQuetions = async (hashCookie) => {
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
     * This function calls the getImageQuetions functions, and once the response is recive the function creates a popup
     * using Sweetalert Javascript library.
     * @param {*} time 
     * @param {*} titile 
     * @returns the result as a true or flase depedning on the user's answer.
     */
    async MATHQuestion(time, titile) {
        if (checkCookie()) {
            var cookie = (getCookie("CookeisAPIS"));
            var encryptedAES = CryptoJS.AES.encrypt(cookie, "27b509240c6979d2a69181340d83a18c1cf98d10972694159d24f2c5b46eec04");
        } else {
            location.href = "./Includes/logout.inc.php";
        }
        var result = await this.getMATHQuetions(encodeURIComponent(encryptedAES.toString())).then(response => {
            try {
                let decData = CryptoJS.enc.Base64.parse(response).toString(CryptoJS.enc.Utf8);
                response = JSON.parse((CryptoJS.AES.decrypt(decData, cookie).toString(CryptoJS.enc.Utf8)));
            } catch (e) {
                swal("Something went wrong!", "when trying to retrieve game! " + e, "warning");
            }
            let question = response.MathAPI.question;
            let answer = response.MathAPI.answer;
            var resultSwal = swal({
                title: `${titile}`,
                text: `\t Time Allocated: ${time} Seconds; \n \t Your Quetions is: \n  ${question}`,
                timer: time * 1000,
                content: "input",
            }).then((value) => {
                if ((value == Math.round(answer)) || (value == Math.round(answer * 1000) / 1000)) {
                    swal("Good job!", "Your answer is Correct!", "success");
                    return true;
                } else if ((value == null) || (value == '')) {
                    swal("We are Sorry!", "Your time is up!", "error");
                    return false;
                } else {
                    swal("We are Sorry!", "Your answer is Wrong!", "error");
                    return false;
                }
            });
            return resultSwal;
        })
        return result;
    }
}