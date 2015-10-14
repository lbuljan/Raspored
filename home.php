<?php 
include_once "head.php";

if(!isset($_SESSION["operater"])):
	header("location: index.php");
endif;
	
	$predmeti = $con->prepare("select * from korisnik inner join slusa on slusa.korisnik=korisnik.sifra inner join predmet on slusa.predmet=predmet.sifra where slusa.korisnik=:u");
	$predmeti->bindParam(":u", $_SESSION["operater"]->sifra);
	$predmeti->execute();
	$slusa = $predmeti->fetchAll(PDO::FETCH_OBJ);
?>

	<body>
	<?php include_once "nav.php";?>
	
	
		<?php foreach($slusa as $sl):
		$profesor = $con->prepare("select * from profesor inner join predmet on profesor.sifra=predmet.profesor where profesor.sifra=:p");
		$profesor->bindValue(":p", $sl->profesor);
		$profesor->execute();
		$prof = $profesor->fetch(PDO::FETCH_OBJ);
		
		if($sl->asistent!=NULL):
			$asistent = $con->prepare("select * from profesor inner join predmet on profesor.sifra=predmet.asistent where profesor.sifra=:p");
			$asistent->bindValue(":p", $sl->asistent);
			$asistent->execute();
			$asist = $asistent->fetch(PDO::FETCH_OBJ);
		endif;			
		?>
		<div class="predmet">
			<div class="row">
				<div class="small-12 columns">
						<h3 class="naslov"> <?php echo $sl->naziv;?> </h3>
						<small>Profesor: <?php echo $prof->ime . " " . $prof->prezime;?></small>
						<?php if($sl->asistent!=NULL):?>
							<small>, Asistent: <?php echo $asist->ime . " " . $asist->prezime;?> </small>
						<?php endif; ?>
						<hr/>
				</div>
			</div>

			<div class="row centar">
				<div class="small-6 columns">
					<p>Predavanja: <strong class="izostanci"> <?php echo $sl->izostanak_pr;?> / <?php echo $sl->max_izostanaka_pr;?> </strong> </p>
				</div>
				<div class="small-6 columns">
				<img class="dodaj" id="pr_<?php echo $sl->sifra;?>" src="img/plus.png" alt="+"/>				
				<img class="oduzmi" id="pr_<?php echo $sl->sifra;?>" src="img/minus.png" alt="-"/>
				</div>
			</div>
			<div class="row centar">
				<div class="small-6 columns">
					<p>Vježbe/seminari: <strong class="izostanci"> <?php echo $sl->izostanak_vj;?> / <?php echo $sl->max_izostanaka_vj;?> </strong> </p>
				</div>
				<div class="small-6 columns">
					<img class="dodaj" id="vj_<?php echo $sl->sifra;?>" src="img/plus.png" alt="+"/>
					<img class="oduzmi" id="vj_<?php echo $sl->sifra;?>" src="img/minus.png" alt="-"/>
				</div>
			</div>
		</div>
		<?php 
		endforeach;
		?>
	<?php include_once "js.php";?>
	<script>
		$(".dodaj").click(function(){
			var tip = $(this).attr("id").split("_")[0];
			var sifra = $(this).attr("id").split("_")[1];
			$.ajax({
						type: "POST",
						url: "dodajIzostanak.php",
						data: "tip=" + tip + "&sifra=" + sifra,
						success: function(vratioServer){
							if(vratioServer=="OK"){
								location.reload();
							}else{
								alert(vratioServer);
							}
						}
						
			});	
			return false;
		})
		$(".oduzmi").click(function(){
			var tip = $(this).attr("id").split("_")[0];
			var sifra = $(this).attr("id").split("_")[1];
			$.ajax({
						type: "POST",
						url: "oduzmiIzostanak.php",
						data: "tip=" + tip + "&sifra=" + sifra,
						success: function(vratioServer){
							if(vratioServer=="OK"){
								location.reload();
							}else{
								alert(vratioServer);
							}
						}
						
			});	
			return false;
		})
	</script>
	</body>
	
</html>