<!DOCTYPE html>
<html lang="et">
	<head>
		<title><?php echo $title; ?></title>
		<meta charset="utf-8" />
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
	</head>
	<body>
		<div class="wrapper">

			<nav class="navbar navbar-inverse">
				<div class="container">
					<div class="navbar-header">
						<a href="<?php echo base_url(); ?>">
							<img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Mängumaailm" />
						</a>
					</div>
					<ul class="nav navbar-nav navbar-right" id="navbar">
						<li><a href="<?php echo base_url(); ?>mangud">MÄNGUD & ELAMUSED</a></li>
						<li><a href="<?php echo base_url(); ?>hinnakiri">HINNAKIRI</a></li>
						<li><a href="<?php echo base_url(); ?>kkk">KKK</a></li>
						<li><a href="<?php echo base_url(); ?>broneerimine">BRONEERIMINE</a></li>
					</ul>
					<div class="container pull-right" id="konto-lingid-konteiner">
						<div class="pull-right">
							<ul class="list-inline" id="konto-lingid">
								<?php if (!isset($_SESSION['email'])) {
									echo '<li><form action="sisene" method="get"><input class="btn-link" type="submit" value="SISENE"></form></li>';
									echo '<li><form action="registreeru" method="get"><input class="btn-link" type="submit" value="REGISTREERU"></form></li>';
									//echo '<li><a href="' . base_url() . 'sisene">SISENE</a></li>';
									//echo '<li><a href="' . base_url() . 'registreeru">REGISTREERU</a></li>';
								}
								else {
									echo '<li><form action="profiil" method="get"><input class="btn-link" type="submit" value="PROFIIL"></form></li>';
									echo '<li><form action="input/logout" method="post" id="logout-form"><input class="btn-link" type="submit" value="VÄLJU"></form></li>';
									//echo '<li><a href="' . base_url() . 'profiil" class="btn-link">PROFIIL</a></li>';
									//echo '<li><a href="#" id="logout-link">VÄLJU</a></li>';
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</nav>
			
		 