<?php
include "baza.class.php";
$baza=new BazaPod();
$pin= mt_rand(100000, 999999);
$ip= $_SERVER['REMOTE_ADDR'];
$arr=[];
if(isset($_GET["arr"])){
    $arr=json_decode($_GET['arr'], false);
    $sqlUpit="INSERT INTO zahtjev_upis VALUES ( NULL,'".$arr[0]."','0','".$arr[1]."','".$arr[2]."','".$arr[3]."','".$pin."','".$ip."')";
    if($rezultat=$baza->izvrsiDB($sqlUpit)){
        echo 'da';
        
                
    }
}else{
    echo "ne";
}


