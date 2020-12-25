<?php
include "baza.class.php";
$baza = new BazaPod();
$id = $_COOKIE['id'];
if (isset($_GET['polje'])) {
    $idO =json_decode($_GET['polje'],false);
    $sqlUpit = "SELECT oglas.idOglas, status, oglas.naziv, url, opis, slika, aktivanDatumVrijeme, ZavrsetakAktivnosti  FROM oglas INNER JOIN vrsta_oglasa ON vrsta_oglasa.idVrsta_oglasa=oglas.idVrstaOglasa INNER JOIN pozicija on vrsta_oglasa.idPozicija=pozicija.idPozicija AND pozicija.idPozicija='".$idO."' AND pozicija.idKorisnikM='".$id."'";
    
    $rezultat = $baza->selectDB($sqlUpit);
    if (mysqli_num_rows($rezultat) > 0) {
        for ($set = array(); $row = $rezultat->fetch_array(MYSQLI_NUM); $set[] = $row);
        echo json_encode($set);
    }
}