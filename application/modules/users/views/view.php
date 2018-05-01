<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
	<div class="white-box">
	    <h3 class="box-title">Users lists</h3>
	    <ul class="list-inline text-right">
		<li>
		    <h5><i class="fa fa-circle m-r-5 text-info"></i>Mac</h5> </li>
		<li>
		    <h5><i class="fa fa-circle m-r-5 text-inverse"></i>Windows</h5> </li>
	    </ul>
	    <div id="ct-visits" style="min-height: 405px;">
		<table cellpadding="0" cellspacing="0" width="100%" class="table table-condensed">
		    <thead>
			<tr>
			    <td style="width: 20px;"></td>
			    <td>Name</td>
			    <td>Email</td>
			    <td>Role</td>
			    <td>username</td>
			</tr>
		    </thead>
		    <tbody>

			<?php if (count($users) > 0): foreach ( $users as $user ): ?>
				<tr>
				    <td>
					<a href="javascript:void(0);" onClick="if (confirm('Are you sure you want to perform this action?')) {
	                                    location.href = '<?= site_url('users/delete/' . $user->user_id) ?>';
	                                }" class="btn btn-danger btn-xs">
					    <span class="fa fa-trash"></span></a>
				    </td>
				    <td style="border-left: 0;">
					<a href="<?= base_url() ?>users/view/<?= $user->user_id ?>"><?= $user->firstname; ?> <?= $user->lastname; ?></a>
				    </td>
				    <td><?= $user->email; ?></td>
				    <td><?= $user->is_admin == 0 ? 'subscriber' : 'admin'; ?></td>
				    <td ><?= $user->username; ?></td>
				</tr>
			    <?php endforeach;
			else:
			    ?>
    		    <td colspan="6"> No user is available at the moment</td>
<?php endif; ?>
		    </tbody>
		</table>

	    </div>
	</div>
    </div>
</div>
