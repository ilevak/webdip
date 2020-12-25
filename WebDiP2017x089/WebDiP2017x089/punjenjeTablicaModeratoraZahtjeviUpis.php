<?php
include "baza.class.php";
$baza = new BazaPod();
$id = $_COOKIE['id'];
if (isset($_GET['polje'])) {
    $idG =json_decode($_GET['polje'],false);
    $sqlUpit="SELECT zahtjev_upis.idZahtjev_upis, zahtjev_upis.status, zahtjev_upis.Ime, zahtjev_upis.prezime, zahtjev_upis.email FROM zahtjev_upis WHERE zahtjev_upis.idGrupa='".$idG."'";
   
    $rezultat = $baza->selectDB($sqlUpit);
    if (mysqli_num_rows($rezultat) > 0) {
        for ($set = array(); $row = $rezultat->fetch_array(MYSQLI_NUM); $set[] = $row);
        echo json_encode($set);
    }
}