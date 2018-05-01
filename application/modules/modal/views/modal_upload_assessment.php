<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
        <div class="panel-title" >
            <i class="entypo-upload-cloud"></i>
            Upload Assessment score sheet
        </div>
        </div>
        <div class="panel-body form-horizontal form-groups-bordered">
            <?php echo form_open(base_url().'assessments/upload?return='.$url , array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Document</label>
                    <div class="col-sm-5">
                        <input type="file" name="userdoc" >
                    </div>
                </div>
				

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
						<input type="hidden" name="class" value="<?php echo $current_class ?>">
                        <input type="submit" class="btn btn-info" value="upload document" />
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
        </div>
    </div>
</div>
