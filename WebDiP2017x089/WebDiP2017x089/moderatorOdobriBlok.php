<?php

include 'baza.class.php';
$baza = new BazaPod();
$id = $_COOKIE['id'];
if (isset($_GET['zahtjev'])) {
    $zahtjev = json_decode($_GET['zahtjev'], false);

    foreach ($zahtjev as $idO) {
        $sqlUpit = "UPDATE oglas SET status='2' WHERE idOglas='" . $idO . "'";
        $baza->izvrsiDB($sqlUpit);
        $sqlUpit = "SELECT email FROM korisnik INNER JOIN oglas ON  oglas.idKorisnik=korisnik.idKorisnik AND oglas.idOglas='" . $id0 . "'";

        $rezultat = $baza->izvrsiDB($sqlUpit);
        $zahtjevOdr = $rezultat->fetch_assoc();

        $prima = $zahtjevOdr['email'];
        $predmet = 'Oglas na stranici Autoškola DIK';
        $poruka = ' 
                    Vaš oglas je blokiran! Ako želite možete ga pogledati u svojoj galeriji!
                ';

        $header = 'From:noreply@autoskola.com' . "\r\n";
        mail($prima, $predmet, $poruka, $header);
    }
}
