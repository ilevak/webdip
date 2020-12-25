<?php

include_once 'baza.class.php';
$baza = new BazaPod();
if (isset($_GET['polje'])) {
    $id = json_decode($_GET['polje'], false);
    $sqlUpit = "SELECT idOglas, razlog, datum FROM zahtjev_blokiranje WHERE idOglas='" . $id . "' ORDER BY datum ASC";
    $rezultat = $baza->selectDB($sqlUpit);
    if (mysqli_num_rows($rezultat) > 0) {
        for ($set = array(); $row = $rezultat->fetch_array(MYSQLI_NUM); $set[] = $row) ;
        echo json_encode($set);
    }
}