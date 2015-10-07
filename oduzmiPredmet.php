<?php
include 'konfiguracija.php';
$dodaj = $con->prepare("delete from slusa where korisnik=:k and predmet=:p");
$dodaj->bindParam(":p", $_POST["sifra"]);
$dodaj->bindParam(":k", $_SESSION["operater"]->sifra);
$dodaj->execute();
echo "OK";