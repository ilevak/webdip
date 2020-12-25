<?php
include "baza.class.php";
$baza=new BazaPod();

$virtualnoVrijeme;
$sqlUpit = "SELECT pomak FROM virtualno_vrijeme";
if ($rezultat = $baza->selectDB($sqlUpit)) {
    $value = mysqli_fetch_object($rezultat);
    $virtualnoVrijeme = $value->pomak * 60 * 60;
}


$arr=[];

$datumSad = date_add((new DateTime()), date_interval_create_from_date_string('' . $virtualnoVrijeme . ' seconds'));
            $datum = $datumSad->format('Y-m-d H:i:s');
if(isset($_GET["arr"])){
    $arr=json_decode($_GET['arr'], false);
    $arr[0]=4;
    
    $sqlUpit="INSERT INTO zahtjev_blokiranje VALUES ( null,'".$arr[1]."','".$datum."','".$arr[0]."')";
    if($rezultat=$baza->izvrsiDB($sqlUpit)){
        echo 'da';
        
    }
}else{
    echo "ne";
}


