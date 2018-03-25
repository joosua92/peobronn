<div class="container">
	<div class="page-header">
		<h1>Profiil</h1>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="col-md-6">
					<img src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png" id="profiilipilt">
					<form>
						<div class="form-group" id="vaheta-pilti">
							<label for="exampleFormControlFile1">Vaheta profiilipilti</label>
							<input type="file" class="form-control-file" id="kasutaja-fail">
						</div>
					</form>
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