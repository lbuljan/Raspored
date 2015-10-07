<?php
include 'konfiguracija.php';
$dodaj = $con->prepare("insert into slusa (korisnik, predmet) values (:k, :p)");
$dodaj->bindParam(":p", $_POST["sifra"]);
$dodaj->bindParam(":k", $_SESSION["operater"]->sifra);
$dodaj->execute();
echo "OK";