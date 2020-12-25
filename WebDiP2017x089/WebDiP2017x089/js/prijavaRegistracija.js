
var korisnickoImeR;
var emailR;
var lozinkaR;
var lozinkaPonovljenaR;
var dobR;


$(document).ready(function () {
    korisnickoImeR = $("#korimeR");
    emailR = $("#email-R");
    dobR = $("#dob-R");
    lozinkaR = $("#lozinka-R");
    lozinkaPonovljenaR = $("#lozinkaPonovljena-R");
    


    emailR.on("keyup", tocnostEmailaR);
    korisnickoImeR.on("keyup", tocnostKorisnickogImenaR);
    lozinkaR.on("keyup", tocnostLozinkeR);
    lozinkaPonovljenaR.on("keyup", tocnostPonovljeneLozinkeR);
    dobR.on("keyup", tocnostDobiR);

});



function tocnostEmailaR() {
    var email = emailR.val();
    var izraz = new RegExp(/[a-z A-Z /. 0-9 \- _]+@+[a-z  A-Z 0-9 \-]+\.+[a-z A-Z]{2,}/);

    if (izraz.test(email)) {
        emailR.css("background-color", "rgba(20, 167, 108,0.5)");
    } else {
        emailR.css("background-color", "rgba(114, 13, 13, 0.5)");
    }
    if (email === '') {
        emailR.css("background-color", "rgba(255,255,255,0.2)");
    }
}

function tocnostKorisnickogImenaR() {
    var korime = korisnickoImeR.val();
    var izraz = new RegExp(/[A-Z a-z 0-9 \. \- _ ~]/);
    if (korime.length > 3 && izraz.test(korime)) {
        korisnickoImeR.css("background-color", "rgba(20, 167, 108,0.5)");
    } else {
        korisnickoImeR.css("background-color", "rgba(114, 13, 13, 0.5)");
    }
    if (korime === '') {
        korisnickoImeR.css("background-color", "rgba(255,255,255,0.2)");
    }

}
function tocnostLozinkeR() {
    var lozinka = lozinkaR.val();
    var izraz = new RegExp(/([A-Z a-z])*([0-9])/);

    if (lozinka.length > 6 && izraz.test(lozinka)) {
        lozinkaR.css("background-color", "rgba(20, 167, 108,0.5)");
    } else {
        lozinkaR.css("background-color", "rgba(114, 13, 13, 0.5)");
    }

    if (lozinka === '') {
        lozinkaR.css("background-color", "rgba(255,255,255,0.2)");
    }
}
function tocnostPonovljeneLozinkeR() {
    var lozinkaPonovljena = lozinkaPonovljenaR.val();
    var lozinka = lozinkaR.val();
    if (lozinka === lozinkaPonovljena) {
        lozinkaPonovljenaR.css("background-color", "rgba(20, 167, 108,0.5)");
    } else {
        lozinkaPonovljenaR.css("background-color", "rgba(114, 13, 13, 0.5)");
    }
    if (lozinkaPonovljena === '') {
        lozinkaPonovljenaR.css("background-color", "rgba(255,255,255,0.2)");
    }
}
function tocnostDobiR() {
    var dob =dobR.val();
    if (Number(dob) > 17) {
        dobR.css("background-color", "rgba(20, 167, 108,0.5)");
    } else {
        dobR.css("background-color", "rgba(114, 13, 13, 0.5)");
    }
    if (dob === '') {
        dobR.css("background-color", "rgba(255,255,255,0.2)");
    }
}

function provjeri(unos, polje, vrijednost) {
var xmlhttp;
if (window.XMLHttpRequest) { // for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp = new XMLHttpRequest();
} else { // for IE6, IE5
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
document.getElementById(polje).innerHTML = "...";
} else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
document.getElementById(polje).innerHTML = xmlhttp.responseText;

document.getElementById(unos).addClass("netocno");

} else {
document.getElementById(polje).innerHTML = "U redu!.";
 document.getElementById(unos).addClass("tocno");
}
}
xmlhttp.open("GET", "validation.php?polje=" + polje + "&vrijednost=" + vrijednost, false);
xmlhttp.send();
}
