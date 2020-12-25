
var text = "";

function funkcija() {
    document.getElementById("terminiSekcija").classList.add("sakrij");
    document.getElementById("zahtjev").classList.add("sakrij");
    document.getElementById("grupaSelect").classList.remove("sakrij");
    document.getElementById("zahtjeviSekcija").classList.add("sakrij");
    var id = "grupaSelect";
    mojaFunkcija3(id);
}


function mojaFunkcija() {

    document.getElementById('termini').innerHTML = '';
    document.getElementById("terminiSekcija").classList.remove("sakrij");
    var xmlhttp;
    var txt = "";
    var objekt = "";
    var polje = document.getElementById("grupaSelect").value;
    var obj = JSON.stringify(polje);

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
                txt += "<tr id='" + objekt[i][0] + "'><td><input class='checkboxTermin' type='checkbox' name='checkbox' id='checkbox' value='" + objekt[i][0] + "'><td class='sakrij'>" + objekt[i][0] + "</td>";
                for (var j = 1; j < objekt[i].length; j++) {
                    txt += "<td>" + objekt[i][j] + "</td>";
                }
                txt += "</tr>";
            }
            document.getElementById('termini').innerHTML = txt;
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeTablicaModeratoraTermini.php?polje=" + obj, true);
    xmlhttp.send();
    mojaFunkcija2();
}

function mojaFunkcija2() {

    document.getElementById('zahtjev_upis').innerHTML = '';
    document.getElementById("zahtjeviSekcija").classList.remove("sakrij");
    var xmlhttp;
    var txt = "";
    var objekt = "";
    var polje = document.getElementById("grupaSelect").value;
    var obj = JSON.stringify(polje);

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
                txt += "<tr id='" + objekt[i][0] + "'><td><input class='checkboxZahtjev' type='checkbox' name='checkbox' id='checkbox' value='" + objekt[i][0] + "'></td><td class='sakrij'>" + objekt[i][0] + "</td>";
                for (var j = 1; j < objekt[i].length; j++) {
                    txt += "<td>" + objekt[i][j] + "</td>";
                }
                txt += "</tr>";
            }
            document.getElementById('zahtjev_upis').innerHTML = txt;
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeTablicaModeratoraZahtjeviUpis.php?polje=" + obj, true);
    xmlhttp.send();
}



function mojaFunkcija3(id) {
    var xmlhttp;
    var objekt = "";
    var obj = JSON.stringify(id);
    var txt = "";

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            objekt = JSON.parse(this.responseText);
            txt += "<option>  </option>";
            for (var i = 0; i < objekt.length; i++) {
                txt += "<option value='" + objekt[i][0] + "'>" + objekt[i][1] + "</option>";
            }
            document.getElementById(id).innerHTML = txt;
        } else {
        }
    }
    xmlhttp.open("GET", "punjenjeTablicaModeratora.php?id=" + obj, true);
    xmlhttp.send();

}



function dodajNovi(id) {
    document.getElementById("terminiSekcija").classList.add("sakrij");
    document.getElementById("zahtjev").classList.remove("sakrij");
    document.getElementById("grupaSelect").classList.add("sakrij");
    document.getElementById('zahtjeviSekcija').classList.add("sakrij");
    mojaFunkcija3("grupaSelect2");
}

function validirajFormu() {
    var vrstaTermina = document.forms["formaZahtjev"]["vrstaTermina"].value;
    var idGrupe = document.forms["formaZahtjev"]["grupaSelect2"].value;
    var datumPocetka = document.forms["formaZahtjev"]["datumPocetka"].value;
    var datumZavrsetka = document.forms["formaZahtjev"]["datumZavrsetka"].value;
    var vrijemePocetka = document.forms["formaZahtjev"]["vrijemePocetka"].value;
    var vrijemeZavrsetka = document.forms["formaZahtjev"]["trajanje"].value;
    var danVrijemeOdrzavanja = document.forms["formaZahtjev"]["danVrijemeOdrzavanja"].value;
    var polaznika = document.forms["formaZahtjev"]["polaznika"].value;

    if (vrstaTermina.length == 0 || idGrupe.length == 0 || datumPocetka.length == 0 || datumZavrsetka.length == 0 || vrijemePocetka.length == 0 || vrijemeZavrsetka.length == 0 || danVrijemeOdrzavanja.length == 0 || polaznika.length == 0) {
        alert("Morate upisati sve podatke!");
        return false;
    } else {


        document.getElementById("formaZahtjev").classList.add("sakrij");
        document.getElementById("terminiSekcija").classList.add("sakrij");
        document.getElementById("zahtjev").classList.add("sakrij");
        document.getElementById("grupaSelect").classList.remove("sakrij");
        var id = "grupaSelect";
        mojaFunkcija3(id);
        document.getElementById("zahtjev").innerHTML = "<p>Poslali ste zahtjev!</p>";
        var arr = [idGrupe, vrstaTermina, datumPocetka, datumZavrsetka, vrijemePocetka, vrijemeZavrsetka, danVrijemeOdrzavanja, polaznika];
        var xmlhttp;
        var obj = JSON.stringify(arr);
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

        }
        xmlhttp.onreadystatechange = function () {

        }

        xmlhttp.open("GET", "moderatoriKreiranjeTermina.php?arr=" + obj, true);
        xmlhttp.send();
        return false;

    }


}
function upisiPolaznika() {
    var checkZahtjev ="";
    var zahtjevi = document.getElementsByClassName('checkboxZahtjev');
    for (var i = 0; zahtjevi[i]; ++i) {
        if (zahtjevi[i].checked) {
            checkZahtjev=zahtjevi[i].value;
            console.log(checkZahtjev);
        }
    }
    var termincheck = "";
    var termini = document.getElementsByClassName('checkboxTermin');
    for (var i = 0; termini[i]; ++i) {
        if (termini[i].checked) {
            termincheck=termini[i].value;
            console.log(termincheck);
        }
    }
    if(termincheck.length==0 || checkZahtjev.length==0){
        alert("Morate oznaciti barem jedan termin i barem jednog polaznika!");
    }else{
        document.getElementById("zahtjev").innerHTML = "<p>Poslali ste termin!</p>";
        var xmlhttp;
        var obj2 = JSON.stringify(checkZahtjev);
        var obj1 = JSON.stringify(termincheck);
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
            alert("Upisali ste korisnika!");
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

        }
        xmlhttp.onreadystatechange = function () {

        }

        xmlhttp.open("GET", "moderatoriUpisPolaznika.php?termin=" + obj1+"&zahtjev="+obj2, true);
        xmlhttp.send();
        mojaFunkcija2();
        mojaFunckija3();
    }
    


}
