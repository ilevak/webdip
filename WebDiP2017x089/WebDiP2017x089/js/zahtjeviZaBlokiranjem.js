var txt = '';
function prikaziZahtjev(red) {
    document.getElementById('zahtjevZaUkl').classList.remove("sakrij");
    txt += '<div id="iskocniProzor" style="display:block"  class="iskocniProzor">';
    txt += '<div class="sadrzajIskocniProzor tekstCentar" ><div>Zašto ne želite da vam se prikazuje ovaj sadržaj?</div>';
    txt+='<select id="selectRazlog" name="selectRazlog" class="dropdownRazlog">';
    txt+='<option value="nevazeci url">Nevažeći url</option>';
     txt+='<option value="neprimjeren sadrzaj">Neprimjeren sadržaj</option>';
      txt+='<option value="url ne odgovara slici">Url ne odgovara slici</option>';
       txt+='<option value="ne zelim ga vidjeti">Ne zanima me</option>';
    txt+='</select>';
    txt+='<button id="gumbUvjetiKoristenja" class="gumbTablicaForma" onclick="posaljiZahtjevZaBlokiranjem(\''+red+'\')">Prihvaćam</button></div>';
    txt += '</div>';
    document.getElementById('zahtjevZaUkl').innerHTML = txt;
    
}
function posaljiZahtjevZaBlokiranjem(oglas){
    document.getElementById('zahtjevZaUkl').classList.add("sakrij");
    var x=document.getElementById('selectRazlog').value;
    console.log(x);
     var arr = [oglas, x];
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

        xmlhttp.open("GET", "slanjeZahtjevaZaBlokiranje.php?arr=" + obj, true);
        xmlhttp.send();
        return false;
    
    
    
}


