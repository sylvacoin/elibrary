<div class="row">
    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
	<div class="white-box">
	    <h3 class="box-title">Document Properties</h3>
	    <div id="ct-visits" style="min-height: 405px;">
		<div class="form-group">
		    <div class="col-sm-12">
			<label><b style="width:7em; display: inline-block;">Name:</b> 
			    <span style="margin-left: 10px;"><?php echo isset($result->title) ? $result->title : ''; ?></span></label>
		    </div>
		    <div class="clear"></div>
		</div>

		<div class="form-group">
		    <div class="col-sm-12">
			<label><b style="width:7em; display: inline-block;">Type:</b> 
			    <span style="margin-left: 10px;"><?php echo isset($result->doc_type) ? str_replace('.', '', $result->doc_type) : ''; ?></span></label>
		    </div>
		    <div class="clear"></div>
		</div>

		<div class="form-group">
		    <div class="col-sm-12">
			<label><b style="width:7em; display: inline-block;">Size:</b> 
			    <span style="margin-left: 10px;"><?php echo isset($result->file_size) ? $result->file_size : 0; ?>KB</span></label>
		    </div>
		    <div class="clear"></div>
		</div>

		<div class="form-group">
		    <div class="col-sm-12">
			<label><b style="width:7em; display: inline-block;">Accessibility:</b> 
			    <span style="margin-left: 10px;"><?php echo isset($result->access_level) ? $result->access_level : ''; ?></span></label>
		    </div>
		    <div class="clear"></div>
		</div>
		<?php if ($result->access_level == 'specific') : ?>
    		<div class="form-group">
    		    <div class="col-sm-12">
    			<label><b style="width:7em; display: inline-block;">Allowed users:</b> 
    			    <span style="margin-left: 10px;">
				    <?php $users = unserialize($result->access_ids);
				    if (isset($result->access_ids) && count($users) > 0): foreach ( $users as $user ):
					    ?>
	    				<p><?= $user ?></p>
	<?php endforeach;
    endif; ?>
    			    </span></label>
    		    </div>
    		    <div class="clear"></div>
    		</div>
<?php endif ?>
		<div class="form-group">
		    <div class="col-sm-12">
			<label><b style="width:7em; display: inline-block;">Security Key:</b> 
			    <span style="margin-left: 10px;"><?php echo $result->is_pswd == true ? 'YES' : 'NO'; ?></span></label>
		    </div>
		    <div class="clear"></div>
		</div>
		<div class="widgetButtons">

		    <a href="<?= base_url() ?>documents/" class="btn btn-default" id="form_btn_cancel">back</a>
		    <a href="<?= base_url() ?>documents/modify/<?= $result->doc_id ?>" class="btn btn-info" id="form_btn_cancel">modify</a>
		    
		    <button type="button" id="form_btn_cancel" name="form[btn_cancel]" class="btn btn-danger" onclick="if (confirm('Are you sure you want to delete this document?')){ location.href = '<?= base_url() ?>documents/delete/<?= $result->doc_id ?>'; }">Delete</button>

		</div>

	    </div>
	</div>
    </div>
    <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12">
	<div class="white-box">
	    <div id="ct-visits" style="min-height: 405px;">
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

