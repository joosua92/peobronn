		<div id="notification-bar" class="collapse">
			<div class="container">
				<p id="notification-text"></p>
				<span id="notification-close"><button type="button" class="btn btn-link">X</button></span>
			</div>
		</div>
		</div>
		<div id="footer-clear"></div>
		<footer class="footer text-center">
			<p><a href="<?php echo base_url() . 'kontakt'; ?>" class="footer-link"><?php echo lang('footer_link_contact'); ?></a> |
			<a href="<?php echo base_url() . 'statistika'; ?>" class="footer-link"><?php echo lang('footer_link_visitor_stats'); ?></a></p>
		</footer>
		<!-- Assetid -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery-fallback.js"></script> <!-- CDN fallback -->
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery-ui-fallback.js"></script> <!-- CDN fallback -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-js-fallback.js"></script> <!-- CDN fallback -->
		<script src="https://apis.google.com/js/platform.js?onload=onGoogleLoad" async defer></script>
		<script src="<?php echo base_url(); ?>assets/js/page.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/polling.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/datepicker-control.min.js"></script>
    </body>
</html>