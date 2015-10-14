<?php
include 'konfiguracija.php';


$valid=true;

$provjeri = $con->prepare("select * from korisnik where korisnik=:k");
$provjeri->bindParam(":k", $_POST["korisnik"]);
$provjeri->execute();
$korisnik = $provjeri->fetch(PDO::FETCH_OBJ);

if($korisnik==NULL):
	if($_FILES["photo"]["name"]):
		if(!$_FILES["photo"]["error"]):
				$file_name=$_POST["korisnik"] . "_" . $_FILES["photo"]["name"];
				if($_FILES["photo"]["size"] > (3096000)):
					$valid=false;
					header("location: registracija.php?err=1");
				endif;
				
				if($valid):
					move_uploaded_file($_FILES["photo"]["tmp_name"], "img/user/". $file_name);
				endif;
			else:
				echo "Problem: " . $_FILES["photo"]["error"];
			endif;	
		$insert = $con->prepare("insert into korisnik(korisnik, lozinka, slika) values (:k, :l, :s)");
		$insert->bindParam(":k", $_POST["korisnik"]);
		$insert->bindParam(":l", md5($_POST["lozinka"]));
		$insert->bindParam(":s", $file_name);
		$insert->execute();
		$id = $con->lastInsertId();
		if($id):
			header("location: index.php");
		else:
			header("location: registracija.php?err=2");
		endif;
	else:
		$insert = $con->prepare("insert into korisnik(korisnik, lozinka) values (:k, :l)");
		$insert->bindParam(":k", $_POST["korisnik"]);
		$insert->bindParam(":l", md5($_POST["lozinka"]));
		$insert->execute();
		$id = $con->lastInsertId();
		if($id):
			header("location: index.php");
		else:
			header("location: registracija.php?err=2");
		endif;
	endif;
else:
	header("location: registracija.php?err=3");
endif;