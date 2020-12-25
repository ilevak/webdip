function funkcijaOglasi(){
    
    
    var arr=document.getElementsByClassName("oglasi");
    for(var i=0; i<arr.length; i++){
        pronadiSliku(arr[i].id);
    }
}
function pronadiSliku(red){
    var xmlhttp;
    var txt = "";
    var objekt = "";
    var x = "";
    var obj = JSON.stringify(red);
    var id = red;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
        } else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            objekt = JSON.parse(this.responseText);
                txt +="<div class='oglasSlika'><a href="+objekt[1]+"><image src="+objekt[2]+"></a></div>";
            document.getElementById(id).innerHTML = txt;
        } else {
        }
    }

    xmlhttp.open("GET", "punjenjeOglasiSlike.php?oglas=" + obj, true);
    xmlhttp.send();

}