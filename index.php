<?php include_once "head.php";?>
  <body>
    <div class="row prijava">
		<div class="row">
			<div class="small-8 push-2 columns">
				<img id="logo" src="<?php echo $put;?>img/logo.png" alt="Missed It!"/>
			</div>
		</div>
		<div class="medium-6 push-3 small-12 columns">
			<form action="#" method="POST">
					<input type="text" id="korisnik" name="korisnik" placeholder="Korisničko ime"/>
					<input type="password" id="lozinka" name="lozinka" placeholder="Lozinka"/>
					<button class="tipka" id="prijavi"> Prijavi me </button>
			</form>
			<p id="error"></p>
			<a href="registracija.php"> Registriraj se! </a>
		</div>
	</div>
    
    
<?php include_once "js.php";?>
<script>
	$("#prijavi").click(function(){
		var kor = $("#korisnik").val();
		var pass =$("#lozinka").val();
		$.ajax({
						type: "POST",
						url: "prijava.php",
						data: "korisnik=" + kor + "&lozinka=" + pass,
						success: function(vratioServer){
							if(vratioServer=="NE"){
								$("#error").html("Nepostojeći korisnik ili neispravna lozinka");
							}
							if(vratioServer=="DA"){
								window.location.href = "home.php";
							}
						}
						
			});
		return false;
	});
</script>
  </body>
</html>
