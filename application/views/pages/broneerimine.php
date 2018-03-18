<div class="container">
	<div class="page-header">
		<h1>BRONEERIMINE</h1>
	</div>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Mängumaailm</a></li>
			<li class="breadcrumb-item active" aria-current="page">Broneerimine</li>
		</ol>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<form>
					<div class="form-group">
						<label for="date">Kuupäev</label>
						<input type="text" class="form-control" id="date" placeholder="18-03-2018" name="date">
					</div>
					<div class="form-group">
						<label for="kellaaeg">Vali kellaaeg:</label>
						<select class="form-control" id="kellaaeg">
							<option selected="selected" disabled="disabled" hidden="hidden">-</option>
							<option>10:00 - 11:00</option>
							<option>11:00 - 12:00</option>
							<option>12:00 - 13:00</option>
							<option>13:00 - 14:00</option>
							<option>14:00 - 15:00</option>
							<option>15:00 - 16:00</option>
							<option>16:00 - 17:00</option>
							<option>17:00 - 18:00</option>
							<option>18:00 - 19:00</option>
						</select>
					</div>
					<div class="form-group">
						<label for="pakett">Vali pakett:</label>
						<select class="form-control" id="pakett">
							<option selected="selected" disabled="disabled" hidden="hidden">-</option>
							<option>Pakett 1</option>
							<option>Pakett 2</option>
						</select>
					</div>
					<div class="form-group">
						<label for="name">Nimi:</label>
						<input type="text" class="form-control" id="name" placeholder="Sisesta nimi" name="name">
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" class="form-control" id="email" placeholder="Sisesta email" name="email">
					</div>
					<div class="form-group">
						<label for="phone">Telefon:</label>
						<input type="text" class="form-control" id="phone" placeholder="Sisesta telefoninumber" name="phone">
					</div>
					<button type="submit" class="btn btn-default">Broneeri</button>
				</form>
			</div>
			<div class="col-md-6">
				<!-- KALENDER JA AJA VALIMINE -->
			</div>
		</div>
	</div>
</div>
