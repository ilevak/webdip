
var text = "";

function funkcija() {
    document.getElementById("terminiSekcija").classList.remove("sakrij");
    document.getElementById("zahtjeviSekcija").classList.remove("sakrij");
    mojaFunkcija();
}


function mojaFunkcija() {

    
    var xmlhttp;
    var txt = "";
    var objekt = "";
    var x = "";
    var obj = JSON.stringify('1');
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
                txt += "<tr onclick='mojaFunkcija2(id)'id='" + objekt[i][0] + "'><td class='sakrij'>" + objekt[i][0] + "</td>";
                for (var j = 2; j < objekt[i].length; j++) {
                    txt += "<td>" + objekt[i][j] + "</td>";
                }
                txt += "</tr>";
            }
            document.getElementById('pozicija').innerHTML = "";
            document.getElementById('pozicija').innerHTML = txt;
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeTablicaModeratoraPozicije.php?polje=" + obj, true);
    xmlhttp.send();
}

function mojaFunkcija2(id) {

    document.getElementById('oglas').innerHTML = '';
    document.getElementById("zahtjeviSekcija").classList.remove("sakrij");
    var xmlhttp;
    var txt = "";
    var objekt = "";
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
                txt += "<tr onclick='mojaFunkcija3(id)' id='" + objekt[i][0] + "'><td><input class='checkboxZahtjev' type='checkbox' name='checkbox' id='checkbox' value='" + objekt[i][0] + "'></td><td class='sakrij'>" + objekt[i][0] + "</td>";
                for (var j = 1; j < objekt[i].length; j++) {
                    txt += "<td>" + objekt[i][j] + "</td>";
                }
                txt += "</tr>";
            }
            document.getElementById('oglas').innerHTML = txt;
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeTablicaModeratoraOglasi.php?polje=" + obj, true);
    xmlhttp.send();
}

function mojaFunkcija3(id) {

    document.getElementById('blokiranje').innerHTML = '';
    document.getElementById("zahtjeviSekcija").classList.remove("sakrij");
    var xmlhttp;
    var txt = "";
    var objekt = "";
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
                txt += "<tr  id='" + objekt[i][0] + "'><td><input class='checkboxZahtjevBlok' type='checkbox' name='checkbox' id='checkbox' value='" + objekt[i][0] + "'></td><td class='sakrij'>" + objekt[i][0] + "</td>";
                for (var j = 1; j < objekt[i].length; j++) {
                    txt += "<td>" + objekt[i][j] + "</td>";
                }
                txt += "</tr>";
            }
            document.getElementById('blokiranje').innerHTML = txt;
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeTablicaModeratoraZahtjevBlok.php?polje=" + obj, true);
    xmlhttp.send();
}








function odobriOglas() {
    var checkZahtjev =[];
    var zahtjevi = document.getElementsByClassName('checkboxZahtjev');
    for (var i = 0; zahtjevi[i]; ++i) {
        if (zahtjevi[i].checked) {
            checkZahtjev.push(zahtjevi[i].value);
            console.log(checkZahtjev);
        }
    }
    if(checkZahtjev.length==0){
        alert("Morate oznaciti barem jedan oglas!");
    }else{
        var xmlhttp;
        var obj2 = JSON.stringify(checkZahtjev);
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
            alert("Odobrili ste oglas!");
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

        }
        xmlhttp.onreadystatechange = function () {

        }
        
        xmlhttp.open("GET", "moderatorOdobriOglas.php?zahtjev="+obj2, true);
        xmlhttp.send();
        funkcija();
    }
}


function odobriBlok() {
    var checkZahtjev =[];
    var zahtjevi = document.getElementsByClassName('checkboxZahtjevBlok');
    for (var i = 0; zahtjevi[i]; ++i) {
        if (zahtjevi[i].checked) {
            checkZahtjev.push(zahtjevi[i].value);
            console.log(checkZahtjev);
        }
    }
    if(checkZahtjev.length==0){
        alert("Morate oznaciti barem jedan oglas!");
    }else{
        var xmlhttp;
        var obj2 = JSON.stringify(checkZahtjev);
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
            alert("Odobrili ste oglas!");
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

        }
        xmlhttp.onreadystatechange = function () {

        }
        
        xmlhttp.open("GET", "moderatorOdobriBlok.php?zahtjev="+obj2, true);
        xmlhttp.send();
        funkcija();
    }
}



