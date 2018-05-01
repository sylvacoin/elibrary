<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
	<div class="white-box">
	    <?php $page_id = $this->uri->segment(1); ?>
	    <h3 class="box-title"><?= $page_id == 'favorites' ? 'Favorite books' : 'Shared books' ?></h3>

	    <div id="ct-visits" style="height: 405px;">
		<table cellpadding="0" cellspacing="0" width="100%" class="table table-condensed" id='fav'>
		    <thead>
			<tr>
			    <td style="width: 20px;"></td>
			    <td>Document title</td>
			    <td><?php if ($page_id !== 'favorites' ): echo 'Shared by'; endif; ?></td>
			    <td>category</td>
			    <td>Document type</td>
			</tr>
		    </thead>
		    <tbody>

			<?php if (count($documents) > 0): foreach ( $documents as $doc ): ?>
				<tr>
				    <td>
					<button class="btn btn-danger btn-xs remove" data-id='<?= $doc->doc_id ?>'>
					    <?php if ($page_id == 'favorites' ): ?>
					    <span class="fa fa-heart-o"></span>
					    <?php else : ?>
					    <span class="fa fa-remove"></span>
					    <?php endif; ?>
					</button>
				    </td>
				    <td style="border-left: 0;">
					<a href="<?= base_url() ?>documents/read/<?= $doc->doc_id ?>"><?= $doc->title; ?></a>
				    </td>
				    <td ><?php if ($page_id !== 'favorites' ): echo $doc->firstname.' '.$doc->lastname; endif; ?></td>
				    <td onclick=""><?= $doc->doc_category; ?></td>
				    <td ><?= str_replace('.', '', $doc->doc_type); ?></td>
				</tr>
			    <?php endforeach;
			else:
			    ?>
    		    <td colspan="6"> No document is available at the moment</td>
<?php endif; ?>
		    </tbody>
		</table>

	    </div>
	</div>
    </div>
</div>