<?php include_once "head.php";?>
  <body>
    <div class="row prijava">
		<div class="large-6 push-3 small-12 columns">
			<form action="registriraj.php" method="POST" enctype="multipart/form-data">
				<label for="korisnik"> Korisničko ime </label>
				<input type="text" id="korisnik" name="korisnik" placeholder="Korisničko ime *"/>
				<input type="text" id="potvrdi" name="potvrdi" placeholder="Potvrdi korisničko ime *" />
				<label for="profilna"> Profilna slika (nije obavezna) </label>
				<input type="file" name="photo" class="small radius alert button"/>
				<input type="submit" id="registriraj" name="submit" class="small radius button" value="Registriraj se" />
			</form>
			<?php 
			if(isset($_GET["err"])):
				if($_GET["err"]==1):?>
				<p> Slika je prevelika, mora biti ispod 3MB </p>
			<?php endif;
				if($_GET["err"]==2):?>
				<p> Registracija neuspjela, pokušajte opet </p>
			<?php endif;
				if($_GET["err"]==3):?>
				<p> Korisnik već postoji </p>
			<?php endif;
			endif;?>
		</div>
	</div>
    
    
<?php include_once "footer.php";?>
  <script>
	$("#registriraj").click(function(){
		var korisnik = $("#korisnik").val();
		var potvrdi = $("#potvrdi").val();
		if(!korisnik){
			alert("Korisničko ime ne smije ostati prazno");
			return false;
		}
		if(korisnik!=potvrdi){
			alert("Korisnička imena se ne podudaraju!");
			return false;
		};
	})
  </script>
  </body>
</html>
