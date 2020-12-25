<?php
session_start();
if(!isset($_SESSION["prijava"])){
    header("Location: index.php");
    
}else{
    if($_SESSION["prijava"]>=1){
    header("Location: index.php");
    }
}

include_once 'baza.class.php';
$baza = new BazaPod();
$korimeG = $emailG = "";
$popratnaporuka = "";
$greska = $greskaEmail = $greskaKorime = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['korime-G'])) {
        $korimeG = ($_POST["korime-G"]);
        $sqlUpitKorime = 'SELECT*FROM korisnik WHERE korisnickoIme=\'' . $korimeG . '\'';
        $rezultatKorime = $baza->selectDB($sqlUpitKorime);
        if ($rezultatKorime->num_rows == 1) {
            $korisnik = $rezultatKorime->fetch_assoc();
        } else {
            $greskaKorime = "Upisali ste krivo korisnicko ime";
        }
    } else if (isset($_POST['email-G'])) {
        $emailG = ($_POST["email-G"]);
        $sqlUpitEmail = 'SELECT*FROM korisnik WHERE email=\'' . $emailG . '\'';
        $rezultatEmail = $baza->selectDB($sqlUpitEmail);
        if ($rezultatEmail->num_rows == 1) {
            $korisnik = $rezultatEmail->fetch_assoc();
        } else {
            $greskaEmail = "Upisali ste krivi e-mail";
        }
    } else {
        $greska = "Niste upisali nijedan podatak!";
    }
    if (!empty($korisnik)) {
        $lozinka = bin2hex(openssl_random_pseudo_bytes(4));
        $prima = $korisnik['email'];
        $predmet = 'Nova lozinka za račun';
        $poruka = ' 
                    Hvala što ste se registrirali!
                    Tvoj račun je kreiran, možeš se prijaviti sa sljedećim podacima, nakon što pritiskom na link niže aktiviraš račun!
                    
                    ------------------------------------
                    Korisničko ime: ' . $korisnik['ime'] . '
                    Lozinka: ' . $lozinka . '
                    ------------------------------------
                    Molimo pritisnite link kako bi se prijavili:
                    http://barka.foi.hr/WebDiP/2017_projekti/WebDiP2017x089/prijavaRegistracija.php?mod=prijava

                    ';

        $header = 'From:noreply@autoskola.com' . "\r\n";
        mail($prima, $predmet, $poruka, $header);

        $sqlUpit = "UPDATE korisnik SET lozinka='" . $lozinka . "' WHERE email='" . $prima . "'";
        if ($baza->izvrsiDB($sqlUpit)) {
            $popratnaporuka = "Uspjesno vam je poslan email!";
        }
    }
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
                    <a class="logo" href="index.php#pocetak-stranice">
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
                                        Upišite svoj e-mail ili korisnicko ime i poslat ćemo vam podatke za novu lozinku
                                    </h1>
                                    <div id="google_translate_element"></div>
                                    <div class="sadrzajPrijavaRegistracija">
                                        <form name="slanjeLozinke" id="slanjeLozinke" novalidate method="post">
                                            <div class="red">
                                                <div class="sadrzajPrijavaRegistracija  inputKontakt">
                                                    <div class="grupaForme">
                                                        <input type="text" id="korime-G" name="korime-G" class="formaDio" placeholder="Korisnicko ime">
                                                        <p class="pomoc tekst-krivo"><?php echo $greskaKorime ?></p>
                                                    </div>
                                                </div>
                                                <div class="sadrzajPrijavaRegistracija  inputKontakt">
                                                    <div class="grupaForme">
                                                        <input type="email" id="email-G" name="email-G" class="formaDio" placeholder="Email">
                                                        <p class="pomoc tekst-krivo"><?php echo $greskaEmail ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>

                                                <?php echo $popratnaporuka; ?>
                                            </p>
                                            <p class="pomoc tekst-krivo"><?php echo $greska ?></p>
                                            <button type="submit" name="tipkaSlanjeLozinke" class="gumbForme">Pošalji mi podatke</button>
                                        </form>
                                    </div>
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