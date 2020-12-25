

<?php
include_once 'baza.class.php';
$baza=new BazaPod();

$korime = $_GET['vrijednost'];
$formpolje = $_GET['polje'];



if ($formpolje == "korisnickoImeID") {
$sqlUpit = 'SELECT * FROM korisnik WHERE korisnickoIme=\'' . $korime . '\'';
$rezultat = $baza->selectDB($sqlUpit);
if(mysqli_num_rows($rezultat)>0){
    echo "Ovo korisnicko ime vec postoji!";
}
}
