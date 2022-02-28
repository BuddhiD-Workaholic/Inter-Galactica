$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip();
});

function togglePopup() {
	document.getElementById('popup-1').classList.toggle('active');
}

const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});


//Google Translate
function setCookie(b, h, c, f, e) {
    var a;
    if (c === 0) {
        a = ""
    } else {
        var g = new Date();
        g.setTime(g.getTime() + (c * 24 * 60 * 60 * 1000));
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
        includedLanguages: 'en,si,ta',
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
            setCookie("googtrans", "", 0, "/", ".http://localhost/IT20768676/Inter-Galactica/index.php");
            setCookie("googtrans", "", 0, "/");
            location.reload();
        } else {
            setCookie("googtrans", "/es/en", 0, "/", ".http://localhost/IT20768676/Inter-Galactica/index.php");
            setCookie("googtrans", "/es/en", 0, "/");
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