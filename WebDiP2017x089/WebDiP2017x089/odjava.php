<?php
setcookie('id', '', 1);
session_start();
session_unset();
session_destroy();

header("Location: prijavaRegistracija.php?mod=prijava");