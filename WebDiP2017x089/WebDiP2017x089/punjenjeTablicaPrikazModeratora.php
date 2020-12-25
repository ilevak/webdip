
<?php

include 'baza.class.php';
$baza = new BazaPod();
if (isset($_GET['id'])) {
    $formid = json_decode($_GET['id'], false);
        $sqlUpit="SELECT korisnik.ime, korisnik.prezime, AVG(ocjena.ocjena) FROM korisnik INNER JOIN zaduženost ON korisnik.idkorisnik=zaduženost.idKorisnik INNER JOIN grupa ON zaduženost.idGrupa=".$formid."  LEFT JOIN ocjena ON ocjena.idKorisnikM=korisnik.idKorisnik";
        $rezultat2=$baza->selectDB($sqlUpit);
        if (mysqli_num_rows($rezultat2) > 0) {
            for ($set = array (); $row = $rezultat2->fetch_array(MYSQLI_NUM); $set[] = $row);

            echo json_encode($set);
            
            
            }
} else {
    $formpolje = "";
    echo "ne";
}


