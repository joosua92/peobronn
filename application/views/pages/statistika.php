<div class="container">
	<div class="page-header">
		<h1><?php echo lang('visitor_stats_main_heading'); ?></h1>
	</div>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo lang('breadcrumb_root'); ?></a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo lang('visitor_stats_breadcrumb_last'); ?></li>
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
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="<?php echo base_url() . 'assets/js/charts.js' ; ?>"></script>