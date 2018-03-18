<!DOCTYPE html>
<html lang="et">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $title; ?></title>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.png">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/extra_style.css">
		<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/page.js"></script>
	</head>
	<body onload="setActiveNavitem()">

		<nav class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<a href="<?php echo base_url(); ?>">
						<img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Mängumaailm">
					</a>
				</div>
				
				<ul class="nav navbar-nav navbar-right" id="navbar">
					<li><a href="<?php echo base_url(); ?>mangud">MÄNGUD & ELAMUSED</a></li>
					<li><a href="<?php echo base_url(); ?>hinnakiri">HINNAKIRI</a></li>
					<li><a href="<?php echo base_url(); ?>kkk">KKK</a></li>
					<li><a href="<?php echo base_url(); ?>broneerimine">BRONEERIMINE</a></li>
				</ul>
			</div>
		</nav>