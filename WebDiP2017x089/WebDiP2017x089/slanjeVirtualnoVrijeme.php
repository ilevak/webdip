<?php
sleep(1);
session_start();
include 'baza.class.php';
$baza = new BazaPod();
$url = "http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=xml";

if (!($fp = fopen($url, 'r'))) {
    echo "Problem: nije moguće otvoriti url: " . $url;
    exit;
}

$xml_string = fread($fp, 10000);
fclose($fp);

$domdoc = new DOMDocument;
$domdoc->loadXML($xml_string);

$params = $domdoc->getElementsByTagName('brojSati');
$sati = 0;

if ($params != NULL) {
    $sati = $params->item(0)->nodeValue;
}
$sqlUpit="UPDATE virtualno_vrijeme SET pomak='".$sati."' WHERE idVirtualno_vrijeme='1'";
$baza->izvrsiDB($sqlUpit);

header('Location: tablica.php');
?>
