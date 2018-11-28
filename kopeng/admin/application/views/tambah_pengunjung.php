<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<?php
			$page = "Menu";
			$title = "Data Pengunjung";
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
					<a class="btn btn-primary pull-right" href="<?php echo site_url("master_data/pengunjung"); ?>">Kembali</a>
					<h1>
						Master Data
						<small>Data Pengunjung</small>
					</h1>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Tambah Data</h3>
									<i class="pull-right"><b>Catatan:</b> Field dengan tanda <b style="color: red;">*</b> wajib diisi</i>
								</div>
								<form role="form" action="<?php echo site_url("master_data/pengunjung_tambah_proses"); ?>" method="post" id="form_tambah" name="form_tambah">
									<div class="box-body">
										<?php if (isset($error["form_tambah"])) { ?>
											<div class="callout callout-<?php echo $error["form_tambah_warna"]; ?>">
												<h4><i class="icon fa fa-<?php echo $error["form_tambah_icon"]; ?>"></i> <?php echo $error["form_tambah_judul"]; ?></h4>
												<p><?php echo $error["form_tambah"]; ?></p>
											</div>
										<?php } ?>
										<div class="form-group">
											<label for="cb_lokasi">Lokasi <b style="color: red;">*</b></label> <?php if (isset($error["cb_lokasi"])) { ?><small class="label label-danger"><?php echo $error["cb_lokasi"]; ?></small><?php } ?>
											<select class="form-control" id="cb_lokasi" name="cb_lokasi" style="width: 100%;" required>
											<?php
												foreach ($list_pariwisata as $pariwisata) {
													if ($pariwisata->id_pariwisata == $cb_lokasi) {
														echo "<option value=\"" . $pariwisata->id_pariwisata . "\" selected>" . $pariwisata->nama_lokasi . "</option>";
													} else {
														echo "<option value=\"" . $pariwisata->id_pariwisata . "\">" . $pariwisata->nama_lokasi . "</option>";
													}
												}
											?>
											</select>
										</div>
										<div class="form-group">
											<label for="cb_tahun">Tahun <b style="color: red;">*</b></label> <?php if (isset($error["cb_tahun"])) { ?><small class="label label-danger"><?php echo $error["cb_tahun"]; ?></small><?php } ?>
											<select class="form-control" id="cb_tahun" name="cb_tahun" style="width: 100%;" required>
											<?php
												foreach ($list_tahun as $tahun) {
													if ($tahun == $cb_tahun) {
														echo "<option value=\"" . $tahun . "\" selected>" . $tahun . "</option>";
													} else {
														echo "<option value=\"" . $tahun . "\">" . $tahun . "</option>";
													}
												}
											?>
											</select>
										</div>
										<div class="form-group">
											<label for="txt_jumlah_pengunjung">Jumlah Pengunjung <b style="color: red;">*</b></label> <?php if (isset($error["txt_jumlah_pengunjung"])) { ?><small class="label label-danger"><?php echo $error["txt_jumlah_pengunjung"]; ?></small><?php } ?>
											<input type="text" class="form-control" id="txt_jumlah_pengunjung" name="txt_jumlah_pengunjung" value="<?php echo $txt_jumlah_pengunjung; ?>" placeholder="Jumlah Pengunjung" required>
										</div>
									</div>
									<div class="box-footer">
										<input type="submit" class="btn btn-success pull-right" id="btn_simpan" name="btn_simpan" value="Simpan"></input>
									</div>
								</form>
							</div>
						</div>
					</div>
				</section>
			</div>
			<div class="modal fade" id="modal_simpan">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Simpan Data</h4>
						</div>
						<div class="modal-body">
							<p>Apakah Anda ingin menyimpan data ini ?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
							<button type="button" class="btn btn-primary" id="btn_modal_simpan">Simpan</button>
						</div>
					</div>
				</div>
			</div>
			<?php
				include_once("footer.php");
			?>
		</div>
		<?php
			include_once("foot_import.php");
		?>
		<script>
			var form_submit = false;
			
			$(function() {
				$("#cb_lokasi").select2();
				$("#cb_tahun").select2();
				
				$("#txt_jumlah_pengunjung").keydown(function (e) {
					// Allow: backspace, delete, tab, escape, enter
					if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
						 // Allow: Ctrl/cmd+A
						(e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
						 // Allow: Ctrl/cmd+C
						(e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
						 // Allow: Ctrl/cmd+X
						(e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
						 // Allow: home, end, left, right
						(e.keyCode >= 35 && e.keyCode <= 39)) {
							 // let it happen, don't do anything
							 return;
					}
					// Ensure that it is a number and stop the keypress
					if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
						e.preventDefault();
					}
				});
				
				$("#form_tambah").submit(function() {
					$("#modal_simpan").modal("show");
					return form_submit;
				});
				
				$("#btn_modal_simpan").click(function() {
					form_submit = true;
					$("#btn_simpan").click();
				});
			});
		</script>
	</body>
</html>