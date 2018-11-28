<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class lupa_kata_sandi extends CI_Controller {
	
		public $data;

		public function __construct() {
			parent:: __construct();
			$this->load->library("session");
			$this->load->helper("url");
		}

		public function index() {
			if ($this->session->userdata("login") == NULL) {
				$this->data["txt_username"] = "";
				$this->load->view("lupa_kata_sandi", $this->data);
			} else {
				if ($this->session->userdata("login")->status != "admin") {
					$this->load->view("lupa_kata_sandi");
				} else {
					redirect(site_url("beranda"));
				}
			}
		}
		
		public function proses(){
			if ($this->input->post("btn_reset")) {
				$this->load->model("user_model");
				$txt_username = $this->input->post("txt_username");
				$status = "admin";
				$user = $this->user_model->get_user($txt_username, $status);
				if ($user == NULL) {
					$error["warna"] = "red";
					$error["teks"] = "Nama Pengguna tidak ditemukan";
				} else {
					if ($this->user_model->change_password($user)) {
						$error["warna"] = "green";
						$error["teks"] = "Kata Sandi baru telah dikirimkan ke email Anda";
						$txt_username = "";
					} else {
						$error["warna"] = "red";
						$error["teks"] = "Terjadi kesalahan saat proses data, silahkan coba lagi nanti.";
					}					
				}
				$this->data["error"] = $error;
				$this->data["txt_username"] = $txt_username;
				$this->load->view("lupa_kata_sandi", $this->data);
			} else {
				redirect(site_url("lupa_kata_sandi"));
			}
		}
	}
?>