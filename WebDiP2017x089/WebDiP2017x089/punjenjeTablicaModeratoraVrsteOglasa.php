<?php

include_once 'baza.class.php';
$baza = new BazaPod();
if (isset($_GET['polje'])) {
    $id = json_decode($_GET['polje'], false);
    $sqlUpit = "SELECT idVrsta_oglasa, `naziv`,`trajanjePrikazivanja`,`frekvencijaIzmjene`,`cijena` FROM vrsta_oglasa WHERE idPozicija='" . $id . "'";
    $rezultat = $baza->selectDB($sqlUpit);
    if (mysqli_num_rows($rezultat) > 0) {
        for ($set = array(); $row = $rezultat->fetch_array(MYSQLI_NUM); $set[] = $row) ;
        echo json_encode($set);
    }
}