function validirajFormu() {

    var ime = document.forms["formaZahtjev"]["ime"].value;
    var prezime = document.forms["formaZahtjev"]["prezime"].value;
    var email = document.forms["formaZahtjev"]["email"].value;
    var dob = document.forms["formaZahtjev"]["dob"].value;
    var stanje;
    var e = document.getElementById("grupaSelect").value;
    stanje = true;
    if (ime == "" || prezime == "" || email == "" || dob.length == 0) {
        alert("Morate upisati sve podatke!");
        return false;
    } else {
        document.getElementById("formaZahtjev").classList.add("sakrij");
        document.getElementById("zahtjev").innerHTML = "<p>Poslali ste zahtjev!</p>"
        var arr = [e, ime, prezime, email];
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

        xmlhttp.open("GET", "slanjeZahtjevaZaUpis.php?arr=" + obj, true);
        xmlhttp.send();
        return false;
    }
}


function validirajFormuOcjena() {
    var pin = document.forms["formaOcjena"]["pin"].value;
    var ocjena = document.forms["formaOcjena"]["ocjena"].value;
    if (pin == "" || ocjena.length == 0) {
        alert("Morate upisati sve podatke!");
        return false;
    } else {
        document.getElementById("formaOcjena").classList.add("sakrij");

        var xmlhttp;
        var objP = JSON.stringify(pin);
        var objO = JSON.stringify(ocjena);
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (xmlhttp.responseText == "da")
                    document.getElementById("ocjenaZ").innerHTML = "<p>Ocjenili  ste moderatora!</p>";
                else if (xmlhttp.responseText == "ne") {
                    document.getElementById("ocjenaZ").innerHTML = "<p>Vec ste ocijenili moderatora!</p>";
                }
            } else {
            }
        }

        xmlhttp.open("GET", "slanjeOcjene.php?pin=" + objP + "&&ocjena=" + objO, true);
        xmlhttp.send();
        return false;
    }
}




