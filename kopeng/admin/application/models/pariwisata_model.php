<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class pariwisata_model extends CI_Model {
		
		public function __construct() {
			parent:: __construct();
			$this->load->database("default");
			$this->load->helper("url");
		}
		
		public function get_all_pariwisata() {
			$this->db->order_by("nama_lokasi", "ASC");
			$result = $this->db->get("tbl_pariwisata");
			return $result->result();
		}
		
		public function insert_pariwisata($params) {
			$this->db->insert("tbl_pariwisata", $params);
			return ($this->db->affected_rows() > 0) ? true : false;
		}
		
		public function get_pariwisata($id_pariwisata) {
			$this->db->where("id_pariwisata", $id_pariwisata);
			return $this->db->get("tbl_pariwisata")->row();
		}

		public function update_pariwisata($id_pariwisata, $params) {
			$this->db->where("id_pariwisata", $id_pariwisata);
			return ($this->db->update("tbl_pariwisata", $params) === true) ? true : false;
		}

		public function delete_pariwisata($id_pariwisata) {
			$this->db->where("id_pariwisata", $id_pariwisata);
			$this->db->delete("tbl_pariwisata");
			return ($this->db->affected_rows() > 0) ? true : false;
		}
		
		public function ajax_get_all_pariwisata($params) {
			$data = array();
			$columns = array(
				1 => "nama_lokasi",
				2 => "deskripsi",
				3 => "jumlah_suka"
			);
			$where = "";
			$query = "SELECT CONCAT((@row_number:=@row_number + 1), '.') AS no, nama_lokasi, deskripsi, REPLACE(FORMAT(jumlah_suka, 0), ',', '.') AS jumlah_suka, CONCAT('<a class=\"btn btn-sm btn-primary\" data-placement=\"bottom\" data-toggle=\"tooltip\" title=\"Lihat Data\" href=\"" . site_url("master_data/pariwisata_lihat/") . "', id_pariwisata, '\"><span class=\"glyphicon glyphicon-eye-open\"></span></a> <a class=\"btn btn-sm btn-warning\" data-placement=\"bottom\" data-toggle=\"tooltip\" title=\"Ubah Data\" href=\"" . site_url("master_data/pariwisata_ubah/") . "', id_pariwisata, '\"><span class=\"glyphicon glyphicon-edit\"></span></a> <a class=\"btn btn-sm btn-danger tooltips\" data-placement=\"bottom\" data-toggle=\"tooltip\" title=\"Hapus Data\" onclick=\"return hapus(', id_pariwisata, ');\"><span class=\"glyphicon glyphicon-trash\"></a></center></span></a></div></center></td>') AS opsi 
						FROM tbl_pariwisata, (SELECT @row_number:=0) AS t ";
			if(!empty($params["search"]["value"])) {
				$where .="WHERE (nama_lokasi LIKE '%".$params["search"]["value"]."%' ";
				$where .="OR deskripsi LIKE '%".$params["search"]["value"]."%') ";
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
						$row->deskripsi,
						$row->jumlah_suka,
						$row->opsi
					);
				}
			}
			return $data;
		}
		
		public function ajax_get_all_total_pariwisata($params) {
			$total = 0;
			$where = "";
			$query = "SELECT COUNT(id_pariwisata) AS total 
						FROM tbl_pariwisata ";
			if(!empty($params["search"]["value"])) {
				$where .="WHERE (nama_lokasi LIKE '%".$params["search"]["value"]."%' ";
				$where .="OR deskripsi LIKE '%".$params["search"]["value"]."%') ";
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