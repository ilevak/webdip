<?php

include "baza.class.php";
$baza = new BazaPod();
$arr = [];
if (isset($_GET["arr"])) {
    $arr = json_decode($_GET['arr'], false);
    $sqlUpit = "INSERT INTO vrsta_oglasa  VALUES ( NULL,'" . $arr[0] . "','" . $arr[1] . "','" . $arr[2] . "','" . $arr[3] . "','" . $arr[4] . "')";
    if ($rezultat = $baza->izvrsiDB($sqlUpit)) {
        echo 'da';
    }
} else {
    echo "ne";
}

