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
					<a class="btn btn-primary pull-right" href="<?php echo site_url("master_data/pengunjung_tambah"); ?>">Tambah Data</a>
					<h1>
						Master Data
						<small>Data Pengunjung</small>
					</h1>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-body">
									<?php if (isset($error["form_hapus"])) { ?>
										<div class="callout callout-<?php echo $error["form_hapus_warna"]; ?>">
											<h4><i class="icon fa fa-<?php echo $error["form_hapus_icon"]; ?>"></i> <?php echo $error["form_hapus_judul"]; ?></h4>
											<p><?php echo $error["form_hapus"]; ?></p>
										</div>
									<?php } ?>
									<table id="tbl_pengunjung" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>No.</th>
												<th>Lokasi</th>
												<th>Tahun</th>
												<th>Jumlah Pengunjung</th>
												<th>Opsi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<div class="modal fade" id="modal_hapus">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Hapus Data</h4>
						</div>
						<div class="modal-body">
							<p>Apakah Anda ingin menghapus data ini ?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
							<button type="button" class="btn btn-primary" id="btn_modal_hapus">Hapus</button>
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
			var id_pengunjung;
		
			$(function() {
				var tbl_pengunjung = $("#tbl_pengunjung").DataTable({
					"columnDefs": [{
						"searchable": false,
						"orderable": false,
						"targets": [0, 4]
					}],
					"order": [[1, "asc"]],
					"paging": true,
					"lengthChange": true,
					"searching": true,
					"ordering": true,
					"info": true,
					"autoWidth": false,
					"language": {
						"lengthMenu": "&nbspTampilkan _MENU_ data",
						"search": "Pencarian :",
						"searchPlaceholder": "Masukkan kata kunci",
						"zeroRecords": "Tidak ada data ditemukan",
						"info": "Menampilkan data _START_ s/d _END_ dari _TOTAL_ data",
						"infoEmpty": "Menampilkan data _END_ s/d _END_ dari _TOTAL_ data",
						"infoFiltered": " (pencarian dari total _MAX_ data)"
					},
					"bProcessing": true,
					"serverSide": true,
					"ajax": {
						url: "<?php echo site_url("ajax/get_all_pengunjung"); ?>",
						type: "POST",
						error: function() {
							$("#tbl_pengunjung_processing").css("display", "none");
						}
					},
					"dom": "<\"pull-left\"f><\"pull-left\"l><\"pull-left\"r><<t>ip>"
				});
				tbl_pengunjung.on("draw.dt", function () {
					var page = tbl_pengunjung.page.info().page;
					var length = tbl_pengunjung.page.info().length;
					tbl_pengunjung.column(0, {
						search: "applied", 
						order: "applied"
					}).nodes().each(function (cell, i) {
						cell.innerHTML = ((page * length) + (i + 1)) + ".";
					});
				});
				
				$("#btn_modal_hapus").click(function() {
					window.location.href = "<?php echo site_url("master_data/pengunjung_hapus_proses"); ?>/" + id_pengunjung;
				});
			});
			
			function hapus(id_hapus) {
				id_pengunjung = id_hapus;
				$("#modal_hapus").modal("show");
			}
		</script>
	</body>
</html>