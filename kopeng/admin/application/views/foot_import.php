<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	if ($page == "Login") {
?>	
		<!-- jQuery 2.1.4 -->
		<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
		<script>
			$(function () {
				$('input').iCheck({
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
					increaseArea: '20%' // optional
				});
			});
		</script>
		<script src="<?php echo base_url(); ?>assets/js/auto-focus.js"></script>
<?php
	} else if ($page == "Menu") {
?>	
		<!-- jQuery 2.1.4 -->
		<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
		  $.widget.bridge('uibutton', $.ui.button);
		</script>
		<!-- Bootstrap 3.3.5 -->
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
		<!-- Data Tables 3.3.5 -->
		<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- Morris.js charts -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/morris/morris.min.js"></script>
		<!-- Sparkline -->
		<script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
		<!-- jvectormap -->
		<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<!-- jQuery Knob Chart -->
		<script src="<?php echo base_url(); ?>assets/plugins/knob/jquery.knob.js"></script>
		<!-- daterangepicker -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
		<!-- Dropdown -->
		<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
		<!-- datepicker -->
		<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
		<!-- Bootstrap WYSIHTML5 -->
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<!-- Slimscroll -->
		<script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
		<script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script>
		<!-- AdminLTE App -->
		<script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>
		<!-- Auto Focus -->
		<script src="<?php echo base_url(); ?>assets/js/auto-focus.js"></script>
<?php
	}
?>