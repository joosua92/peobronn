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
	<div class="alert collapse" role="alert" id="alert-box">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<form action="input/reserv" method="post" id="reserv-form">
					<div class="form-group">
						<label for="kuupäev">Vali kuupäev:</label>
						<div id="datepicker"></div>
						<input type="text" class="form-control" id="kuupäev" name="kuupäev">
					</div>
					<div class="form-group">
						<label for="kellaaeg">Vali kellaaeg:</label>
						<select class="form-control" id="kellaaeg" name="kellaaeg">
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
						<select class="form-control" id="pakett" name="pakett">
							<option selected="selected" disabled="disabled" hidden="hidden">-</option>
							<option>Pakett 1</option>
							<option>Pakett 2</option>
						</select>
					</div>
					<button type="submit" class="btn btn-default">Broneeri</button>
				</form>
			</div>
			<div class="col-md-6 col-md-offset-3" id="lisainfo">
				<p>Broneeringuid saab näha ja tühistada profiililehelt.</p>
				<p>Pakett 1 - max 10 inimest</p>
				<p>Pakett 2 - 10+ inimest</p>
			</div>
		</div>
	</div>
</div>
