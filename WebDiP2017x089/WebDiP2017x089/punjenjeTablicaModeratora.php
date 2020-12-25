<?php

include "baza.class.php";
$baza = new BazaPod();
$id = $_COOKIE['id'];
if (isset($_GET['id'])) {
    $naziv=json_decode($_GET['id'], false);
    $sqlUpit = "SELECT grupa.idgrupa, naziv FROM grupa INNER JOIN zaduženost ON idKorisnik='" . $id . "' AND grupa.idGrupa=zaduženost.idGrupa";
    
    $rezultat = $baza->selectDB($sqlUpit);
    if (mysqli_num_rows($rezultat) > 0) {
        for ($set = array(); $row = $rezultat->fetch_array(MYSQLI_NUM); $set[] = $row)
            ;
        echo json_encode($set);
    }
} else {
    echo 'ne';
}
