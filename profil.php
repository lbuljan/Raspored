<?php 
include_once "head.php";

if(!isset($_SESSION["operater"])):
	header("location: index.php");
endif;

?>

	<body>
	<?php include_once "nav.php";?>
	
	<div class="row prijava">
		<div class="small-10 push-1 medium-6 push-3 columns">
		<?php if(isset($_GET["info"])):?>
			<p> Nova slika bit će vidljiva nakon sljedeće prijave </p>
		<?php endif;?>
		<?php if(isset($_GET["err"])):?>
			<p> Došlo je do greške prilikom promjene slike </p>
		<?php endif;?>
		
		<p id="error"></p>
			<form action="#" method="POST" >
				<input type="password" id="n_lozinka" name="n_lozinka" placeholder="Nova lozinka *"/>
				<input type="password" id="p_lozinka" name="p_lozinka" placeholder="Potvrdi novu lozinku *"/>		
				<button class="tipka" id="promjeni"> Promjeni</button>
				
			</form>
			<form action="promjeniSliku.php" method="POST" enctype="multipart/form-data">
				<label> Profilna slika (nije obavezna) </label>
				<div class="row">
					<input id="upload_file" type="file" name="photo" />
				</div>
				<br/>
				<input type="submit" id="upload_file" class="button tipka" value="Promjeni sliku" />
			</form>
		</div>
	</div>
	
	<?php include_once "js.php";?>
	</body>
	<script>
	$("#promjeni").click(function(){
		var nloz = $("#n_lozinka").val();
		var ploz = $("#p_lozinka").val();
		
		if(nloz!=ploz){
			$("#error").html("Nova lozinka ne podudara se s potvrdom iste");
			return false;
		}
		
		$.ajax({
						type: "POST",
						url: "promjeni.php",
						data: "nloz=" + nloz,
						success: function(vratioServer){
							if(vratioServer!="OK"){
								$("#error").html(vratioServer);
							}else{
								window.location.href = "odjava.php";
							}
						}
						
			});
		return false;
	});
	</script>
</html>