<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class beranda extends CI_Controller {
	
		public $data;
	
		public function __construct() {
			parent:: __construct();
			$this->load->helper("url");
			$this->load->helper("cookie");
		}

		public function index() {
			$this->load->model("pariwisata_model");
			$list_pariwisata = $this->pariwisata_model->get_pariwisata(6, 1);
			foreach ($list_pariwisata as &$pariwisata) {
				if (get_cookie("suka" . $pariwisata->id_pariwisata)) {
					$pariwisata->suka = 1;
					$pariwisata->gambar_suka = "like";
				} else {
					$pariwisata->suka = -1;
					$pariwisata->gambar_suka = "dislike";
				}
			}
			$this->data["list_pariwisata"] = $list_pariwisata;
			$this->load->view("beranda", $this->data);
		}
	}
?>