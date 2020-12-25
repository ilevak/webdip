<?php

include 'pdf/fpdf.php';
include 'baza.class.php';
$sqlUpit = "SELECT * FROM korisnik";
$baza = new BazaPod();
$rezultat = $baza->selectDB($sqlUpit);
$broj = mysqli_num_rows($rezultat);

$column_id = "";
$column_ime = "";
$column_prezime = "";
$column_email = "";
$column_korime = "";
$column_tip="";

while ($red = mysqli_fetch_array($rezultat)) {
    $id = $red['idkorisnik'];
    $korime = $red['korisnickoIme'];
    $ime = $red['ime'];
    $prezime = $red['prezime'];
    $email = $red['email'];
    $tip=$red['tip'];
    
    $column_id =$column_id.$id."\n";
    $column_ime =$column_ime.$ime."\n";
    $column_prezime =$column_prezime.$prezime."\n";
    $column_email =$column_email.$email."\n";
    $column_korime =$column_korime.$korime."\n";
     $column_tip =$column_tip.$tip."\n";
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
$pdf->Cell(30,6,'Ime',1,0,'L',1);
$pdf->SetX(45);
$pdf->Cell(30,6,'Prezime',1,0,'L',1);
$pdf->SetX(75);
$pdf->Cell(60,6,'Email',1,0,'L',1);
$pdf->SetX(135);
$pdf->Cell(35,6,'Korisnicko ime',1,0,'L',1);
$pdf->SetX(170);
$pdf->Cell(30,6,'Tip',1,0,'L',1);




$pdf->SetFont('Arial','B',12);
$pdf->SetY($tablica);
$pdf->SetX(5);
$pdf->MultiCell(10,6,$column_id,1,0,'L',1);

$pdf->SetY($tablica);
$pdf->SetX(15);
$pdf->MultiCell(30,6,$column_ime,1,0,'L',1);

$pdf->SetY($tablica);
$pdf->SetX(45);
$pdf->MultiCell(30,6,$column_prezime,1,0,'L',1);

$pdf->SetY($tablica);
$pdf->SetX(75);
$pdf->MultiCell(60,6,$column_email,1,0,'L',1);

$pdf->SetY($tablica);
$pdf->SetX(135);
$pdf->MultiCell(35,6,$column_korime,1,0,'L',1);
$pdf->SetY($tablica);
$pdf->SetX(170);
$pdf->MultiCell(30,6,$column_tip,1,0,'L',1);



$pdf->Output();