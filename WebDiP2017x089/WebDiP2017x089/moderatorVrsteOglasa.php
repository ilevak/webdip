<?php
/* moderator i admin */
session_start();

if (!isset($_SESSION["prijava"])) {
    header("Location: index.php");
} else {
    if ($_SESSION["prijava"] < 2) {
        header("Location: index.php");
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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                                        Pozicije i vrste oglasa!
                                    </h1>
                                    <div id="google_translate_element"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slika velika i tekst kratki.. -->
            </header>
            <section  class="sekcijaNeparna tekstCentar" >
                <div class="div2Tablica">
                    <div class="redTablica">
                        <div class="naslovTablice">
                            <h2>Pozicije</h2>
                            <p>Pritiskom na redak u tablici birate poziciju kojoj zelite dodati vrstu oglasa po želji!</p>
                        </div>
                        <div>
                            <div>
                            </div>
                            <div class=" grupeDiv">

                                <table class="div3Tablica tekstCentar">
                                    <thead>
                                        <tr>
                                            <th>Visina</th>
                                            <th>Sirina</th>
                                            <th>Lokacija</th>
                                            <th>Url</th>
                                            <th>Naziv</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pozicija">
                                    </tbody>
                                </table>
                            </div>
                            <div id="zahtjev"></div>
                        </div>
                    </div>
                    <div class="divovi" id="divVrsta">
                        <div class="div2Tablica">
                            <div class="redTablica" id="2">
                                <div class="naslovTablice">
                                    <h2>Vrste oglasa</h2>
                                </div>
                                <div>
                                    <div>
                                    </div>
                                    <div class=" grupeDiv">

                                        <table class="div3Tablica tekstCentar">
                                            <thead>
                                                <tr>
                                                    <th>Naziv</th>
                                                    <th>Trajanje</th>
                                                    <th>Frekvencija izmjene</th>
                                                    <th>Cijena</th>
                                                </tr>
                                            </thead>
                                            <tbody id="vrsta_oglasa">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="sadrzajTablica" >
                                <form name="formaZahtjev" id="formaZahtjev"  method="POST" onsubmit=" return validirajFormu()" novalidate>
                                    <div class="red">
                                        <div class="naslovTablice">
                                            <h2>Kreiraj vrstu oglasa!</h2>
                                        </div>
                                        <div class="sadrzajTablica  " id="forma">
                                            <div class="grupaForme">
                                                <input type="text" readonly="true" class="formaDio"  id="idPozicija" value="" name="idPozicija">
                                                <input type="text" id="naziv" name="naziv" class="formaDio" placeholder="Naziv vrste">
                                                <input type="number" id="trajanjePrikazivanja" name="trajanjePrikazivanja" class="formaDio" placeholder="Trajanje prikazivanja">
                                                <input type="number" id="frekvencijaIzmjene" name="frekvencijaIzmjene" class="formaDio" placeholder="Koliko ce se cesto izmjenjivati">
                                                <input type="number" id="cijena" name="cijena" class="formaDio" placeholder="Cijena">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" class="gumbTablicaForma"  name="gumbZahtjeva" id="gumbZahtjeva" value="Pošalji">
                                </form>
                            </div>
                        </div>
                    </div> 
            </section>
            <footer>
                <p class="tekstCentar"> Copyright &copy; 2017 Iva Levak. </p>
            </footer>
            <script type="text/javascript" src="js/prilagodbe.js">
            </script> 
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            <script type="text/javascript" src="js/googleTranslateAPI.js"></script> 
            <link href='css/ilevakGoogleTranslate.css' rel='stylesheet' type="text/css">
            <script src="js/moderatorVrsteOglasaPozicije.js" type="text/javascript"></script>
            <?php
            echo "<script type='text/javascript'>funkcija()</script> ";
            ?>


        </body>
    </html>

