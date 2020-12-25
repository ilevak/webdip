var text="";
function mojaFunkcija(){
   var x = document.getElementsByTagName("TBODY");
    var i;
    var text = "";
    for (i = 0; i < x.length; i++) {
    text += x[i].id + "<br>";
}
document.getElementById("demo").innerHTML = text;
}

