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
	<body data-spy="scroll" data-target="#template-navbar">
		<?php
			include_once("header.php");
		?>
		<section id="about" class="about">
            <div class="wrapper">
				<div class="container-fluid">
					<div class="col-md-6">
						<div class="center slider">
							<div>
								<img src="<?php echo base_url(); ?>assets/img/About-C-bg.jpg">
							</div>
							<div>
								<img src="<?php echo base_url(); ?>assets/img/About-C-bg.jpg">
							</div>
							<div>
								<img src="<?php echo base_url(); ?>assets/img/About-C-bg.jpg">
							</div>
							<div>
								<img src="<?php echo base_url(); ?>assets/img/About-C-bg.jpg">
							</div>
							<div>
								<img src="<?php echo base_url(); ?>assets/img/About-C-bg.jpg">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="section-content" style="padding: 68px 0px 30px 15px;">
							<h2 class="section-content-title">Tentang Kopeng</h2>
							<p class="section-content-para" style="text-indent:50px; text-align: justify; padding: 0; margin: 0;">
								Kopeng adalah sebuah desa di kecamatan Getasan, Kabupaten Semarang, Jawa Tengah, Indonesia.
							</p>
							<p class="section-content-para" style="text-indent:50px; text-align: justify; padding: 0; margin: 0;">
								Desa ini berada di lereng Gunung Merbabu atau di ketinggian sekitar 1500-1700 mdpl (meter di atas permukaan laut). Karena berada di lereng gunung, sehingga desa Kopeng memiliki hawa yang sejuk dan dingin.
								Ayo Wisata ke Kopeng
							</p>
							<p class="section-content-para" style="text-indent:50px; text-align: justify; padding: 0; margin: 0;">
								Untuk awal tahun 2010, Desa Kopeng ditetapkan sebagai Desa Vokasi di wilayah Kecamatan Getasan, Kabupaten Semarang. Produk yang diunggulkan di Desa Vokasi Kopeng ini adalah sayuran organik, pembuatan berbagai kerajinan tangan khas, makanan khas, tanaman hias dll.
							</p>
							<p class="section-content-para" style="text-indent:50px; text-align: justify; padding: 0; margin: 0;">
								Kopeng merupakan salah satu desa wisata yang ada di Kabupaten Semarang. Ada beberapa objek wisata yang bisa anda kunjungi ketika berada di Kopeng. Antara lain: Taman Wisata Kopeng, Umbul Songo, Kalipancur, bahkan ada beberapa tempat menarik baru yang bisa anda kunjungi yakni Gardu Pandang Kopeng dan Pohon Harapan di dusun Cuntel.
							</p>
						</div>
					</div>
				</div>
            </div>
        </section>
        <section id="pricing" class="pricing">
            <div id="w">
                <div class="pricing-filter">
                    <div class="pricing-filter-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="section-header" style="padding: 0; margin: 0">
                                        <center><h2 class="pricing-title">Destinasi Pariwisata</h2></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">  
                        <div class="col-md-10 col-md-offset-1">
							<ul id="menu-pricing" class="menu-price">
								<?php
									foreach($list_pariwisata as $pariwisata) {
								?>
										<div id="image_popup_<?php echo $pariwisata->id_pariwisata; ?>" class="white-popup mfp-hide">
											<div class="container-fluid">
												<div class="row">
													<div class="pop-up-color">
														<div class="col-md-6 p-l-0 p-r-0">
															<img src="<?php echo $pariwisata->foto; ?>" class="img-responsive" alt="<?php echo $pariwisata->nama_lokasi; ?>" style="object-fit: contain; width: 100%; height: 536px; margin-top: 25px;">
														</div>
														<div class="col-md-1">
														</div>
														<div class="col-md-5" style="border-left:">
															<div>
																<h2 class="popup-head" style="margin-left: 0;"><?php echo $pariwisata->nama_lokasi; ?></h2>
															</div>
															<div>
																<p class="popup-parapraph" style="margin: 0; padding: 0;"><textarea rows="17" style="width: 100%; border: 0; text-align: justify; white-space: normal; text-indent: 50px;" readonly><?php echo $pariwisata->deskripsi; ?></textarea></p>
																<table width="100%">
																	<tr>
																		<td valign="middle">
																			<h4 class="align-left"><b id="lbl_total_suka_<?php echo $pariwisata->id_pariwisata; ?>">Total Suka: <?php echo number_format($pariwisata->jumlah_suka, 0, ".", "."); ?></b></h4>
																		</td>
																		<td valign="middle">
																			<img class="pull-right" src="<?php echo base_url(); ?>assets/img/<?php echo $pariwisata->gambar_suka; ?>.png" style="width: 60px; cursor: pointer;" data-id="<?php echo $pariwisata->id_pariwisata; ?>" data-jumlah-suka="<?php echo $pariwisata->jumlah_suka; ?>" data-suka="<?php echo $pariwisata->suka; ?>" id="btn_suka_<?php echo $pariwisata->id_pariwisata; ?>">
																		</td>
																	</tr>
																</table>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<li class="item">
											<a href="#image_popup_<?php echo $pariwisata->id_pariwisata; ?>" class="open-popup-link" style="width: 100%;">
												<center>
													<img src="<?php echo $pariwisata->foto; ?>" class="img-responsive" alt="<?php echo $pariwisata->nama_lokasi; ?>" style="object-fit: contain; width: 100%; height: 250px;">
													<div class="menu-desc text-center">
														<span>
															<h3><?php echo $pariwisata->nama_lokasi; ?></h3>
														</span>
													</div>
												</center>
											</a>
											<h4 class="white">Total Pengunjung : <?php echo number_format($pariwisata->jumlah_pengunjung, 0, ".", "."); ?></h4>
										</li>
								<?php
									}
								?>
							</ul>
                        </div>   
                    </div>
                </div>
            </div> 
        </section>
		<?php
			include_once("footer.php");
			include_once("foot_import.php");
		?>		
		<script>
			var data_id = [<?php foreach($list_pariwisata as $pariwisata) { echo $pariwisata->id_pariwisata . ", "; }?>];
			var request = false;
			var ajax_request;
			
			$(function() {
				$(".center").slick({
					dots: true,
					infinite: true,
					centerMode: true,
					slidesToShow: 1,
				});
				
				$(window).scroll(function() {
					if ($(document).scrollTop() > 50) {
						$("#logo").attr("src", "<?php echo base_url(); ?>assets/img/Logo_stick.png")
					} else {
						 $("#logo").attr("src", "<?php echo base_url(); ?>assets/img/Logo_main.png")
					}
				});
				
				for (var i=0; i<data_id.length; i++) {
					$("[id='btn_suka_" + data_id[i] + "']").each(function() {
						$(this).mouseover(function() {
							$(this).attr("src", "<?php echo base_url(); ?>assets/img/like.png");
						});
						$(this).mouseout(function() {
							if ($(this).attr("data-suka") == 0) {
								$(this).attr("src", "<?php echo base_url(); ?>assets/img/dislike.png");
							}
						});
						$(this).click(function() {
							if (request) {
								ajax_request.abort();
							}
							request = true;
							ajax_request = $.ajax({
								url: "<?php echo site_url("ajax/suka/"); ?>" + $(this).attr("data-id"),
								type: "POST",
								async: "true",
								dataType: "json",
								
								success: function(data) {
									request = false;
									$("[id='btn_suka_" + data.id + "']").each(function() {
										$(this).attr("data-jumlah-suka", parseInt($(this).attr("data-jumlah-suka")) + data.result);
										$(this).attr("data-suka", data.result);
										if (data.result == 1) {
											$(this).attr("src", "<?php echo base_url(); ?>assets/img/like.png");
										} else if (data.result == -1) {
											$(this).attr("src", "<?php echo base_url(); ?>assets/img/dislike.png");
										}
									});
									$("[id='lbl_total_suka_" + data.id + "']").each(function() {
										$(this).html("Total Suka: " + $("#btn_suka_" + data.id).attr("data-jumlah-suka").toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
									});
								},
								error: function(data, error) {
									request = false;
									alert("Terjadi kesalahan saat proses data, silahkan coba lagi nanti.");
								}
							});
						});
					});
				}
			});
		</script>
	</body>
</html>