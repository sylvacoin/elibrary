<form method='post' action='<?= site_url('share') ?>' id="share">
<?= form_hidden('document', $this->uri->segment(3)) ?>
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
			<input type="checkbox" name="contacts[<?= $user->user_id ?>] " value='1'/>
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
        <td colspan="6"> No user is available at the moment</td>
<?php endif; ?>
</tbody>
</table>
    
    <div class="form-group-lg">
	<input type='submit' name="share" value="share" class="btn btn-primary"/>
    </div>
</form>