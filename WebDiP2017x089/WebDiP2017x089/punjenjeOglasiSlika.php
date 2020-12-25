<?php

include 'baza.class.php';
$baza = new BazaPod();
if (isset($_GET['oglas'])) {
    $id = $_GET['oglas'];
    $sqlUpit = "SELECT oglas.naziv, oglas.url, oglas.slika FROM pozicija WHERE lokacija=".$id."  INNER JOIN vrsta_oglasa on vrsta_oglasa.idPozicija=pozicija.idPozicija INNER JOIN oglas on oglas.idVrstaOglasa=vrsta_oglasa.idVrstaOglasa ";
    $rezultat = $baza->selectDB($sqlUpit);
    if (mysqli_num_rows($rezultat) > 0) {
        for ($set = array(); $row = $rezultat->fetch_array(MYSQLI_NUM); $set[] = $row)
            ;
        echo json_encode($set);
    }
} else {
    $id = "";
    echo "ne";
}
