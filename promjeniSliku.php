<?php
include 'konfiguracija.php';


$valid=true;
if($_FILES["photo"]["name"]):
	if(!$_FILES["photo"]["error"]):
			$file_name=$_SESSION["operater"]->sifra . "_" . $_FILES["photo"]["name"];
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
		$insert = $con->prepare("update korisnik set slika=:slika where sifra=:s");
		$insert->bindParam(":slika", $file_name);
		$insert->bindParam(":s", $_SESSION["operater"]->sifra);
		$insert->execute();
		
		header("location: profil.php?info");
else:
		header("location: profil.php?err");
endif;