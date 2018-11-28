<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class user_model extends CI_Model {
		
		public function __construct() {
			parent:: __construct();
			$this->load->database("default");
		}
		
		public function login($id_user, $password, $status) {
			$this->db->where("id_user", $id_user);
			$this->db->where("password", md5($password));
			$this->db->where("status", $status);
			return $this->db->get("tbl_user")->row();
		}
		
		public function change_password($user) {
			$this->load->model("other_model");
			$password = $this->other_model->random_kode(8);
			$this->db->where("id_user", $user->id_user);
			$params = array(
				"password" => md5($password)
			);
			if ($this->db->update("tbl_user", $params) === true) {
				$subject = "Reset Kata Sandi PROVILLA";
				$body = "Yang terhormat Bpk/Ibu " . $user->nama . "<br /><br />
						Anda telah melakukan reset kata sandi. Silahkan masukan password di bawah ini untuk login :<br />
						Password : <b>" . $password . "</b><br />
						---------------------------------------------------------------------------------------------------------------<br />
						Kontak Kami<br />
						<table>
							<tr>
								<td>Website</td>
								<td>:</td>
								<td>http://www.provilla.com</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>:</td>
								<td>provilla@gmail.com</td>
							</tr>
							<tr>
								<td>Hp</td>
								<td>:</td>
								<td>0123456789</td>
							</tr>
						</table>";
				$this->other_model->kirim_email($user->email, $subject, $body);
				return true;
			} else {
				return false;
			}
		}
		
		public function get_user($id_user, $status) {
			$this->db->where("id_user", $id_user);
			$this->db->where("status", $status);
			return $this->db->get("tbl_user")->row();
		}
		
		public function update_user($id_user, $params) {
			$this->db->where("id_user", $id_user);
			return ($this->db->update("tbl_user", $params) === true) ? true : false;
		}
	}
?>