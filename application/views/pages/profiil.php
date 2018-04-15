<div class="container">
	<div class="page-header">
		<h1><?php echo lang('profile_main_heading'); ?></h1>
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
								<label for="kasutaja-fail"><?php echo lang('profile_change_picture'); ?></label>
								<a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo lang('profile_change_picture_tip'); ?>">
									<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
								</a>
								<input type="file" class="form-control-file" name="kasutaja-fail" id="kasutaja-fail">
							</div>
							<input type="submit" value="<?php echo lang('profile_button_upload'); ?>" id="lae-pilt">
						</form>
						<form action="profile/picture_remove" method="post">
							<input type="submit" value="<?php echo lang('profile_button_remove'); ?>" id="eemalda-pilt">
						</form>
					</div>
				</div>
				<div class="col-md-6" id="profiili-info">
					<h3><?php echo lang('profile_data_heading'); ?></h3>
					<p><b><?php echo lang('profile_data_first_name'); ?>&nbsp&nbsp</b><?php echo $_SESSION['eesnimi']; ?></p>
					<p><b><?php echo lang('profile_data_last_name'); ?>&nbsp&nbsp</b><?php echo $_SESSION['perenimi']; ?></p>
					<p><b><?php echo lang('profile_data_email'); ?>&nbsp&nbsp</b><?php echo $_SESSION['email']; ?></p>
				</div>
			</div>
			<div class="col-md-6">
				<h3><?php echo lang('profile_reservations_heading'); ?></h3>
				<?php
				if (count($reservations) == 0) {
					echo '<p>' . lang('profile_no_reservations') . '</p>';
				}
				else {
					echo '<table class="table">';
					echo '<tr><th>' . lang('profile_reservations_date') . '</th><th>' . lang('profile_reservations_time') . '</th><th>' . lang('profile_reservations_service') . '</th><th></th></tr>';
					foreach ($reservations as $reservation) {
						$cancel_form = '<form action="input/cancel_reservation/' . $reservation->id . '" method="post"><input type="submit" value="' . lang('profile_reservations_cancel') . '" class="btn-link"></form>';
						echo '<tr><td>' . $reservation->kuupäev . '</td><td>' . $reservation->kellaaeg . '</td><td>' . $reservation->pakett . '</td><td>' . $cancel_form . '</td></tr>';
					}
					echo '</table>';
				}
				?>
			</div>
		</div>
	</div>
</div>