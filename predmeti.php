<?php 
include_once "head.php";

if(!isset($_SESSION["operater"])):
	header("location: index.php");
endif;

$slusa = $con->prepare("select sifra from predmet where sifra not in (select predmet from slusa where korisnik=:k) order by naziv asc;");
$slusa->bindParam(":k", $_SESSION["operater"]->sifra);
$slusa->execute();
$popis = $slusa->fetchAll(PDO::FETCH_OBJ);

$upisan = array();
foreach($popis as $po):
	array_push($upisan, $po->sifra);
endforeach;

$predmeti = $con->prepare("select * from predmet order by naziv asc");
$predmeti->execute();
$subjects = $predmeti->fetchAll(PDO::FETCH_OBJ);

?>

	<body>
		<?php include_once "nav.php";?>

	
	<div class="row">
		<div class="small-12 columns centar">
			<h1 class="naslov"> Predmeti </h1>
			<p> Odaberi predmete koje slušaš i na kraju klikni na link "Početna" </p>
			<hr/>
		</div>
	</div>
	
		<?php 
		foreach($subjects as $list):
		
				$profesor = $con->prepare("select * from profesor inner join predmet on profesor.sifra=predmet.profesor where profesor.sifra=:p");
				$profesor->bindValue(":p", $list->profesor);
				$profesor->execute();
				$prof = $profesor->fetch(PDO::FETCH_OBJ);
				
				if($list->asistent!=NULL):
					$asistent = $con->prepare("select * from profesor inner join predmet on profesor.sifra=predmet.asistent where profesor.sifra=:p");
					$asistent->bindValue(":p", $list->asistent);
					$asistent->execute();
					$asist = $asistent->fetch(PDO::FETCH_OBJ);
				endif;
		?>
		<div class="predmet">
			<div class="row">
				<div class="small-9 columns">
						<h3 class="naslov"> <?php echo $list->naziv;?> </h3>						
				</div>
				<div class="small-3 columns centar">
					<?php if(in_array($list->sifra, $upisan)):?>
						<img class="dodaj" id="pr_<?php echo $list->sifra;?>" src="img/plus.png" alt="+"/>
						<?php else:?>
						<img class="oduzmi" id="pr_<?php echo $list->sifra;?>" src="img/minus.png" alt="-"/>
					<?php endif;?>
				</div>
				<div class="small-12 columns">
					<small>Profesor: <?php echo $prof->ime . " " . $prof->prezime;?></small>
						<?php if($list->asistent!=NULL):?>
							<small>, Asistent: <?php echo $asist->ime . " " . $asist->prezime;?> </small>
						<?php endif; ?>
				</div>
				<hr/>
			</div>
			<div class="row">
				<div class="small-12 medium-12 columns">
					<p>Broj dopuštenih izostanaka s predavanja: <strong class="izostanci"> <?php echo $list->max_izostanaka_pr;?> </strong> </p>
					<p>Broj dopuštenih izostanaka s vježbi/seminara: <strong class="izostanci"> <?php echo $list->max_izostanaka_vj;?> </strong> </p>
				</div>
				<hr/>
			</div>
		</div>
		<?php
		endforeach;
		?>
	<?php include_once "js.php";?>
	<script>
		$(".dodaj").click(function(){
			var sifra = $(this).attr("id").split("_")[1];
			$.ajax({
						type: "POST",
						url: "dodajPredmet.php",
						data: "&sifra=" + sifra,
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
			var sifra = $(this).attr("id").split("_")[1];
			$.ajax({
						type: "POST",
						url: "oduzmiPredmet.php",
						data: "sifra=" + sifra,
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