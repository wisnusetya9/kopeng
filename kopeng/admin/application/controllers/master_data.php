<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class master_data extends CI_Controller {
	
		public $data;
	
		public function __construct() {
			parent:: __construct();
			$this->load->library("session");
			$this->load->helper("url");
			if ($this->session->userdata("login") == NULL) {
				redirect(site_url("masuk"));
			} else {
				if ($this->session->userdata("login")->status != "admin") {
					redirect(site_url("masuk"));
				} else {
					global $data;
					$this->data = &$data;
					$data["login"] = $this->session->userdata("login");
				}
			}
		}

		public function pariwisata() {
			$this->load->view("data_pariwisata", $this->data);
		}
		
		public function pariwisata_tambah() {
			$this->data["txt_nama_lokasi"] = "";
			$this->data["txt_deskripsi"] = "";
			$this->load->view("tambah_pariwisata", $this->data);
		}
		
		public function pariwisata_tambah_proses() {
			if ($this->input->post("btn_simpan")) {
				$txt_nama_lokasi = $this->input->post("txt_nama_lokasi");
				$txt_deskripsi = $this->input->post("txt_deskripsi");
				$jumlah_suka = 0;
				$file_foto = $_FILES["file_foto"]["name"];
				$extension = "";
				
				// proteksi
				if ($txt_nama_lokasi == "") {
					$error["txt_nama_lokasi"] = "Nama Lokasi tidak boleh kosong";
				}
				if ($file_foto == "") {
					$error["file_foto"] = "Foto belum dipilih";
				} else {
					$extension = pathinfo($file_foto, PATHINFO_EXTENSION);
					if (!($extension == "jpg" || $extension == "jpeg" || $extension == "png")) {
						$error["file_foto"] = "Foto harus ekstensi .jpg / .jpeg / .png";
					}
				}
				// end proteksi
				
				if (!isset($error["txt_nama_lokasi"]) && !isset($error["file_foto"])) {
					$this->load->model("pariwisata_model");
					$file_temp = $_FILES["file_foto"]["tmp_name"];
					$foto = file_get_contents($file_temp, true);
					if ($extension == "png") {
						$this->load->model("other_model");
						$file_temp = $this->other_model->png2jpg($file_temp, 50);
						$foto = file_get_contents($file_temp, true);
						$extension = "jpg";
						unlink($file_temp);
					}
					$foto = "data:image/" . $extension . ";base64," . base64_encode($foto);
					$params = array(
						"nama_lokasi" => $txt_nama_lokasi,
						"deskripsi" => $txt_deskripsi,
						"jumlah_suka" => $jumlah_suka,
						"foto" => $foto
					);
					if ($this->pariwisata_model->insert_pariwisata($params)) {
						$error["form_tambah_judul"] = "Sukses";
						$error["form_tambah_warna"] = "success";
						$error["form_tambah_icon"] = "check";
						$error["form_tambah"] = "Data pariwisata baru telah berhasil disimpan.";
						$txt_nama_lokasi = "";
						$txt_deskripsi = "";
					} else {
						$error["form_tambah_judul"] = "Gagal";
						$error["form_tambah_warna"] = "danger";
						$error["form_tambah_icon"] = "close";
						$error["form_tambah"] = "Terjadi kesalahan saat proses data, silahkan coba lagi nanti.";
					}
				}
				$this->data["txt_nama_lokasi"] = $txt_nama_lokasi;
				$this->data["txt_deskripsi"] = $txt_deskripsi;
				$this->data["error"] = $error;
				$this->load->view("tambah_pariwisata", $this->data);
			} else {
				redirect(site_url("master_data/pariwisata_tambah"));
			}
		}
		
		public function pariwisata_lihat($id_pariwisata = 0) {
			$this->load->model("pariwisata_model");
			$pariwisata = $this->pariwisata_model->get_pariwisata($id_pariwisata);
			if ($pariwisata == NULL) {
				$this->data["data_pariwisata"] = false;
			} else {
				$this->data["data_pariwisata"] = true;
				$this->data["pariwisata"] = $pariwisata;
			}
			$this->load->view("lihat_pariwisata", $this->data);
		}
		
		public function pariwisata_ubah($id_pariwisata = 0) {
			$this->load->model("pariwisata_model");
			$pariwisata = $this->pariwisata_model->get_pariwisata($id_pariwisata);
			if ($pariwisata == NULL) {
				$this->data["data_pariwisata"] = false;
			} else {
				$this->data["data_pariwisata"] = true;
				$this->data["id_pariwisata"] = $id_pariwisata;
				$this->data["txt_nama_lokasi"] = $pariwisata->nama_lokasi;
				$this->data["txt_deskripsi"] = $pariwisata->deskripsi;
			}
			$this->load->view("ubah_pariwisata", $this->data);
		}
		
		public function pariwisata_ubah_proses($id_pariwisata = 0) {
			if ($this->input->post("btn_simpan") && $id_pariwisata != 0) {
				$txt_nama_lokasi = $this->input->post("txt_nama_lokasi");
				$txt_deskripsi = $this->input->post("txt_deskripsi");
				$file_foto = $_FILES["file_foto"]["name"];
				$extension = "";
				
				// proteksi
				if ($txt_nama_lokasi == "") {
					$error["txt_nama_lokasi"] = "Nama Lokasi tidak boleh kosong";
				}
				if ($file_foto != "") {
					$extension = pathinfo($file_foto, PATHINFO_EXTENSION);
					if (!($extension == "jpg" || $extension == "jpeg" || $extension == "png")) {
						$error["file_foto"] = "Foto harus ekstensi .jpg / .jpeg / .png";
					}
				}
				// end proteksi
				
				if (!isset($error["txt_nama_lokasi"]) && !isset($error["file_foto"])) {
					$this->load->model("pariwisata_model");
					if ($file_foto == "") {
						$params = array(
							"nama_lokasi" => $txt_nama_lokasi,
							"deskripsi" => $txt_deskripsi
						);
					} else {
						$file_temp = $_FILES["file_foto"]["tmp_name"];
						$foto = file_get_contents($file_temp, true);
						if ($extension == "png") {
							$this->load->model("other_model");
							$file_temp = $this->other_model->png2jpg($file_temp, 50);
							$foto = file_get_contents($file_temp, true);
							$extension = "jpg";
							unlink($file_temp);
						}
						$foto = "data:image/" . $extension . ";base64," . base64_encode($foto);
						$params = array(
							"nama_lokasi" => $txt_nama_lokasi,
							"deskripsi" => $txt_deskripsi,
							"foto" => $foto
						);
					}
					if ($this->pariwisata_model->update_pariwisata($id_pariwisata, $params)) {
						redirect(site_url("master_data/pariwisata"));
					} else {
						$error["form_ubah_judul"] = "Gagal";
						$error["form_ubah_warna"] = "danger";
						$error["form_ubah_icon"] = "close";
						$error["form_ubah"] = "Terjadi kesalahan saat proses data, silahkan coba lagi nanti.";
					}
				}
				$this->data["data_pariwisata"] = true;
				$this->data["id_pariwisata"] = $id_pariwisata;
				$this->data["txt_nama_lokasi"] = $txt_nama_lokasi;
				$this->data["txt_deskripsi"] = $txt_deskripsi;
				$this->data["error"] = $error;
				$this->load->view("ubah_pariwisata", $this->data);
			} else {
				redirect(site_url("master_data/pariwisata_ubah/" . $id_pariwisata));
			}
		}
		
		public function pariwisata_hapus_proses($id_pariwisata = 0) {
			if ($id_pariwisata != 0) {
				$this->load->model("pariwisata_model");
				if ($this->pariwisata_model->delete_pariwisata($id_pariwisata)) {
					$error["form_hapus_judul"] = "Sukses";
					$error["form_hapus_warna"] = "success";
					$error["form_hapus_icon"] = "check";
					$error["form_hapus"] = "Data pariwisata telah berhasil dihapus.";
				} else {
					$error["form_hapus_judul"] = "Gagal";
					$error["form_hapus_warna"] = "danger";
					$error["form_hapus_icon"] = "close";
					$error["form_hapus"] = "Terjadi kesalahan saat proses data, silahkan coba lagi nanti.";
				}
				$this->data["error"] = $error;
				$this->load->view("data_pariwisata", $this->data);
			} else {
				redirect(site_url("master_data/pariwisata"));
			}
		}

		public function pengunjung() {
			$this->load->view("data_pengunjung", $this->data);
		}
		
		public function pengunjung_tambah() {
			$this->load->model("pariwisata_model");
			$this->data["list_pariwisata"] = $this->pariwisata_model->get_all_pariwisata();
			for ($i=date("Y"); $i>=2000; $i--) {
				$this->data["list_tahun"][] = $i;
			}
			$this->data["cb_lokasi"] = "";
			$this->data["cb_tahun"] = "";
			$this->data["txt_jumlah_pengunjung"] = "";
			$this->load->view("tambah_pengunjung", $this->data);
		}
		
		public function pengunjung_tambah_proses() {
			if ($this->input->post("btn_simpan")) {
				$this->load->model("pariwisata_model");
				$this->load->model("pengunjung_model");
				$cb_lokasi = $this->input->post("cb_lokasi");
				$cb_tahun = $this->input->post("cb_tahun");
				$txt_jumlah_pengunjung = $this->input->post("txt_jumlah_pengunjung");
				
				// proteksi
				if ($cb_lokasi == "") {
					$error["cb_lokasi"] = "Lokasi belum dipilih";
				}
				if ($cb_tahun == "") {
					$error["cb_tahun"] = "Tahun belum dipilih";
				} else if ($cb_tahun < 2000 || $cb_tahun > date("Y")) {
					$error["cb_tahun"] = "Tahun tidak benar";
				} else if ($this->pengunjung_model->check_pengunjung_exist(0, $cb_lokasi, $cb_tahun)) {
					$error["cb_tahun"] = "Data Pengunjung pada tahun ini sudah ada";
				}
				if ($txt_jumlah_pengunjung == "") {
					$error["txt_jumlah_pengunjung"] = "Jumlah Pengunjung tidak boleh kosong";
				} else if (!ctype_digit(strval($txt_jumlah_pengunjung))) {
					$error["txt_jumlah_pengunjung"] = "Jumlah Pengunjung harus menggunakan angka";
				}
				// end proteksi
				
				if (!isset($error["cb_lokasi"]) && !isset($error["cb_tahun"]) && !isset($error["txt_jumlah_pengunjung"])) {
					$params = array(
						"id_pariwisata" => $cb_lokasi,
						"tahun" => $cb_tahun,
						"jumlah_pengunjung" => $txt_jumlah_pengunjung
					);
					if ($this->pengunjung_model->insert_pengunjung($params)) {
						$error["form_tambah_judul"] = "Sukses";
						$error["form_tambah_warna"] = "success";
						$error["form_tambah_icon"] = "check";
						$error["form_tambah"] = "Data pengunjung baru telah berhasil disimpan.";
						$cb_lokasi = "";
						$cb_tahun = "";
						$txt_jumlah_pengunjung = "";
					} else {
						$error["form_tambah_judul"] = "Gagal";
						$error["form_tambah_warna"] = "danger";
						$error["form_tambah_icon"] = "close";
						$error["form_tambah"] = "Terjadi kesalahan saat proses data, silahkan coba lagi nanti.";
					}
				}
				$this->data["list_pariwisata"] = $this->pariwisata_model->get_all_pariwisata();
				for ($i=date("Y"); $i>=2000; $i--) {
					$this->data["list_tahun"][] = $i;
				}
				$this->data["cb_lokasi"] = $cb_lokasi;
				$this->data["cb_tahun"] = $cb_tahun;
				$this->data["txt_jumlah_pengunjung"] = $txt_jumlah_pengunjung;
				$this->data["error"] = $error;
				$this->load->view("tambah_pengunjung", $this->data);
			} else {
				redirect(site_url("master_data/pengunjung_tambah"));
			}
		}
		
		public function pengunjung_lihat($id_pengunjung = 0) {
			$this->load->model("pengunjung_model");
			$pengunjung = $this->pengunjung_model->get_pengunjung($id_pengunjung);
			if ($pengunjung == NULL) {
				$this->data["data_pengunjung"] = false;
			} else {
				$this->data["data_pengunjung"] = true;
				$this->data["pengunjung"] = $pengunjung;
			}
			$this->load->view("lihat_pengunjung", $this->data);
		}
		
		public function pengunjung_ubah($id_pengunjung = 0) {
			$this->load->model("pengunjung_model");
			$pengunjung = $this->pengunjung_model->get_pengunjung($id_pengunjung);
			if ($pengunjung == NULL) {
				$this->data["data_pengunjung"] = false;
			} else {
				$this->load->model("pariwisata_model");
				$this->data["list_pariwisata"] = $this->pariwisata_model->get_all_pariwisata();
				for ($i=date("Y"); $i>=2000; $i--) {
					$this->data["list_tahun"][] = $i;
				}
				$this->data["data_pengunjung"] = true;
				$this->data["id_pengunjung"] = $id_pengunjung;
				$this->data["cb_lokasi"] = $pengunjung->id_pariwisata;
				$this->data["cb_tahun"] = $pengunjung->tahun;
				$this->data["txt_jumlah_pengunjung"] = $pengunjung->jumlah_pengunjung;
			}
			$this->load->view("ubah_pengunjung", $this->data);
		}
		
		public function pengunjung_ubah_proses($id_pengunjung = 0) {
			if ($this->input->post("btn_simpan") && $id_pengunjung != 0) {
				$this->load->model("pariwisata_model");
				$this->load->model("pengunjung_model");
				$cb_lokasi = $this->input->post("cb_lokasi");
				$cb_tahun = $this->input->post("cb_tahun");
				$txt_jumlah_pengunjung = $this->input->post("txt_jumlah_pengunjung");
				
				// proteksi
				if ($cb_lokasi == "") {
					$error["cb_lokasi"] = "Lokasi belum dipilih";
				}
				if ($cb_tahun == "") {
					$error["cb_tahun"] = "Tahun belum dipilih";
				} else if ($cb_tahun < 2000 || $cb_tahun > date("Y")) {
					$error["cb_tahun"] = "Tahun tidak benar";
				} else if ($this->pengunjung_model->check_pengunjung_exist($id_pengunjung, $cb_lokasi, $cb_tahun)) {
					$error["cb_tahun"] = "Data Pengunjung pada tahun ini sudah ada";
				}
				if ($txt_jumlah_pengunjung == "") {
					$error["txt_jumlah_pengunjung"] = "Jumlah Pengunjung tidak boleh kosong";
				} else if (!ctype_digit(strval($txt_jumlah_pengunjung))) {
					$error["txt_jumlah_pengunjung"] = "Jumlah Pengunjung harus menggunakan angka";
				}
				// end proteksi
				
				if (!isset($error["cb_lokasi"]) && !isset($error["cb_tahun"]) && !isset($error["txt_jumlah_pengunjung"])) {
					$params = array(
						"id_pariwisata" => $cb_lokasi,
						"tahun" => $cb_tahun,
						"jumlah_pengunjung" => $txt_jumlah_pengunjung
					);
					if ($this->pengunjung_model->update_pengunjung($id_pengunjung, $params)) {
						redirect(site_url("master_data/pengunjung"));
					} else {
						$error["form_ubah_judul"] = "Gagal";
						$error["form_ubah_warna"] = "danger";
						$error["form_ubah_icon"] = "close";
						$error["form_ubah"] = "Terjadi kesalahan saat proses data, silahkan coba lagi nanti.";
					}
				}
				$this->data["data_pengunjung"] = true;
				$this->data["list_pariwisata"] = $this->pariwisata_model->get_all_pariwisata();
				for ($i=date("Y"); $i>=2000; $i--) {
					$this->data["list_tahun"][] = $i;
				}
				$this->data["cb_lokasi"] = $cb_lokasi;
				$this->data["cb_tahun"] = $cb_tahun;
				$this->data["txt_jumlah_pengunjung"] = $txt_jumlah_pengunjung;
				$this->data["id_pengunjung"] = $id_pengunjung;
				$this->data["error"] = $error;
				$this->load->view("ubah_pengunjung", $this->data);
			} else {
				redirect(site_url("master_data/pengunjung_ubah/" . $id_pengunjung));
			}
		}
		
		public function pengunjung_hapus_proses($id_pengunjung = 0) {
			if ($id_pengunjung != 0) {
				$this->load->model("pengunjung_model");
				if ($this->pengunjung_model->delete_pengunjung($id_pengunjung)) {
					$error["form_hapus_judul"] = "Sukses";
					$error["form_hapus_warna"] = "success";
					$error["form_hapus_icon"] = "check";
					$error["form_hapus"] = "Data pengunjung telah berhasil dihapus.";
				} else {
					$error["form_hapus_judul"] = "Gagal";
					$error["form_hapus_warna"] = "danger";
					$error["form_hapus_icon"] = "close";
					$error["form_hapus"] = "Terjadi kesalahan saat proses data, silahkan coba lagi nanti.";
				}
				$this->data["error"] = $error;
				$this->load->view("data_pengunjung", $this->data);
			} else {
				redirect(site_url("master_data/pengunjung"));
			}
		}
	}
?>