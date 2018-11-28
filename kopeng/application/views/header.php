<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<nav id="template-navbar" class="navbar navbar-default custom-navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#Food-fair-toggle">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				<img id="logo" src="<?php echo base_url(); ?>assets/img/Logo_main.png" class="logo img-responsive">
			</a>
			<b class="pull-right" style="font-size: 25px; margin-top: 1vh; margin-right: 2vw; letter-spacing: 3px; font-family: Maiandra GD;">PROVILLA</b>
		</div>
		<div class="collapse navbar-collapse" id="Food-fair-toggle">
			<ul class="nav navbar-nav navbar-right">
				<li <?php if ($title == "Beranda") { echo "class=\"active\""; } ?>><a href="<?php echo site_url("beranda"); ?>"><b>Beranda</b></a></li>
				<li <?php if ($title == "Lokasi Pariwisata") { echo "class=\"active\""; } ?>><a href="<?php echo site_url("lokasi_pariwisata"); ?>"><b>Lokasi Pariwisata</b></a></li>
				<li <?php if ($title == "Tentang Kami") { echo "class=\"active\""; } ?>><a href="<?php echo site_url("tentang_kami"); ?>"><b>Tentang Kami</b></a></li>
			</ul>
		</div>
	</div>
</nav>
<nav style="position: relative;">
<br />
<br />
<br />
<br />
</nav>