<div class="widget grid12">
    <div class="whead"><h6><span class="icon-list_nested"></span>Document List</h6>
	<div class="titleOpt">
	    <a href="#" data-toggle="dropdown"><span class="icos-arrowdown"></span><span class="clear"></span></a>
	    <ul class="dropdown-menu pull-right">
		<li><a href="/papernic/web/en/document/sort/document.date_added/desc"><span class="icos-listimg"></span>Reset Sort Order</a></li>
	    </ul>
	</div>
	<div class="clear"></div>
    </div>

    <table cellpadding="0" cellspacing="0" width="100%" class="tDefault">
	<thead>
	    <tr>
		<td style="width: 20px;"></td>
		<td class="curHand" style="border-left: 0;" onClick="location.href = '/papernic/web/en/document/sort/document.document_subject/asc';">
		    <a href="/papernic/web/en/document/sort/document.document_subject/asc" class="pastelRed">Document title</a>
		</td>
		<td class="curHand" onClick="location.href = '/papernic/web/en/document/sort/type.document_type/asc';">
		    <a href="/papernic/web/en/document/sort/type.document_type/asc" class="pastelRed">Access Status</a>
		</td>
		<td class="curHand" onClick="location.href = '/papernic/web/en/document/sort/category.document_category/asc';">
		    <a href="/papernic/web/en/document/sort/category.document_category/asc" class="pastelRed">Size/category</a>
		</td>
		<td class="curHand" onClick="location.href = '/papernic/web/en/document/sort/contact.contact_name/asc';">
		    <a href="/papernic/web/en/document/sort/contact.contact_name/asc" class="pastelRed">Document type</a>
		</td>
	    </tr>
	</thead>
	<tbody>

	    <?php if ( count($documents) > 0 ): foreach ($documents as $doc): ?>
	    <tr>
		<td>
		    <div class="btn-group">
			<a href="#" class="tablectrl_small bLightBlue" data-toggle="dropdown"><span class="icon-curved_arrow" style="margin-right: 1px; line-height: 12px;"></span></a>
			<ul class="dropdown-menu pull-right">
			    <li>
				<a href="javascript:void(0);" class="a-send-email" data-document-id="5"><span class="icos-email"></span>Send via E-mail
				</a>
			    </li>
			    <li>
				<a href="javascript:void(0);" onClick="if (confirm('Are you sure you want to perform this action?')) {
                                                            location.href = '/papernic/web/en/document/delete/5';
                                                        }"><span class="icos-trash"></span>Delete
				</a>
			    </li>
			</ul>
		    </div>
		</td>
		<td style="border-left: 0;" class="curHand">
		    <a href="<?= base_url() ?>document/view/<?= $doc->doc_id ?>" 
		       onClick="authDocument(<?= $doc->is_pswd; ?>, <?= $doc->doc_id ?>); return false;"><?= $doc->title; ?></a>
		</td>
		<td class="curHand" ><?= $doc->access_level; ?></td>
		<td class="curHand" onclick=""><?= $doc->file_size; ?>KB</td>
		<td class="curHand" >
			<?= str_replace('.','',$doc->doc_type); ?></td>
	    </tr>
	    <?php endforeach; else: ?>
	    <td colspan="6" class="curHand"> No document is available at the moment</td>
	    <?php endif; ?>
	</tbody>
    </table>

</div>

<script type="text/javascript">
    function authDocument( pswd_status, doc_id )
    {
	
	if ( pswd_status === 1 )
	{
	   var pswd = prompt( 'This document has been locked. Please enter password to open document');
	    $.ajax({
		url: '<?= base_url() ?>document/ajax_authDocument',
		data: {doc:doc_id,doc_pswd:pswd},
		type: 'POST',
		success: function(data){
		    data = JSON.parse(data);
		    if ( data.status == 'true' )
		    {
			location.href = '<?= base_url() ?>document/view/'+doc_id;
		    }else{
			alert( 'Invalid password. You dont have access to this document' );
		    }
		}
	    });
	}else{
	    location.href = '<?= base_url() ?>document/view/'+doc_id;
	}
	return false;
    }
</script>