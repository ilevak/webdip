
<?php
session_start();



if (!empty($_COOKIE['uvjetiKoristenja'])) {
    
} else {
    echo ' <div id="iskocniProzor" class="iskocniProzor">
            <div class="sadrzajIskocniProzor tekstCentar">
                <span>Da bi nastavili morate prihvatiti uvjete korištenja!</span><br>
                <button id="gumbUvjetiKoristenja" class="gumbTablicaForma">Prihvaćam</button>
            </div>
        </div>';
}

if (isset($_POST["tipkaKontakt"])) {
    $prima = 'ivalevak@hotmail.com';
    $predmet = 'Poruka od' . $_POST['ime'] . $_POST['prezime'];
    $poruka = $_POST['poruka'];
    $header = 'From:' . $_POST['email'] . "\r\n";
    mail($prima, $predmet, $poruka, $header);
}

$zahtjev = '';
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
                                        Dobro došli na stranicu autoškole
                                        <span class="logoTekst">DIK </span>
                                    </h1>
                                    <p> Mi smo autoskola smjestena u Sesvetama, 
                                        ovo je nasa stranica
                                    </p>
                                    <a class="gumbUsluge"href="#usluge">Saznaj više</a>
                                    <div id="google_translate_element"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slika velika i tekst kratki.. -->
            </header>
            
            <div id="oglasOnama" class="oglasi">
                
            <?php if(isset($_SESSION['prijava'])){ ?>
                <div class="blokOglasiGumb">
                    <a class="gumb" title="Zahtjev za uklanjanjem oglasa" href="javascript:prikaziZahtjev('onama')">
                        <img src="multimedija/delete.png"/>
                    </a>

                </div>
                <?php }?> 
            </div>
            
            <?php 
                            if(isset($_SESSION['prijava'])){ ?>
            <div id='zahtjevZaUkl'></div>
            <div><?php echo $zahtjev; ?></div>
            <?php }?> 
            <section id="o-nama"  class="sekcijaNeparna tekstCentar" >

                <div class="divovi">

                    <div class="naslov1">
                        <h2>
                            O nama
                        </h2>
                        <p>  
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. 
                            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
                        </p>
                    </div>
                    <div class="red">
                        <div class="oNamaDiv">
                            <img src="multimedija/slika2.jpg">
                        </div>
                        <div>
                            <div class="oNamaTekst">
                                <h4>Što radimo</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. 
                                    Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
                                    Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. 

                                </p>
                                <h4>Kako nas pronaći</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. 
                                    Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
                                    Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. 

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- DIvovi sa tekstom, naslov, slika -->
            </section>
            
          
            <div id="oglasUsluge" class="oglasi">
                  <?php if(isset($_SESSION['prijava'])){ ?>
                <div class="blokOglasiGumb">
                    <a class="gumb" title="Zahtjev za uklanjanjem oglasa" href="javascript:prikaziZahtjev('usluge')">
                        <img src="multimedija/delete.png"/>
                    </a>

                </div>
                <?php }?> 
            </div>
            <?php if(isset($_SESSION['prijava'])){ ?>
            <div id='zahtjevZaUkl'></div>
            <div><?php echo $zahtjev; ?></div>
            <?php }?> 
            <section id="usluge" class="sekcijaParna tekstCentar">

                <!--  Naslov, slike usluga, naziv svake usluge.. otvaranje nove stranice di je usluga bolje objašnjena...-->
                <div>
                    <h2>Usluge</h2>
                    <p></p>
                </div>
                <div>
                    <div>
                        <a></a>
                        <h4>A razina</h4>
                        <p></p>
                    </div>
                    <div>
                        <a></a>
                        <h4>B razina</h4>
                        <p></p>
                    </div>
                    <div>
                        <a></a>
                        <h4>C razina</h4>
                        <p></p>
                    </div>
                </div>
            </section>
            <section id="cijenik" class="sekcijaNeparna tekstCentar">
                <!-- Paketi i cijene paketa -->
            </section>
            
            
            <div id="oglasInstruktori" class="oglasi">
                <?php  if(isset($_SESSION['prijava'])){ ?>
                <div class="blokOglasiGumb">
                    <a class="gumb" title="Zahtjev za uklanjanjem oglasa" href="javascript:prikaziZahtjev('instruktori')">
                        <img src="multimedija/delete.png"/>
                    </a>

                </div>
                <?php } ?>
            </div>
            <?php if(isset($_SESSION['prijava'])){ ?>
            <div id='zahtjevZaUkl'></div>
            <div><?php echo $zahtjev; ?></div>
            <?php }?> 
            <section id="popisInstruktora" class="sekcijaParna tekstCentar">

                <div class="divovi">
                    <div class="naslov1">
                        <h2>Instruktori</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam. Sed commodo nibh ante facilisis bibendum dolor apibus lornare diam commodo nibh.</p>
                    </div>
                    <div id="red">
                        <div class="">
                            <div class="thumbnail"> <img src="" alt="..." class="slikaOkruglo">
                                <div class="naslovTim">
                                    <h3>Ivo Ivić</h3>
                                    <p>Founder / CEO</p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="thumbnail"> <img src="" alt="..." class="slikaOkruglo">
                                <div class="naslovTim">
                                    <h3>Ivo Ivić</h3>
                                    <p>Web Designer</p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="thumbnail"> <img src="" alt="..." class="slikaOkruglo">
                                <div class="naslovTim">
                                    <h3>Ivo Ivić</h3>
                                    <p>Creative Director</p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="thumbnail"> <img src="" alt="..." class="slikaOkruglo">
                                <div class="naslovTim">
                                    <h3>Ivo Ivić</h3>
                                    <p>Project Manager</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="kontakt" class="sekcijaKontakt tekstCentar">
                <div class="pozadinskaSlikaKontakt"> 
                    <div class="preklapanje">
                        <div class="divovi">
                            <div class="naslov1">
                                <h2>Kontakt</h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. 
                                    Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
                                    Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim
                                </p>
                            </div>
                            <div class="sadrzajKontakt">
                                <form name="posaljiPoruku" id="contactForm" method="post" novalidate>
                                    <div class="red">
                                        <div class="sadrzajKontakt  inputKontakt">
                                            <div class="grupaForme">
                                                <input type="text" id="ime" name="ime"class="formaDio" placeholder="Ime" required="required">
                                                <p class="pomoc tekst-krivo"></p>
                                            </div>
                                        </div>
                                        <div class="sadrzajKontakt  inputKontakt">
                                            <div class="grupaForme">
                                                <input type="email" id="email" name="email" class="formaDio" placeholder="Email" required="required">
                                                <p class="pomoc tekst-ktivo"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grupaForme">
                                        <textarea name="poruka" id="poruka" class="formaDio" rows="4" placeholder="Poruka" required></textarea>
                                        <p class="pomoc tekst-krivo"></p>
                                    </div>
                                    <div id="uspjesno"></div>
                                    <button type="submit" id="tipkaKontakt" class="gumbForme">Pošalji poruku</button>
                                </form>
                            </div>

                            <div class="ikoneDrustvenihMreza tekstCentar">
                                <ul>
                                    <li><a href="#"><img src="multimedija/facebookLogo.png"></a></li>
                                    <li><a href="#"><img src="multimedija/instagramLogo.png"></a></li>
                                    <li><a href="#"><img src="multimedija/twitterLogo.png"></a></li>
                                    <li><a href="#"><img src="multimedija/youtubeLogo.png"></a></li>
                                </ul>
                            </div>
                        </div>
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
            <script type="text/javascript" src="js/oglasi.js">funkcijaOglasi()</script>
            <script src="js/zahtjeviZaBlokiranjem.js" type="text/javascript"></script>
        </body>
    </html>