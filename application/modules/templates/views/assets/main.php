

<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper">
    <div class="container-fluid">
	<div class="row bg-title">
	    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<?php if ( is_numeric($this->session->user_id) ): ?>
		<h4 class="page-title">Dashboard</h4> 
		<?php else:?>
		<h4 class="page-title">Welcome to <?= SITENAME ?></h4> 
		<?php endif; ?></div>
	    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<?php if ( isset($this->session->user_id) ): ?>
		<a href="<?= site_url('logout') ?>" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i class="fa fa-power-off"></i> logout</a>
		
		
		<ol class="breadcrumb">
		    <li><a href="#">Dashboard</a></li>
		</ol>
		
		<?php endif; ?>
	    </div>
	    <!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<!-- ============================================================== -->
	<!-- Different data widgets -->
	<!-- ============================================================== -->
	<!-- .row -->
	<?php
	if (!isset($view_file)) {
	    $view_file = "";
	}

	if (!isset($module)) {
	    $module = $this->uri->segment(1);
	}

	if ($view_file != "" && $module != "") {
	    $path = $module . '/' . $view_file;
	    $this->load->view($path);
	} else {
	    echo nl2br($body);
	}
	?>
</div>
            <!-- /.container-fluid -->