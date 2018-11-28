<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class tentang_kami extends CI_Controller {
	
		public $data;
	
		public function __construct() {
			parent:: __construct();
			$this->load->helper("url");
		}

		public function index() {
			$this->load->view("tentang_kami", $this->data);
		}
	}
?>