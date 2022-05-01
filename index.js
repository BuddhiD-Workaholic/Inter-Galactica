/**
 * The google translate is been utlized in here with the help of the W3school, The code listed in the webpage been utilzed and changed appropriately
 * //https://www.w3schools.com/howto/howto_google_translate.asp
 */

//Google Translate
function setCookieGT(b, h, c, f, e) {
    var a;
    if (c === 0) {
        a = ""
    } else {
        var g = new Date();
        g.setTime(g.getTime() + (c * 24 * 60 * 60 * 1000));
        console.log('Time+' + g.setTime(g.getTime() + (c * 24 * 60 * 60 * 1000)))
        a = "expires=" + g.toGMTString() + "; "
    }
    var e = (typeof e === "undefined") ? "" : "; domain=" + e;
    document.cookie = b + "=" + h + "; " + a + "path=" + f + e
}

function getCookie(d) {
    var b = d + "=";
    var a = document.cookie.split(";");
    for (var e = 0; e < a.length; e++) {
        var f = a[e].trim();
        if (f.indexOf(b) == 0) {
            return f.substring(b.length, f.length)
        }
    }
    return ""
}

//Google provides this function
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: "en",
        includedLanguages: 'en,si,ta,ko,ja,zh-CN,fr,de',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
        autoDisplay: false
    }, "google_translate_element")
}

//Using jQuery
$(document).ready(function () {
    $(".post-owl").owlCarousel({
        navigation: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        autoPlay: 3000,
    });

    $(".lang-change").on("click", function () {
        if (googTrans == '/es/en') {
            setCookieGT("googtrans", "", 30, "/", ".http://inter-galactica.herokuapp.com/index.php");
            setCookieGT("googtrans", "", 30, "/");
            location.reload();
        } else {
            setCookieGT("googtrans", "/es/en", 30, "/", ".http://inter-galactica.herokuapp.com/index.php");
            setCookieGT("googtrans", "/es/en", 30, "/");
            location.reload()
        }
    });

    var googTrans = getCookie('googtrans');

    if (googTrans === '/es/en') {
        downloadJSAtOnload();
        var src = $('#lang-change-en > img').attr('src').replace('flag_en.png', 'flag_es.gif');
        $('#lang-change-en > img').attr('src', src);
        $('#lang-change-en').attr('id', 'lang-change-es');
    }
});

function downloadJSAtOnload() {
    var i;
    var paths = new Array(
        '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit'
    );
    for (i in paths) {
        if (typeof paths[i] !== 'string') {
            console.log(typeof paths[i]);
            continue;
        }
        var element = document.createElement("script");
        element.src = paths[i];
        document.body.appendChild(element);
    }
}

/**
 * The tooltip elemnt helps to add more information about the each element, That would be useful to increase the User
 * experience when sign-up to the system
 * Reference: 
 * https://stackoverflow.com/questions/1333546/how-can-i-display-a-tooltip-message-on-hover-using-jquery
 */

//Adding a Tooltip element for email
$("#email").attr('title', 'When entering email make sure its a valid email address!');

//Adding a Tooltip element for Passowrd
$("#pwd1").attr('title', 'The Password length must be between 8 chracters to 10 characters long!');
$("#pwdc").attr('title', 'Confirm the above added password again!');

//Adding a Tooltip element for contact number
$("#contact").attr('title', 'When entering password enter your Country code, followed with the number: +94 XX XXXXXX');