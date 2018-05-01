
<?php
if ($this->session->flashdata('error') != NULL) {
    echo DIV_ERR . $this->session->flashdata('error') . DIV_CLOSE;
}

if ($this->session->flashdata('success') != NULL) {
    echo DIV_SUCCESS . $this->session->flashdata('success') . DIV_CLOSE;
}
?>
<?= validation_errors(DIV_ERR, DIV_CLOSE) ?>
<table cellpadding="0" cellspacing="0" width="100%" class="table table-condensed">
    <thead>
	<tr>
	    <td style="width: 70px;"></td>
	    <td>Name</td>
	    <td>Email</td>
	    <td>Role</td>
	    <td>username</td>
	</tr>
    </thead>
    <tbody>

	<?php if (isset($users) && count($users) > 0): foreach ( $users as $user ): ?>
		<tr>
		    <td>
			<?php if ($this->uri->segment(1) == 'contacts'): ?>
	    		<a href="javascript:void(0);" onClick="if (confirm('Are you sure you want to add this contact?')) {
	                                                        location.href = '<?= site_url('contacts/add/' . $user->user_id) ?>';
	                                                    }" class="btn btn-success btn-xs" title="add <?= $user->firstname; ?> <?= $user->lastname; ?> to contact">
	    		    <span class="fa fa-user-plus"></span></a>
			<?php elseif ($this->uri->segment(1) == 'requests'): ?>
			<?php if ( $this->session->user_id == $user->ucontact_id ): ?>
	    		<a href="javascript:void(0);" onClick="if (confirm('Are you sure you want to accept this contact request?')) {
	                                                        location.href = '<?= site_url('requests/accept/' . $user->user_id) ?>';
	                                                    }" class="btn btn-success btn-xs" title="accept <?= $user->firstname; ?> <?= $user->lastname; ?> as contact">
	    		    <span class="fa fa-plus"></span></a>
			<?php endif; ?>
	    		<a href="javascript:void(0);" onClick="if (confirm('Are you sure you want to reject this contact request?')) {
	                                                        location.href = '<?= site_url('requests/reject/' . $user->user_id) ?>';
	                                                    }" class="btn btn-danger btn-xs" title="reject <?= $user->firstname; ?> <?= $user->lastname; ?> as contact">
	    		    <span class="fa fa-remove"></span></a>
			<?php else: ?>
	    		<a href="javascript:void(0);" class="disabled btn btn-default btn-xs">
	    		    <span class="fa fa-check"></span></a>
			<?php endif; ?>
		    </td>
		    <td style="border-left: 0;">
			<?= $user->firstname; ?> <?= $user->lastname; ?>
		    </td>
		    <td><?= $user->email; ?></td>
		    <td><?= $user->is_admin == 0 ? 'subscriber' : 'admin'; ?></td>
		    <td ><?= $user->username; ?></td>
		</tr>
		<?php
	    endforeach;
	else:
	    ?>
        <td colspan="6"> No request available at the moment</td>
    <?php endif; ?>
</tbody>
</table>

