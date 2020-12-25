<?php
session_start();
if(!isset($_SESSION["prijava"])){
    header("Location: index.php");
    
}else{
    if($_SESSION["prijava"]!=4){
    header("Location: index.php");
    }
}




include 'baza.class.php';
$baza = new BazaPod();
$virtualnoVrijeme;
$sqlUpit = "SELECT pomak FROM virtualno_vrijeme WHERE idVirtualno_vrijeme=1";
if ($rezultat = $baza->selectDB($sqlUpit)) {
    $value = mysqli_fetch_object($rezultat);
    $virtualnoVrijeme = $value->pomak * 60 * 60;
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
            <script type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.js"></script>  
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>

        <body id="pocetak-stranice">
            <nav class="navigacija" id="navigacijaId">

                <div class="headerNavigacije">
                    <a href="index.php"></a>
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
                                    <?php if (isset($_SESSION['prijava']) && $_SESSION["prijava"] == 3) { ?> 
                                        <li><a href="tablica.php#korisnik">Podaci</a></li>
                                    <?php } ?> 
                                    <li><a href="odabirGrupe.php">Odabir grupe</a></li>
                                    <?php if (isset($_SESSION['prijava']) && $_SESSION["prijava"] > 1) { ?> 

                                        <li><a href="prihvacanjeZahtjeva.php">Zahtjevi za upis</a></li>
                                        <li><a href="moderatorVrsteOglasa.php">Kreiranje vrsta oglasa</a></li>
                                        <li><a href="moderatorPrihvacanjeOglasa.php">Prihvacanje oglasa</a></li>
                                    <?php } ?>
                                    <?php if (isset($_SESSION['prijava'])) { ?> 
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
                            <?php if (!isset($_SESSION['prijava'])) { ?>
                                <li> <a href="prijavaRegistracija.php?mod=prijava">Prijava</a></li>
                                <?php
                            }
                            if (isset($_SESSION['prijava'])) {
                                ?>
                                <li><a href="odjava.php">Odjava</a></li>
                            <?php } ?> 
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
                                        Virtualno vrijeme
                                    </h1>
                                    <div id="google_translate_element"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slika velika i tekst kratki.. -->
            </header>   
            <section class="sekcijaNeparna tekstCentar">
            <div class="divovi">
                <div class="naslov1">
                    <h2>
                        Postavi virtualno vrijeme!
                    </h2>
                </div>
                <div class="red">

                <a class="gumbVirt" title="Postavi pomak virtualnog vremena" href="http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.html" target="_blank">
                    <span>Postavi pomak</span>
                </a>
                <a class="gumbVirt" title="Aktiviraj pomak virtualnog vremena" href="slanjeVirtualnoVrijeme.php">
                    <span>Aktiviraj pomak</span>   
                </a>
                <?php echo "<input type='text' class='formaVrijeme' style='width:100px; display:inline-block;' contenteditable='false' id='virtualnoVrijeme' value='" . $virtualnoVrijeme . "'>"
                ?>
            
                </div>
            </div>
        </section>
            <footer>
                <p class="tekstCentar"> Copyright &copy; 2017 Iva Levak. </p>
            </footer>
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> 
            <script type="text/javascript" src="js/prilagodbe.js"></script> 
            <script type="text/javascript" src="js/googleTranslateAPI.js"></script> 
            <script type="text/javascript" src="js/cookieUvjetiKoristenja.js"></script> 
            <link href='css/ilevakGoogleTranslate.css' rel='stylesheet' type="text/css">
        </body>
    </html>