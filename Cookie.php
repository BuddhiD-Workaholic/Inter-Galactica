<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--Boostrap Starts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/Game.css" type="text/css" />
    <!--Jquery CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--Axios CDN-->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!--SweetAlert CDN-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--Crypto-JS CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js" integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./AjaxFunctions.js"></script>
</head>

<body>
    <script>
        function test() {
            GetUserData().then(response => {
                try {
                    response = JSON.parse(response);
                    console.log(response)
                    console.log(response.email);
                    console.log(response.name);
                    console.log(response.Xp);
                    console.log(response.level);
                } catch (e) {
                    swal("SQL DB Error!", "Error: GetUserData()" + e, "error");
                }
            });
            GetGameData(2).then(response => { //The Level of the game is passed
                try {
                    response = JSON.parse(response);
                    console.log(response)
                } catch (e) {
                    swal("SQL DB Error!", "Error: GetGameData()" + e, "error");
                }
            });
            UpdateXP(2000);
            UpdateLevel(2);
        }
        test();
    </script>
</body>

</html>