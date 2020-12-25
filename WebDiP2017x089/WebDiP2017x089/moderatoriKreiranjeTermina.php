<?php

include "baza.class.php";
$baza = new BazaPod();
$virtualnoVrijeme;
$id = $_COOKIE['id'];
$sqlUpit = "SELECT pomak FROM virtualno_vrijeme";
if ($rezultat = $baza->selectDB($sqlUpit)) {
    $value = mysqli_fetch_object($rezultat);
    $virtualnoVrijeme = $value->pomak * 60 * 60;
}
$stanje = true;
$arr = [];
if (isset($_GET['arr'])) {
    $arr = json_decode($_GET['arr'], false);
    $datumSad = date_add((new DateTime()), date_interval_create_from_date_string('' . $virtualnoVrijeme . ' seconds'));
    $datum = $datumSad->format('Y-m-d H:i:s');
    $sqlUpit = "select datumPocetka, datumZavrsetka, od, do, danVrijemeOdrzavanja  from termin where idKorisnikM='" . $id . "'";
    $rezultat = $baza->selectDB($sqlUpit);
    if (mysqli_num_rows($rezultat) > 0) {
        for ($set = array(); $row = $rezultat->fetch_array(MYSQLI_NUM); $set[] = $row)
            ;
        for ($i = 0; $i < $set . length; $i++) {
            if ($arr[2] >= $set[i][0] && $arr[2] <= $set[i][1] && $arr[6] == $set[i][4] || $arr[3] <= $set[i][1] && $arr[3] >= $set[i][0] && $arr[6] == $set[i][4]) {
                if ($arr[4] > $set[i][2] && $arr[4] < $set[i][3] || $arr[5] < $set[i][3] && $arr[5] > $set[i][2]) {
                    $stanje = false;
                }
            }
        }
        if ($stanje == true) {
            $sqlUpit = "INSERT INTO termin VALUES (null,'" . $arr[0] . "','" . $id . "','" . $arr[1] . "','" . $arr[2] . "','" . $arr[3] . "','" . $arr[6] . "','" . $arr[7] . "','" . $arr[4] . "','" . $arr[5] . "')";
            $rezultat = $baza->izvrsiDB($sqlUpit);
            if (mysqli_num_rows($rezultat) > 0) {
                       echo 'da';
            }
        } else {
            echo 'Kolizija termina';
        }
    }
}

    