<div class="panel panel-warning">
    <div class="panel-heading">
        <h4><i class="fa fa-fw fa-2x fa-plus-circle"></i> Secure Document</h4>
    </div>
    <div class="panel-body">
<?php
    if ($this->session->flashdata('error') != '') {
        echo '<div class="alert alert-error alert-dismissable"><button class="close" data-dismiss="alert">&times;</button>'.$this->session->flashdata('error').'</div>';
    }

    if ($this->session->flashdata('success') != '') {
        echo '<div class="alert alert-success alert-dismissable"><button class="close" data-dismiss="alert">&times;</button>'.$this->session->flashdata('success').'</div>';
    }
    ?>
<?= validation_errors('<div class="alert alert-danger alert-dismissable"><button class="close" data-dismiss="alert">&times;</button>', '</div>') ?>
<?= form_open_multipart('', ['class'=>'form-horizontal']); ?>
    <div class="col-sm-12">
        
        <div class="form-group">
                <label class="col-sm-2 control-label">Document Title: </label>
                <div class="col-sm-10">
                    <input type="text" name="title" id="docTitle" class="form-control" 
                    value="<?php echo isset($_SESSION['doc_data']['title'])?$_SESSION['doc_data']['title']:'' ?>" required="required">
                </div>
        </div>
        
        <div class="col-sm-12">
            <div class="form-group">
                <label class="col-sm-5 control-label"></label>
                <div class="col-sm-6">
                    <input type="submit" class="btn btn-success" value="Save Document" name="btnsubmit"/>
                </div>
            </div>
        </div>
    </div>
<?= form_close(); ?>
</div>
</div> 