<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BazaPod {

    const server = "localhost";
    const korisnik = "WebDiP2017x089";
    const lozinka = "admin_lzxJ";
    const baza = "WebDiP2017x089";

    private $veza = null;
    private $greska = '';

	function spojiDB()
	{
		$mysqli = new mysqli(self::server, self::korisnik, self::lozinka, self::baza);
		if($mysqli->connect_errno)
		{
			echo "Neuspješno spajanje na bazu. " . $mysqli -> connect_errno . ', ' . E_USER_ERROR;
		}
		mysqli_set_charset($mysqli, 'utf8');
		return $mysqli;
	}
	function selectDB($upit)
	{
		$veza = self::spojiDB();
		$res = $veza->query($upit) or trigger_error($veza->error);
		if(!$res)
		{
			$res = false;
		}
		self::zatvoriDB($veza);
		return $res;
	}
	function zatvoriDB($veza)
	{
		$veza->close();
	}
	function izvrsiDB($upit)
	{
		$res = self::spojiDB();
		if($rezultat = $res->query($upit))
		{
			self::zatvoriDB($res);
			return true;
		}
		else
		{
			echo $res->error;
			self::zatvoriDB($res);
			return false;
		}
	}
}
?>
