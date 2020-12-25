
function funkcija() {

    document.getElementById("divOglas").classList.add("sakrij");
    var x = document.getElementsByTagName("TBODY");
    var i;
    var obj;
    for (i = 0; i < x.length; i++) {
        var obj = "";
        obj = x[i].id;
        mojaFunkcija(obj);
    }
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
                for (var j = 1; j < objekt[i].length; j++) {
                    txt += "<td>" + objekt[i][j] + "</td>";
                }
                txt += "</tr>";
            }
            document.getElementById(id).innerHTML = txt;
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeVrsteOglasa.php?polje=" + obj, true);
    xmlhttp.send();
}
function trclick(id) {
    var c = document.getElementById("idVrsteOglasa").value;
    if (c != id) {
        document.getElementById("divOglas").classList.add("prikazi");
        document.getElementById("idVrsteOglasa").value = id;
        document.getElementById(id).style.backgroundColor = "#FF652F";
        document.getElementById(c).style.backgroundColor = "transparent";
    }
}
function validirajFormu() {
    
    var naziv = document.forms["formaZahtjev"]["naziv"].value;
    var opis = document.forms["formaZahtjev"]["opis"].value;
    var id = document.forms["formaZahtjev"]["idVrsteOglasa"].value;
    var url = document.forms["formaZahtjev"]["url"].value;
    var datum = document.forms["formaZahtjev"]["datum"].value;
    var vrijeme = document.forms["formaZahtjev"]["vrijeme"].value;
    if (naziv == "" || opis == "" || url == "" || datum == null || vrijeme == null) {
        alert("Morate upisati sve podatke!");
        return false;
    } else {
        document.getElementById("formaZahtjev").classList.add("sakrij");
        document.getElementById("zahtjev").innerHTML = "<p>Poslali ste zahtjev!</p>"

        var arr = [id, naziv, url, opis, datum, vrijeme];
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

        xmlhttp.open("GET", "slanjeOglasa.php?arr=" + obj, true);
        xmlhttp.send();
        return false;
    }
}
