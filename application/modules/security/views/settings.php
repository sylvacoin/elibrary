<div class="row">
    <div class="col-md-6 col-xs-12">
	<div class="x_panel">
	    <div class="x_title">
		<h2>system settings</h2>
		<ul class="nav navbar-right panel_toolbox">
		    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		    </li>
		    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
			    <li><a href="#">Settings 1</a>
			    </li>
			    <li><a href="#">Settings 2</a>
			    </li>
                        </ul>
		    </li>
		    <li><a class="close-link"><i class="fa fa-close"></i></a>
		    </li>
		</ul>
		<div class="clearfix"></div>
	    </div>
	    <div class="x_content">
		<br />
		    <?php echo form_open(site_url('settings/update/do_update') , 
  array('class' => 'form-horizontal form-label-left input_mask','target'=>'_top'));?>

		    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">System name</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
			    <input type="text" class="form-control" name="name" value="<?php echo ( isset($name) ? $name : set_value('name')) ?>">
                        </div>
		    </div>
		    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">School name </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
			    <input type="text" class="form-control" name="title" value="<?php echo ( isset($title) ? $title : set_value('title')) ?>">
                        </div>
		    </div>
		    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
			    <input type="text" class="form-control" name="address" value="<?php echo ( isset($address) ? $address : set_value('address')) ?>">
                        </div>
		    </div>
		    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
			    <input type="text" class="form-control" name="phone" value="<?php echo ( isset($phone) ? $phone : set_value('phone')) ?>">
                        </div>
		    </div>
		    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
			    <input type="text" class="form-control" name="system_email" value="<?php echo ( isset($system_email) ? $system_email : set_value('system_email')) ?>">
                        </div>
		    </div>
		    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Current Session</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
			    <input type="text" class="form-control" name="session" value="<?php echo ( isset($session) ? $session : set_value('session')) ?>">
                        </div>
		    </div>
		    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Current term</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
			    <input type="text" class="form-control" name="term" value="<?php echo ( isset($term) ? $term : set_value('term')) ?>">
                        </div>
		    </div>
		    <div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Login type</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
			    <div class="radio">
				<label>
				    <input type="radio" name="login_type" value="EMAIL" <?php if (isset($login_type) && $login_type == 'EMAIL') {
    echo 'checked';
} ?>> student log in with email and password
				</label>
			    </div>
			    <div class="radio">
				<label>
				    <input type="radio" name="login_type" value="ID" <?php if (isset($login_type) && $login_type == 'ID') {
    echo 'checked';
} ?>> student logs in with student ID and password
				</label>
			    </div>
			    <div class="radio">
				<label>
				    <input type="radio" name="login_type" value="DEFAULT" <?php if (isset($login_type) && $login_type == 'DEFAULT') {
    echo 'checked';
} ?>> DEFAULT
				</label>
			    </div>
			</div>
		    </div>
		    <div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Allow pin login?</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
			    <div class="radio">
				<label>
				    <input type="radio" name="pin" value="TRUE" <?php if (isset($pin) && $pin == 'TRUE') {
    echo 'checked';
} ?>> Yes
				</label>
			    </div>
			    <div class="radio">
				<label>
				    <input type="radio" name="pin" value="FALSE" <?php if (isset($pin) && $pin == 'FALSE') {
    echo 'checked';
} ?>> No
				</label>
			    </div>
			</div>
		    </div>
		    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Max pin usage</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
			    <input type="number" max="10" min="0" class="form-control" name="use_count" value="<?php echo ( isset($use_count) ? $use_count : set_value('use_count')) ?>">
                        </div>
		    </div>
		    <div class="ln_solid"></div>
		    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
			    <button type="submit" class="btn btn-info">Save</button>
                        </div>
		    </div>

		<?= form_close() ?>
	    </div>
	</div>

    </div>

    <div class="col-md-6 col-xs-12">
	
	<div class="x_panel">
	    <div class="x_title">
		<h2>Upload school logo</h2>
		<ul class="nav navbar-right panel_toolbox">
		    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		    </li>
		    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
			    <li><a href="#">Settings 1</a>
			    </li>
			    <li><a href="#">Settings 2</a>
			    </li>
                        </ul>
		    </li>
		    <li><a class="close-link"><i class="fa fa-close"></i></a>
		    </li>
		</ul>
		<div class="clearfix"></div>
	    </div>
	    <div class="x_content">
		<br />
		<?php echo form_open_multipart(site_url('settings/update/do_upload'), array(
        'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
		<div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                <img src="<?php echo base_url(); ?>assets/uploads/logo_thumb.png" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="userfile" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
		    <div class="col-sm-offset-3 col-sm-9">
			<button type="submit" class="btn btn-info">Upload</button>
		    </div>
                </div>
		<?= form_close() ?>
	    </div>
	</div>
    </div>


    <div class="col-md-6 col-sm-12 col-xs-12">
	<div class="x_panel">
	    <div class="x_title">
		<h2>school wallpaper</h2>
		<ul class="nav navbar-right panel_toolbox">
		    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		    </li>
		    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
			    <li><a href="#">Settings 1</a>
			    </li>
			    <li><a href="#">Settings 2</a>
			    </li>
                        </ul>
		    </li>
		    <li><a class="close-link"><i class="fa fa-close"></i></a>
		    </li>
		</ul>
		<div class="clearfix"></div>
	    </div>
	    <div class="x_content">
		<?php echo form_open_multipart(site_url('settings/update/do_upload_wallpaper'), array(
        'class' => 'form-horizontal form-groups-bordered validate'));?>

		
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 100px;" data-trigger="fileinput">
                                <img src="<?php echo base_url();?>assets/uploads/wallpaper_thumb.jpg" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="wallpaper_file" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">
                      <button type="submit" class="btn btn-info">Upload</button>
                  </div>
                </div>

		<?= form_close(); ?>
	    </div>
	</div>
    </div>
</div>
