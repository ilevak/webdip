
function funkcija() {
    document.getElementById("divVrsta").classList.add("sakrij");
    var i;
    var obj;
    mojaFunkcija('pozicija');
}


function mojaFunkcija(polje) {
    
    
    var xmlhttp;
    var txt = "";
    var objekt = "";
    var x = "";
    var obj = JSON.stringify(polje);
    var id = polje;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
        } else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            objekt = JSON.parse(this.responseText);
            for (var i = 0; i < objekt.length; i++) {
                txt += "<tr onclick='trclick(id)'id='" + objekt[i][0] + "'><td class='sakrij'>" + objekt[i][0] + "</td>";
                for (var j = 2; j < objekt[i].length; j++) {
                    txt += "<td>" + objekt[i][j] + "</td>";
                }
                txt += "</tr>";
            }
            document.getElementById(id).innerHTML = "";
            document.getElementById(id).innerHTML = txt;
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeTablicaModeratoraPozicije.php?polje=" + obj, true);
    xmlhttp.send();
}
function trclick(id) {
    var c = document.getElementById("idPozicija").value;
    if (c != id) {
        document.getElementById("divVrsta").classList.add("prikazi");
        document.getElementById("idPozicija").value = id;
        mojaFunkcija2(id);
        document.getElementById(id).style.backgroundColor = "#FF652F";
        document.getElementById(c).style.backgroundColor = "transparent";
    }
}


function mojaFunkcija2(id) {
    var xmlhttp;
    var txt = "";
    var objekt = "";
    var x = "";
    var obj = JSON.stringify(id);
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
        } else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            objekt = JSON.parse(this.responseText);
            for (var i = 0; i < objekt.length; i++) {
                txt += "<tr id='" + objekt[i][0] + "'><td class='sakrij'>" + objekt[i][0] + "</td>";
                for (var j = 1; j < objekt[i].length; j++) {
                    txt += "<td>" + objekt[i][j] + "</td>";
                }
                txt += "</tr>";
            }
            document.getElementById('vrsta_oglasa').innerHTML = txt;
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeTablicaModeratoraVrsteOglasa.php?polje=" + obj, true);
    xmlhttp.send();
}




function validirajFormu() {

    var naziv = document.forms["formaZahtjev"]["naziv"].value;
    var trajanjePrikazivanja = document.forms["formaZahtjev"]["trajanjePrikazivanja"].value;
    var id = document.forms["formaZahtjev"]["idPozicija"].value;
    var frekvencijaIzmjene = document.forms["formaZahtjev"]["frekvencijaIzmjene"].value;
    var cijena = document.forms["formaZahtjev"]["cijena"].value;
    if (naziv == "" || trajanjePrikazivanja == "" || frekvencijaIzmjene == "" || cijena == null) {
        alert("Morate upisati sve podatke!");
        return false;
    } else {
        document.getElementById("zahtjev").innerHTML = "<p>Poslali ste zahtjev!</p>"
        var arr = [id, naziv, trajanjePrikazivanja, frekvencijaIzmjene, cijena];
        console.log(arr);
        var xmlhttp;
        var obj = JSON.stringify(arr);
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (xmlhttp.responseText == "da")
                    console.log("u redu je!");
                

            } else {
            }
        }

        xmlhttp.open("GET", "slanjeVrsteOglasa.php?arr=" + obj, true);
        xmlhttp.send();

        return false;

    }
}
