<?php

include 'baza.class.php';
$baza = new BazaPod();
if (isset($_GET['moderator']) && isset($_GET['grupa'])) {
    $moderator = json_decode($_GET['moderator'], false);
    $grupa = json_decode($_GET['grupa'], false);
    $sqlUpit = "INSERT INTO zaduženost VALUES ('".$moderator."','".$grupa."')";
    $rezultat = $baza->izvrsiDB($sqlUpit);
}