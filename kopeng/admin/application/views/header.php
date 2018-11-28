<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<header class="main-header">
	<b class="logo">
		<span class="logo-mini"><b>P</b>V</span>
		<span class="logo-lg"><b>PRO</b>VILLA</span>
	</b>
    <nav class="navbar navbar-static-top" role="navigation">
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="<?php echo site_url("profil"); ?>">
						<i class="fa fa-user"></i> <span class="hidden-xs"><?php echo $login->nama; ?></span>
					</a>
				</li>
			</ul>
		</div>
	</nav>
</header>