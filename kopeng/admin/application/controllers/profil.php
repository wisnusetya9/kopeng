<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class profil extends CI_Controller {
	
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
			$this->data["txt_email"] = $this->session->userdata("login")->email;
			$this->data["txt_nama"] = $this->session->userdata("login")->nama;
			$this->load->view("profil", $this->data);
		}
		
		public function proses() {
			if ($this->input->post("btn_simpan")) {
				$this->load->model("user_model");
				$id_user = $this->session->userdata("login")->id_user;
				$txt_email = $this->input->post("txt_email");
				$txt_nama = $this->input->post("txt_nama");
				$status = "admin";
				
				// proteksi
				if ($txt_email == "") {
					$error["txt_email"] = "Email tidak boleh kosong";
				}
				if ($txt_nama == "") {
					$error["txt_nama"] = "Nama tidak boleh kosong";
				}
				// end proteksi
				
				if (!isset($error["txt_email"]) && !isset($error["txt_nama"])) {
					$params = array(
						"email" => $txt_email,
						"nama" => $txt_nama
					);
					if ($this->user_model->update_user($id_user, $params)) {
						$error["form_ubah_judul"] = "Sukses";
						$error["form_ubah_warna"] = "success";
						$error["form_ubah_icon"] = "check";
						$error["form_ubah"] = "Profil telah berhasil diubah.";
						$user = $this->user_model->get_user($id_user, $status);
						$this->session->set_userdata("login", $user);
						$this->data["login"] = $this->session->userdata("login");
					} else {
						$error["form_ubah_judul"] = "Gagal";
						$error["form_ubah_warna"] = "danger";
						$error["form_ubah_icon"] = "close";
						$error["form_ubah"] = "Terjadi kesalahan saat proses data, silahkan coba lagi nanti.";
					}
				}
				$this->data["txt_email"] = $txt_email;
				$this->data["txt_nama"] = $txt_nama;
				$this->data["error"] = $error;
				$this->load->view("profil", $this->data);
			} else {
				redirect(site_url("profil"));
			}
		}
	}
?>