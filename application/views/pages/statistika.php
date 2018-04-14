<div class="container">
	<div class="page-header">
		<h1>Külastajat statistika</h1>
	</div>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Mängumaailm</a></li>
			<li class="breadcrumb-item active" aria-current="page">Külastajate statistika</li>
		</ol>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div id="browser-piechart"></div>
			</div>
			<div class="col-md-4">
				<div id="country-piechart"></div>
			</div>
			<div class="col-md-4">
				<div id="time-piechart"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/charts.js' ; ?>"></script>