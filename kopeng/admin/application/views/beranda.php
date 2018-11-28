<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<?php
			$page = "Menu";
			$title = "Beranda";
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
						Beranda
					</h1>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Grafik Data Pengunjung</h3>
								</div>
								<div class="box-body">
									<form role="form" action="" class="form-horizontal" method="post" id="form_tampil" name="form_tampil">
										<div class="form-group col-md-7">
											<div class="box-body">
												<div class="form-group">
													<label for="cb_tahun_awal" class="col-md-2 control-label">Pilih tahun</label>
													<div class="col-md-4">
														<select class="form-control" id="cb_tahun_awal" name="cb_tahun_awal" style="width: 100%;" required>
														<?php
															foreach ($list_tahun as $tahun) {
																if ($tahun == $cb_tahun_awal) {
																	echo "<option value=\"" . $tahun . "\" selected>" . $tahun . "</option>";
																} else {
																	echo "<option value=\"" . $tahun . "\">" . $tahun . "</option>";
																}
															}
														?>
														</select>
													</div>
													<label for="cb_tahun_akhir" class="col-md-2 control-label">s/d</label>
													<div class="col-md-4">
														<select class="form-control" id="cb_tahun_akhir" name="cb_tahun_akhir" style="width: 100%;" required>
														<?php
															foreach ($list_tahun as $tahun) {
																if ($tahun == $cb_tahun_akhir) {
																	echo "<option value=\"" . $tahun . "\" selected>" . $tahun . "</option>";
																} else {
																	echo "<option value=\"" . $tahun . "\">" . $tahun . "</option>";
																}
															}
														?>
														</select>
													</div>
												</div>
												<input type="submit" name="btn_tampil" class="btn btn-info pull-right" value="Tampilkan"></input>
											</div>
										</div>
									</form>
									<div class="col-md-12">
										<div class="chart">
											<canvas id="chart" style="height:350px"></canvas>
										</div>
										<b>Keterangan :</b>
										<div id="chart_legend">
										</div>
									</div>
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
		<script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
		<script>
			$(function() {
				$("#cb_tahun_awal").select2();
				$("#cb_tahun_akhir").select2();
				
				$("#cb_tahun_awal").change(function() {
					if ($("#cb_tahun_awal").val() > $("#cb_tahun_akhir").val()) {
						$("#cb_tahun_akhir").val($("#cb_tahun_awal").val()).trigger("change");
					} else if ($("#cb_tahun_awal").val() < $("#cb_tahun_akhir").val() - 2) {
						$("#cb_tahun_akhir").val(parseInt($("#cb_tahun_awal").val()) + 2).trigger("change");
					}
				}); 

				$("#cb_tahun_akhir").change(function() {
					if ($("#cb_tahun_akhir").val() < $("#cb_tahun_awal").val()) {
						$("#cb_tahun_awal").val($("#cb_tahun_akhir").val()).trigger("change");
					} else if ($("#cb_tahun_akhir").val() > $("#cb_tahun_awal").val() + 2) {
						$("#cb_tahun_awal").val(parseInt($("#cb_tahun_akhir").val()) - 2).trigger("change");
					}
				});
				
				var warna_periode = ["#d2d6de", "#f39c12", "#00a65a"];
				var chartData = {
					labels: [<?php foreach ($list_pariwisata as $pariwisata) { echo "\"" . $pariwisata->nama_lokasi . "\", "; } ?>], 
					datasets: [
						<?php
							$warna = 0;
							for ($i=$cb_tahun_awal; $i<=$cb_tahun_akhir; $i++) {
						?>
								{
									label: "Tahun <?php echo $i; ?>",
									fillColor: warna_periode[<?php echo $warna; ?>],
									strokeColor: warna_periode[<?php echo $warna; ?>],
									pointColor: warna_periode[<?php echo $warna; ?>],
									pointStrokeColor: warna_periode[<?php echo $warna; ?>],
									pointHighlightFill: "#fff",
									pointHighlightStroke: warna_periode[<?php echo $warna; ?>],
									data: [<?php echo $list_pengunjung[$i]; ?>]
								},
						<?php
								$warna ++;
							}
						?>
					]
				};
				var chartCanvas = $("#chart").get(0).getContext("2d");
				var chartOptions = {
					scaleBeginAtZero        : true,
					//Boolean - Whether grid lines are shown across the chart
					scaleShowGridLines      : true,
					//String - Colour of the grid lines
					scaleGridLineColor      : 'rgba(0,0,0,.05)',
					//Number - Width of the grid lines
					scaleGridLineWidth      : 1,
					//Boolean - Whether to show horizontal lines (except X axis)
					scaleShowHorizontalLines: true,
					//Boolean - Whether to show vertical lines (except Y axis)
					scaleShowVerticalLines  : true,
					//Boolean - If there is a stroke on each bar
					barShowStroke           : true,
					//Number - Pixel width of the bar stroke
					barStrokeWidth          : 2,
					//Number - Spacing between each of the X value sets
					barValueSpacing         : 5,
					//Number - Spacing between data sets within X values
					barDatasetSpacing       : 1,
					//String - A legend template
					legendTemplate : "<table style=\"border: 1px solid black;\">" +
										"<% for (var i=0; i<datasets.length; i++) { %>" +
										  "<tr><td style=\"padding: 5px; \"><div style=\"height: 20px; width: 25px; background-color: <%=datasets[i].fillColor %>\"></div></td><td style=\"padding: 5px; \"><%= datasets[i].label %></td></tr>" +
										"<% } %>",
					//Boolean - whether to make the chart responsive
					responsive              : true,
					maintainAspectRatio     : true
				};
				chartOptions.datasetFill = false;
				var chart = new Chart(chartCanvas).Bar(chartData, chartOptions);
				$("#chart_legend").append(chart.generateLegend());
			});
		</script>
	</body>
</html>