<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<?php
			$page = "Login";
			$title = "Masuk";
			include_once("head_import.php");
		?>
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<b>PRO</b>VILLA
			</div>
			<div class="login-box-body">
				<p class="login-box-msg">Masuk sebagai Admin</p>
				<form action="<?php echo site_url("masuk/proses"); ?>" method="post">
					<div class="form-group has-feedback">
						<input type="text" class="form-control" id="txt_username" name="txt_username" placeholder="Nama Pengguna" value="<?php echo $txt_username; ?>" required>
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" id="txt_password" name="txt_password" placeholder="Kata Sandi" required>
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<?php
						if (isset($error)) {
					?>
							<p style="color: red;">Nama pengguna / Kata sandi Anda salah</p>
					<?php
						}
					?>
					<div class="row">
						<div class="col-xs-12">
							<input type="submit" class="btn btn-success btn-block btn-flat" name="btn_login" value="Masuk">
						</div>
					</div>
				</form>
				<a href="<?php echo site_url("lupa_kata_sandi"); ?>">Lupa kata sandi ?</a><br>
			</div>
		</div>
		<?php
			include_once("foot_import.php");
		?>
		<script>
			$(document).ready(function() {
				$("#txt_username").focusTextToEnd();
			});
		</script>
	</body>
</html>