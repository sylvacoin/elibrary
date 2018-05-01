<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
	<div class="sidebar-head">
	    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
	</div>
	<ul class="nav" id="side-menu">
	    <?php if ( !is_numeric( $this->session->user_id ) ) : ?>
	    <li style="padding: 70px 0 0;">
		<a href="<?= site_url('login') ?>" class="waves-effect"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i>Login</a>
	    </li>
	    <li>
		<a href="<?= site_url('signup') ?>" class="waves-effect"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i>Register</a>
	    </li>
	    <?php else: ?>
	    
		<?php if ( $this->session->role == 1 ): ?>
		<li style="padding: 70px 0 0;">
		    <a href="<?= site_url('dashboard') ?>" class="waves-effect"><i class="fa fa-home fa-fw" aria-hidden="true"></i>Dashboard</a>
		</li>
		<li>
		    <a href="<?= site_url('search') ?>" class="waves-effect"><i class="fa fa-search fa-fw" aria-hidden="true"></i>Search Books</a>
		</li>
		<li>
		    <a href="<?= site_url('documents') ?>" class="waves-effect"><i class="fa fa-cloud-upload fa-fw" aria-hidden="true"></i>Upload Books</a>
		</li>
		
		<li>
		    <a href="<?= site_url('users/view') ?>" class="waves-effect"><i class="fa fa-users fa-fw" aria-hidden="true"></i>Users</a>
		</li>
		<?php else: ?>
		<li style="padding: 70px 0 0;">
		    <a href="<?= site_url('dashboard') ?>" class="waves-effect"><i class="fa fa-home fa-fw" aria-hidden="true"></i>Dashboard</a>
		</li>
		<li>
		    <a href="<?= site_url('search') ?>" class="waves-effect"><i class="fa fa-search fa-fw" aria-hidden="true"></i>Search Books</a>
		</li>
		<li>
		    <a href="<?= site_url('favorites') ?>" class="waves-effect"><i class="fa fa-heart-o fa-fw" aria-hidden="true"></i>Favorite Books</a>
		</li>
		<li>
		    <a href="<?= site_url('shared-documents') ?>" class="waves-effect"><i class="fa fa-exchange fa-fw" aria-hidden="true"></i>Shared Books</a>
		</li>
		<li>
		    <a href="<?= site_url('my-contacts') ?>" class="waves-effect"><i class="fa fa-users fa-fw" aria-hidden="true"></i> My contacts</a>
		</li>
		<li>
		    <a href="<?= site_url('requests') ?>" class="waves-effect"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> Contact requests</a>
		</li>
		<li>
		    <a href="<?= site_url('contacts') ?>" class="waves-effect"><i class="fa fa-search-plus fa-fw" aria-hidden="true"></i> Find contacts</a>
		</li>
		<?php endif; ?>
		<li>
		    <a href="<?= site_url('profile') ?>" class="waves-effect"><i class="fa fa-lock fa-fw" aria-hidden="true"></i> Account</a>
		</li>
	    <?php endif; ?>
	</ul>
    </div>

</div>
<!-- ============================================================== -->
<!-- End Left Sidebar -->