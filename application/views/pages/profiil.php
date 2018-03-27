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
			</div>
		</div>
	</div>
</div>