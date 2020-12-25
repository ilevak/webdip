

<?php

include '../baza.class.php';
$baza = new BazaPod();
$sqlUpit = "SELECT korisnik.ime, korisnik.prezime, korisnik.tip, korisnik.lozinka FROM korisnik";
$rezultat = $baza->selectDB($sqlUpit);
if (mysqli_num_rows($rezultat) > 0) {
    for ($set = ""; $row = $rezultat->fetch_array(MYSQLI_NUM); $set.="[Ime:".$row[0].",Prezime:".$row[1].",Tip:".$row[2].",Lozinka:".$row[3]."]<br>");
        
} 
echo $set;


