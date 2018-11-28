<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class pengunjung_model extends CI_Model {
		
		public function __construct() {
			parent:: __construct();
			$this->load->database("default");
			$this->load->helper("url");
		}
		
		public function get_all_pengunjung_grafik($tahun){
			$result = $this->db->query("SELECT GROUP_CONCAT(IFNULL((SELECT pen.jumlah_pengunjung FROM tbl_pengunjung pen WHERE pen.id_pariwisata = par.id_pariwisata AND pen.tahun=" . $tahun . "), 0)) AS data FROM tbl_pariwisata par ORDER BY par.nama_lokasi")->row();
			$data = $result->data;
			return $data;
		}
		
		public function check_pengunjung_exist($id_pengunjung, $id_pariwisata, $tahun) {
			$this->db->where("id_pengunjung <>", $id_pengunjung);
			$this->db->where("id_pariwisata", $id_pariwisata);
			$this->db->where("tahun", $tahun);
			if ($this->db->get("tbl_pengunjung")->row() == NULL) {
				return false;
			} else {
				return true;
			}
		}
		
		public function insert_pengunjung($params) {
			$this->db->insert("tbl_pengunjung", $params);
			return ($this->db->affected_rows() > 0) ? true : false;
		}
		
		public function get_pengunjung($id_pengunjung) {
			$this->db->select("pen.*, par.nama_lokasi");
			$this->db->from("tbl_pengunjung pen");
			$this->db->join("tbl_pariwisata par", "par.id_pariwisata=pen.id_pariwisata");
			$this->db->where("pen.id_pengunjung", $id_pengunjung);
			return $this->db->get()->row();
		}

		public function update_pengunjung($id_pengunjung, $params) {
			$this->db->where("id_pengunjung", $id_pengunjung);
			return ($this->db->update("tbl_pengunjung", $params) === true) ? true : false;
		}

		public function delete_pengunjung($id_pengunjung) {
			$this->db->where("id_pengunjung", $id_pengunjung);
			$this->db->delete("tbl_pengunjung");
			return ($this->db->affected_rows() > 0) ? true : false;
		}
		
		public function ajax_get_all_pengunjung($params) {
			$data = array();
			$columns = array(
				1 => "par.nama_lokasi",
				2 => "pen.tahun",
				3 => "pen.jumlah_pengunjung"
			);
			$where = "";
			$query = "SELECT CONCAT((@row_number:=@row_number + 1), '.') AS no, par.nama_lokasi, pen.tahun, REPLACE(FORMAT(pen.jumlah_pengunjung, 0), ',', '.') AS jumlah_pengunjung, CONCAT('<a class=\"btn btn-sm btn-primary\" data-placement=\"bottom\" data-toggle=\"tooltip\" title=\"Lihat Data\" href=\"" . site_url("master_data/pengunjung_lihat/") . "', id_pengunjung, '\"><span class=\"glyphicon glyphicon-eye-open\"></span></a> <a class=\"btn btn-sm btn-warning\" data-placement=\"bottom\" data-toggle=\"tooltip\" title=\"Ubah Data\" href=\"" . site_url("master_data/pengunjung_ubah/") . "', id_pengunjung, '\"><span class=\"glyphicon glyphicon-edit\"></span></a> <a class=\"btn btn-sm btn-danger tooltips\" data-placement=\"bottom\" data-toggle=\"tooltip\" title=\"Hapus Data\" onclick=\"return hapus(', id_pengunjung, ');\"><span class=\"glyphicon glyphicon-trash\"></a></center></span></a></div></center></td>') AS opsi 
						FROM tbl_pengunjung pen 
						JOIN tbl_pariwisata par ON (par.id_pariwisata=pen.id_pariwisata), (SELECT @row_number:=0) AS t ";
			if(!empty($params["search"]["value"])) {
				$where .="WHERE (par.nama_lokasi LIKE '%".$params["search"]["value"]."%') ";
			}
			if(isset($where) && $where != "") {
				$query .= $where;
			}
			$query .=  "ORDER BY " . $columns[$params["order"][0]["column"]] . " " . $params["order"][0]["dir"] . "  LIMIT " . $params["start"] . ", " . $params["length"];
			$result = $this->db->query($query);
			if ($result->num_rows() > 0) {
				foreach ($result->result() as $row) {
					$data[] = array(
						$row->no,
						$row->nama_lokasi,
						$row->tahun,
						$row->jumlah_pengunjung,
						$row->opsi
					);
				}
			}
			return $data;
		}
		
		public function ajax_get_all_total_pengunjung($params) {
			$total = 0;
			$where = "";
			$query = "SELECT COUNT(pen.id_pengunjung) AS total 
						FROM tbl_pengunjung pen 
						JOIN tbl_pariwisata par ON (par.id_pariwisata=pen.id_pariwisata) ";
			if(!empty($params["search"]["value"])) {
				$where .="WHERE (par.nama_lokasi LIKE '%".$params["search"]["value"]."%') ";
			}
			if(isset($where) && $where != "") {
				$query .= $where;
			}
			$result = $this->db->query($query)->row();
			$total = $result->total;
			return $total;
		}
	}
?>