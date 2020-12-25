<?php

include 'pdf/fpdf.php';
include 'baza.class.php';
$sqlUpit = "SELECT *, grupa.naziv, ime, prezime FROM termin JOIN grupa ON grupa.idGrupa=termin.idGrupa LEFT JOIN korisnik ON korisnik.idKorisnik=termin.idKorisnikM";
$baza = new BazaPod();
$rezultat = $baza->selectDB($sqlUpit);
$broj = mysqli_num_rows($rezultat);

$column_idTermin = "";
$column_idGrupa = "";
$column_idKorisnikM = "";
$column_Vrsta_termina = "";
$column_datumPocetka = "";
$column_datumZavrsetka = "";
$column_danVrijemeOdrzavanja = "";
$column_polaznika="";
$column_do="";
$column_od="";

while ($red = mysqli_fetch_array($rezultat)) {
    $idTermin = $red['idTermin'];
    $idGrupa = $red['naziv'];
    $idKorisnikM= $red['ime']." ".$red['prezime']."\n";
    $Vrsta_termina = $red['Vrsta_termina'];
    $datumPocetka = $red['datumPocetka'];
    $datumZavrsetka = $red['datumZavrsetka'];
    $danVrijemeOdrzavanja = $red['danVrijemeOdrzavanja'];
    $polaznika = $red['polaznika'];
    $do = $red['do'];
    $od = $red['od'];
    
    $column_idTermin =$column_idTermin.$idTermin."\n";
    $column_idGrupa =$column_idGrupa.$idGrupa."\n";
    $column_idKorisnikM =$column_idKorisnikM.$idKorisnikM;
    $column_Vrsta_termina =$column_Vrsta_termina.$Vrsta_termina."\n";
    $column_datumPocetka =$column_datumPocetka.$datumPocetka."\n";
     $column_datumZavrsetka =$column_datumZavrsetka.$datumZavrsetka."\n";
     $column_danVrijemeOdrzavanja =$column_danVrijemeOdrzavanja.$danVrijemeOdrzavanja."\n";
     $column_polaznika =$column_polaznika.$polaznika."\n";
     $column_do =$column_do.$do."\n";
     $column_od =$column_od.$od."\n";
}

$pdf = new FPDF();
$pdf->AddPage();
$imePolja=20;
$tablica=26;

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',12);
$pdf->SetY($imePolja);
$pdf->SetX(5);
$pdf->Cell(10,6,'ID',1,0,'L',1);
$pdf->SetX(15);
$pdf->Cell(15,6,'Grupa',1,0,'L',1);
$pdf->SetX(30);
$pdf->Cell(27,6,'Vrsta',1,0,'L',1);
$pdf->SetX(57);
$pdf->Cell(25,6,'Pocetak',1,0,'L',1);
$pdf->SetX(82);
$pdf->Cell(25,6,'Zavrsetak',1,0,'L',1);
$pdf->SetX(107);
$pdf->Cell(27,6,'Dan:',1,0,'L',1);
$pdf->SetX(134);
$pdf->Cell(15,6,'Mjesta:',1,0,'L',1);
$pdf->SetX(149);
$pdf->Cell(19,6,'OD:',1,0,'L',1);
$pdf->SetX(168);
$pdf->Cell(19,6,'DO:',1,0,'L',1);




$pdf->SetFont('Arial','B',12);
$pdf->SetY($tablica);
$pdf->SetX(5);
$pdf->MultiCell(10,6,$column_idTermin,1,0,'L',1);
$pdf->SetY($tablica);
$pdf->SetX(15);
$pdf->MultiCell(15,6,$column_idGrupa,1,0,'L',1);
$pdf->SetY($tablica);
$pdf->SetX(30);
$pdf->MultiCell(27,6,$column_Vrsta_termina,1,0,'L',1);
$pdf->SetY($tablica);
$pdf->SetX(57);
$pdf->MultiCell(25,6,$column_datumPocetka,1,0,'L',1);
$pdf->SetY($tablica);
$pdf->SetX(82);
$pdf->MultiCell(25,6,$column_datumZavrsetka,1,0,'L',1);
$pdf->SetY($tablica);
$pdf->SetX(107);
$pdf->MultiCell(27,6,$column_danVrijemeOdrzavanja,1,0,'L',1);
$pdf->SetY($tablica);
$pdf->SetX(134);
$pdf->MultiCell(15,6,$column_polaznika,1,0,'L',1);
$pdf->SetY($tablica);
$pdf->SetX(149);
$pdf->MultiCell(19,6,$column_do,1,0,'L',1);
$pdf->SetY($tablica);
$pdf->SetX(168);
$pdf->MultiCell(19,6,$column_od,1,0,'L',1);





$pdf->Output();