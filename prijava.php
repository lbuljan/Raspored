<?php
include 'konfiguracija.php';

$check = $con->prepare("select * from korisnik where korisnik=:korisnik;");
$check -> bindParam(":korisnik", $_POST["korisnik"]);
$check -> execute();
$operater = $check -> fetch(PDO::FETCH_OBJ);

$_SESSION['operater'] = $operater;
if($operater==NULL):
	header("location: index.php?err=1");
else:
	header("location: home.php");
endif;