<div class="container">
	<div class="page-header">
		<h1>Profiil</h1>
	</div>
	<?php
	if (isset($_SESSION['alertType'])) {
		echo '<div class="alert alert-' . $_SESSION['alertType'] . '" role="alert" id="alert-box">' . $_SESSION['alertMessage'] . '</div>';
	}
	else {
		echo '<div class="alert collapse" role="alert" id="alert-box"></div>';
	}
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="col-md-6">
					<?php
					echo '<img src="' . $profile_picture_path . '?=' . rand(10000, 99999) . '" id="profiilipilt">';
					?>
					<div id="vaheta-pilti-konteiner">
						<form action="profile/picture_upload" method="post" enctype="multipart/form-data">
							<div class="form-group" id="vaheta-pilti-form-group">
								<label for="kasutaja-fail">Vaheta profiilipilti</label>
								<a href="#" data-toggle="tooltip" data-placement="right" title="Sobivad formaadid: gif, jpg, png">
									<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
								</a>
								<input type="file" class="form-control-file" name="kasutaja-fail" id="kasutaja-fail">
							</div>
							<input type="submit" value="Lae pilt üles" id="lae-pilt">
						</form>
						<form action="profile/picture_remove" method="post">
							<input type="submit" value="Eemalda praegune pilt" id="eemalda-pilt">
						</form>
					</div>
				</div>
				<div class="col-md-6" id="profiili-info">
					<h3>Andmed</h3>
					<p><b>Eesnimi:&nbsp&nbsp</b><?php echo $_SESSION['eesnimi']; ?></p>
					<p><b>Perenimi:&nbsp&nbsp</b><?php echo $_SESSION['perenimi']; ?></p>
					<p><b>E-mail:&nbsp&nbsp</b><?php echo $_SESSION['email']; ?></p>
				</div>
			</div>
			<div class="col-md-6">
				<h3>Broneeringud</h3>
				<?php
				if (count($reservations) == 0) {
					echo '<p>Teil pole ühtegi broneeringut.</p>';
				}
				else {
					echo '<table class="table">';
					echo '<tr><th>Kuupäev</th><th>Kellaaeg</th><th>Pakett</th><th></th></tr>';
					foreach ($reservations as $reservation) {
						$cancel_form = '<form action="input/cancel_reservation/' . $reservation->id . '" method="post"><input type="submit" value="Tühista" class="btn-link"></form>';
						echo '<tr><td>' . $reservation->kuupäev . '</td><td>' . $reservation->kellaaeg . '</td><td>' . $reservation->pakett . '</td><td>' . $cancel_form . '</td></tr>';
					}
					echo '</table>';
				}
				?>
			</div>
		</div>
	</div>
</div>