<div class="traka">
		<div class="row" >
			<div class="small-12 medium-10 push-1 columns" style="text-align: center">
				<div class="small-12 medium-4 columns">
					<a href="<?php echo $put;?>profil.php">
						<img id="profilna" src="<?php echo $put;?>img/user/<?php echo $_SESSION["operater"]->slika;?>" />
						<?php echo $_SESSION["operater"]->korisnik;?> 
					</a>
				</div>
				<div class="small-12 medium-8 columns">
					<div class="small-4 columns">
						<a href="<?php echo $put;?>home.php"> Početna </a>
					</div>
					<div class="small-4 columns">
						<a href="<?php echo $put;?>predmeti.php"> Predmeti </a>
					</div>
					<div class="small-4 columns">
						<a href="<?php echo $put;?>odjava.php"> Odjava </a>
					</div>
				</div>
			</div>	
		</div>
	</div>