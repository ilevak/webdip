<?php
session_start();




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
                                        Grupe termini i moderatori¨!
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
                <div class="div2Tablica" >
                    <div class="redTablica" id=tablica1">
                        <div class="naslovTablice">
                            <h2>Grupe</h2>
                        </div>
                        <div>
                            <div>
                                <div class="blockGumbiLijevo">
                                </div>
                            </div>
                            <div class=" korisniciDiv">
                                <p id="p"></p>
                                <table class="div3Tablica tekstCentar">
                                    <thead>
                                        <tr>
                                            <th>Naziv</th>
                                            <th>Opis</th>
                                            <th>Kategorija</th>
                                        </tr>
                                    </thead>
                                    <tbody id="grupa">
                                    </tbody>
                                </table>
                            </div>
                            <div class=" korisniciDiv" id="divModerator">
                                <div class="naslovTablice">
                                    <h2>Moderatori</h2>
                                </div>
                                <input type="text" class="formaModerator" id="inputSearchM" onkeyup="searchFunkcijaM()" placeholder="Pretraži moderatore..">
                                <table class="div3Tablica tekstCentar" id="moderatoriTablicaS">
                                    <thead>
                                        <tr>
                                            <th>Ime i prezime</th>
                                            <th>Ocijena</th>
                                        </tr>
                                    </thead>
                                    <tbody id="moderatori">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 





                <div class="div2Tablica">
                    <div class="redTablica" id="2">
                        <div class="naslovTablice">
                            <h2>Termini</h2>
                        </div>
                        <div>
                            <div>
                            </div>
                            <div class=" grupeDiv">

                                <table class="div3Tablica tekstCentar">
                                    <thead>
                                        <tr>
                                            <th>Vrsta</th>
                                            <th>Datum  početka</th>
                                            <th>Datum  završetka</th>
                                            <th>Odrzava se svaki:</th>
                                            <th>Polaznika</th>
                                            <th>Od</th>
                                            <th>Do</th>
                                            <th>Grupa</th>
                                            <th>Kategorija</th>
                                        </tr>
                                    </thead>
                                    <tbody id="termin">
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="divovi" id="zahtjev">
                        <div class="sadrzajTablica" >
                            <form name="formaZahtjev" id="formaZahtjev" onsubmit=" return validirajFormu()">
                                <div class="red">
                                    <div class="naslovTablice">
                                        <h2>Upiši se u grupu!</h2>
                                    </div>
                                    <div class="sadrzajTablica  " id="forma">
                                        <div class="grupaForme">
                                            <div class="dropdownGrupe">
                                                <select id="grupaSelect" name="grupaSelect">
                                                </select>
                                            </div>
                                            <input type="email" id="email" name="email" class="formaDio" placeholder="Email">
                                            <p class="pomoc tekst-krivo" id="emailG"></p>
                                            <input type="text" id="ime" name="ime" class="formaDio" placeholder="Ime">
                                            <p class="pomoc tekst-krivo" id="imeG"></p>
                                            <input type="text" id="prezime" name="prezime" class="formaDio" placeholder="Prezime">
                                            <p class="pomoc tekst-krivo" id="prezimeG"></p>
                                            <input type="number" id="dob" name="dob" class="formaDio" placeholder="Godine">
                                            <p class="pomoc tekst-krivo" id="dobG"></p>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="gumbTablicaForma" name="gumbZahtjeva" id="gumbZahtjeva" value="Pošalji">
                            </form>
                        </div>
                    </div>
                    <div class="divovi" id="ocjenaZ">
                        <div class="sadrzajTablica" >

                            <form name="formaOcjena" id="formaOcjena" onsubmit="return validirajFormuOcjena()">
                                <div class="red">
                                    <div class="naslovTablice">
                                        <h2>Ocjenite moderatora!</h2>
                                        <p>Unesite svoj pin koji ste dobili i ocjenu</p>
                                    </div>
                                    <div class="sadrzajTablica  " >
                                        <div class="grupaForme">
                                            <input type="text" id="pin" name="pin" class="formaDio" placeholder="Pin">
                                            <input type="number" id="dob" name="ocjena" class="formaDio" placeholder="Ocjena">
                                            <p class="pomoc tekst-krivo" id="greska"></p>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="gumbTablicaForma" name="gumbZahtjeva" id="gumbZahtjeva" value="Pošalji">
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
            <script type="text/javascript" src="js/odabirGrupeForma.js"></script>
            <script src="js/odabirGrupeJS.js" type="text/javascript"></script>
            <?php
            echo "<script type='text/javascript'>funkcija()</script> ";
            ?>


        </body>
    </html>

