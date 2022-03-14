class MathImages {
    constructor() {
        this.fixscore = 20;
    }

    /**
    * Math Image API class 
    */
    getImageQuetions = async (hashCookie) => {
        try {
            let url = "https://math-api-app.herokuapp.com/getmathImg/" + hashCookie;
            const resp = await axios.get(url);
            return resp.data;
        } catch (err) {
            console.log(err);
            return (err);
        }
    }

    async MATHImage() {
        if (checkCookie()) {
            var cookie = (getCookie("CookeisAPIS"));
            var encryptedAES = CryptoJS.AES.encrypt(cookie, "27b509240c6979d2a69181340d83a18c1cf98d10972694159d24f2c5b46eec04");
        } else {
            location.href = "./Includes/logout.inc.php";
        }

        var result = await this.getImageQuetions(encodeURIComponent(encryptedAES.toString())).then(response => {
            console.log("Answer: "+response.MathAPI.solution);
            return response;
        })
        return result;
    }

}