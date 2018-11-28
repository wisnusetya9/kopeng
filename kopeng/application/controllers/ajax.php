<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class ajax extends CI_Controller {
	
		public $data;
	
		public function __construct() {
			parent:: __construct();
			$this->load->helper("cookie");
		}

		public function suka($id_pariwisata) {
			$this->load->model("pariwisata_model");
			$response["result"] = 0;
			if (get_cookie("suka" . $id_pariwisata)) {
				if ($this->pariwisata_model->update_jumlah_suka($id_pariwisata, -1)) {
					delete_cookie("suka" . $id_pariwisata);
					$response["result"] = -1;	
				}
			} else {
				if ($this->pariwisata_model->update_jumlah_suka($id_pariwisata, 1)) {
					$cookie = array(
						"name" => "suka" . $id_pariwisata,
						"value" => "1",
						"expire" => time() + (100 * 365 * 24 * 60 * 60)
					);
					set_cookie($cookie);
					$response["result"] = 1;
				}				
			}
			$response["id"] = $id_pariwisata;
			echo json_encode($response);
		}
	}
?>