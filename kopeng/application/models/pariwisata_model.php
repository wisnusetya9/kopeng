<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class pariwisata_model extends CI_Model {
		
		public function __construct() {
			parent:: __construct();
			$this->load->database("default");
		}
		
		public function get_pariwisata($limit, $tipe) { //tipe {1 = terbaru, 2 = jumlah suka terbanyak, 3 = jumlah pengunjung terbanyak, 4 = normal}
			$this->db->select("par.*, IFNULL((SELECT SUM(pen.jumlah_pengunjung) FROM tbl_pengunjung pen WHERE pen.id_pariwisata=par.id_pariwisata), 0) AS jumlah_pengunjung");
			$this->db->from("tbl_pariwisata par");
			if ($tipe == 2) {
				$this->db->order_by("par.jumlah_suka", "DESC");
			} else if ($tipe == 3) {
				$this->db->order_by("jumlah_pengunjung", "DESC");
			} else if ($tipe == 4) {
				$this->db->order_by("par.nama_lokasi", "ASC");
			}
			$this->db->order_by("par.id_pariwisata", "DESC");
			if ($limit > 0) {
				$this->db->limit($limit);	
			}
			$result = $this->db->get();
			return $result->result();
		}
		
		public function update_jumlah_suka($id_pariwisata, $tambah) {
			$this->db->query("UPDATE tbl_pariwisata SET jumlah_suka=jumlah_suka+" . $tambah . " WHERE id_pariwisata=" . $id_pariwisata);
			return ($this->db->affected_rows() > 0) ? true : false;
		}
	}
?>