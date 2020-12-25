<?php
/* moderator i admin */
session_start();

if (!isset($_SESSION["prijava"])) {
    header("Location: index.php");
} else {
    if ($_SESSION["prijava"] == 1) {
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
                                        Prihvacanje zahtjeva¨!
                                    </h1>
                                    <div id="google_translate_element"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slika velika i tekst kratki.. -->
            </header>

            <section  class="sekcijaNeparna tekstCentar">
                <div class="div2Tablica">
                    <div class="dropdownGrupe">
                        <select id="grupaSelect" onchange="javascript:mojaFunkcija()" name="grupaSelect">
                        </select>
                    </div>
                </div>

                <div class="div2Tablica" id="terminiSekcija">
                    <div class="redTablica" id=tablica1">
                        <div class="naslovTablice">
                            <h2>Termini</h2>
                        </div>
                        <div>
                            <div>
                                <div class="blockGumbiLijevo">
                                    <div class="gumbTablicaBlok">
                                        <a class="gumb" title="Dodaj novi" href="javascript:dodajNovi('termin');">
                                            <img src="multimedija/plus16.png"/>
                                            <span class="sakrijGumbTekstTablica">Dodaj novi</span>
                                        </a>
                                    </div>
                                </div>
                                <div class=" korisniciDiv">
                                    <p id="p"></p>
                                    <table class="div3Tablica tekstCentar">
                                        <thead>
                                            <tr>
                                                <th>Označi</th>
                                                <th>Naziv grupe</th>
                                                <th>Kategorija</th>
                                                <th>Vrsta termina</th>
                                                <th>Datum pocetka</th>
                                                <th>Datum zavrsetka</th>
                                                <th>Dan odrzavanja</th>
                                                <th>Od</th>
                                                <th>Do</th>
                                                <th>Polaznika</th>
                                            </tr>
                                        </thead>
                                        <tbody id="termini">
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div> 
                </div>
                <div class="divovi" id="zahtjev">
                    <div class="sadrzajTablica" >
                        <form name="formaZahtjev" id="formaZahtjev" onsubmit=" return validirajFormu()">
                            <div class="red">
                                <div class="naslovTablice">
                                    <h2>Kreiraj novi termin!</h2>
                                </div>
                                <div class="sadrzajTablica  " id="forma">
                                    <div class="grupaFormeTermini">
                                        <div class="dropdownGrupe moderator" style="padding-bottom: 10px;">
                                            <select id="grupaSelect2" name="grupaSelect2"></select>
                                        </div>
                                        <div class="dropdownGrupe moderator">
                                            <select id="vrstaTermina" name="vrstaTermina">
                                                <option value="predavanje">Predavanje</option>
                                                <option value="voznja">Vožnja</option>
                                                <option value="prvaPomoc">Prva pomoć</option>
                                                <option value="ispit">Ispit</option>
                                            </select>
                                        </div>
                                        <label for="datumPocetka">Datum početka:</label>
                                        <input type="date" id="datumPocetka" namedatumPocetka class="formaDio moderator" placeholder="">
                                        <label for="datumZavrsetka">Datum završetka:</label>
                                        <input type="date" id="datumZavrsetka" name="datumZavrsetka" class="formaDio" placeholder="">
                                        <label for="vrijemePocetka">Od:</label>
                                        <input type="time" id="vrijemePocetka" name="vrijemePocetka" class="formaDio" placeholder="">
                                        <label for="trajanje">Do:</label>
                                        <input type="time" id="trajanje" name="trajanje" class="formaDio" placeholder="">
                                        <label for="danVrijemeOdrzavanja">Dan i vrijeme odrzavanja:</label>
                                        <input type="text" id="danVrijemeOdrzavanja" name="danVrijemeOdrzavanja" class="formaDio" placeholder="ponedjeljak>
                                        <label for="polaznika">Maksimalan broj polaznika:</label>
                                        </table>
                                        <input type="number" id="polaznika" name="polaznika" class="formaDio" placeholder="Broj polaznika">
                                        
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="gumbTablicaForma" name="gumbZahtjeva" id="gumbZahtjeva" value="Pošalji">
                        </form>
                    </div>
                </div>
                 <div class="div2Tablica" id="zahtjeviSekcija">
                    <div class="redTablica" id=tablica1">
                        <div class="naslovTablice">
                            <h2>Zahtjevi za upis</h2>
                        </div>
                        <div>
                            <div>
                                <div class="blockGumbiLijevo">
                                    <div class="gumbTablicaBlok">
                                        <a class="gumb" title="Upiši" href="javascript:upisiPolaznika();">
                                            <img src="multimedija/plus16.png"/>
                                            <span class="sakrijGumbTekstTablica">Upiši korisnika</span>
                                        </a>
                                    </div>
                                </div>
                                <div class=" korisniciDiv">
                                    <p id="p"></p>
                                    <table class="div3Tablica tekstCentar">
                                        <thead>
                                            <tr>
                                                <th>Označi</th>
                                                <th>Stanje</th>
                                                <th>Ime</th>
                                                <th>Prezime</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody id="zahtjev_upis">
                                        </tbody>
                                    </table>
                                </div>

                            </div>
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
            <script src="js/moderatoriTerminiGruoe.js" type="text/javascript"></script>
            <?php
            echo "<script type='text/javascript'>funkcija()</script> ";
            ?>


        </body>
    </html>

