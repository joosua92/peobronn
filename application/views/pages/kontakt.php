<div class="container">
	<div class="page-header">
		<h1><?php echo lang('contact_main_heading'); ?></h1>
	</div>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo lang('breadcrumb_root'); ?></a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo lang('contact_breadcrumb_last'); ?></li>
		</ol>
	</nav>
	<div class="row">
		<div class="col-md-6">
			<p><?php echo lang('contact_open_times'); ?></p>
			<p><?php echo lang('contact_email'); ?><a href="mailto:mangumaailm@online.ee">mangumaailm@online.ee</a><p>
			<p><?php echo lang('contact_address'); ?></p>
		</div>
		<div class="col-md-6">
			<div class="map-container" id="col41">
				<div id="map"></div>
			</div>
			<script src="<?php echo base_url(); ?>assets/js/maps.js"></script>
			<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXuhqKp6fhCXlKHJvyZf-jV6Ivp4H9QhE&callback=initMap">
			</script>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<br />
			<h3><?php echo lang('contact_layout'); ?></h3>
			<?php
			if ($_SESSION['site_lang'] == 'english') {
				include 'assets/svg/layout_eng.svg';
			} else {
				include 'assets/svg/layout_est.svg';
			}
			?>
		</div>
	</div>
</div>
