<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<footer>
	<div class="container">
		<div class="pull-right hidden-xs">
			<b>Versi</b> 1.0.0
		</div>
		<?php
			$year_create = 2017;
			$year_now = date("Y");
			if (($year_create - $year_now) == 0) {
				$year_copyright = "2017";
			} else {
				$year_copyright = "2017 - " . $year_now;
			}
		?>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="copyright text-center">
					<p>
						<strong>Copyright &copy; <?php echo $year_copyright; ?> PROVILLA.</strong> All rights reserved.
					</p>
				</div>
			</div>
		</div>
	</div>
</footer>