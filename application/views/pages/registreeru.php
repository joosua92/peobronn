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
						<input type="text" class="form-control" id="eesnimi" placeholder="Sisest eesnimi" name="eesnimi">
					</div>
					<div class="form-group">
						<label for="perenimi">Perenimi:</label>
						<input type="text" class="form-control" id="perenimi" placeholder="Sisesta perenimi" name="perenimi">
					</div>
					<div class="form-group">
						<label for="email">E-mail:</label>
						<input type="text" class="form-control" id="email" placeholder="Sisesta e-mail" name="email">
					</div>
					<div class="form-group">
						<label for="salasõna">Salasõna:</label>
						<input type="password" class="form-control" id="salasõna" placeholder="Sisesta salasõna" name="salasõna">
					</div>
					<div class="form-group">
						<label for="korda-salasõna">Korda salasõna:</label>
						<input type="password" class="form-control" id="korda-salasõna" placeholder="Sisesta salasõna uuesti" name="korda-salasõna">
					</div>
					<input type="submit" value="Registreeru">
				</form>
			</div>
			<div class="col-md-6">
				<div id="google-login-container">
					<div><b>Sisene läbi Google<b></div>
					<div class="g-signin2" data-onsuccess="onSignIn"></div>
				</div>
			</div>
		</div>
	</div>
</div>
