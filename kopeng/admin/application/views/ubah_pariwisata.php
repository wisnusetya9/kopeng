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
									<h3 class="box-title">Ubah Data</h3>
									<?php
										if ($data_pariwisata) {
									?>
											<i class="pull-right"><b>Catatan:</b> Field dengan tanda <b style="color: red;">*</b> wajib diisi</i>
									<?php
										}
									?>
								</div>
								<?php
									if (!$data_pariwisata) {
								?>
										<div class="box-body">
											<div class="callout callout-danger">
												<h4><i class="icon fa fa-close"></i> Error</h4>
												<p>Data tidak ditemukan.</p>
											</div>
										</div>
								<?php
									} else {
								?>
										<form role="form" action="<?php echo site_url("master_data/pariwisata_ubah_proses/" . $id_pariwisata); ?>" method="post" enctype="multipart/form-data" id="form_ubah" name="form_ubah">
											<div class="box-body">
												<?php if (isset($error["form_ubah"])) { ?>
													<div class="callout callout-<?php echo $error["form_ubah_warna"]; ?>">
														<h4><i class="icon fa fa-<?php echo $error["form_ubah_icon"]; ?>"></i> <?php echo $error["form_ubah_judul"]; ?></h4>
														<p><?php echo $error["form_ubah"]; ?></p>
													</div>
												<?php } ?>
												<div class="form-group">
													<label for="txt_nama_pariwisata">Nama Lokasi <b style="color: red;">*</b></label> <?php if (isset($error["txt_nama_lokasi"])) { ?><small class="label label-danger"><?php echo $error["txt_nama_lokasi"]; ?></small><?php } ?>
													<input type="text" class="form-control" id="txt_nama_lokasi" name="txt_nama_lokasi" value="<?php echo $txt_nama_lokasi; ?>" placeholder="Nama Lokasi" required>
												</div>
												<div class="form-group">
													<label for="txt_deskripsi">Deskripsi</label>
													<textarea class="form-control" rows="1" id="txt_deskripsi" name="txt_deskripsi" placeholder="Deskripsi" style="resize: none; overflow: hidden;"><?php echo $txt_deskripsi; ?></textarea>
												</div>
												<div class="form-group">
													<label for="file_foto">Foto <i>(pilih untuk mengubah foto)</i></label> <?php if (isset($error["file_foto"])) { ?><small class="label label-danger"><?php echo $error["file_foto"]; ?></small><?php } ?>
													<input type="file" id="file_foto" name="file_foto" accept="image/jpg, image/jpeg, image/png" />
												</div>
											</div>
											<div class="box-footer">
												<input type="submit" class="btn btn-success pull-right" id="btn_simpan" name="btn_simpan" value="Simpan"></input>
											</div>
										</form>
								<?php
									}
								?>
							</div>
						</div>
					</div>
				</section>
			</div>
			<?php
				if ($data_pariwisata) {
			?>
					<div class="modal fade" id="modal_simpan">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Simpan Data</h4>
								</div>
								<div class="modal-body">
									<p>Apakah Anda ingin menyimpan perubahan data ini ?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
									<button type="button" class="btn btn-primary" id="btn_modal_simpan">Simpan</button>
								</div>
							</div>
						</div>
					</div>
			<?php
				}
			?>
			<?php
				include_once("footer.php");
			?>
		</div>
		<?php
			include_once("foot_import.php");
		?>
		<?php
			if ($data_pariwisata) {
		?>
				<script>
					var form_submit = false;
					
					$(function() {
						$("#txt_nama_lokasi").focusTextToEnd();
						
						$("#txt_deskripsi").css({"height" : "auto"});
						$("#txt_deskripsi").css({"height" : $("#txt_deskripsi")[0].scrollHeight + "px"});
						
						$("#txt_deskripsi").keydown(function() {
							setTimeout(function(){
								$("#txt_deskripsi").css({"height" : "auto"});
								$("#txt_deskripsi").css({"height" : $("#txt_deskripsi")[0].scrollHeight + "px"});
							}, 0);
						});
						
						$("#file_foto").change(function() {
							if (!file_extension_validation(/(\.jpg|\.jpeg|\.png)$/i, "file_foto")) {
								alert("Silahkan pilih foto dengan ekstensi .jpg / .jpeg / .png !");
								$("#file_foto").replaceWith($("#file_foto").val('').clone(true));
							}
						});
					
						$("#form_ubah").submit(function() {
							$("#modal_simpan").modal("show");
							return form_submit;
						});
						
						$("#btn_modal_simpan").click(function() {
							form_submit = true;
							$("#btn_simpan").click();
						});
					});
					
					function file_extension_validation(allowed_extensions, id) {
						var file_input = document.getElementById(id);
						var file_path = file_input.value;
						if (!allowed_extensions.exec(file_path)) {
							return false;
						} else {
							return true;
						}
					}
				</script>
		<?php
			}
		?>
	</body>
</html>