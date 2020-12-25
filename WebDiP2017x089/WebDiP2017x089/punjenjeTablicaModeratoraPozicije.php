<?php

include_once 'baza.class.php';
$baza = new BazaPod();
$id = $_COOKIE['id'];
$sqlUpit = "SELECT pozicija.* FROM pozicija WHERE idKorisnikM='".$id."'";
$rezultat = $baza->selectDB($sqlUpit);
if (mysqli_num_rows($rezultat) > 0) {
    for ($set = array(); $row = $rezultat->fetch_array(MYSQLI_NUM); $set[] = $row);
    echo json_encode($set);
}