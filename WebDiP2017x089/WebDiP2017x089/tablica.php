<?php
session_start();
if (!isset($_SESSION["prijava"])) {
    header("Location: index.php");
} else {
    if ($_SESSION["prijava"] != 3) {
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
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            <script src="js/prilagodbe.js" type="text/javascript"></script>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body id="pocetak-stranice" onload="glavnaFunkcija()">
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
                                        Podaci
                                    </h1>
                                    <p>
                                        Tu se nalazi svi podaci predoceni u tablicama
                                    </p>

                                    <div id="google_translate_element"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slika velika i tekst kratki.. -->
            </header>
            <section  class="sekcijaNeparna tekstCentar" >             
                <div id="divTablica">
                    <button class="gumbTablica aktivno" onclick="filtriraj('sve'); provjeri();"> Prikazi sve</button>
                    <button class="gumbTablica" onclick="filtriraj('korisniciDiv')"> Korisnici</button>
                    <button class="gumbTablica" onclick="filtriraj('ocjeneDiv')"> Ocjene</button>
                    <button class="gumbTablica" onclick="filtriraj('terminDiv')"> Termini</button>
                    <button class="gumbTablica" onclick="filtriraj('zahtjev_blokiranjeDiv')">Zahtjevi za blokiranje </button>
                    <button class="gumbTablica" onclick="filtriraj('zahtjev_upisDiv')">Zahtjevi za upis</button>
                    <button class="gumbTablica" onclick="filtriraj('grupaDiv')"> Grupe</button>
                    <button class="gumbTablica" onclick="filtriraj('oglasDiv')">Oglasi</button>
                    <button class="gumbTablica" onclick="filtriraj('pozicijaDiv')">Pozicije</button>
                </div>
                <div style="padding-top: 20px; padding-left: 20px;">
                    <a href="pomakVremena.php">Namjesti pomak!</a>
                </div>
                <div class="div2Tablica tablica korisniciDiv">
                    <div class="redTablica">
                        <div class="naslovTablice">
                            <h2>Korisnici</h2>
                        </div>
                        <p id="korisnikBrisanje"></p>   

                        <div>
                            <div>
                                <div class="blockGumbiLijevo">
                                    <div class="gumbTablicaBlok">
                                        <a class="gumb" title="Dodaj novi" href="javascript:dodajNovi('korisnik', 13);">
                                            <img src="multimedija/plus16.png"/>
                                            <span class="sakrijGumbTekstTablica">Dodaj novi</span>
                                        </a>
                                    </div>
                                    <div class="gumbTablicaBlok">
                                        <a class="gumb" title="Izradi pdf" href="korisniciPDF.php">
                                            <img src="multimedija/export-arrow.png"/>
                                            <span class="sakrijGumbTekstTablica">Izradi pdf</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="stranicenje">
                                    <a class="gumb" href="javascript:stranicenje('korisnik', -1)" id="prethodni" title="prethodno">
                                        <img src="multimedija/left-arrow.png"/>
                                    </a> 
                                    <a class="gumb" href="javascript:stranicenje('korisnik', 1)" id="prethodni" title="prethodno">
                                        <img src="multimedija/right-arrow.png"/>
                                    </a> 
                                    
                                    <input type="number" id="stranice" class="formaVrijeme" style="width: 40px; display:inline-block;" value="10">
                                    
                                    <a class="gumb" href="javascript:popraviStranicenje()" id="prethodni" title="prethodno">
                                        <img src="multimedija/olovka.png" alt=""/>
                                    </a> 
                                    <p style="font-size: 10px; display:inline-block">Broj stranica:</p>
                                    <input type="number" id="brojkorisnik" contenteditable="false" class="formaVrijeme" style="width: 40px; display:inline-block;" value="0">
                                </div>

                            </div>
                            <div class="korisniciDiv">
                                <table class="div3Tablica tekstCentar">
                                    <thead>
                                        <tr>
                                            <th>Označi</th>
                                            <th>Operacije</th>
                                            <th><a href='javascript:sortiraj("idKorisnik", "korisnik")'>Id</a></th>
                                            <th><a href='javascript:sortiraj("tip", "korisnik")'>Tip korisnika</a></th>
                                            <th><a href='javascript:sortiraj("ime", "korisnik")'>Ime</a></th>
                                            <th><a href='javascript:sortiraj("prezime", "korisnik")'>Prezime</a></th>
                                            <th><a href='javascript:sortiraj("korisnickoIme", "korisnik")'>Korisnicko ime</a></th>
                                            <th>Email</th>
                                            <th>Lozinka</th>
                                            <th>Prihvaćen?</th>
                                            <th>Datum registracije</th>
                                            <th>Kriptirana lozinka</th>
                                            <th>Godine</th>
                                            <th>Hash</th>
                                            <th>Blokiran stanje?</th>
                                        </tr>
                                    </thead>
                                    <tbody id="korisnik">
                                    </tbody>
                                </table>
                            </div>
                            <div id="korisnikUredivanje">
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="div2Tablica tablica ocjeneDiv">
                    <div class="redTablica">
                        <div class="naslovTablice">
                            <h2>Ocjene</h2>
                        </div>
                        <div>
                            <div>
                                <div class="gumbTablicaBlok">
                                    <a class="gumb" title="Dodaj novi" href="javascript:dodajNovi('ocjena', 5);">
                                        <img src="multimedija/plus16.png"/>
                                        <span class="sakrijGumbTekstTablica">Dodaj novi</span>
                                    </a>
                                </div>
                                <div class="gumbTablicaBlok">
                                    <a class="gumb" title="Izradi pdf" href="ocjenePDF.php">
                                        <img src="multimedija/export-arrow.png"/>
                                        <span class="sakrijGumbTekstTablica">Izradi pdf</span>
                                    </a>
                                </div>
                                <div class="stranicenje">
                                    <a class="gumb" href="javascript:stranicenje('ocjena', -1)" id="prethodni" title="prethodno">
                                        <img src="multimedija/left-arrow.png"/>
                                    </a> 
                                    <a class="gumb" href="javascript:stranicenje('ocjena', 1)" id="prethodni" title="prethodno">
                                        <img src="multimedija/right-arrow.png"/>
                                    </a> 
                                    
                                    <p style="font-size: 10px; display:inline-block">Broj stranica:</p>
                                    <input type="number" id="brojocjena" contenteditable="false" class="formaVrijeme" style="width: 40px; display:inline-block;" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="ocjeneDiv">
                            <table class="div3Tablica tekstCentar">
                                <thead>
                                    <tr>
                                        <th>Označi</th>
                                        <th>Operacije</th>
                                        <th><a href='javascript:sortiraj("idOcjena", "ocjena")'>Id</a></th>
                                        <th><a href='javascript:sortiraj("datum", "ocjena")'>Datum</a></th>
                                        <th><a href='javascript:sortiraj("ocjena", "ocjena")'>Ocjena</a></th>
                                        <th><a href='javascript:sortiraj("idKorisnikM", "ocjena")'>Id moderatora</a></th>
                                        <th>Pin</th>
                                    </tr>
                                </thead>
                                <tbody id="ocjena">
                                </tbody>
                            </table>
                        </div>
                        <div id="ocjenaUredivanje">
                        </div>
                    </div>
                </div>
            </div> 
            <div class="div2Tablica tablica oglasDiv">
                <div class="redTablica">
                    <div class="naslovTablice">
                        <h2>Oglasi</h2>
                    </div>
                    <div>
                        <div>
                            <div class="blockGumbiLijevo">
                                <div class="gumbTablicaBlok">
                                    <a class="gumb" title="Dodaj novi" href="javascript:dodajNovi('oglas', 11);">
                                        <img src="multimedija/plus16.png"/>
                                        <span class="sakrijGumbTekstTablica">Dodaj novi</span>
                                    </a>
                                </div>
                            </div>
                            <div class="stranicenje">
                                <a class="gumb" href="javascript:stranicenje('oglas', -1)" id="prethodni" title="prethodno">
                                    <img src="multimedija/left-arrow.png"/>
                                </a> 
                                <a class="gumb" href="javascript:stranicenje('oglas', 1)" id="prethodni" title="prethodno">
                                    <img src="multimedija/right-arrow.png"/>
                                </a> 
                                 <p style="font-size: 10px; display:inline-block">Broj stranica:</p>
                                    <input type="number" id="brojoglas" contenteditable="false" class="formaVrijeme" style="width: 40px; display:inline-block;" value="0">
                               
                            </div>
                        </div>
                        <div class=" oglasDiv">
                            <table class="div3Tablica tekstCentar">
                                <thead>
                                    <tr>
                                        <th>Označi</th>
                                        <th>Operacije</th>
                                        <th><a href='javascript:sortiraj("idOglas", "oglas")'>Id</a></th>
                                        <th><a href='javascript:sortiraj("idKorisnik", "oglas")'>Id korisnika</a></th>
                                        <th><a href='javascript:sortiraj("idVrstaOglasa", "oglas")'>Id vrsta oglasa</a></th>
                                        <th><a href='javascript:sortiraj("status", "oglas")'>Status</a></th>
                                        <th>Naziv</th>
                                        <th>URL</th>
                                        <th>Opis</th>
                                        <th>Slika</th>
                                        <th>BrojKlikova</th>
                                        <th>Datum kreiranja</th>
                                        <th>Od kad je aktivan</th>
                                    </tr>
                                </thead>
                                <tbody id="oglas">
                                </tbody>
                            </table>
                        </div>
                        <div id="oglasUredivanje">
                        </div>
                    </div>
                </div>
            </div> 
            <div class="div2Tablica tablica grupaDiv">
                <div class="redTablica">
                    <div class="naslovTablice">
                        <h2>Grupe</h2>
                    </div>
                    <div>
                        <div>
                            <div class="blockGumbiLijevo">
                                <div class="gumbTablicaBlok">
                                    <a class="gumb" title="Dodaj novi" href="javascript:dodajNovi('grupa', 4);">
                                        <img src="multimedija/plus16.png"/>
                                        <span class="sakrijGumbTekstTablica">Dodaj novi</span>
                                    </a>
                                </div>
                                <div class="gumbTablicaBlok">
                                    <a class="gumb" title="Izradi pdf" href="grupePDF.php">
                                        <img src="multimedija/export-arrow.png"/>
                                        <span class="sakrijGumbTekstTablica">Izradi pdf</span>
                                    </a>
                                </div>
                            </div>
                            <div class="divovi" style="height:40px;">
                                    <div class="dropdownGrupeZ">
                                        <select id="grupaSelect" name="grupaSelect">
                                        </select>
                                    </div>
                                    <div class="dropdownGrupeZ">
                                        <select id="moderatorSelect" name="moderatorSelect">
                                        </select>
                                    </div>
                                    <div class="gumbTablicaBlokL">
                                        <a class="gumb" title="Dodaj novi" href="javascript:dodijeliModeratora();">
                                            <img src="multimedija/plus16.png"/>
                                            <span class="sakrijGumbTekstTablica">Dodijeli moderatora grupi</span>
                                        </a>
                                    </div>
                           </div>
                            <div class="stranicenje">
                                <a class="gumb" href="javascript:stranicenje('grupa', -1)" id="prethodni" title="prethodno">
                                    <img src="multimedija/left-arrow.png"/>
                                </a> 
                                <a class="gumb" href="javascript:stranicenje('grupa', 1)" id="prethodni" title="prethodno">
                                    <img src="multimedija/right-arrow.png"/>
                                </a> 
                                 <p style="font-size: 10px; display:inline-block">Broj stranica:</p>
                                    <input type="number" id="brojgrupa" contenteditable="false" class="formaVrijeme" style="width: 40px; display:inline-block;" value="0">
                               
                            </div>
                        </div>
                        <div class="grupaDiv">
                            <table class="div3Tablica tekstCentar">
                                <thead>
                                    <tr>
                                        <th>Označi</th>
                                        <th>Operacije</th>
                                        <th><a href='javascript:sortiraj("idGrupa", "grupa")'>Id</a></th>
                                        <th><a href='javascript:sortiraj("naziv", "grupa")'>Naziv</a></th>
                                        <th><a href='javascript:sortiraj("opis", "grupa")'>Opis</a></th>
                                        <th><a href='javascript:sortiraj("kategorija", "grupa")'>Kategorija</a></th> 
                                    </tr>
                                </thead>
                                <tbody id="grupa">
                                </tbody>
                            </table>
                        </div>
                        <div id="grupaUredivanje">
                        </div>
                    </div>
                </div>
            </div> 
            <div class="div2Tablica tablica zahtjev_blokiranjeDiv">
                <div class="redTablica">
                    <div class="naslovTablice">
                        <h2>Zahtjevi za blokiranjem oglasa</h2>
                    </div>
                    <div>
                        <div>
                            <div class="blockGumbiLijevo">
                                <div class="gumbTablicaBlok">
                                    <a class="gumb" title="Dodaj novi" href="javascript:dodajNovi('zahtjev_blokiranje', 5);">
                                        <img src="multimedija/plus16.png"/>
                                        <span class="sakrijGumbTekstTablica">Dodaj novi</span>
                                    </a>
                                </div>
                                <div class="gumbTablicaBlok">
                                    <a class="gumb" title="Izradi pdf" href="zahtjeviBlokiranjePDF.php">
                                        <img src="multimedija/export-arrow.png"/>
                                        <span class="sakrijGumbTekstTablica">Izradi pdf</span>
                                    </a>
                                </div>
                            </div>
                            <div class="stranicenje">
                                <a class="gumb" href="javascript:stranicenje('zahtjev_blokiranje', -1)" id="prethodni" title="prethodno">
                                    <img src="multimedija/left-arrow.png"/>
                                </a> 
                                <a class="gumb" href="javascript:stranicenje('zahtjev_blokiranje', 1)" id="prethodni" title="prethodno">
                                    <img src="multimedija/right-arrow.png"/>
                                </a> 
                                 <p style="font-size: 10px; display:inline-block">Broj stranica:</p>
                                    <input type="number" id="brojzahtjev_blokiranje" contenteditable="false" class="formaVrijeme" style="width: 40px; display:inline-block;" value="0">
                               
                            </div>
                        </div>
                        <div class="zahtjev_blokiranjeDiv">
                            <table class="div3Tablica tekstCentar">
                                <thead>
                                    <tr>
                                        <th>Označi</th>
                                        <th>Operacije</th>
                                        <th><a href='javascript:sortiraj("idZahtjev_blokiranje", "zahtjev_blokiranje")'>Id</a></th>
                                        <th><a href='javascript:sortiraj("razlog", "zahtjev_blokiranje")'>razlog</a></th>
                                        <th><a href='javascript:sortiraj("datum", "zahtjev_blokiranje")'>datum</a></th>
                                        <th><a href='javascript:sortiraj("idOglas", "zahtjev_blokiranje")'>Id blokiranog oglasa</a></th>
                                    </tr>
                                </thead>
                                <tbody id="zahtjev_blokiranje">
                                </tbody>
                            </table>
                        </div>
                        <div id="zahtjev_blokiranjeUredivanje">
                        </div>
                    </div>
                </div>
            </div> 
            <div class="div2Tablica tablica zahtjev_upisDiv">
                <div class="redTablica">
                    <div class="naslovTablice">
                        <h2>Zahtjevi za upise u termine</h2>
                    </div>
                    <div>
                        <div>
                            <div class="blockGumbiLijevo">
                                <div class="gumbTablicaBlok">
                                    <a class="gumb" title="Dodaj novi" href="javascript:dodajNovi('zahtjev_upis', 7);">
                                        <img src="multimedija/plus16.png"/>
                                        <span class="sakrijGumbTekstTablica">Dodaj novi</span>
                                    </a>
                                </div>
                            </div>
                            <div class="stranicenje">
                                <a class="gumb" href="javascript:stranicenje('zahtjev_upis', -1)" id="prethodni" title="prethodno">
                                    <img src="multimedija/left-arrow.png"/>
                                </a> 
                                <a class="gumb" href="javascript:stranicenje('zahtjev_upis', 1)" id="prethodni" title="prethodno">
                                    <img src="multimedija/right-arrow.png"/>
                                </a> 
                                 <p style="font-size: 10px; display:inline-block">Broj stranica:</p>
                                    <input type="number" id="brojzahtjev_upis" contenteditable="false" class="formaVrijeme" style="width: 40px; display:inline-block;" value="0">
                               
                            </div>
                        </div>
                        <div class="zahtjev_upisDiv">
                            <table class="div3Tablica tekstCentar">
                                <thead>
                                    <tr>
                                        <th>Označi</th>
                                        <th>Operacije</th>
                                        <th><a href='javascript:sortiraj("idZahtjev_Upis", "zahtjev_upis")'>Id</a></th>
                                        <th><a href='javascript:sortiraj("idGrupa", "zahtjev_upis")'>Id grupe</a></th>
                                        <th><a href='javascript:sortiraj("status", "zahtjev_upis")'>Prihvaćen?</a></th>
                                        <th><a href='javascript:sortiraj("ime", "zahtjev_upis")'>Ime</a></th>
                                        <th><a href='javascript:sortiraj("prezime", "zahtjev_upis")'>Prezime</a></th>
                                        <th>Email</th>
                                        <th>Pin</th>
                                        <th>ipAdresa</th>
                                    </tr>
                                </thead>
                                <tbody id="zahtjev_upis">
                                </tbody>
                            </table>
                        </div>
                        <div id="zahtjevUpisUredivanje">
                        </div>
                    </div>
                </div>
            </div> 
            <div class="div2Tablica tablica pozicijaDiv">
                <div class="redTablica">
                    <div class="naslovTablice">
                        <h2>Pozicija</h2>
                    </div>
                    <div>
                        <div>
                            <div class="blockGumbiLijevo">
                                <div class="gumbTablicaBlok">
                                    <a class="gumb" title="Dodaj novi" href="javascript:dodajNovi('pozicija', 8);">
                                        <img src="multimedija/plus16.png"/>
                                        <span class="sakrijGumbTekstTablica">Dodaj novi</span>
                                    </a>
                                </div>
                            </div>
                            <div class="stranicenje">
                                <a class="gumb" href="javascript:stranicenje('pozicija', -1)" id="prethodni" title="prethodno">
                                    <img src="multimedija/left-arrow.png"/>
                                </a> 
                                <a class="gumb" href="javascript:stranicenje('pozicija', 1)" id="prethodni" title="prethodno">
                                    <img src="multimedija/right-arrow.png"/>
                                </a> 
                                 <p style="font-size: 10px; display:inline-block">Broj stranica:</p>
                                    <input type="number" id="brojpozicija" contenteditable="false" class="formaVrijeme" style="width: 40px; display:inline-block;" value="0">
                               
                            </div>
                        </div>
                        <div class="pozicijaDiv">
                            <table class="div3Tablica tekstCentar">
                                <thead>
                                    <tr>
                                        <th>Označi</th>
                                        <th>Operacije</th>
                                        <th><a href='javascript:sortiraj("idPozicija", "pozicija")'>Id</a></th>
                                        <th><a href='javascript:sortiraj("idKorisnikM", "pozicija")'>id korisnika</a></th>
                                        <th><a href='javascript:sortiraj("visina", "pozicija")'>datum</a></th>
                                        <th><a href='javascript:sortiraj("sirina", "pozicija")'>Id blokiranog oglasa</a></th>
                                        <th>Lokacija</th>
                                        <th>URL</th>
                                        <th>Naziv stranice</th>
                                    </tr>
                                </thead>
                                <tbody id="pozicija">
                                </tbody>
                            </table>
                        </div>
                        <div id="pozicijaUredivanje">
                        </div>
                    </div>                            
                </div>
            </div> 
            <div class="div2Tablica tablica terminDiv">
                <div class="redTablica">
                    <div class="naslovTablice">
                        <h2>Termini</h2>
                    </div>                   
                    <div>
                        <div>
                            <div class="blockGumbiLijevo">
                                <div class="gumbTablicaBlok">
                                    <a class="gumb" title="Dodaj novi" href="javascript:dodajNovi('termin', 5);">
                                        <img src="multimedija/plus16.png"/>
                                        <span class="sakrijGumbTekstTablica">Dodaj novi</span>
                                    </a>
                                </div>
                                <div class="gumbTablicaBlok">
                                    <a class="gumb" title="Izradi pdf" href="terminiPDF.php">
                                        <img src="multimedija/export-arrow.png"/>
                                        <span class="sakrijGumbTekstTablica">Izradi pdf</span>
                                    </a>
                                </div>
                            </div>
                            <div class="stranicenje">
                                <a class="gumb" href="javascript:stranicenje('termin', -1)" id="prethodni" title="prethodno">
                                    <img src="multimedija/left-arrow.png"/>
                                </a> 
                                <a class="gumb" href="javascript:stranicenje('termin', 1)" id="prethodni" title="prethodno">
                                    <img src="multimedija/right-arrow.png"/>
                                </a> 
                                 <p style="font-size: 10px; display:inline-block">Broj stranica:</p>
                                    <input type="number" id="brojtermin" contenteditable="false" class="formaVrijeme" style="width: 40px; display:inline-block;" value="0">
                               
                            </div>
                            
                        </div>
                        <div class="terminDiv">
                            <table class="div3Tablica tekstCentar">
                                <thead>
                                    <tr>
                                        <th>Označi</th>
                                        <th>Operacije</th>
                                        <th><a href='javascript:sortiraj("idTermin", "termin")'>Id</a></th>
                                        <th><a href='javascript:sortiraj("idGrupa", "termin")'>Id grupe</a></th>
                                        <th><a href='javascript:sortiraj("idKorisnikM", "termin")'>Moderator id</a></th>
                                        <th><a href='javascript:sortiraj("vrsta_termina", "termin")'>Vrsta </a></th>
                                        <th><a href='javascript:sortiraj("datumVrijemePocetka", "termin")'>Datum pocetka</a></th>
                                        <th><a href='javascript:sortiraj("datumVrijemeZavrsetka", "termin")'>Datum  zavrsetka</a></th>
                                        <th>Dan</th>
                                        <th>Polaznika</th>
                                        <th>Od</th>
                                        <th>Do</th>
                                    </tr>
                                </thead>
                                <tbody id="termin">
                                </tbody>
                            </table>
                        </div>
                        <div id="terminUredivanje">
                        </div>
                    </div>                         
                </div>
            </div> 
        </section>
        <footer>
            <p class="tekstCentar"> Copyright &copy; 2017 Iva Levak. </p>
        </footer>


        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <script type="text/javascript" src="js/tablicaSort.js"></script> 
        <script type="text/javascript" src="js/googleTranslateAPI.js"></script> 
        <link href='css/ilevakGoogleTranslate.css' rel='stylesheet' type="text/css">


    </body>
</html>

