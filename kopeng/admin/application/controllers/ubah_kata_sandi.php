<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ubah_kata_sandi extends CI_Controller {
	
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

		public function index() {
			$this->data["txt_kata_sandi_lama"] = "";
			$this->data["txt_kata_sandi_baru"] = "";
			$this->data["txt_konfirmasi_kata_sandi_baru"] = "";
			$this->load->view("ubah_kata_sandi", $this->data);
		}
		
		public function proses() {
			if ($this->input->post("btn_simpan")) {
				$this->load->model("user_model");
				$id_user = $this->session->userdata("login")->id_user;
				$txt_kata_sandi_lama = $this->input->post("txt_kata_sandi_lama");
				$txt_kata_sandi_baru = $this->input->post("txt_kata_sandi_baru");
				$txt_konfirmasi_kata_sandi_baru = $this->input->post("txt_konfirmasi_kata_sandi_baru");
				$status = "admin";
				
				// proteksi
				if ($txt_kata_sandi_lama == "") {
					$error["txt_kata_sandi_lama"] = "Kata Sandi Lama tidak boleh kosong";
				} else if ($this->user_model->login($id_user, $txt_kata_sandi_lama, $status) == NULL) {
					$error["txt_kata_sandi_lama"] = "Kata Sandi Lama tidak benar";
				}
				if ($txt_kata_sandi_baru == "") {
					$error["txt_kata_sandi_baru"] = "Kata Sandi Baru tidak boleh kosong";
				} else if (strlen($txt_kata_sandi_baru) < 4 || strlen($txt_kata_sandi_baru) > 20) {
					$error["txt_kata_sandi_baru"] = "Kata Sandi hanya boleh 4 s/d 20 karakter";
				}
				if ($txt_konfirmasi_kata_sandi_baru == "") {
					$error["txt_konfirmasi_kata_sandi_baru"] = "Konfirmasi Kata Sandi Baru tidak boleh kosong";
				} else if ($txt_konfirmasi_kata_sandi_baru != $txt_kata_sandi_baru) {
					$error["txt_konfirmasi_kata_sandi_baru"] = "Konfirmasi Kata Sandi Baru tidak benar";
				}
				// end proteksi
				
				if (!isset($error["txt_kata_sandi_lama"]) && !isset($error["txt_kata_sandi_baru"]) && !isset($error["txt_konfirmasi_kata_sandi_baru"])) {
					$params = array(
						"password" => md5($txt_kata_sandi_baru)
					);
					if ($this->user_model->update_user($id_user, $params)) {
						$error["form_ubah_judul"] = "Sukses";
						$error["form_ubah_warna"] = "success";
						$error["form_ubah_icon"] = "check";
						$error["form_ubah"] = "Kata sandi telah berhasil diubah.";
						$txt_kata_sandi_lama = "";
						$txt_kata_sandi_baru = "";
						$txt_konfirmasi_kata_sandi_baru = "";
					} else {
						$error["form_ubah_judul"] = "Gagal";
						$error["form_ubah_warna"] = "danger";
						$error["form_ubah_icon"] = "close";
						$error["form_ubah"] = "Terjadi kesalahan saat proses data, silahkan coba lagi nanti.";
					}
				}
				$this->data["txt_kata_sandi_lama"] = $txt_kata_sandi_lama;
				$this->data["txt_kata_sandi_baru"] = $txt_kata_sandi_baru;
				$this->data["txt_konfirmasi_kata_sandi_baru"] = $txt_konfirmasi_kata_sandi_baru;
				$this->data["error"] = $error;
				$this->load->view("ubah_kata_sandi", $this->data);
			} else {
				redirect(site_url("ubah_kata_sandi"));
			}
		}
	}
?>