<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<?php
			$page = "Menu";
			$title = "Profil";
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
						Profil
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
								<form role="form" action="<?php echo site_url("profil/proses"); ?>" method="post" id="form_ubah" name="form_ubah">
									<div class="box-body">
										<?php if (isset($error["form_ubah"])) { ?>
											<div class="callout callout-<?php echo $error["form_ubah_warna"]; ?>">
												<h4><i class="icon fa fa-<?php echo $error["form_ubah_icon"]; ?>"></i> <?php echo $error["form_ubah_judul"]; ?></h4>
												<p><?php echo $error["form_ubah"]; ?></p>
											</div>
										<?php } ?>
										<div class="form-group">
											<label>Nama Pengguna</label>
											<p><?php echo $login->id_user; ?></p>
										</div>
										<div class="form-group">
											<label for="txt_email">Email <b style="color: red;">*</b></label> <?php if (isset($error["txt_email"])) { ?><small class="label label-danger"><?php echo $error["txt_email"]; ?></small><?php } ?>
											<input type="email" class="form-control" id="txt_email" name="txt_email" value="<?php echo $txt_email; ?>" placeholder="Email" required>
										</div>
										<div class="form-group">
											<label for="txt_nama">Nama <b style="color: red;">*</b></label> <?php if (isset($error["txt_nama"])) { ?><small class="label label-danger"><?php echo $error["txt_nama"]; ?></small><?php } ?>
											<input type="text" class="form-control" id="txt_nama" name="txt_nama" value="<?php echo $txt_nama; ?>" placeholder="Nama" required>
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