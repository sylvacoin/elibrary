<div class="row">
    <div class="col-sm-offset-3 col-md-6 col-lg-6 col-sm-6 col-xs-12">
	<div class="white-box">
	    <h3 class="box-title">Sign up</h3>
	    <ul class="list-inline text-right">
		<li>
		    <h5><i class="fa fa-circle m-r-5 text-info"></i>Mac</h5> </li>
		<li>
		    <h5><i class="fa fa-circle m-r-5 text-inverse"></i>Windows</h5> </li>
	    </ul>
	    <div id="ct-visits">
		<form class="form-horizontal form-material" method="post">
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
			<label for="fname" class="col-md-12">First name</label>
			<div class="col-md-12">
			    <input type="text" name="fname" placeholder="ex. james" class="form-control form-control-line" id="fname" autocomplete="false" value="<?= isset($fname) ? $fname : set_value('fname') ?>" > </div>
		    </div>
		    <div class="form-group">
			<label for="lname" class="col-md-12">Last name</label>
			<div class="col-md-12">
			    <input type="text" name="lname" placeholder="ex. Martin" class="form-control form-control-line" id="lname" autocomplete="false" value="<?= isset($lname) ? $lname : set_value('lname') ?>" > </div>
		    </div>
		    <div class="form-group">
			<label for="uname" class="col-md-12">Username</label>
			<div class="col-md-12">
			    <input type="text" name="uname" placeholder="ex. james" class="form-control form-control-line" id="uname" autocomplete="false" value="<?= isset($uname) ? $uname : set_value('uname') ?>" > </div>
		    </div>
		    <div class="form-group">
			<label for="email" class="col-md-12">Email</label>
			<div class="col-md-12">
			    <input type="email" name="email" placeholder="ex. johnathan@admin.com" class="form-control form-control-line" id="email" value="<?= isset($email) ? $email : set_value('email') ?>" data-mask="email" > </div>
		    </div>

		    <div class="form-group">
			<label for="phone" class="col-md-12">Phone number</label>
			<div class="col-md-12">
			    <input type="text" name="phone" placeholder="ex. 0812345789" class="form-control form-control-line" id="email" value="<?= isset($phone) ? $phone : set_value('phone') ?>"> </div>
		    </div>
		    <div class="form-group">
			<label for="password" class="col-md-12">Password</label>
			<div class="col-md-12">
			    <input type="password" name="pswd" placeholder="Password" class="form-control form-control-line" id="password" autocomplete="false"> </div>
		    </div>
		    <div class="form-group">
			<label for="password" class="col-md-12">Confirm Password</label>
			<div class="col-md-12">
			    <input type="password" name="pswd2" placeholder="Password" class="form-control form-control-line" id="password" autocomplete="false"> </div>
		    </div>	    

		    <div class="form-group">
			<input class="btn btn-primary btn-block btn-lg btn-login" type="submit" value="<?= is_numeric($this->uri->segment(3)) ? 'Update Profile' : 'Register Now' ?>" id="btnSubmit"/>
		    </div>

		</form>
		<div class="form-group">
		    <div class="col-sm-6">
			<a href="<?= site_url('recovery') ?>" class="btn btn-default btn-block">forgot password?</a>
		    </div>
		    <div class="col-sm-6">
			<a href="<?= site_url('login') ?>" class="btn btn-default btn-block">Log in</a>
		    </div>
		</div>
		<div class="clearfix"></div>

		<div class="separator">
		    <div class="text-center">
			<h3><i class="fa fa-paw"></i> <?= SITENAME ?></h3>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>