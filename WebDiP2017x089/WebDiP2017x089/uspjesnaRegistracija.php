<?php
session_start();


include_once 'baza.class.php';
$baza = new BazaPod();
$stanje="";
$status=false;
$popratnaporuka="";


$virtualnoVrijeme;
$sqlUpit="SELECT pomak FROM virtualno_vrijeme";
if($rezultat=$baza->selectDB($sqlUpit)){
    $value = mysqli_fetch_object($rezultat);
    $virtualnoVrijeme=$value->pomak*60*60;
}


if (isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])) {
    $email = mysql_escape_string($_GET['email']);
    $hash = mysql_escape_string($_GET['hash']);
    $sqlUpit = 'SELECT * FROM korisnik WHERE email=\'' . $email . '\'AND hash=\'' . $hash . '\'';
    $rezultat = $baza->selectDB($sqlUpit);
    if ($rezultat->num_rows == 1) {
        $red=$rezultat->fetch_assoc();
        $rezultat=$red['datumVrijemeRegistracije'];
        $rezultat= date_create_from_format('Y-m-d H:i:s',$rezultat);
        date_add($rezultat, date_interval_create_from_date_string('1 day'));
        $datumSad=date_add((new DateTime()), date_interval_create_from_date_string(''.$virtualnoVrijeme.' seconds'));
        if ($rezultat > $datumSad) {
            $sqlUpit = "UPDATE korisnik SET stanje='1' WHERE email='" . $email . "'AND hash='" . $hash . "' AND stanje='0'";
            if($baza->izvrsiDB($sqlUpit)){
            $stanje="Uspješno ste aktivirali račun! možete na stranicu prijave";
            $status=true;
            }
        }
        else{
            $stanje="Prošlo je 24h otkako smo vam poslali email, trebate se ponovo registrirati!";
            $sqlUpit='DELETE FROM korisnik WHERE email=\'' . $email . '\'AND hash=\'' . $hash . '\' AND stanje=\'0\'';
            $baza->izvrsiDB($sqlUpit);
        }
    }
    else{
        $stanje="Niste registrirani!";
    }
} else {
    $stanje="Uspjesno ste se registrirali, potrebno je još aktivirati račun!";
    $popratnaporuka="Poslali smo Vam email sa linkom za aktivaciju računa";
    
}

?>
<!DOCTYPE html>
<html>
    <html>
        <head>
            <title>Autoškola</title>
            <meta charset="UTF-8">
            <meta name="autor" content="Iva Levak">
            <meta name="naslov" content="Početna stranica">
            <meta name="opis" content="Stranica izradena za kolegij Web dizajn i programiranje">
            <meta name="datum promjene" content="--">
            <link href='css/ilevak.css' rel='stylesheet' type="text/css">
            <link href='css/ilevak_prilagodbe.css' rel='stylesheet' type="text/css">
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body id="pocetak-stranice">
            <nav class="navigacija" id="navigacijaId">

                <div class="headerNavigacije">
                    <a class="logo" href="#pocetak-stranice">
                        <image class="slika1" src="multimedija/ikonaLogo.png"> 
                        <span class="logoTekst"> DIK</span>
                    </a>
                </div>
                <div class="dropdown">
                    <button class="gumbNavigacije sakrijGumbNavigacije">
                        <span class="crtica"></span>
                        <span class="crtica"></span>
                        <span class="crtica"></span>
                    </button>
                    <div class="navigacijaSklanjanje dropdown-content">
                         <ul class="navigacijaUl">
                            <li> <a href="index.php#pocetak-stranice">Početna stranica</a></li>
                            <li> <a href="index.php#o-nama">O NAMA</a></li>
                            <li> <a href="index.php#kontakt">KONTAKT</a></li>
                            <li> <a href="index.php#usluge">USLUGE</a>
                                <ul>
                                    <li> <a href="index.php#cijenik">CIJENIK</a></li>
                                    <li><a href="index.php#popisInstruktora">INSTRUKTORI</a></li>
                                </ul> 
                            </li>
                            <li><a href="#">Upisi</a>
                                <ul>
                                    <?php if(isset($_SESSION['prijava']) && $_SESSION["prijava"]==3){?> 
                                    <li><a href="tablica.php#korisnik">Podaci</a></li>
                                    <?php } ?> 
                                    <li><a href="odabirGrupe.php">Odabir grupe</a></li>
                                    <?php if(isset($_SESSION['prijava'])&& $_SESSION["prijava"]>1){?> 
                                    
                                    <li><a href="prihvacanjeZahtjeva.php">Zahtjevi za upis</a></li>
                                    <li><a href="moderatorVrsteOglasa.php">Kreiranje vrsta oglasa</a></li>
                                    <li><a href="moderatorPrihvacanjeOglasa.php">Prihvacanje oglasa</a></li>
                                     <?php } ?>
                                    <?php if(isset($_SESSION['prijava'])){?> 
                                    <li><a href="vrsteOglasa.php">Vrsta oglasa</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li><a href="dokumentacija.html">Dokumentacija</a>
                                <ul>
                                    <li><a href="dokumentacija.html">O projektu</a></li>
                                    <li><a href="o_autoru.html">O autoru</a></li>
                                </ul>
                            </li>
                            <li> <a href="prijavaRegistracija.php?mod=registracija">Registracija</a></li>
                            <?php if(!isset($_SESSION['prijava'])){ ?>
                            <li> <a href="prijavaRegistracija.php?mod=prijava">Prijava</a></li>
                            <?php }
                            if(isset($_SESSION['prijava'])){ ?>
                            <li><a href="odjava.php">Odjava</a></li>
                            <?php }?> 
                        </ul>
                    </div>
                </div>
            </nav>
            <header>
                <div class="pozadinskaSlika tekstCentar ">
                    <div class="preklapanje">
                        <div class="divovi">
                            <div class="red">
                                <div class="pozadinskitekst">
                                    <h1>
                                        <?php echo $stanje; ?>
                                    </h1>
                                    <div id="google_translate_element"></div>
                                    <p>
                                        <?php echo $popratnaporuka; ?>
                                    </p>
                                    <?php if($status==true){ ?>
                                    <a class="gumbForme" href="prijavaRegistracija.php?mod=prijava">Prijavi se</a>
                                    <?php }?>
                                    <?php if($status==false && $popratnaporuka==''){ ?>
                                    <a class="gumbForme" href="prijavaRegistracija.php?mod=registracija">Registriraj se</a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slika velika i tekst kratki.. -->
            </header>

            <footer>
                <p class="tekstCentar"> Copyright &copy; 2017 Iva Levak. </p>
            </footer>
            <script type="text/javascript" src="js/prilagodbe.js">
            </script> 
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            <script type="text/javascript" src="js/googleTranslateAPI.js"></script> 
            <link href='css/ilevakGoogleTranslate.css' rel='stylesheet' type="text/css">

        </body>
    </html>

