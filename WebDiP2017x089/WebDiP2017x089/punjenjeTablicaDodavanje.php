<?php

include 'baza.class.php';
$baza=new BazaPod();
$tablica="";
$text='';
$status=false;
$polje=array();
if(isset($_GET['tablica']) && isset($_GET['id'])){
    $tablica=json_decode($_GET['tablica'],false);
    $id=json_decode($_GET['id'],false);
    $polje=$id;
    
    
        echo "da";
        $text.='( null,';
        for($i=1; $i<count($polje)-1; $i++){
            if($polje[$i]==null){
                $text.=' , ';
            }else{
            $text.='"'.$polje[$i].'", ';
            }
        }
        $brojac=count($polje)-1;
        $text.='"'.$polje[$brojac].'") ';
        
         $sqlUpit2="INSERT INTO ".$tablica." VALUES ".$text."";
         echo $sqlUpit2;
         if($rezultat2=$baza->izvrsiDB($sqlUpit2)){
            echo "da";
         }
    
    }
    