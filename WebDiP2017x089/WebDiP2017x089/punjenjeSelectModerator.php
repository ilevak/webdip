<?php

include 'baza.class.php';
$baza = new BazaPod();

$sqlUpit="SELECT idKorisnik, ime, prezime FROM korisnik WHERE tip='moderator'";
$rezultat = $baza->selectDB($sqlUpit);
if (mysqli_num_rows($rezultat) > 0) {
    for ($set = array(); $row = $rezultat->fetch_array(MYSQLI_NUM); $set[] = $row)
        ;
    echo json_encode($set);
}
