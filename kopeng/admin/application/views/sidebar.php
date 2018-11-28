<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu">
			<li <?php if ($title == "Beranda") { echo "class=\"active\""; } ?>><a href="<?php echo site_url("beranda"); ?>"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
			<li class="treeview  <?php if ($title == "Data Pariwisata" || $title == "Data Pengunjung") { echo "active"; } ?>">
				<a href="#">
					<i class="fa fa-table"></i> <span>Master Data</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li <?php if ($title == "Data Pariwisata") { echo "class=\"active\""; } ?>><a href="<?php echo site_url("master_data/pariwisata"); ?>"><i class="fa fa-table"></i> Data Pariwisata</a></li>
					<li <?php if ($title == "Data Pengunjung") { echo "class=\"active\""; } ?>><a href="<?php echo site_url("master_data/pengunjung"); ?>"><i class="fa fa-table"></i> Data Pengunjung</a></li>
				</ul>
			</li>
			<li <?php if ($title == "Profil") { echo "class=\"active\""; } ?>><a href="<?php echo site_url("profil"); ?>"><i class="fa fa-user"></i> <span>Profil</span></a></li>
			<li <?php if ($title == "Ubah Kata Sandi") { echo "class=\"active\""; } ?>><a href="<?php echo site_url("ubah_kata_sandi"); ?>"><i class="fa fa-lock"></i> <span>Ubah Kata Sandi</span></a></li>
			<li><a href="<?php echo site_url("keluar"); ?>"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>
		</ul>
	</section>
</aside>