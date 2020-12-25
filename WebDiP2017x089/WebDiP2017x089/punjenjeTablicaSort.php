<?php

include 'baza.class.php';
$baza = new BazaPod();
if (isset($_GET['polje']) && isset($_GET['oznaka'])) {
    $polje = json_decode($_GET['polje'], false);
    $oznaka= json_decode($_GET['oznaka'], false);
    $sqlUpit = "SELECT * FROM ". $polje ." ORDER BY ".$oznaka." ASC";
    $rezultat = $baza->selectDB($sqlUpit);
    if (mysqli_num_rows($rezultat) > 0) {
        for ($set = array (); $row = $rezultat->fetch_array(MYSQLI_NUM); $set[] = $row);
        echo json_encode($set);
    }
} else {
    $polje = "";
    echo "ne";
}




