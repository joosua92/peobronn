<div class="container">
	<div class="page-header">
		<h1><?php echo lang('reserv_main_heading'); ?></h1>
	</div>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo lang('breadcrumb_root'); ?></a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo lang('reserv_breadcrumb_last'); ?></li>
		</ol>
	</nav>
	<div class="alert collapse" role="alert" id="alert-box">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<form action="input/reserv" method="post" id="reserv-form">
					<div class="form-group">
						<label for="kuupäev"><?php echo lang('reserv_select_data'); ?></label>
						<a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo lang('reserv_select_data_tip_nojs'); ?>" id="date-tooltip-nojs">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<a href="#" class="collapse" data-toggle="tooltip" data-placement="right" title="<?php echo lang('reserv_select_data_tip_js'); ?>" id="date-tooltip-js">
							<img class="tooltip-image" alt="#" src="<?php echo base_url(); ?>assets/images/tooltip_mark.png">
						</a>
						<div id="datepicker"></div>
						<input type="text" class="form-control" id="kuupäev" name="kuupäev">
					</div>
					<div class="form-group">
						<label for="kellaaeg"><?php echo lang('reserv_select_time'); ?></label>
						<select class="form-control" id="kellaaeg" name="kellaaeg">
							<option selected="selected" disabled="disabled" hidden="hidden"><?php echo lang('reserv_select_time_default_option'); ?></option>
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
						<label for="pakett"><?php echo lang('reserv_select_service'); ?></label>
						<select class="form-control" id="pakett" name="pakett">
							<option selected="selected" disabled="disabled" hidden="hidden"><?php echo lang('reserv_select_service_default_option'); ?></option>
							<option>1</option>
							<option>2</option>
						</select>
					</div>
					<button type="submit" class="btn btn-default"><?php echo lang('reserv_button_reserv'); ?></button>
				</form>
			</div>
			<div class="col-md-6 col-md-offset-3" id="lisainfo">
				<p><?php echo lang('reserv_info_1'); ?></p>
				<p><?php echo lang('reserv_info_2'); ?></p>
				<p><?php echo lang('reserv_info_3'); ?></p>
			</div>
		</div>
	</div>
</div>
