<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="page-header">
				<h1><?php echo lang('register_main_heading'); ?></h1>
			</div>
			<div class="alert collapse" role="alert" id="alert-box">
			</div>
			<div class="col-md-6">
				<form action="input/register" method="post" id="register-form">
					<div class="form-group">
						<label for="eesnimi"><?php echo lang('register_insert_first_name'); ?></label>
						<a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo lang('register_insert_first_name_tip'); ?>">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<input type="text" class="form-control" id="eesnimi" placeholder="<?php echo lang('register_insert_first_name_placeholder'); ?>" name="eesnimi">
					</div>
					<div class="form-group">
						<label for="perenimi"><?php echo lang('register_insert_last_name'); ?></label>
						<a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo lang('register_insert_last_name_tip'); ?>">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<input type="text" class="form-control" id="perenimi" placeholder="<?php echo lang('register_insert_last_name_placeholder'); ?>" name="perenimi">
					</div>
					<div class="form-group">
						<label for="email"><?php echo lang('register_insert_email'); ?></label>
						<a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo lang('register_insert_email_tip'); ?>">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<input type="text" class="form-control" id="email" placeholder="<?php echo lang('register_insert_email_placeholder'); ?>" name="email">
					</div>
					<div class="form-group">
						<label for="salasõna"><?php echo lang('register_insert_password'); ?></label>
						<a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo lang('register_insert_password_tip'); ?>">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<input type="password" class="form-control" id="salasõna" placeholder="<?php echo lang('register_insert_password_placeholder'); ?>" name="salasõna">
					</div>
					<div class="form-group">
						<label for="korda-salasõna"><?php echo lang('register_repeat_password'); ?></label>
						<a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo lang('register_repeat_password_tip'); ?>">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<input type="password" class="form-control" id="korda-salasõna" placeholder="<?php echo lang('register_repeat_password_placeholder'); ?>" name="korda-salasõna">
					</div>
					<input type="submit" value="<?php echo lang('register_register_button'); ?>">
				</form>
			</div>
			<div class="col-md-6">
				<div id="google-login-container">
					<div><strong><?php echo lang('register_through_google'); ?></strong></div>
					<div class="g-signin2" data-onsuccess="onSignIn"></div>
				</div>
			</div>
		</div>
	</div>
</div>
