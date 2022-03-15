class MathQuetions {
    constructor() {
        this.fixscore = 10;
    }

    /**
     * Math API class 
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

    async MATHQuestion(time, titile) {
        if (checkCookie()) {
            var cookie = (getCookie("CookeisAPIS"));
            var encryptedAES = CryptoJS.AES.encrypt(cookie, "27b509240c6979d2a69181340d83a18c1cf98d10972694159d24f2c5b46eec04");
        } else {
            location.href = "./Includes/logout.inc.php";
        }
        var result = await this.getMATHQuetions(encodeURIComponent(encryptedAES.toString())).then(response => {
            try{
            let decData = CryptoJS.enc.Base64.parse(response).toString(CryptoJS.enc.Utf8);
            response = JSON.parse((CryptoJS.AES.decrypt(decData, cookie).toString(CryptoJS.enc.Utf8)));
            }catch(e){
                swal("Something went wrong!", "when trying to retrieve game! " + e, "warning");
            }
            let question = response.MathAPI.question;
            let answer = response.MathAPI.answer;
            console.log("Answer: " + Math.round(answer));
            var resultSwal = swal({
                title: `${titile}`,
                text: `Your Quetions is: ${question}`,
                content: "input",
            }).then((value) => {
                if ((value == Math.round(answer)) || (value == Math.round(answer * 1000) / 1000)) {
                    swal("Good job!", "Your answer is Correct!", "success");
                    return true;
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