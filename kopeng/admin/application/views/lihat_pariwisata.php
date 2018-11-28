<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<?php
			$page = "Menu";
			$title = "Data Pariwisata";
			include_once("head_import.php");
		?>
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<?php
				include_once("header.php");
				include_once("sidebar.php");
			?>
			<div class="content-wrapper">
				<section class="content-header">
					<a class="btn btn-primary pull-right" href="<?php echo site_url("master_data/pariwisata"); ?>">Kembali</a>
					<h1>
						Master Data
						<small>Data Pariwisata</small>
					</h1>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Lihat Data</h3>
								</div>
								<div class="box-body">
									<?php
										if (!$data_pariwisata) {
									?>
											<div class="callout callout-danger">
												<h4><i class="icon fa fa-close"></i> Error</h4>
												<p>Data tidak ditemukan.</p>
											</div>
									<?php
										} else {
									?>
											<div class="form-group">
												<label>Nama Lokasi</label>
												<p><?php echo $pariwisata->nama_lokasi; ?></p>
											</div>
											<div class="form-group">
												<label>Deskripsi</label>
												<p><?php echo nl2br($pariwisata->deskripsi); ?></p>
											</div>
											<div class="form-group">
												<label>Jumlah Suka</label>
												<p><?php echo number_format($pariwisata->jumlah_suka, 0, ".", "."); ?></p>
											</div>
											<div class="form-group">
												<label>Foto</label>
												<img class="img-responsive" src="<?php echo $pariwisata->foto; ?>" />
											</div>
									<?php
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<?php
				include_once("footer.php");
			?>
		</div>
		<?php
			include_once("foot_import.php");
		?>
	</body>
</html>