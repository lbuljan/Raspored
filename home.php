<?php include_once "head.php";?>
<?php
	
	$predmeti = $con->prepare("select * from korisnik inner join slusa on slusa.korisnik=korisnik.sifra inner join predmet on slusa.predmet=predmet.sifra inner join profesor on profesor.sifra=predmet.profesor where slusa.korisnik=:u");
	$predmeti->bindParam(":u", $_SESSION["operater"]->sifra);
	$predmeti->execute();
	$slusa = $predmeti->fetchAll(PDO::FETCH_OBJ);
?>

	<body>
	<div class="row traka">
		<div class="small-12 columns">
			<p style="float: left;"> <?php echo $_SESSION["operater"]->korisnik;?> </p>
			<a href="prijaviPredmete.php;?>" style="float: right;"> Prijavi predmete </a> 
		</div>
	</div>
	
	<div class="row">
		<?php foreach($slusa as $sl):
			echo $sl->naziv . " " . $sl->ime . " " . $sl->prezime;
		endforeach;?>
	</div>
	<?php include_once "footer.php";?>
	</body>
	
</html>