<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="page-header">
				<h1><?php echo lang('login_main_heading'); ?></h1>
			</div>
			<?php
			if (isset($_SESSION['alertType'])) {
				echo '<div class="alert alert-' . $_SESSION['alertType'] . '" role="alert" id="alert-box">' . $_SESSION['alertMessage'] . '</div>';
			}
			else {
				echo '<div class="alert collapse" role="alert" id="alert-box"></div>';
			}
			?>
			<div class="col-md-6">
				<form action="input/login" method="post" id="login-form">
					<div class="form-group">
						<label for="email"><?php echo lang('login_insert_email'); ?></label>
						<a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo lang('login_insert_email_tip'); ?>">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<input type="text" class="form-control" id="email" placeholder="<?php echo lang('login_insert_email_placeholder'); ?>" name="email">
					</div>
					<div class="form-group">
						<label for="salasõna"><?php echo lang('login_insert_password'); ?></label>
						<a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo lang('login_insert_password_tip'); ?>">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<input type="password" class="form-control" id="salasõna" placeholder="<?php echo lang('login_insert_password_placeholder'); ?>" name="salasõna">
					</div>
					<input type="submit" value="Sisene">
				</form>
			</div>
			<div class="col-md-6">
				<div id="google-login-container">
					<div><strong><?php echo lang('login_through_google'); ?></strong></div>
					<div class="g-signin2" data-onsuccess="onSignIn"></div>
				</div>
			</div>
		</div>
	</div>
</div>