<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="page-header">
				<h1>Registreeru</h1>
			</div>
			<div class="alert collapse" role="alert" id="alert-box">
			</div>
			<div class="col-md-6">
				<form action="input/register" method="post" id="register-form">
					<div class="form-group">
						<label for="eesnimi">Eesnimi:</label>
						<a href="#" data-toggle="tooltip" data-placement="right" title="Sisesta enda eesnimi või eesnimed">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<input type="text" class="form-control" id="eesnimi" placeholder="Sisest eesnimi" name="eesnimi">
					</div>
					<div class="form-group">
						<label for="perenimi">Perenimi:</label>
						<a href="#" data-toggle="tooltip" data-placement="right" title="Sisesta enda perenimi">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<input type="text" class="form-control" id="perenimi" placeholder="Sisesta perenimi" name="perenimi">
					</div>
					<div class="form-group">
						<label for="email">E-mail:</label>
						<a href="#" data-toggle="tooltip" data-placement="right" title="Sisestage e-posti aadress, mille kaudu teiega kontakti saab">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<input type="text" class="form-control" id="email" placeholder="Sisesta e-mail" name="email">
					</div>
					<div class="form-group">
						<label for="salasõna">Salasõna:</label>
						<a href="#" data-toggle="tooltip" data-placement="right" title="Salasõna peab olema vähemalt 8 märgi pikkune">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<input type="password" class="form-control" id="salasõna" placeholder="Sisesta salasõna" name="salasõna">
					</div>
					<div class="form-group">
						<label for="korda-salasõna">Korda salasõna:</label>
						<a href="#" data-toggle="tooltip" data-placement="right" title="Korda salasõna ja jäta see meelde">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<input type="password" class="form-control" id="korda-salasõna" placeholder="Sisesta salasõna uuesti" name="korda-salasõna">
					</div>
					<input type="submit" value="Registreeru">
				</form>
			</div>
			<div class="col-md-6">
				<div id="google-login-container">
					<div><strong>Sisene läbi Google</strong></div>
					<div class="g-signin2" data-onsuccess="onSignIn"></div>
				</div>
			</div>
		</div>
	</div>
</div>
