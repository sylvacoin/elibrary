<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{sitename}} school management software by dimconnect" />
    <meta name="author" content="dimconnect" />
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/imgs/static/favicon.png">
    
    <title>{{pagetitle}} | {{site name}} </title>

    <!-- Bootstrap -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url() ?>assets/css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url() ?>assets/css/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
           <?php

	if (!isset($view_file)){
	    $view_file = "";
	}

	if (!isset($module)){
	    $module = $this->uri->segment(1);
	}

	if ($view_file != "" && $module != "") { 
	    $path = $module.'/'.$view_file;
	    $this->load->view($path);
	}else{
	    echo nl2br($body);
	}

	?>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?= base_url() ?>assets/js/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?= base_url() ?>assets/js/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?= base_url() ?>assets/js/custom.js"></script>
  </body>
</html>