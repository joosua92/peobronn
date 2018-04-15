<!DOCTYPE html>
<?php 
if ($_SESSION['site_lang'] == 'english') {
	echo '<html lang="en">';
} else {
	echo '<html lang="et">';
}
?>
	<head>
		<title><?php echo $title; ?></title>
		<meta charset="utf-8" />
		<meta name="application-name" content="Mängumaailm" />
		<meta name="description" content="<?php echo $pageDescription; ?>" />
		<meta name="keywords" content="<?php echo $keywords; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="google-signin-client_id" content="883720088699-for1689vnajr1birt2hqrnam9bs7j6ku.apps.googleusercontent.com" />
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.png" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/extra_style.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery-fallback.js"></script> <!-- CDN fallback -->
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></scrips>
		<script src="<?php echo base_url(); ?>assets/js/jquery-ui-fallback.js"></script> <!-- CDN fallback -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-js-fallback.js"></script> <!-- CDN fallback -->
		<script src="https://apis.google.com/js/platform.js?onload=onGoogleLoad" async defer></script>
		<script src="<?php echo base_url(); ?>assets/js/page.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/polling.js"></script>
		<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "WebSite",
			"url": "http://mangumaailm.000webhostapp.com/",
			"about": {
				"@type": "Organization",
				"name": "Mängumaailm"
				"description": "Virtuaalreaalsuskeskus Mängumaailm"
				"address": "Kaarli pst. 8, Tallinn",
				"email": "mangumaailm@online.ee",
				"logo": "<?php echo base_url(); ?>assets/images/logo.png"
			},
			"keywords": "virtuaalreaalsus,meelelahutus,mängud",
			"isFamilyFriendly": true;
		}
		</script>
	</head>
	<body>
		<div class="wrapper">
			<nav class="navbar navbar-inverse">
				<div class="container">
					<div class="navbar-header">
						<a href="<?php echo base_url(); ?>">
							<img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Mängumaailma" title="<?php echo lang('header_logo_title'); ?>" />
						</a>
					</div>
					<ul class="nav navbar-nav navbar-right" id="navbar">
						<li><a href="<?php echo base_url(); ?>mangud" title="<?php echo lang('header_link_games_title'); ?>"><?php echo lang('header_link_games'); ?></a></li>
						<li><a href="<?php echo base_url(); ?>hinnakiri" title="<?php echo lang('header_link_prices_title'); ?>"><?php echo lang('header_link_prices'); ?></a></li>
						<li><a href="<?php echo base_url(); ?>kkk" title="<?php echo lang('header_link_faq_title'); ?>"><?php echo lang('header_link_faq'); ?></a></li>
						<li><a href="<?php echo base_url(); ?>broneerimine" title="<?php echo lang('header_link_reserv_title'); ?>"><?php echo lang('header_link_reserv'); ?></a></li>
					</ul>
					<div class="container pull-right" id="konto-lingid-konteiner">
						<div class="pull-right">
							<ul class="list-inline" id="konto-lingid">
								<li><a href="#" id="est-flag"><img src="<?php echo base_url(); ?>assets/images/flags/est.png" class="lang-flag" /></a></li>
								<li><a href="#" id="eng-flag"><img src="<?php echo base_url(); ?>assets/images/flags/eng.png" class="lang-flag" /></a></li>
								<?php if (!isset($_SESSION['email'])) {
									echo '<li><form action="sisene" method="get"><input class="btn-link" type="submit" value="' . lang('header_link_login') . '" /></form></li>';
									echo '<li><form action="registreeru" method="get"><input class="btn-link" type="submit" value="' . lang('header_link_register') . '" /></form></li>';
								}
								else {
									echo '<li><form action="profiil" method="get"><input class="btn-link" type="submit" value="' . lang('header_link_profile') . '" /></form></li>';
									echo '<li><form action="input/logout" method="post" id="logout-form"><input class="btn-link" type="submit" value="' . lang('header_link_log_out') . '" /></form></li>';
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</nav>
			
		 