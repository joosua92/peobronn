<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="page-header">
				<h1>Sisene</h1>
			</div>
			<?php
			if (isset($_SESSION['alertType'])) {
				echo '<div class="alert alert-' . $_SESSION['alertType'] . '" role="alert" id="alert-box">' . $_SESSION['alertMessage'] . '</div>';
			}
			else {
				echo '<div class="alert collapse" role="alert" id="alert-box"></div>';
			}
			?>
			<div class="alert collapse" role="alert" id="alert-box">
			</div>
			<div class="col-md-6">
				<form action="input/login" method="post" id="login-form">
					<div class="form-group">
						<label for="email">E-mail:</label>
						<input type="text" class="form-control" id="email" placeholder="Sisesta e-mail" name="email">
					</div>
					<div class="form-group">
						<label for="salasõna">Salasõna:</label>
						<input type="password" class="form-control" id="salasõna" placeholder="Sisesta salasõna" name="salasõna">
					</div>
					<input type="submit" value="Sisene">
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