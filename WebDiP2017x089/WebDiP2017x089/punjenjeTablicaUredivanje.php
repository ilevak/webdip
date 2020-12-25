<?php

include 'baza.class.php';
$baza = new BazaPod();
$tablica = "";
$text = '';
$status = false;
$polje = array();
if (isset($_GET['tablica']) && isset($_GET['id'])) {
    $tablica = json_decode($_GET['tablica'], false);
    $id = json_decode($_GET['id'], false);
    $polje = $id;
    $idTablice = $polje[0];
        $idTablica = "";
        $idTablica = "id" . $tablica . "";
        $sqlUpit = "DELETE FROM " . $tablica . " WHERE " . $idTablica . "=" . $idTablice . "";
        $rezultat = $baza->izvrsiDB($sqlUpit);
    
    $text .= '( ';
    for ($i = 0; $i < count($polje) - 1; $i++) {
        $text .= '"' . $polje[$i] . '", ';
    }
    $brojac = count($polje) - 1;
    $text .= '"' . $polje[$brojac] . '") ';

    $sqlUpit2 = "INSERT INTO " . $tablica . " VALUES " . $text . "";
    echo $sqlUpit2;
    if ($rezultat2 = $baza->izvrsiDB($sqlUpit2)) {
        echo "da";
    }
}


    
