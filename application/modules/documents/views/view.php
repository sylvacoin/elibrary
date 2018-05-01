<table cellpadding="0" cellspacing="0" width="100%" class="table table-condensed">
    <thead>
	<tr>
	    <td style="width: 20px;"></td>
	    <td>Document title</td>
	    <td>Access Status</td>
	    <td>category</td>
	    <td>Document type</td>
	</tr>
    </thead>
    <tbody>

	<?php if (count($documents) > 0): foreach ( $documents as $doc ): ?>
		<tr>
		    <td>
			<a href="javascript:void(0);" onClick="if (confirm('Are you sure you want to perform this action?')) { location.href = '<?= site_url('documents/delete/'.$doc->doc_id) ?>'; }" class="btn btn-danger btn-xs">
			    <span class="fa fa-trash"></span></a>
		    </td>
		    <td style="border-left: 0;">
			<a href="<?= base_url() ?>documents/view/<?= $doc->doc_id ?>"><?= $doc->title; ?></a>
		    </td>
		    <td ></td>
		    <td onclick=""><?= $doc->doc_category; ?></td>
		    <td ><?= str_replace('.', '', $doc->doc_type); ?></td>
		</tr>
	    <?php endforeach;
	else: ?>
        <td colspan="6"> No document is available at the moment</td>
<?php endif; ?>
</tbody>
</table>
