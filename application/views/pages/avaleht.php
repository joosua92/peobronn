<div class="container">
	<div class="page-header">
		<h1><?php echo lang('home_main_heading'); ?></h1>
	</div>
	<?php
	if (isset($_SESSION['alertType'])) {
		echo '<div class="alert alert-' . $_SESSION['alertType'] . '" role="alert" id="alert-box">' . $_SESSION['alertMessage'] . '</div>';
	}
	else {
		echo '<div class="alert collapse" role="alert" id="alert-box"></div>';
	}
	?>
	<div>
		<h2><?php echo lang('home_introduction_title'); ?></h2>
		<p class="tutvustus">
			<?php echo lang('home_introduction_text'); ?>
		</p>
	</div>
</div>
