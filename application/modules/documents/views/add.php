<form id="upload-form" class="form-horizontal" style="margin-top: 5px;" enctype="multipart/form-data">
    <div class="form-group">
	<div class="col-sm-6">
	    <ul class="filesDown list-unstyled">
		<li class="currentFile" id="li-upload">
		    <div class="fileProcess">

			<input type="hidden" id="hidden" value="<?php echo isset($docCategory) ? $docCategory : '' ?>">
			<input type="file" id="file" name="file" style="display: none"/>
			<button type="button" id="btnUpload" class="btn btn-info" value="Select File(s) to Upload" style="margin-bottom: 10px; width: 100%;">
			    <span class="fa fa-upload"></span>
			    Select File(s) to Upload
			</button>

			<div id="progress1" style="height: 40px;">
			    <span id="pb" style="background: #FFF; border: 1px solid #eee; box-shadow: none; height: 8px; margin: 0; padding: 0;" class="pbar ui-progressbar ui-widget ui-widget-content ui-corner-all" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
				<div id="progressvalue" class="ui-progressbar-value ui-widget-header ui-corner-left" style="width: 0%;"></div>
			    </span>
			    <span class="elapsed" id="elapsed"></span>
			</div>
		    </div>
		</li>
		<li id="actionParent">
		    <div class="fileProcess">
			<img src="<?php echo base_url() ?>assets/images/statics/4.gif"/> <span> <b id="action">Uploading document</b> </span>
		    </div>
		</li>
	    </ul>
	</div>
	<div class="col-sm-6">

	</div>
    </div>
</form>

<?php
$suffix = '';
if ( isset($id) )
{
    $suffix = '/'.$id;
}
?>
<form name="form" method="post"class="form-horizontal" action="<?= site_url('documents/access' .$suffix) ?>">
    <div class="form-group">
	<div class="col-sm-12">
	    <label class="col-sm-12">Document Title <span class="kirmizi">*</span></label>
	    <div class="col-sm-12">
		<input type="text" name="title" id="docTitle"  class="form-control"
		       value="<?php echo isset($docTitle) ? $docTitle : '' ?>" required="required">
	    </div>
	</div>
    </div>
    <div class="form-group">
	<div class="col-sm-6">
	    <label class="col-sm-12">Document Author</label>
	    <div class="col-sm-12">
		<input type="text" name="docAuthor" id="docAuthor" class="form-control" 
		       value="<?php echo isset($docAuthor) ? $docAuthor : '' ?>" required="required" placeholder="Document Author">
	    </div>
	</div>
	<div class="col-sm-6">
	    <label class="col-sm-12">Document Category &nbsp; - &nbsp;<a id="category_add_label">Add New</a><a id="category_cancel_label" style="display: none;">Cancel</a></label>
	    <div class="col-sm-12">
		<select id="form_category_id" name="docCategory" class="form-control">
		    <option value="">Choose...</option>            
		</select>
		<div id="category_add_div" style="display: none;">
		    <input type="text" id="form_category_add" name="docCategory2" class="form-control" />
		</div>
	    </div>
	</div>
    </div>

    <div class="form-group">

	<div class="col-sm-6">
	    <label class="col-sm-12">Has Edition</label>
	    <div class="col-sm-12">
		<select id="docHasEdition" name="docHasEdition" class="form-control">		    
		    <option value="">Choose...</option>
		    <option value="true" 
			    <?php echo (isset($docHasEdition) && $docHasEdition == 1) ? 'selected' : '' ?>>YES</option>
		    <option value="false" 
			    <?php echo (isset($docHasEdition) && $docHasEdition == 0) ? 'selected' : '' ?>>NO</option>
		</select>
	    </div>
	</div>

	<div class="col-sm-6">
	    <div id="docEditionParent">
		<label class="col-sm-12">Document Edition</label>
		<div class="col-sm-12">
		    <input type="text" name="docEdition" id="docEdition" class="form-control" value="<?php echo isset($docEdition) ? 'selected' : '' ?>">
		</div>
	    </div>
	</div>
    </div>
    <div class="form-group">

	<div class="col-sm-6">
	    <label class="col-sm-12">Accessibility </label>
	    <div class="col-sm-12">
		<select class="form-control" id="docAccess" name="docAccessibility">
		    <option value="">Choose...</option>            
		    <option value="everyone"
			    <?php echo (isset($docAccessibility) && $docAccessibility == 'everyone' ) ? 'selected' : '' ?>>Every One</option>
		    <option value="specific"
			    <?php echo (isset($docAccessibility) && $docAccessibility == 'specific' ) ? 'selected' : '' ?>>Specific</option>
		    <option value="private"
			    <?php echo (isset($docAccessibility) && $docAccessibility == 'private' ) ? 'selected' : '' ?>>Private</option>
		</select>
	    </div>
	</div>

	<div class="col-sm-6" id="docContactsParent">
	    <label class="col-sm-12">Share with Contact:</label>
	    <div class="col-sm-12">
		<?php
		$contact_list = modules::run('contact/get_user_contact_list');
		echo form_dropdown('docContacts[]', $contact_list, isset($docContact) ? $docContact : '', 'multiple class="form-control"');
		?>
	    </div>
	</div>
    </div>
    <div class="form-group">
	<div class="col-sm-6">
	    <label class="col-sm-12">Password Document</label>
	    <div class="col-sm-12">
		<select id="docHasPswd" name="docHasPswd" class="form-control">		    
		    <option value="">Choose...</option>
		    <option value="1" <?= isset($docHasPswd) && $docHasPswd == 1 ? 'selected' : '' ?>>YES</option>
		    <option value="0" <?= isset($docHasPswd) && $docHasPswd == 0 ? 'selected' : '' ?>>NO</option>
		</select>
	    </div>
	</div>
    </div>

    <div class="form-group"  id="docPswdParent">
	<div class="col-sm-6">
	    <label class="col-sm-12">Password</label>
	    <div class="col-sm-12">
		<input type="password" name="docPswd" id="docPswd" value="" placeholder="enter document password" class="form-control">
	    </div>
	</div>

	<div class="col-sm-6">
	    <label class="col-sm-12">Confirm Password</label>
	    <div class="col-sm-12">
		<input type="password" name="docPswd1" id="docPswd1" value="" placeholder="confirm document password" class="form-control">
	    </div>
	</div>
    </div>
    <div class="form-group">
	<div class="col-sm-8 col-sm-offset-4">
	    <button type="submit" id="form_btn_save_document" name="form[btn_save_document]" class="btn btn-danger">Save Document</button>

	    <a href="document/cancel" id="form_btn_cancel" name="form[btn_cancel]" class="btn btn-default">Cancel</a>
	</div>
    </div>
</form>

