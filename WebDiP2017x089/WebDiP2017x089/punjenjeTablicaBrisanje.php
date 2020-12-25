<?php

include 'baza.class.php';
$baza=new BazaPod();
$tablica="";
if(isset($_GET['tablica']) && isset($_GET['id'])){
    $tablica=json_decode($_GET['tablica'],false);
    $id= json_decode($_GET['id'],false);
    echo $tablica;
    echo $id;
    $idTablica="";
    echo $idTablica="id".$tablica."";
    $sqlUpit="DELETE FROM ".$tablica." WHERE ".$idTablica."=".$id."";
    
    if($baza->izvrsiDB($sqlUpit)){
        echo json_decode("Uspjesno ste obrisali redak!");
    }
    
}

