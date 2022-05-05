/**
* Math Image API class 
*/
class MathImages {
    /**
     * The ocnstructor initlaize the MathImage Objects, PlusScore and MinusScore, Which is different from one player to another
     * depending on the player's level
     * @param {*} PlusScore 
     * @param {*} MinusScore 
     */
    constructor(PlusScore, MinusScore) {
        this.fixscore = PlusScore;
        this.fixMinusScore = MinusScore;
    }

    /**
     * This functions represent an async function used to call the API hosted on Heokru
     * The function wait for the API response and Axios library functions are used to handle the API requests
     * @param {*} hashCookie 
     * @returns the response recived from the API or an error message
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

    /**
     * This function calls the getImageQuetions functions, and before the getImageQuetions function is called it encrypts 
     * the API request with the user cookie storerd with the help of base64 encrypted secret key
     * @returns the result or the API response
     */
    async MATHImage() {
        if (checkCookie()) {
            var cookie = (getCookie("CookeisAPIS"));
            var encryptedAES = CryptoJS.AES.encrypt(cookie, "27b509240c6979d2a69181340d83a18c1cf98d10972694159d24f2c5b46eec04");
        } else {
            location.href = "./Includes/logout.inc.php";
        }

        var result = await this.getImageQuetions(encodeURIComponent(encryptedAES.toString())).then(response => {
            try {
                let decData = CryptoJS.enc.Base64.parse(response).toString(CryptoJS.enc.Utf8);
                response = JSON.parse((CryptoJS.AES.decrypt(decData, cookie).toString(CryptoJS.enc.Utf8)));
            } catch (e) {
                swal("Something went wrong!", "when trying to retrieve game! " + e, "warning");
            }
            return response;
        })
        return result;
    }

}