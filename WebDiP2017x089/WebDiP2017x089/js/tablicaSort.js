filtriraj("sve");




function filtriraj(podatak) {
    var klasaTablica, i;
    var klasaT;
    klasaTablica = document.getElementsByClassName("div2Tablica");
    if (podatak == "sve")
        podatak = "";
    for (i = 0; i < klasaTablica.length; i++) {
        makniKlasu(klasaTablica[i], "prikaziTablica");
        if (klasaTablica[i].className.indexOf(podatak) > -1)
            dodajKlasu(klasaTablica[i], "prikaziTablica");
    }
}

function dodajKlasu(element, naziv) {
    var i, el, ime;
    el = element.className.split(" ");
    ime = naziv.split(" ");
    for (i = 0; i < ime.length; i++) {
        if (el.indexOf(ime[i]) == -1) {
            element.className += " " + ime[i];
        }
    }
}

function makniKlasu(element, naziv) {
    var i, el, ime;
    el = element.className.split(" ");
    ime = naziv.split(" ");
    for (i = 0; i < ime.length; i++) {
        while (el.indexOf(ime[i]) > -1) {
            el.splice(el.indexOf(ime[i]), 1);
        }
    }
    element.className = el.join(" ");
}

var divTablica = document.getElementById("divTablica");
var gumb = divTablica.getElementsByClassName("gumbTablica");
for (var i = 0; i < gumb.length; i++) {
    gumb[i].addEventListener("click", function () {
        var current = document.getElementsByClassName("aktivno");
        current[0].className = current[0].className.replace(" aktivno", "");
        this.className += " aktivno";
    });
}
var text = "";

function glavnaFunkcija() {
    var x = document.getElementsByTagName("TBODY");
    var i;
    var obj;
    for (i = 0; i < x.length; i++) {
        var obj = "";
        obj = x[i].id;
        mojaFunkcija(obj, 0, 10);

    }
    mojaFunkcija3();
}
function mojaFunkcija(polje, broj1, broj2) {
    var xmlhttp;
    var txt = "";
    var objekt = "";
    var x = "";
    var id = "";
    var obj = JSON.stringify(polje);
    var id = polje;
    var i = broj1;
    var k = broj2;
    var brojac;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
        } else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            objekt = JSON.parse(this.responseText);
            if (objekt.length < i) {
                document.getElementById(id).innerHTML = "<br><br><br><p>Nema podatka</p>";
            } else {
                if (objekt.length < k) {

                    brojac = objekt.length;
                } else {
                    brojac = k;
                }

                for (i; i < brojac; i++) {
                    txt += "<tr>" + "<td><input type='checkbox' name='checkbox' id='checkbox' value='" + objekt[i][0] + "'></td>";
                    txt += "<td>";
                    txt += "<span class='operacijskiGumbi'><a class='link-ikona' href='javascript:uredi(\"tr" + id + objekt[i][0] + "\",\"" + id + "\");'";
                    txt += "  title='Uredi'><img src='multimedija/olovka.png'/></a></span>";
                    txt += "<span class='operacijskiGumbi'><a class='link-ikona' href='javascript:izbrisi(\"" + id + "\"," + objekt[i][0] + ");'";
                    txt += "  title='Izbriši'><img src='multimedija/izbrisi.png'/></a></span>";
                    txt += "</td>";
                    for (var j = 0; j < objekt[i].length; j++) {
                        txt += "<td contenteditable='false' name='tr" + id + objekt[i][0] + "'>" + objekt[i][j] + "</td>";
                    }
                    txt += "</tr>";
                }
            }
            document.getElementById(id).innerHTML = txt;
        } else {
        }
    }

    xmlhttp.open("GET", "tablicapunjenje.php?polje=" + obj, true);
    xmlhttp.send();
}



function izbrisi(naziv, idPolja) {

    var xmlhttp;
    var txt = "";
    var objekt = "";
    var id = ""
    var x = JSON.stringify(idPolja);
    var obj = JSON.stringify(naziv);
    id = naziv + "Brisanje";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
            document.getElementById("demo").innerHTML = "Validating..";
        } else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            objekt = JSON.parse(this.responseText);
            document.getElementById(id).innerHTML = "Uspješno ste obrisali element";
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeTablicaBrisanje.php?tablica=" + obj + "&id=" + x, true);
    xmlhttp.send();
    mojaFunkcija(naziv, 0, 10);
}
function uredi(idretka, idTablica) {
    var mjenjanjeRed = document.getElementsByName(idretka);
    var i;
    for (i = 0; i < mjenjanjeRed.length; i++) {
        mjenjanjeRed[i].setAttribute("contenteditable", true);
    }
    var tablica = "";
    tablica += idTablica + "Uredivanje";
    var txt = "";
    txt += "<a class='gumb' id='dodaj' href='javascript:spremiUredeno(\"" + idretka + "\",\"" + idTablica + "\");'>Dodaj</a>";
    document.getElementById(tablica).innerHTML = txt;
}
function spremiUredeno(idRetka, idTablica) {
    var mjenjanjeRed = [];
    mjenjanjeRed = document.getElementsByName(idRetka);
    var i;
    var dataZaJSON = [];
    for (i = 0; i < mjenjanjeRed.length; i++) {
        mjenjanjeRed[i].setAttribute("contenteditable", false);
        dataZaJSON[i] = mjenjanjeRed[i].textContent;
    }

    var xmlhttp;
    var id = ""
    var obj = [];
    id += idTablica + "Uredivanje";
    var x = JSON.stringify(idTablica);
    obj = JSON.stringify(dataZaJSON);
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
        } else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(id).innerHTML = "Uspješno ste uredili element";
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeTablicaUredivanje.php?tablica=" + x + "&id=" + obj, true);
    xmlhttp.send();
    mojaFunkcija(idTablica, 0, 10);
}


function dodajNovi(tablica, n) {
    var txt = "";
    txt += "<tr id='novi'>" + "<td><input type='checkbox' name='checkbox' id='checkbox' value=''></td>";
    txt += "<td> /</td>";
    txt += "<td  name='trNovi'>null</td>";
    for (var i = 1; i < n; i++) {
        txt += "<td contenteditable='true' class='noviPodaci' name='trNovi'></td>";
    }
    txt += "</tr>";

    document.getElementById(tablica).innerHTML += txt;

    var text = "";
    text += "<a class='gumb' id='dodaj' href='javascript:spremiDodano(\"trNovi\",\"" + tablica + "\");'>Dodaj</a>";
    var tablicaP = "";
    tablicaP += tablica + "Uredivanje";
    document.getElementById(tablicaP).innerHTML = text;
}
function sortiraj(oznaka, tablica) {
    var xmlhttp;
    var txt = "";
    var objekt = "";
    var x = "";
    var id = "";
    var obj2 = JSON.stringify(oznaka);
    var obj = JSON.stringify(tablica);
    id = tablica;
    console.log("da");
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
            document.getElementById("demo").innerHTML = "Validating..";
        } else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            objekt = JSON.parse(this.responseText);
            for (var i = 0; i < objekt.length; i++) {
                txt += "<tr>" + "<td><input type='checkbox' name='checkbox' id='checkbox' value='" + objekt[i][0] + "'></td>";
                txt += "<td>";
                txt += "<span class='operacijskiGumbi'><a class='link-ikona' href='javascript:uredi(\"tr" + id + objekt[i][0] + "\",\"" + id + "\");'";
                txt += "  title='Uredi'><img src='multimedija/olovka.png'/></a></span>";
                txt += "<span class='operacijskiGumbi'><a class='link-ikona' href='javascript:izbrisi(\"" + id + "\"," + objekt[i][0] + ");'";
                txt += "  title='Izbriši'><img src='multimedija/izbrisi.png'/></a></span>";
                txt += "</td>";
                txt += "<td  name='tr" + id + objekt[i][0] + "'>" + objekt[i][0] + "</td>";
                for (var j = 1; j < objekt[i].length; j++) {
                    txt += "<td contenteditable='false' name='tr" + id + objekt[i][0] + "'>" + objekt[i][j] + "</td>";
                }
                txt += "</tr>";
            }
            document.getElementById(id).innerHTML = txt;
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeTablicaSort.php?polje=" + obj + "&oznaka=" + obj2, true);
    xmlhttp.send();
}



function stranicenje(tablica, ofset) {
    var naziv="broj"+tablica;
    var broj=parseInt(document.getElementById(naziv).value);
    var x=parseInt(document.getElementById("stranice").value);
    var i = 0;
    var k = 0;
    var c = broj;
    broj += ofset;
    
    if (broj >= 0) {
        i = broj * x;
        k = i + x;
        mojaFunkcija(tablica, i, k);
        
    } else {
        broj = c;
    }
    document.getElementById(naziv).value=broj;
}

function popraviStranicenje(){
    var broj=parseInt(document.getElementById("stranice").value);
    var x = document.getElementsByTagName("TBODY");
    var i;
    var obj;
    for (i = 0; i < x.length; i++) {
        var obj = "";
        obj = x[i].id;
        stranicenje(obj, 0, broj);

    }
}


function spremiDodano(idRetka, idTablica) {
    var mjenjanjeRed = [];
    mjenjanjeRed = document.getElementsByName(idRetka);
    var i;
    var dataZaJSON = [];
    for (i = 0; i < mjenjanjeRed.length; i++) {
        mjenjanjeRed[i].setAttribute("contenteditable", false);
        dataZaJSON[i] = mjenjanjeRed[i].textContent;
    }



    var xmlhttp;
    var id = ""
    var obj = [];
    id += idTablica + "Uredivanje";
    var x = JSON.stringify(idTablica);
    obj = JSON.stringify(dataZaJSON);
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
        } else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById(id).innerHTML = "Uspješno ste uredili element";
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeTablicaDodavanje.php?tablica=" + x + "&id=" + obj, true);
    xmlhttp.send();
    mojaFunkcija(idTablica, 0, 10);
}


function mojaFunkcija3() {
    var xmlhttp;
    var objekt = "";
    var obj = JSON.stringify("iva");
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
            document.getElementById("moderatorSelect").innerHTML = txt;
        } else {
        }
    }
    xmlhttp.open("GET", "punjenjeSelectModerator.php?id=" + obj, true);
    xmlhttp.send();
    mojaFunkcija4();

}

function mojaFunkcija4() {
    var xmlhttp;
    var objekt = "";
    var obj = JSON.stringify("iva");
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
            document.getElementById("grupaSelect").innerHTML = txt;
        } else {
        }
    }
    xmlhttp.open("GET", "punjenjeSelectGrupa.php?id=" + obj, true);
    xmlhttp.send();
}


function dodijeliModeratora() {
    var grupa = document.getElementById("grupaSelect").value;
    var moderator = document.getElementById("moderatorSelect").value;
    var obj1 = JSON.stringify(grupa);
    var obj2 = JSON.stringify(moderator);
    var txt = "";

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert("Uspješno ste dodijelii moderatora");
        } else {
        }
    }
    xmlhttp.open("GET", "punjenjeDodjelaGrupeModeratoru.php?moderator=" + obj2+"&grupa="+obj1, true);
    xmlhttp.send();

}