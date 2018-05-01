<div class="row">
    <div class="col-sm-offset-3 col-md-6 col-lg-6 col-sm-6 col-xs-12">
	<div class="white-box">
	    <h3 class="box-title">Login</h3>
	    <ul class="list-inline text-right">
		<li>
		    <h5><i class="fa fa-circle m-r-5 text-info"></i>Mac</h5> </li>
		<li>
		    <h5><i class="fa fa-circle m-r-5 text-inverse"></i>Windows</h5> </li>
	    </ul>
	    <div id="ct-visits">
		<?= form_open(current_url(), 'class="form-horizontal form-material" role="form" id="form_login"') ?>
		<?php
		if ($this->session->flashdata('error') != NULL) {
		    echo DIV_ERR . $this->session->flashdata('error') . DIV_CLOSE;
		}

		if ($this->session->flashdata('success') != NULL) {
		    echo DIV_SUCCESS . $this->session->flashdata('success') . DIV_CLOSE;
		}
		?>
		<?= validation_errors(DIV_ERR, DIV_CLOSE) ?>
		<div class="form-group">
		    <label for="email" class="col-md-12">Email</label>
		    <div class="col-md-12">
			<input type="email" name="email" placeholder="ex. johnathan@admin.com" class="form-control form-control-line osk" id="email" autocomplete="off" data-mask="email"> </div>
		</div>
		<div class="form-group">
		    <label for="password" class="col-md-12">Password</label>
		    <div class="col-md-12">
			<input type="password" name="pswd" placeholder="Password" class="form-control form-control-line osk" id="password" autocomplete="off" data-osk-options="disableSymbols"> </div>
		</div>
		
		<div class="form-group">
		    <div class="col-sm-4">
			<button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in fa-fw"></i> Log In</button>
		    </div>
		    <div class="col-sm-4">
			<a class="btn btn-info btn-block" onclick="showAjaxModal('auth/qr_scanner'); return false;"><i class="fa fa-photo fa-fw"></i> Login QR-code</a>
		    </div>
		    <div class="col-sm-4">
		    <a class="btn btn-default btn-block submit" href="<?php echo base_url(); ?>auth/forgot_password">Lost password?</a>
		    </div>
		</div>
		<?= form_close(); ?>
		<div class="clearfix"></div>

		<div class="separator">
		    <div class="text-center">
			<h3><i class="fa fa-paw"></i> <?= SITENAME ?></h3>
			<p>©<?= date('Y') ?> All Rights Reserved.</p>
		    </div>
		</div>
		
	    </div>

	</div>
    </div>
</div>