<?php include_once "head.php";?>
  <body>
    <div class="row prijava">
		<div class="large-6 push-3 small-12 columns">
			<form action="prijava.php" method="POST">
				<input type="text" name="korisnik" placeholder="Korisničko ime"/>
				<input type="submit" id="prijavi" class="small radius button" value="Prijavi se" />
			</form>
			<?php if(isset($_GET["err"])):?>
				<p>
					Nepostojeći korisnik.
				</p>
			<?php endif;?>
			<a href="registracija.php"> Registriraj se! </a>
		</div>
	</div>
    
    
<?php include_once "footer.php";?>
  </body>
</html>
