
<?php

include 'baza.class.php';
$baza = new BazaPod();
if (isset($_GET['polje'])) {
    $formpolje = json_decode($_GET['polje'], false);
    $sqlUpit = "SELECT * FROM ". $formpolje ."";
    if($formpolje=="termin"){
        
    $sqlUpit = "SELECT termin.*, grupa.naziv, grupa.kategorija  FROM termin INNER JOIN grupa ON termin.idGrupa=grupa.idGrupa";
    }
    $rezultat = $baza->selectDB($sqlUpit);
    if (mysqli_num_rows($rezultat) > 0) {
        for ($set = array (); $row = $rezultat->fetch_array(MYSQLI_NUM); $set[] = $row);
        echo json_encode($set);
    }
} else {
    $formpolje = "";
    echo "ne";
}


