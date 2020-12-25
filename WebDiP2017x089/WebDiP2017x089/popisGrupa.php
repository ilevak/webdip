<?php

include_once 'baza.class.php';
$baza = new BazaPod();

if (isset($_GET['id'])) {
    $sqlUpit = "SELECT idGrupa, naziv FROM grupa";
    $rezultat = $baza->selectDB($sqlUpit);
    if (mysqli_num_rows($rezultat) > 0) {
        for ($set = array(); $row = $rezultat->fetch_array(MYSQLI_NUM); $set[] = $row)
            ;
        echo json_encode($set);
    }
}
else{
    echo "ne";
}