<?php include_once "head.php";?>
  <body>
    <div class="row prijava">
		<div class="row">
			<div class="small-8 push-2 columns">
				<img id="logo" src="<?php echo $put;?>img/logo.png" alt="Missed It!"/>
			</div>
		</div>
		<div class="large-6 push-3 small-12 columns">
			<form action="registriraj.php" method="POST" enctype="multipart/form-data">
				<input type="text" id="korisnik" name="korisnik" placeholder="Korisničko ime *"/>
				<input type="password" id="lozinka" name="lozinka" placeholder="Lozinka *"/>
				<input type="password" id="p_lozinka" name="p_lozinka" placeholder="Potvrdi lozinku *"/>
				<label> Profilna slika (nije obavezna) </label>
				<div class="row">
					<input id="upload_file" type="file" name="photo" />
				</div>
				<br/>
				<button class="tipka" id="registriraj"> Registriraj se! </button>
			</form>
		</div>
	</div>
    
    
<?php include_once "js.php";?>
  <script>
	$("#registriraj").click(function(){
		var korisnik = $("#korisnik").val();
		var lozinka = $("#lozinka").val();
		var potvrdi = $("#p_lozinka").val();
		if(!korisnik || !lozinka || !potvrdi){
			alert("Korisničko ime ne smije ostati prazno");
			return false;
		}
		if(lozinka!=potvrdi){
			alert("Lozinke se ne podudaraju!");
			return false;
		};
	})
  </script>
  </body>
</html>
