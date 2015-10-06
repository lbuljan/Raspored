<?php
include 'konfiguracija.php';
$tip = "izostanak_" . $_POST["tip"];
$dodaj = $con->prepare("update slusa set $tip=($tip + 1) where predmet=:p and korisnik=:u");
$dodaj->bindParam(":p", $_POST["sifra"]);
$dodaj->bindParam(":u", $_SESSION["operater"]->sifra);
$dodaj->execute();
echo "OK";