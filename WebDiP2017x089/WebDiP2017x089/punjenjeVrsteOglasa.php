<?php

include_once 'baza.class.php';
$baza = new BazaPod();

    $sqlUpit = "SELECT idVrsta_oglasa, pozicija.lokacija, pozicija.stranicaNaziv, naziv, trajanjePrikazivanja, frekvencijaIzmjene,cijena FROM vrsta_oglasa LEFT JOIN pozicija ON pozicija.idPozicija=vrsta_oglasa.idPozicija";
    $rezultat = $baza->selectDB($sqlUpit);
    if (mysqli_num_rows($rezultat) > 0) {
        for ($set = array(); $row = $rezultat->fetch_array(MYSQLI_NUM); $set[] = $row)
            ;
        echo json_encode($set);
        
    }


