<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
	<div class="white-box">
	    <div id="ct-visits" style="min-height: 405px;">
		<div class="form-group">
		    <button class="btn btn-info" onclick="showAjaxModal('<?= base_url("users/get_contacts/".$this->uri->segment(3) ) ?>')"><i class="fa fa-share"></i> share now</button>
		   
		    <?php
		    //check if document is fav document
		    $isFav = Modules::run('documents/is_favorite',$this->uri->segment(3) );
		    
		    $id = $isFav ? 'removeFromFav' : 'addToFav';
		    $class = $isFav ? 'btn-danger' : 'btn-primary';
		    ?>
		    
		    <button class="btn btn-primary <?= $class ?>" id='<?= $id ?>' data-id='<?= $this->uri->segment(3) ?>'><i class="fa fa-heart"></i></button>
		</div>
		<div class="form-group">
	<div class="col-sm-12">
	    <?php if ($result->doc_type == '.pdf'): ?>
    	    <iframe src="<?php echo base_url('parsers/render_pdf/' . $result->enc_name) ?>" style="border:none" width="100%" height="600px"></iframe>
	    <?php elseif ($result->doc_type == '.txt'): ?>

<?php else: ?>
    	    <div class="nNote nWarning" onclick="location.href = '<?= base_url() ?><?= $result->url ?>';">
    		
    		    <span style="font-weight: normal;">Warning: your browser does not support this document click the link below to download document</span>
    		    <br/>
    		<div class="widgetButtons" >
    		    <a href="<?= base_url() ?><?= $result->url ?>" style="text-align: center; display:block; margin:0 auto;">
    			<button type="button" class="buttonM bRed">
    			    Download document</button>
    		    </a>
    		</div>
    		
    	    </div>
<?php endif; ?>
	</div>
	<div class="clear"></div>
    </div>
	    </div>
	</div>
    </div>
</div>

