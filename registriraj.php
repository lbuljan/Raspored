<?php
include 'konfiguracija.php';


$valid=true;
if($_FILES["photo"]["name"]):
	if(!$_FILES["photo"]["error"]):
		$file_name=$_POST["korisnik"] . "_" . $_FILES["photo"]["name"];
		if($_FILES["photo"]["size"] > (3096000)):
			$valid=false;
			header("location: registracija.php?err=1");
		endif;
		
		if($valid):
			move_uploaded_file($_FILES["photo"]["tmp_name"], "img/profilne/". $file_name);
		endif;
	else:
		echo "Problem: " . $_FILES["photo"]["error"];
	endif;
endif;

$provjeri = $con->prepare("select * from korisnik where korisnik=:k");
$provjeri->bindParam(":k", $_POST["korisnik"]);
$provjeri->execute();
$korisnik = $provjeri->fetch(PDO::FETCH_OBJ);

if($korisnik==NULL):
	$insert = $con->prepare("insert into korisnik(korisnik, slika) values (:k, :s)");
	$insert->bindParam(":k", $_POST["korisnik"]);
	$insert->bindParam(":s", $file_name);
	$insert->execute();
	$id = $con->lastInsertId();
	if($id):
		header("location: index.php");
	else:
		header("location: registracija.php?err=2");
	endif;
else:
	header("location: registracija.php?err=3");
endif;