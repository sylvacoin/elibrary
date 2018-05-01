<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
	<div class="white-box">
	    <div id="ct-visits">
		<h3 class="text-center">Welcome <?= $this->session->name ?></h3>
	    </div>

	</div>
    </div>
</div>
<?php $notice = Modules::run('security/notifications') ?>
<div class="row">
    <div class="col-lg-3 col-sm-6 col-xs-12">
	<div class="white-box analytics-info">
	    <h3 class="box-title">Contact request</h3>
	    <ul class="list-inline two-part">
		<li>
		    <a href="<?= site_url('requests') ?>" class="btn btn-success">view</a>
		</li>
		<li class="text-right">
		    <i class="fa fa-user-plus text-success"></i> 
		    <span class="counter text-success"><?= $notice->contact_request ?></span></li>
	    </ul>
	</div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
	<div class="white-box analytics-info">
	    <h3 class="box-title">Recommended books</h3>
	    <ul class="list-inline two-part">
		<li>
		    <a href="<?= site_url('shared-documents') ?>" class="btn btn-primary">view</a>
		</li>
		<li class="text-right">
		    <i class="fa fa-book text-purple"></i> 
		    <span class="counter text-purple"><?= $notice->recommended_books ?></span></li>
	    </ul>
	</div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
	<div class="white-box analytics-info">
	    <h3 class="box-title">Shared books</h3>
	    <ul class="list-inline two-part">
		<li>
		    <div id="sparklinedash"></div>
		</li>
		<li class="text-right">
		    <i class="fa fa-share-alt text-info"></i> 
		    <span class="counter text-info"><?= $notice->shared_books ?></span></li>
	    </ul>
	</div>
    </div>
    
    <div class="col-lg-3 col-sm-6 col-xs-12">
	<div class="white-box analytics-info">
	    <h3 class="box-title">Favorite books</h3>
	    <ul class="list-inline two-part">
		<li>
		    <a href="<?= site_url('favorites') ?>" class="btn btn-danger">view</a>
		</li>
		<li class="text-right">
		    <i class="fa fa-heart text-danger"></i> 
		    <span class="counter text-danger"><?= $notice->fav_books ?></span></li>
	    </ul>
	</div>
    </div>
</div>
