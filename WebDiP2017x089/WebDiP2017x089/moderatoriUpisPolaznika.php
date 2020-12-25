<?php

include 'baza.class.php';
$baza = new BazaPod();
$id = $_COOKIE['id'];
if (isset($_GET['termin']) && isset($_GET['zahtjev'])) {
    $termin = json_decode($_GET['termin'], false);
    $zahtjev = json_decode($_GET['zahtjev'], false);
    $sqlUpit = "SELECT * FROM pohadaTermin WHERE idTermin='" . $termin . "' AND idKorisnik='" . $zahtjev . "'";
    $rezultat = $baza->selectDB($sqlUpit);
    if (mysqli_num_rows($rezultat) == 0) {
        $sqlUpit = "SELECT polaznika FROM termin WHERE idTermin='" . $termin . "'";
        $rezultat = $baza->selectDB($sqlUpit);
        if (mysqli_num_rows($rezultat) == 1) {
            $terminOdr = $rezultat->fetch_assoc();
            if ($terminOdr['polaznika'] > 0) {
                $sqlUpit = "INSERT INTO pohadaTermin VALUES('" . $zahtjev . "','" . $termin . "')";
                if ($baza->izvrsiDB($sqlUpit)) {
                    $sqlUpit = "UPDATE termin SET polaznika=(polaznika-1) WHERE idTermin='" . $termin . "'";
                    $baza->izvrsiDB($sqlUpit);
                    $sqlUpit = "UPDATE zahtjev_upis SET status='1' WHERE zahtjev_upis.IdZahtjev_upis='" . $zahtjev . "'";
                    if ($baza->izvrsiDB($sqlUpit)) {
                        echo 'da';
                        $sqlUpit = "SELECT email, pin FROM zahtjev_upis WHERE idZahtjev_upis='" . $zahtjev . "'";
                        $rezultat = $baza->selectDB($sqlUpit);
                        if (mysqli_num_rows($rezultat) > 0)
                            $zahtjevOdr = $rezultat->fetch_assoc();

                        $prima = $zahtjevOdr['email'];
                        $predmet = 'Ocjena moderatora';
                        $poruka = ' 
                    Hvala što ste se upisali u termin!
                    Kroz sljedeće trnutke moderator će vas odbiti ili prihvatiti na terminu!
                    Nakon toga moći ćete ocijeniti moderator za terminn koji pohađate!
                    ------------------------------------
                    Lozinka: ' . $zahtjevOdr['pin'] . '
                    ------------------------------------
                   
                ';

                        $header = 'From:noreply@autoskola.com' . "\r\n";
                        mail($prima, $predmet, $poruka, $header);
                    }
                }
            }
        }
    }
}

    