<?php
session_start();
include_once 'baza.class.php';
$baza = new BazaPod();
$mod = '';
/* Virtualno */
$virtualnoVrijeme;
$sqlUpit = "SELECT pomak FROM virtualno_vrijeme";
if ($rezultat = $baza->selectDB($sqlUpit)) {
    $value = mysqli_fetch_object($rezultat);
    $virtualnoVrijeme = $value->pomak * 60 * 60;
}

/* za reCaptcha */
require_once 'recaptchalib.php';
$secret = "6Ld8Bl0UAAAAAIthX4fDZbFkzutLr08LFXman1_q";
$response = null;
$reCaptcha = new ReCaptcha($secret);

/* za registraciju (R-reg, G-greska) */
$imeRG = $prezimeRG = $emailRG = $lozinkaRG = $lozinkaPonovljenaRG = $dobRG = $korisnickoImeRG = $recaptchaRG = "";
$imeR = $prezimeR = $emailR = $lozinkaR = $lozinkaPonovljenaR = $dobR = $korisnickoImeR = "";


/* za prijavu */
$korimeP = $lozinkaP = "";
$korimePG = $lozinkaPG = "";
$prijavaUspjesna = "";


/* cookies */
$cookieIme = "Korisnik";
setcookie("brojNeuspjelihPrijava", 0);

if (isset($_POST["tipkaRegistracije"])) {
    $mod = 'registracija';
} else if (isset($_POST["tipkaPrijave"])) {
    $mod = 'prijava';
}
if (isset($_GET['mod'])) {
    $mod = $_GET['mod'];
    if ($mod == 'registracija') {
        registracija();
    } else if ($mod == 'prijava') {
        prijava();
    } else {
        echo "Odabran je nepoznati mod!";
    }
} else {
    echo "Nije odabran mod";
}

function testiranjeInput($podatak) {
    $podatak = trim($podatak);
    $podatak = stripslashes($podatak);
    $podatak = htmlspecialchars($podatak);
    return $podatak;
}

function registracija() {
    global $response;
    global $reCaptcha;
    global $baza;
    global $virtualnoVrijeme;
    global $imeRG, $prezimeRG, $emailRG, $lozinkaRG, $lozinkaPonovljenaRG, $dobRG, $korisnickoImeRG, $recaptchaRG;
    global $imeR, $prezimeR, $emailR, $lozinkaR, $lozinkaPonovljenaR, $dobR, $korisnickoImeR;

    $korisnik = array();
    $status = true;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST["g-recaptcha-response"]) {
            $response = $reCaptcha->verifyResponse(
                    $_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]
            );
        }

        if (empty($_POST["email-R"])) {
            $emailRG = "Potrebno je upisati email!";
            $status = false;
        } else {
            $emailR = testiranjeInput($_POST["email-R"]);
            $sqlUpit = 'SELECT * FROM korisnik WHERE email=\'' . $emailR . '\'';
            $rezultat = $baza->selectDB($sqlUpit);
            if (!preg_match("/([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}/", $emailR)) {
                $emailRG = "Upišite e-mail u formatu: primjer@xxx.com";
                $status = false;
            } else if ($rezultat->num_rows > 0) {
                $emailRG = "Ovaj email vec postoji! Probajte se prijaviti!";
                $status = false;
            }
        }
        if (empty($_POST["prezime-R"])) {
            $prezimeRG = "Potrebno je upisati prezime!";
            $status = false;
        } else {
            $prezimeR = testiranjeInput($_POST["prezime-R"]);
            if (!preg_match("/^([šžćčđŽŠĆČĐA-Z a-z])*$/", $prezimeR)) {
                $prezimeRG = "Dozvoljena su samo velika i mala slova u prezimenu!";
                $status = false;
            }
        }
        if (empty($_POST["ime-R"])) {
            $imeRG = "Potrebno je upisati ime!";
            $status = false;
        } else {
            $imeR = testiranjeInput($_POST["ime-R"]);
            if (!preg_match("/([šžćčđŽĆČŠĐA-Z a-z])+/", $imeR)) {
                $imeRG = "Dozvoljena su samo velika i mala slova u imenu!";
                $status = false;
            }
        }

        if (empty($_POST["korimeR"])) {
            $korisnickoImeRG = "Potrebno je upisati korisnicko ime!";
            $status = false;
        } else {
            $korisnickoImeR = testiranjeInput($_POST["korimeR"]);
            //$sqlUpit = 'SELECT * FROM korisnik WHERE korisnickoIme=\'' . $korisnickoImeR . '\'';
            //  $rezultat = $baza->selectDB($sqlUpit);
            if (!preg_match("/[A-Z a-z 0-9 \. \- _ ~]/", $korisnickoImeR)) {
                $korisnickoImeRG = "Korisnicko ime smije sadrzavati samo slova i brojke te znakove '_', '-', '.' i '~'";
                $status = false;
            }
        }

        if (empty($_POST["dob-R"])) {
            $dobRG = "Potreno je upisati godine!";
            $status = false;
        } else {
            $dobR = testiranjeInput($_POST["dob-R"]);
            if (!preg_match("/[0-9]/", $dobR)) {
                $dobRG = "Dozvoljeni su samo brojevi!";
                $status = false;
            } else if ($dobR < 17) {
                $dobRG = "Morate imati 18god!";
                $status = false;
            }
        }

        if (empty($_POST["lozinka-R"])) {
            $lozinkaRG = "Potrebno je upisati lozinku!";
            $status = false;
        } else {
            $lozinkaR = testiranjeInput($_POST["lozinka-R"]);
            if (!preg_match("/([A-Z a-z])*([0-9])/", $lozinkaR)) {
                $lozinkaRG = "Lozinka mora sadržavati samo velika i mala slova i barem jednu brojku!";
                $status = false;
            }
        }

        if (empty($_POST["lozinkaPonovljena-R"])) {
            $lozinkaPonovljenaRG = "Potrebno je ponovo upisati lozinku!";
            $status = false;
        } else {
            $lozinkaPonovljenaR = testiranjeInput($_POST["lozinkaPonovljena-R"]);
            $lozinkaR = testiranjeInput($_POST["lozinka-R"]);
            if ($lozinkaR != $lozinkaPonovljenaR) {
                $lozinkaPonovljenaRG = "Niste upisali istu lozinku!";
                $status = false;
            }
        }


        if ($response === null || !($response->success)) {
            $recaptchaRG = "Potvrdite re-captcha!";
            $status = false;
        }


        if ($status != false) {
            $korisnik['ime'] = $_POST['ime-R'];
            $korisnik['prezime'] = $_POST['prezime-R'];
            $korisnik['email'] = $_POST['email-R'];
            $korisnik['lozinka'] = $_POST['lozinka-R'];
            $korisnik['lozinkaPonovljena'] = $_POST['lozinkaPonovljena-R'];
            $korisnik['dob'] = $_POST['dob-R'];
            $korisnik['korisnickoIme'] = $_POST['korimeR'];
            $datumSad = date_add((new DateTime()), date_interval_create_from_date_string('' . $virtualnoVrijeme . ' seconds'));
            $korisnik['datumVrijemeRegistracije'] = $datumSad->format('Y-m-d H:i:s');
            $korisnik['hash'] = md5(rand(0, 1000));
            $sqlUpit = 'INSERT INTO korisnik 
            (
                ime, 
                prezime, 
                korisnickoIme, 
                email, 
                lozinka, 
                kriptiranaLozinka, 
                dob, 
                datumVrijemeRegistracije,
                hash
            )
            VALUES
            (
                \'' . $korisnik['ime'] . '\',
                \'' . $korisnik['prezime'] . '\',
                \'' . $korisnik['korisnickoIme'] . '\',
                \'' . $korisnik['email'] . '\',
                \'' . $korisnik['lozinka'] . '\',
                \'' . sha1($korisnik['lozinka'] . '0121123456124') . '\',
                \'' . $korisnik['dob'] . '\',
                \'' . $korisnik['datumVrijemeRegistracije'] . '\',
                \'' . $korisnik['hash'] . '\'
            )';
            if ($baza->izvrsiDB($sqlUpit)) {
                $prima = $korisnik['email'];
                $predmet = 'Registracija/Verifikacija računa';
                $poruka = ' 
                    Hvala što ste se registrirali!
                    Tvoj račun je kreiran, možeš se prijaviti sa sljedećim podacima, nakon što pritiskom na link niže aktiviraš račun!
                    
                    ------------------------------------
                    Korisničko ime: ' . $korisnik['ime'] . '
                    Lozinka: ' . $korisnik['lozinka'] . '
                    ------------------------------------
                    Molimo pritisnite link kako bi aktivirali svoj račun:
                    http://barka.foi.hr/WebDiP/2017_projekti/WebDiP2017x089/uspjesnaRegistracija.php?email=' . $korisnik['email'] . '&hash=' . $korisnik['hash'] . '
                ';

                $header = 'From:noreply@autoskola.com' . "\r\n";
                mail($prima, $predmet, $poruka, $header);




                header("Location: uspjesnaRegistracija.php");
            }
        }
    }
}

function prijava() {
    global $baza;
    global $korimeP, $lozinkaP;
    global $korimePG, $lozinkaPG;
    global $prijavaUspjesna;
    global $cookieIme;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST["korime-P"]) || empty($_POST["lozinka-P"])) {
            $korimePG = "Niste upisali sve podatke!";
        } else {
            $korimeP = testiranjeInput($_POST['korime-P']);
            $lozinkaP = testiranjeInput($_POST['lozinka-P']);
            $sqlUpit = 'SELECT*FROM korisnik WHERE korisnickoIme=\'' . $korimeP . '\'';
            $rezultat = $baza->selectDB($sqlUpit);
            if ($rezultat->num_rows === 1) {
                $sqlUpit = 'SELECT*FROM korisnik WHERE korisnickoIme=\'' . $korimeP . '\' 
                AND stanje=\'1\'AND  blokiran_stanje=\'0\'';
                $rezultat = $baza->selectDB($sqlUpit);
                if ($rezultat->num_rows === 1) {
                    $sqlUpit = 'SELECT*FROM korisnik WHERE korisnickoIme=\'' . $korimeP . '\'AND lozinka=\'' . $lozinkaP . '\'';
                    $rezultat = $baza->selectDB($sqlUpit);
                    if ($rezultat->num_rows === 1) {
                        $korisnik = $rezultat->fetch_assoc();
                        if (isset($_POST['zapamtiMe-P'])) {
                            if (!isset($_COOKIE[$cookieIme])) {
                                $cookieVrijednost = $korisnik['korisnickoIme'];
                                
                                setcookie($cookieIme, $cookieVrijednost, time() + (86400 * 2));
                            }
                        }
                        
                            setcookie("id",$korisnik['idKorisnik']);
                        $prijavaUspjesna = "Uspjesno ste se prijavili!";
                        $_SESSION["prijava"];
                        $sqlUpit = 'SELECT idKorisnik, tip FROM korisnik WHERE korisnickoIme=\'' . $korimeP . '\'AND lozinka=\'' . $lozinkaP . '\'';
                        if ($rezultat2 = $baza->selectDB($sqlUpit)) {
                            $value = mysqli_fetch_object($rezultat2);
                            if ($value->tip == 'registrirani') {
                                $broj = 1;
                            } else if ($value->tip == 'moderator') {
                                $broj = 2;
                            } else if ($value->tip == 'administrator') {
                                $broj = 3;
                            }
                        }
                        setcookie("id",$value->idKorisnik);
                        $_SESSION["prijava"] = $broj;
                        header("Location: index.php");
                    } else {
                        $brojNeuspjelihPrijava = $_COOKIE["brojNeuspjelihPrijava"];
                        $brojNeuspjelihPrijava++;
                        setcookie("brojNeuspjelihPrijava", $brojNeuspjelihPrijava);
                        if ($brojNeuspjelihPrijava === 3) {
                            $sqlUpit = "UPDATE korisnik SET blokiran_stanje='1' WHERE korisnickoIme='" . $korimeP . "'";
                            if ($baza->izvrsiDB($sqlUpit)) {
                                $prijavaUspjesna = "Vas racun je blokiran!Unjeli ste 3 puta krivu lozinku! Pokusajte iduci dan!";
                                setcookie("brojNeuspjelihPrijava", 0);
                            }
                        } else {
                            $lozinkaPG = "Upisali ste krivu lozinku!";
                            $temp = 3 - $brojNeuspjelihPrijava;
                            $prijavaUspjesna = "Imate jos " . $temp . " pokusaja";
                            //echo $brojNeuspjelihPrijava;
                        }
                    }
                } else {
                    $prijavaUspjesna = "Blokiran vam je račun, probajte se prijaviti neki drugi dan!";
                }
            } else {
                $korimePG = "Upisali ste krivo korisnicko ime.";
            }
        }
    } else {
        
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
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/3.2.0/jquery.min.js"></script>
            <script type="text/javascript" src="js/prijavaRegistracija.js"></script> 
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

<?php
if (isset($_GET["mod"]) && $_GET["mod"] == "prijava") {
    if (empty($_SERVER['HTTPS'])) {
        header("Location: https://barka.foi.hr/WebDiP/2017_projekti/WebDiP2017x089/prijavaRegistracija.php?mod=prijava");
    }
    if (isset($_COOKIE[$cookieIme])) {
        $korimeP = $_COOKIE[$cookieIme];
    }
    ?>

                <section id="prijava" class="sekcijaPrijava tekstCentar">
                    <div class="pozadinskaSlikaPrijavaRegistracija"> 
                        <div class="preklapanje">
                            <div class="divovi">
                                <div class="naslov1">
                                    <h2>Prijava</h2>
                                    <div id="google_translate_element"></div>

                                </div>
                                <div class="sadrzajPrijavaRegistracija">
                                    <form name="prijava" id="prijava" novalidate method="post">
                                        <div class="red">
                                            <div class="sadrzajPrijavaRegistracija  inputKontakt">
                                                <div class="grupaForme">
                                                    <input type="text" id="korime-P" name="korime-P" class="formaDio" placeholder="Korisnicko ime" required="required" value="<?php echo $korimeP; ?>">
                                                    <p class="pomoc tekst-krivo"><?php echo $korimePG ?></p>
                                                </div>
                                            </div>
                                            <div class="sadrzajPrijavaRegistracija  inputKontakt">
                                                <div class="grupaForme">
                                                    <input type="password" id="lozinka-P" name="lozinka-P" class="formaDio" placeholder="Lozinka" required="required" value="<?php echo $lozinkaP; ?>">
                                                    <p class="pomoc tekst-ktivo"><?php echo $lozinkaPG ?></p>
                                                </div>
                                            </div>

                                            <div class="sadrzajPrijavaRegistracija inputKontakt inputCheckbox">
                                                <div class="divCheckBox">
                                                    <input id="zapamtiMe-P" name="zapamtiMe-P" type="checkbox" class="checkbox" checked>
                                                    <label for="zapamtiMe-P"></label>
                                                    <p class="pCheckBox">Zapamti me</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="uspjesno"><?php echo $prijavaUspjesna ?></div>
                                        <button type="submit" name="tipkaPrijave" class="gumbForme">Prijavi me</button>

                                        <p> Niste registrirani? <a class="gumbRegistracije" href="prijavaRegistracija.php?mod=registracija">Registriraj se!</a> </p>
                                        <p> Zaboravili ste lozinku? Pritisnite <a class="gumbRegistracije" href="slanjeLozinke.php" >ovdje.</a> </p>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

    <?php
} else if (isset($_GET["mod"]) && $_GET["mod"] == "registracija") {
    if (empty($_SERVER['HTTPS'])) {
        header("Location: https://barka.foi.hr/WebDiP/2017_projekti/WebDiP2017x089/prijavaRegistracija.php?mod=registracija");
    }
    ?>


                <section id="registracija" class="sekcijaRegistracija tekstCentar">
                    <div class="pozadinskaSlikaPrijavaRegistracija"> 
                        <div class="preklapanje">
                            <div class="divovi">
                                <div class="naslov1">
                                    <h2>Registracija</h2>
                                    <div id="google_translate_element"></div>
                                </div>
                                <div class="sadrzajPrijavaRegistracija">
                                    <form name="registracija" id="registracija" method="post"  novalidate action="prijavaRegistracija.php?mod=registracija">
                                        <div class="red">
                                            <div class="sadrzajPrijavaRegistracija  inputKontakt">
                                                <div class="grupaForme">
                                                    <input type="email" id="email-R" name="email-R" class="formaDio" placeholder="Email" value="<?php echo $emailR; ?>">
                                                    <p class="pomoc tekst-krivo"><?php echo $emailRG; ?></p>
                                                </div>
                                            </div>
                                            <div class="sadrzajPrijavaRegistracija  inputKontakt">
                                                <div class="grupaForme">
                                                    <input type="text" id="ime-R" name="ime-R" class="formaDio" placeholder="Ime" value="<?php echo $imeR; ?>">
                                                    <p class="pomoc tekst-krivo"><?php echo $imeRG; ?></p>
                                                </div>
                                            </div>

                                            <div class="sadrzajPrijavaRegistracija  inputKontakt">
                                                <div class="grupaForme">
                                                    <input type="text" id="prezime-R" name="prezime-R" class="formaDio" placeholder="Prezime" value="<?php echo $prezimeR; ?>">
                                                    <span id="dostupnost"></span>
                                                    <p class="pomoc tekst-krivo"><?php echo $prezimeRG; ?></p>
                                                </div>
                                            </div>
                                            <div class="sadrzajPrijavaRegistracija  inputKontakt">
                                                <div class="grupaForme">
                                                    <input type="text" id="korimeR" onblur="provjeri('korimeR', 'korisnickoImeID', this.value)" name="korimeR" class="formaDio" placeholder="Korisnicko ime"  value="<?php echo $korisnickoImeR; ?>">

                                                    <p  id="korisnickoImeID" class="pomoc tekst-krivo"><?php echo $korisnickoImeRG; ?></p>
                                                </div>
                                            </div>
                                            <div class="sadrzajPrijavaRegistracija  inputKontakt">
                                                <div class="grupaForme">
                                                    <input type="password" id="lozinka-R" name="lozinka-R" class="formaDio" placeholder="Lozinka"  value="<?php echo $lozinkaR; ?>">
                                                    <p class="pomoc tekst-krivo"><?php echo $lozinkaRG; ?></p>
                                                </div>
                                            </div>
                                            <div class="sadrzajPrijavaRegistracija  inputKontakt">
                                                <div class="grupaForme">
                                                    <input type="password" id="lozinkaPonovljena-R" name="lozinkaPonovljena-R" class="formaDio" placeholder="Ponovi lozinku"  value="<?php echo $lozinkaPonovljenaR; ?>">
                                                    <p class="pomoc tekst-krivo"><?php echo $lozinkaPonovljenaRG; ?></p>
                                                </div>
                                            </div>
                                            <div class="sadrzajPrijavaRegistracija  inputKontakt">
                                                <div class="grupaForme">
                                                    <input type="number" id="dob-R" class="formaDio" name="dob-R" placeholder="Dob"  value="<?php echo $dobR; ?>">
                                                    <p class="pomoc tekst-krivo"><?php echo $dobRG; ?></p>
                                                </div>
                                            </div>
                                            <div class="sadrzajPrijavaRegistracija  inputKontakt">
                                                <div class="grupaForme tekstCentar">
                                                    <div class="g-recaptcha recaptcha" data-theme="dark" data-sitekey="6Ld8Bl0UAAAAAPca4hv3gBDYHhreY236VAsHRQTw"></div>
                                                    <p class="pomoc tekst-krivo"><?php echo $recaptchaRG; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="uspjesno"></div>
                                        <input type="submit"  name="tipkaRegistracije" id="tipkaRegistracije" class="gumbForme" value="Registriraj me!">
                                        <a class="gumbForme" href="prijavaRegistracija.php?mod=prijava">Prijavi se!</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
    <?php
}
?>
            <footer>
                <p class="tekstCentar"> Copyright &copy; 2017 Iva Levak. </p>
            </footer>
            <script type="text/javascript" src="js/prilagodbe.js"></script> 

            <script src='https://www.google.com/recaptcha/api.js'></script>
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            <script type="text/javascript" src="js/googleTranslateAPI.js"></script> 
            <link href='css/ilevakGoogleTranslate.css' rel='stylesheet' type="text/css">
        </body>
    </html>
