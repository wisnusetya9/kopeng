<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class other_model extends CI_Model {
		
		var $karakter = "abcdefghijklmnopqrstuvwxyz0123456789";
		
		public function __construct() {
			parent:: __construct();
			$this->load->helper("url");
		}
		
		public function random_kode($panjang) {
			$kode = "";
			for ($i=0; $i<$panjang; $i++) {
				$kode .= $this->karakter[rand(0, 35)];
			}
			return $kode;
		}
		
		public function kirim_email($to, $subject, $body) {
			include_once $_SERVER['DOCUMENT_ROOT'] . "/kopeng/admin/assets/plugins/PHPMailer/PHPMailerAutoload.php";
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "ssl";
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465;
			$mail->IsHTML(true);
			$mail->Username = "672011021@student.uksw.edu";
			$mail->Password = "16041994";
			$mail->SetFrom("672011021@student.uksw.edu", "Stephen Aprius");
			$mail->AddAddress($to);
			try {
				$mail->Subject = $subject;
				$mail->Body = $body;
				if($mail->Send()) {
					return true;
				} else {
					return false;
				}
			} catch (Exception $e) {
				return false;
			}
		}
		
		public function png2jpg($file_path, $quality) {
			$image = imagecreatefrompng($file_path);
			$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
			imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
			imagealphablending($bg, TRUE);
			imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
			imagedestroy($image);
			imagejpeg($bg, $file_path . ".jpg", $quality);
			return $file_path . ".jpg";
		}
	}
?>