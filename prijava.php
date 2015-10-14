<?php
include 'konfiguracija.php';

$_POST["lozinka"] = md5($_POST["lozinka"]);

$check = $con->prepare("select * from korisnik where korisnik=:korisnik and lozinka=:lozinka;");
$check -> execute($_POST);
$operater = $check -> fetch(PDO::FETCH_OBJ);

if($operater==NULL):
	echo "NE";
else:
	$_SESSION['operater'] = $operater;
	echo "DA";
endif;