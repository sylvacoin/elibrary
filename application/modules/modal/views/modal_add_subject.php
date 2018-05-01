<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
        <div class="panel-title" >
            <i class="entypo-plus-circled"></i>
            Edit Subject
        </div>
        </div>
        <div class="panel-body">

            <?php echo form_open(base_url().'subjects/add/'.(isset($subject_id)?$subject_id:'') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Subject Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value=" <?php echo isset($name)?$name:set_value('name') ?>" required="required"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">slug name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="slug" value=" <?php echo isset($slug)?$slug:set_value('slug') ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info">Edit Subject</button>
                    </div>
                </div>
            <?php echo form_close() ?>
        </div>
        </div>
    </div>
</div>
