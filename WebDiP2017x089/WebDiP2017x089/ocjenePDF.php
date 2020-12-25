<?php

include 'pdf/fpdf.php';
include 'baza.class.php';
$sqlUpit = "SELECT * FROM ocjena";
$baza = new BazaPod();
$rezultat = $baza->selectDB($sqlUpit);
$broj = mysqli_num_rows($rezultat);

$column_id = "";
$column_datum = "";
$column_ocjena = "";
$column_idModeratora = "";
$column_pin = "";

while ($red = mysqli_fetch_array($rezultat)) {
    $idOcjena = $red['idOcjena'];
    $datum = $red['datum'];
    $ocjena = $red['ocjena'];
    $idKorisnikM = $red['idKorisnikM'];
    $pin = $red['pin'];
    
    $column_id =$column_id.$idOcjena."\n";
    $column_datum =$column_datum.$datum."\n";
    $column_ocjena =$column_ocjena.$ocjena."\n";
    $column_idModeratora =$column_idModeratora.$idKorisnikM."\n";
     $column_pin =$column_pin.$pin."\n";
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
$pdf->Cell(30,6,'Datum',1,0,'L',1);
$pdf->SetX(45);
$pdf->Cell(20,6,'Ocjena',1,0,'L',1);
$pdf->SetX(65);
$pdf->Cell(30,6,'ID moderatora',1,0,'L',1);
$pdf->SetX(95);
$pdf->Cell(30,6,'Pin',1,0,'L',1);




$pdf->SetFont('Arial','B',12);
$pdf->SetY($tablica);
$pdf->SetX(5);
$pdf->MultiCell(10,6,$column_id,1,0,'L',1);

$pdf->SetY($tablica);
$pdf->SetX(15);
$pdf->MultiCell(30,6,$column_datum,1,0,'L',1);

$pdf->SetY($tablica);
$pdf->SetX(45);
$pdf->MultiCell(20,6,$column_ocjena,1,0,'L',1);

$pdf->SetY($tablica);
$pdf->SetX(65);
$pdf->MultiCell(30,6,$column_idModeratora,1,0,'L',1);

$pdf->SetY($tablica);
$pdf->SetX(95);
$pdf->MultiCell(30,6,$column_pin,1,0,'L',1);



$pdf->Output();