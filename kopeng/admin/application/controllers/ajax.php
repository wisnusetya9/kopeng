<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ajax extends CI_Controller {
	
		public $data;
	
		public function __construct() {
			parent:: __construct();
			$this->load->library("session");
		}

		public function get_all_pariwisata() {
			if ($this->session->userdata("login") != NULL) {
				if ($this->session->userdata("login")->status == "admin") {
					$this->load->model("pariwisata_model");
					$params = $_REQUEST;
					$list_pariwisata = $this->pariwisata_model->ajax_get_all_pariwisata($params);
					$total = $this->pariwisata_model->ajax_get_all_total_pariwisata($params);
					$response = array(
						"draw" => intval($params['draw']),
						"recordsTotal" => intval($total),
						"recordsFiltered" => intval($total),
						"data" => $list_pariwisata
					);
					echo json_encode($response);
				}
			}
		}
		
		public function get_all_pengunjung() {
			if ($this->session->userdata("login") != NULL) {
				if ($this->session->userdata("login")->status == "admin") {
					$this->load->model("pengunjung_model");
					$params = $_REQUEST;
					$list_pengunjung = $this->pengunjung_model->ajax_get_all_pengunjung($params);
					$total = $this->pengunjung_model->ajax_get_all_total_pengunjung($params);
					$response = array(
						"draw" => intval($params['draw']),
						"recordsTotal" => intval($total),
						"recordsFiltered" => intval($total),
						"data" => $list_pengunjung
					);
					echo json_encode($response);
				}
			}
		}
	}
?>