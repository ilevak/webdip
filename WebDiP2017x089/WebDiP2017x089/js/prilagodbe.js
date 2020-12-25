 window.onscroll = function() {myFunction()};

function myFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50){
        var element=document.getElementById("navigacijaId");
        element.classList.add("on");
        
    } else {
        var element=document.getElementById("navigacijaId");
        element.classList.remove("on");
    }
}


