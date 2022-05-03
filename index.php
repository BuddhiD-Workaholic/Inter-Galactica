<?php require_once 'DataBase/config.php';
require_once 'Includes/GoogleAPI/vendor/autoload.php';
require_once("Includes/GoogleController.php");

if (isset($_SESSION['userid'])) {
  if ($_SESSION['userTY'] == "GP") {
    header("Location: MainGame.php");
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <!-- <meta name="description" content="width=device-width,initial-scale=1.0" /> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Welcome!</title>

  <!--StyleSheet-->
  <link rel="stylesheet" href="CSS/style.css" type="text/css" />
  <link rel="shortcut icon" href="Images/Icon.jpg">

  <!--FontAwsome CDN-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

  <!--Jquery CDN-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <!--Google translate-->
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <!--SweetAlert CDN-->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!--Axios CDN-->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  <script>
    //ShowPassword
    function ShowPFunc(thisI) {
      var x = document.getElementById("pwd");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
      thisI.classList.toggle('fa-eye-slash');
    }

    //Login 
    function validateLogin() {
      if ((document.getElementById("Uname").value != "") && (document.getElementById("pwd").value != "")) {
        return true;
      } else {
        swal("Please insert the Login credentials!");
        return false;
      }
    }

    //Password
    function ValidatePassword() {
      var pwd1 = document.getElementById("pwd").value;
      var pwdc = document.getElementById("pwdc").value;

      if ((pwd1.length >= 8) && (pwd1.length <= 10)) {
        if(pwd1 == pwdc){
          return true;
        }else{
          swal("Your passowrds don't match!, Please try again later!");
          return false;
        }
      } else {
        swal("Please enter the correct password with Minimum of 8 charcters and Maximum of 10 Characters");
        return false;
      }
    }

    //Email
    const validateEmail = async () => {
      var email = document.getElementById("email").value;
      try {
        var url = "http://apilayer.net/api/check?access_key=e4bfccb27a838acc91c7bf0e8957713f&email=" + email
        const resp = await axios.get(url);
        return resp;
      } catch (err) {
        console.log(err);
        return (err);
      }
    }

    //Phone number
    const validatePhone = async () => {
      var CPno = document.getElementById("contact").value;
      try {
        let url = "https://numlookupapi.com/api/validate/" + CPno+"?apikey=pLWWIdzxTymJ9PSs7WQfg3KDOqMFv4EMgI7MLv8O";
        const resp = await axios.get(url);
        return resp.data;
      } catch (err) {
        console.log(err);
        return (err);
      }
    }

    //SignUp Validation
    async function validateAll(e) {
      //Email validation 
      validateEmail().then(response => {
        console.log("Email validation: "+response.format_valid, " : ", response.mx_found);
        if ((response.format_valid) && (response.smtp_check)&& (response.mx_found)) {
          if (ValidatePassword()) {
            //Phone number validation 
            validatePhone().then(response => {
              console.log("Number validation: "+response.valid, " : ", response.international_format);
              if ((response.valid)) {
                e.submit();
              } else {
                swal("The Phone number you entered is not a valid number! \n Make sure your have added your country code at the begining: +94 XX XXXXXX");
              }
            })
          } else {
            e.preventDefault();
          }
        } else {
          swal("The email you entered is not a valid email! \n You need to have a Valid Email Address!");
        }
      })
    }
  </script>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <!-- Sign In FORM -->
        <div id="google_translate_element">Select a Language</div>
        <form action="Includes/login.inc.php" onsubmit="return validateLogin()" autocomplete="off" method="POST" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fa fa-user"></i>
            <input type="text" id="Uname" required name="Uname" placeholder="Username" />
          </div>
          <div class="input-field">
            <i class="fa fa-lock"></i>
            <input type="password" id="pwd" required name="pwd" id="pwd" placeholder="Password" />
            <!--Password Icons-->
          </div>
          <i class="far fa-eye fa-eye-slash" id="togglePassword" style="float: right;margin-left: 280px;margin-top: -43px;/* margin: -40px -34px 6px 298px; */position: relative;z-index: 2;" onclick="ShowPFunc(this)"></i>
          <div style="display: flex;">
            <div class="google-btn" style="margin-top: 1.8rem;">
              <div class="google-icon-wrapper">
                <img class="google-icon" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" />
              </div>
              <p onclick="window.location='<?php echo $login_url; ?>'" class="btn-text" type="button"><b>Sign in with google</b></p>
            </div>
          </div>
          <input type="submit" name="submit" value="Login" class="btn solid" />
        </form>

        <!-- Sign UP FORM -->
        <form action="Includes/signup.inc.php" autocomplete="off" onsubmit="return validateAll(this); return false;" method="POST" class="sign-up-form">
          <h2 class="title">Sign up</h2>
          <div class="aboutp" align="center">
            <div class="input-field">
              <i class="fa fa-user"></i>
              <input type="text" required id="name" name="name" placeholder="Name" />
            </div>
            <div class="input-field">
              <i class="fa fa-envelope"></i>
              <input type="email" required id="email" name="email" placeholder="Email Address" />
            </div>
            <div class="input-field">
              <i class="fa fa-phone"></i>
              <input type="tel" id="contact" required name="contact" placeholder="Phone Number: +94 XX XXXXXX" />
            </div>
            <div class="input-field">
              <i class="fa fa-lock"></i>
              <input type="password" required id="pwd1" name="pwd" placeholder="Password" />
            </div>
            <div class="input-field">
              <i class="fa fa-lock"></i>
              <input type="password" required id="pwdc" name="pwdc" placeholder="Confirm Password" />
            </div>
            <input type="submit" name="submit" value="submit" class="btn solid" />
          </div>
        </form>
      </div>
    </div>
    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3><span class="las la-star-of-life"></span> Inter Galactica - War For MATH</h3>
          <p>
            A web-based Interactive Mathamatical Game
          </p>
          <button class="btn transparent" id="sign-up-btn">Sign Up</button>
        </div>
        <img src="Images/42222-modified.png" class="image" alt="" />
      </div>

      <div class="panel right-panel">
        <div class="content">
          <h3>Wanna Become One of Us?</h3>
          <p>
            Go ahead and Login with your user credentials to proceeed and
            access our website.
          </p>
          <button class="btn transparent" id="sign-in-btn">Sign in</button>
        </div>
        <img width="38rem;" src="Images/42244-bg.png" class="image" alt="" />
      </div>
    </div>
  </div>
  <?php
  if (isset($_GET['error'])) {
    if ($_GET['error'] == "empty") {
      echo '<script>swal("Error!", "Please Fill the inputs!", "error");</script>';
    } elseif ($_GET['error'] == "wronglogin") {
      echo '<script>swal("Error!", "Your username or Password is invalid!", "error");</script>';
    } elseif ($_GET['error'] == "Invaild") {
      echo '<script>swal("Error!", Invalid User Type!", "error");</script>';
    } elseif ($_GET['error'] == "none") {
      echo '<script>swal("Good job!", "Now you can Play and Learn Maths, and Enjoy Maths! \n Please Sign-In!", "success");</script>';
    } elseif ($_GET['error'] == "uidexists") {
      echo '<script>swal("Error!", "This email already has an Account! <br> Try Sign In!", "error");</script>';
    } elseif ($_GET['error'] == "sqlerror") {
      echo '<script>swal("Error!", "SQL error: ' . $_GET['E'] . '", "error");</script>';
    } elseif ($_GET['error'] == "exception") {
      echo '<script>swal("Error!", "Error has occurerd!, error: ' . $_GET['E'] . '", "error");</script>';
    } else {
      echo '<script>swal("Error!", "Unknown Error!, Please try again later!", "error");</script>';
    }
  }
  ?>
  <!--JavaScript-->
  <script>
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");

    sign_up_btn.addEventListener("click", () => {
      container.classList.add("sign-up-mode");
    });

    sign_in_btn.addEventListener("click", () => {
      container.classList.remove("sign-up-mode");
    });
  </script>
  <script src="./index.js"></script>
</body>

</html>