<div class="container">
	<div class="page-header">
		<h1><?php echo lang('games_main_heading'); ?></h1>
	</div>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo lang('breadcrumb_root'); ?></a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo lang('games_breadcrumb_last'); ?></li>
		</ol>
	</nav>
    <div class="container">
		<div class="row galerii" id="games-gallery">
			<?php
			for ($i = 0; $i < count($games); $i++) {
				$game = $games[$i];
				echo '<div class="col-lg-3 col-md-4 col-xs-6">' . "\n";
				echo '<img class="img-fluid img-thumbnail" src="' . base_url() . 'assets/images/mangupildid/' . $game->image . '" alt="">' . "\n";
				echo '<p class="game-title text-center">';
				echo $game->title;
				echo '</p>' . "\n";
				echo '<p>';
				if ($_SESSION['site_lang'] == "english") {
					echo $game->english_description;
				} else {
					echo $game->estonian_description;
				}
				echo '</p>' . "\n";
				echo '</div>' . "\n";
				$clearfixVisible = '';
				if (($i + 1) % 2 == 0) {
					$clearfixVisible .= ' visible-xs';
				}
				if (($i + 1) % 3 == 0) {
					$clearfixVisible .= ' visible-md';
				}
				if (($i + 1) % 4 == 0) {
					$clearfixVisible .= ' visible-lg';
				}
				if ($clearfixVisible != '') {
					echo '<div class="clearfix' . $clearfixVisible . '"></div>' . "\n";
				}
			}
			?>
		</div>
		<div class="row">
			<button class="btn center-block" type="button" id="all-games-button"><?php echo lang('games_show_all_button'); ?></button>
		</div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/gallery.js"></script>