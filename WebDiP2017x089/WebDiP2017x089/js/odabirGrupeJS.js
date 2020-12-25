
var text = "";

function funkcija() {
    document.getElementById("divModerator").classList.add("sakrij");


    var x = document.getElementsByTagName("TBODY");
    var i;
    var obj;
    for (i = 0; i < x.length; i++) {

        var obj = "";
        obj = x[i].id;
        if (obj == "grupa") {
            mojaFunkcija(obj);
        } else {
            mojaFunkcija2(obj);
        }
    }
    var id = "grupaSelect";
    mojaFunkcija3(id);
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

    xmlhttp.open("GET", "punjenjeTablicaOdabirGrupe.php?polje=" + obj, true);
    xmlhttp.send();
}


function mojaFunkcija2(polje) {
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
                txt += "<tr onclick='trclick2(id)'id='a" + objekt[i][0] + "'>";
                for (var k = 0; k < 3; k++) {
                    txt += "<td class='sakrij'>" + objekt[i][k] + "</td>"
                }
                for (var j = 3; j < objekt[i].length; j++) {
                    txt += "<td>" + objekt[i][j] + "</td>";
                }
                txt += "</tr>";
            }
            document.getElementById(id).innerHTML = txt;
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeTablicaOdabirGrupe.php?polje=" + obj, true);
    xmlhttp.send();
}


function trclick(id) {
    document.getElementById("divModerator").classList.add("prikazi");
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
            for (var i = 0; i < objekt.length; i++) {
                txt += "<tr>";
                txt += "<td>" + objekt[i][0]+" "+objekt[i][1]+ "</td>";
                txt += "<td>" + objekt[i][2] + "</td>";
                txt += "</tr>";
            }
            document.getElementById("moderatori").innerHTML = txt;
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeTablicaPrikazModeratora.php?id=" + obj, true);
    xmlhttp.send();

}



function trclick2(id) {
    
    var ime = document.getElementById("ime");
    var prezime = document.getElementById("prezime");
    var email = document.getElementById("email");
    var dob = document.getElementById("dob");
    var dobG = document.getElementById("dobG");
    var stanje;
    var e = document.getElementById("selectGrupa");
    var grupa = e.options[e.selectedIndex].value;
   
    stanje = true;
    document.getElementById("formaZahtjev").addEventListener("submit", function (event) {
        if (ime.value == "" || prezime.value == "" || email.value == "" || dob.value.length == 0) {
            dobG.innerHTML = "Morate upisati sve podatke!"
            event.preventDefault();
            stanje = false;
        } else {
            event.preventDefault();
            mojaFunkcija4(email.value, ime.value, prezime.value, grupa);
        }
    }, false);
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
            for (var i = 0; i < objekt.length; i++) {
                txt += "<option value='" + objekt[i][0] + "'>" + objekt[i][1] + "</option>";
            }
            document.getElementById("grupaSelect").innerHTML = txt;
        } else {
        }
    }

    xmlhttp.open("GET", "popisGrupa.php?id=" + obj, true);
    xmlhttp.send();

}

function mojaFunkcija4(email, ime, prezime, grupa) {
    var xmlhttp;
    var x=[grupa, ime, prezime, email];
    var obj = JSON.stringify(x);

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            console.log("u redu je!");
        } else {
        }
    }

    xmlhttp.open("GET", "slanjeZahtjevaZaUpis.php?arr=" + obj, true);
    xmlhttp.send();
    funkcija();
}
function searchFunkcijaM() {
  var input, filter, tablica, tr, td, i;
  input = document.getElementById("inputSearchM");
  filter = input.value.toUpperCase();
  tablica = document.getElementById("moderatoriTablicaS");
  tr = tablica.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}