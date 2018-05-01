<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentellela Alela! | </title>

    <!-- Bootstrap -->
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="<?= base_url() ?>assets/css/font-awesome.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="<?= base_url() ?>assets/css/nprogress.css" rel="stylesheet">
	<!-- jQuery custom content scroller -->
	<link href="<?= base_url() ?>assets/css/animate.min.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
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
    </div>
  </body>
</html>