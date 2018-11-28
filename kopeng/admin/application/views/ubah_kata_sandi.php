<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<?php
			$page = "Menu";
			$title = "Ubah Kata Sandi";
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
					<h1>
						Ubah Kata Sandi
					</h1>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Ubah Data</h3>
									<i class="pull-right"><b>Catatan:</b> Field dengan tanda <b style="color: red;">*</b> wajib diisi</i>
								</div>
								<form role="form" action="<?php echo site_url("ubah_kata_sandi/proses"); ?>" method="post" id="form_ubah" name="form_ubah">
									<div class="box-body">
										<?php if (isset($error["form_ubah"])) { ?>
											<div class="callout callout-<?php echo $error["form_ubah_warna"]; ?>">
												<h4><i class="icon fa fa-<?php echo $error["form_ubah_icon"]; ?>"></i> <?php echo $error["form_ubah_judul"]; ?></h4>
												<p><?php echo $error["form_ubah"]; ?></p>
											</div>
										<?php } ?>
										<div class="form-group">
											<label for="txt_kata_sandi_lama">Kata Sandi Lama <b style="color: red;">*</b></label> <?php if (isset($error["txt_kata_sandi_lama"])) { ?><small class="label label-danger"><?php echo $error["txt_kata_sandi_lama"]; ?></small><?php } ?>
											<input type="password" class="form-control" id="txt_kata_sandi_lama" name="txt_kata_sandi_lama" value="<?php echo $txt_kata_sandi_lama; ?>" placeholder="Kata Sandi Lama" required>
										</div>
										<div class="form-group">
											<label for="txt_kata_sandi_baru">Kata Sandi Baru <b style="color: red;">*</b></label> <?php if (isset($error["txt_kata_sandi_baru"])) { ?><small class="label label-danger"><?php echo $error["txt_kata_sandi_baru"]; ?></small><?php } ?>
											<input type="password" class="form-control" id="txt_kata_sandi_baru" name="txt_kata_sandi_baru" value="<?php echo $txt_kata_sandi_baru; ?>" placeholder="Kata Sandi Baru" required>
										</div>
										<div class="form-group">
											<label for="txt_konfirmasi_kata_sandi_baru">Konfirmasi Kata Sandi Baru <b style="color: red;">*</b></label> <?php if (isset($error["txt_konfirmasi_kata_sandi_baru"])) { ?><small class="label label-danger"><?php echo $error["txt_konfirmasi_kata_sandi_baru"]; ?></small><?php } ?>
											<input type="password" class="form-control" id="txt_konfirmasi_kata_sandi_baru" name="txt_konfirmasi_kata_sandi_baru" value="<?php echo $txt_konfirmasi_kata_sandi_baru; ?>" placeholder="Konfirmasi Kata Sandi Baru" required>
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
				include_once("footer.php");
			?>
		</div>
		<?php
			include_once("foot_import.php");
		?>
		<script>
			var form_submit = false;
			
			$(function() {
				$("#form_ubah").submit(function() {
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