
var text = "";
var x = [];
$(document).ready(function () {
    $("#divModerator").addClass("sakrij");
    $("#zahtjev").addClass("sakrij");
    $("tbody").each(function () {
        if ($(this).attr("id") == "grupa") {
            mojaFunkcija($(this));
        } else {
            mojaFunkcija2($(this));
        }
    });
});


function mojaFunkcija($this) {
    $.ajax({
        url: "punjenjeTablicaOdabirGrupe.php",
        type: "GET",
        dataType: "xml",
        data: {polje: $this},
        async: false,
        success: function (json) {
            var data=json_decode(json);
            $.each(data, function (val) {
                $.each(val, function (vval) {
                });
            });
        }}
    );

}
