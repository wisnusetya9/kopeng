<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class masuk extends CI_Controller {
	
		public $data;

		public function __construct() {
			parent:: __construct();
			$this->load->library("session");
			$this->load->helper("url");
		}

		public function index() {
			if ($this->session->userdata("login") == NULL) {
				$this->data["txt_username"] = "";
				$this->load->view("masuk", $this->data);
			} else {
				if ($this->session->userdata("login")->status != "admin") {
					$this->load->view("masuk");
				} else {
					redirect(site_url("beranda"));
				}
			}
		}
		
		public function proses(){
			if ($this->input->post("btn_login")) {
				$this->load->model("user_model");
				$txt_username = $this->input->post("txt_username");
				$txt_password = $this->input->post("txt_password");
				$status = "admin";
				$user = $this->user_model->login($txt_username, $txt_password, $status);
				if ($user == NULL) {
					$this->data["error"] = true;
					$this->data["txt_username"] = $txt_username;
					$this->load->view("masuk", $this->data);
				} else {
					$this->session->set_userdata("login", $user);
					redirect(site_url("beranda"));
				}
			} else {
				redirect(site_url("masuk"));
			}
		}
	}
?>