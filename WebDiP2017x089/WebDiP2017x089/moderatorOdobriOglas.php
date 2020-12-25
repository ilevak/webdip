<?php
include 'baza.class.php';
$baza = new BazaPod();
$id = $_COOKIE['id'];
if (isset($_GET['zahtjev'])) {
    $zahtjev = json_decode($_GET['zahtjev'], false);
    
    foreach($zahtjev as $idO){
     $sqlUpit="UPDATE oglas SET status='1' WHERE idOglas='".$idO."'";
     $baza->izvrsiDB($sqlUpit);
    }
    

}
