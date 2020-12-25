<?php

include "baza.class.php";
$baza = new BazaPod();
if (isset($_GET['pin']) && isset($_GET['ocjena'])) {
    $pin = json_decode($_GET['pin'], false);
    $ocjena = json_decode($_GET['ocjena'], false);
    $sqlUpit = "SELECT korisnik.idKorisnik FROM korisnik INNER JOIN termin ON termin.idKorisnikM=korisnik.idKorisnik INNER JOIN pohadaTermin ON pohadaTermin.idTermin=termin.idTermin INNER JOIN zahtjev_upis ON pohadaTermin.idKorisnik=zahtjev_upis.idZahtjev_upis AND zahtjev_upis.pin='" . $pin . "'";
    if ($rezultat = $baza->selectDB($sqlUpit)) {
        $value = mysqli_fetch_object($rezultat);
        $datum = date("Y-m-d");
        $sqlUpit2 = "INSERT INTO ocjena VALUES(null,'" . $datum . "','" . $ocjena . "','" . $value->idKorisnik . "','" . $pin . "')";
        if ($rezultat = $baza->izvrsiDB($sqlUpit2)) {
            $sqlUpit3 = "UPDATE zahtjev_upis SET pin = '0' WHERE pin ='" . $pin . "'";
            if ($rezultat = $baza->izvrsiDB($sqlUpit3)) {
                echo 'da';
            }
        } else {
            echo 'ne';
        }
    } else {
        echo 'ne';
    }
} else {
    echo "ne";
}


