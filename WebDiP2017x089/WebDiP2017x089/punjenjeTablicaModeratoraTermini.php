<?php
include "baza.class.php";
$baza = new BazaPod();
$id = $_COOKIE['id'];
if (isset($_GET['polje'])) {
    $idG =json_decode($_GET['polje'],false);
    $sqlUpit = "SELECT termin.idTermin, grupa.naziv, grupa.kategorija,  termin.Vrsta_termina, termin.datumPocetka, termin.datumZavrsetka, termin.danVrijemeOdrzavanja, termin.od, termin.do, termin.polaznika  FROM termin INNER JOIN grupa ON termin.idGrupa=grupa.idGrupa AND termin.idGrupa='".$idG."' AND termin.idKorisnikM='".$id."'";
 
    $rezultat = $baza->selectDB($sqlUpit);
    if (mysqli_num_rows($rezultat) > 0) {
        for ($set = array(); $row = $rezultat->fetch_array(MYSQLI_NUM); $set[] = $row);
        echo json_encode($set);
    }
}