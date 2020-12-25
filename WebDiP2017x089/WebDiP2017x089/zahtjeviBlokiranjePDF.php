<?php

include 'pdf/fpdf.php';
include 'baza.class.php';
$sqlUpit = "SELECT * FROM zahtjev_blokiranje";
$baza = new BazaPod();
$rezultat = $baza->selectDB($sqlUpit);
$broj = mysqli_num_rows($rezultat);

$column_id = "";
$column_razlog  = "";
$column_datum = "";
$column_idOglas = "";

while ($red = mysqli_fetch_array($rezultat)) {
    $id = $red['idZahtjev_Blokiranje'];
    $razlog = $red['razlog'];
    $datum = $red['datum'];
    $idOglas = $red['idOglas'];
    
    $column_id =$column_id.$id."\n";
    $column_razlog =$column_razlog.$razlog."\n";
    $column_datum =$column_datum.$datum."\n";
    $column_idOglas =$column_idOglas.$idOglas."\n";
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
$pdf->Cell(100,6,'Razlog',1,0,'L',1);
$pdf->SetX(115);
$pdf->Cell(30,6,'Datum',1,0,'L',1);
$pdf->SetX(145);
$pdf->Cell(30,6,'ID oglas',1,0,'L',1);



$pdf->SetFont('Arial','B',12);
$pdf->SetY($tablica);
$pdf->SetX(5);
$pdf->MultiCell(10,6,$column_id,1,0,'L',1);

$pdf->SetY($tablica);
$pdf->SetX(15);
$pdf->MultiCell(100,6,$column_razlog,1,0,'L',1);

$pdf->SetY($tablica);
$pdf->SetX(115);
$pdf->MultiCell(30,6,$column_datum,1,0,'L',1);

$pdf->SetY($tablica);
$pdf->SetX(145);
$pdf->MultiCell(30,6,$column_idOglas,1,0,'L',1);



$pdf->Output();