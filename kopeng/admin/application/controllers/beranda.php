<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class beranda extends CI_Controller {
	
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
			$this->load->model("pariwisata_model");
			$this->load->model("pengunjung_model");
			$tahun_awal = date("Y");
			$tahun_akhir = date("Y");
			if ($this->input->post("btn_tampil")) {
				$tahun_awal = $this->input->post("cb_tahun_awal");
				$tahun_akhir = $this->input->post("cb_tahun_akhir");
				
				// proteksi
				if ($tahun_awal == "" || $tahun_akhir == "") {
					$tahun_awal = date("Y");
					$tahun_akhir = date("Y");
				} else if (!ctype_digit(strval($tahun_awal)) || !ctype_digit(strval($tahun_akhir))) {
					$tahun_awal = date("Y");
					$tahun_akhir = date("Y");
				} else if (($tahun_awal < 2000 || $tahun_awal > date("Y")) || ($tahun_akhir < 2000 || $tahun_akhir > date("Y"))) {
					$tahun_awal = date("Y");
					$tahun_akhir = date("Y");
				}
				// end proteksi
			}
			$this->data["list_pariwisata"] = $this->pariwisata_model->get_all_pariwisata();
			for ($i=$tahun_awal; $i<=$tahun_akhir; $i++) {
				$this->data["list_pengunjung"][$i] = $this->pengunjung_model->get_all_pengunjung_grafik($i);
			}
			for ($i=date("Y"); $i>=2000; $i--) {
				$this->data["list_tahun"][] = $i;
			}
			$this->data["cb_tahun_awal"] = $tahun_awal;
			$this->data["cb_tahun_akhir"] = $tahun_akhir;
			$this->load->view("beranda", $this->data);
		}
	}
?>