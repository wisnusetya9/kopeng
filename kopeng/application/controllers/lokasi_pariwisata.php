<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class lokasi_pariwisata extends CI_Controller {
	
		public $data;
	
		public function __construct() {
			parent:: __construct();
			$this->load->helper("url");
			$this->load->helper("cookie");
		}

		public function index() {
			$this->load->model("pariwisata_model");
			$list_pariwisata_terbaru = $this->pariwisata_model->get_pariwisata(3, 1);
			$list_pariwisata_jumlah_suka_terbanyak = $this->pariwisata_model->get_pariwisata(3, 2);
			$list_pariwisata_jumlah_pengunjung_terbanyak = $this->pariwisata_model->get_pariwisata(3, 3);
			$list_pariwisata = $this->pariwisata_model->get_pariwisata(0, 1);
			foreach ($list_pariwisata as &$pariwisata) {
				if (get_cookie("suka" . $pariwisata->id_pariwisata)) {
					$pariwisata->suka = 1;
					$pariwisata->gambar_suka = "like";
				} else {
					$pariwisata->suka = -1;
					$pariwisata->gambar_suka = "dislike";
				}
				$filter = "";
				foreach ($list_pariwisata_terbaru as $pariwisata_temp) {
					if ($pariwisata->id_pariwisata == $pariwisata_temp->id_pariwisata) {
						$filter .= " terbaru";
					}
				}
				foreach ($list_pariwisata_jumlah_suka_terbanyak as $pariwisata_temp) {
					if ($pariwisata->id_pariwisata == $pariwisata_temp->id_pariwisata) {
						$filter .= " suka";
					}
				}
				foreach ($list_pariwisata_jumlah_pengunjung_terbanyak as $pariwisata_temp) {
					if ($pariwisata->id_pariwisata == $pariwisata_temp->id_pariwisata) {
						$filter .= " pengunjung";
					}
				}
				$pariwisata->filter = $filter;
			}
			$this->data["list_pariwisata"] = $list_pariwisata;
			$this->load->view("lokasi_pariwisata", $this->data);
		}
	}
?>