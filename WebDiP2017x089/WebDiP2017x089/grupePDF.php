<?php

include 'pdf/fpdf.php';
include 'baza.class.php';
$sqlUpit = "SELECT * FROM grupa";
$baza = new BazaPod();
$rezultat = $baza->selectDB($sqlUpit);
$broj = mysqli_num_rows($rezultat);

$column_id = "";
$column_naziv = "";
$column_opis = "";
$column_kategorija = "";

while ($red = mysqli_fetch_array($rezultat)) {
    $id = $red['idgrupa'];
    $naziv = $red['naziv'];
    $opis = $red['opis'];
    $kategorija = $red['kategorija'];
    
    $column_id =$column_id.$id."\n";
    $column_naziv =$column_naziv.$naziv."\n";
    $column_opis =$column_opis.$opis."\n";
    $column_kategorija =$column_kategorija.$kategorija."\n";
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
$pdf->Cell(30,6,'Naziv',1,0,'L',1);
$pdf->SetX(45);
$pdf->Cell(125,6,'Opis',1,0,'L',1);
$pdf->SetX(170);
$pdf->Cell(30,6,'Kategorija',1,0,'L',1);




$pdf->SetFont('Arial','B',12);
$pdf->SetY($tablica);
$pdf->SetX(5);
$pdf->MultiCell(10,6,$column_id,1,0,'L',1);
$pdf->SetY($tablica);
$pdf->SetX(15);
$pdf->MultiCell(30,6,$column_naziv,1,0,'L',1);

$pdf->SetY($tablica);
$pdf->SetX(45);
$pdf->MultiCell(125,6,$column_opis,1,0,'L',1);

$pdf->SetY($tablica);
$pdf->SetX(170);
$pdf->MultiCell(30,6,$column_kategorija,1,0,'L',1);



$pdf->Output();