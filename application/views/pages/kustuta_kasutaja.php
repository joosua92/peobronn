<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="page-header">
				<h1><?php echo lang('delete_account_main_heading'); ?></h1>
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
				<p><?php echo lang('delete_account_info'); ?></p>
			</div>
			<div>
				<form action="input/delete_account" method="post">
					<div class="form-group">
						<label for="salasõna"><?php echo lang('delete_account_insert_password'); ?></label>
						<a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo lang('delete_account_insert_password_tip'); ?>">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<input type="password" class="form-control" id="salasõna" placeholder="<?php echo lang('delete_account_insert_password_placeholder'); ?>" name="salasõna">
					</div>
					<input type="submit" value="<?php echo lang('delete_account_submit_button'); ?>">
				</form>
			</div>
		</div>
	</div>
</div>