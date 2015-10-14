<?php
include 'konfiguracija.php';

$_POST["nloz"] = md5($_POST["nloz"]);

$update = $con->prepare("update korisnik set lozinka=:lozinka where sifra=:s");
$update->bindParam("lozinka", $_POST["nloz"]);
$update->bindParam(":s", $_SESSION["operater"]->sifra);
$update->execute();
echo "OK";