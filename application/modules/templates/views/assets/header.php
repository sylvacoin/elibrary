<!DOCTYPE html>
<html lang="en">

    <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/images/favicon.png">
	<title><?= isset($page_title) ? $page_title . ' | ' . SITENAME : SITENAME ?></title>
	<!-- Bootstrap Core CSS -->
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- Menu CSS -->
	<link href="<?= base_url() ?>assets/css/sidebar-nav.min.css" rel="stylesheet">
	<!-- toast CSS -->
	<link href="<?= base_url() ?>assets/css/jquery.toast.css" rel="stylesheet">

	<!-- animation CSS -->
	<link href="<?= base_url() ?>assets/css/animate.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
	<!-- color CSS -->
	<link href="<?= base_url() ?>assets/css/colors/default.css" id="theme" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<!-- All Jquery -->
	<!-- ============================================================== -->
	<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
	<script>
            var baseurl = '<?= base_url() ?>';
	</script>
	<?php if ($this->uri->segment(1) == 'profile'): ?>
    	<script src="<?= base_url() ?>assets/js/jquery-qrcode-0.14.0.min.js"></script>
	<?php endif; ?>
	<?php if ($this->uri->segment(1) == 'login' || $this->uri->segment(1) == NULL): ?>
    	<!-- onScreen Keyboard CSS -->
    	<link href="<?= base_url() ?>assets/css/onScreenKeyboard.cs" rel="stylesheet">
    	<style>
	    #osk-container {
		width: 38%;
		min-width: 360px;
		max-width: 1200px;
		background: rgba(255,255,255,.8);
		border-radius: 0px;
		box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	    }
    	</style>
    	<script src="<?= base_url() ?>assets/js/jquery.onScreenKeyboard.min.js"></script>
	<script type="text/javascript">
	    $(document).ready(function(){
		$('.osk').onScreenKeyboard({
                    topPosition: '60%',
                    leftPosition: '40%'
                });
	    });
    	</script>
    	<script src="<?= base_url() ?>assets/js/instascan.min.js"></script>
	<?php endif; ?>
    </head>

    <body class="fix-header">
	<!-- ============================================================== -->
	<!-- Preloader -->
	<!-- ============================================================== -->
	<div class="preloader">
	    <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
	    </svg>
	</div>
	<!-- ============================================================== -->
	<!-- Wrapper -->
	<!-- ============================================================== -->
	<div id="wrapper">
