var prozor = document.getElementById('iskocniProzor');
var gumb = document.getElementById('gumbUvjetiKoristenja')
$(document).ready(function () {
    prozor.style.display = "block";

    $("#gumbUvjetiKoristenja").click(function () {
        $.ajax({
            url: 'cookieUvjetiKoristenja.php',
            dataType: 'json',
            success: function (data) {

            }
        });
        prozor.style.display = "none";
    });
    
});