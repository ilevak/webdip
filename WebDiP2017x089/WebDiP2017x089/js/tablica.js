filtriraj("sve")
function filtriraj(podatak) {
  var klasaTablica, i;
  klasaTablica = document.getElementsByClassName("tablica");
  if (podatak == "sve") podatak = "";
  // Add the "prikaziTablica" class (display:block) to the filtered elements, and remove the "prikaziTablica" class from the elements that are not selected
  for (i = 0; i < klasaTablica.length; i++) {
    makniKlasu(klasaTablica[i], "prikaziTablica");
    if (klasaTablica[i].className.indexOf(podatak) > -1) dodajKlasu(klasaTablica[i], "prikaziTablica");
  }
}

// Show filtered elements
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

// Hide elements that are not selected
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

// Add aktivno class to the current control button (highlight it)
var divTablica = document.getElementById("divTablica");
var gumb = divTablica.getElementsByClassName("gumbTablica");
for (var i = 0; i < gumb.length; i++) {
  gumb[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("aktivno");
    current[0].className = current[0].className.replace(" aktivno", "");
    this.className += " aktivno";
  });
}
