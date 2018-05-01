<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
        <div class="panel-title" >
            <i class="entypo-plus-circled"></i>
            Edit Class
        </div>
        </div>
        <div class="panel-body">

            <?php echo form_open(base_url() . 'classes/section/'.$class_id.'/edit/true' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Section Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value=" <?php echo isset($name)?$name:set_value('name') ?>" required="required"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Section Nick Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="nick" value=" <?php echo isset($nick)?$nick:set_value('nick') ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Form Teacher</label>
                    <div class="col-sm-5">
                        <select name="teacher_id" class="form-control">
                            <option value="select">Select</option>
                            <?php 
                            $teachers = $this->db->get('administrators')->result();
                            foreach($teachers as $row2):
                            ?>
                                <option value="<?php echo $row2->user_id; ?>" <?php if( $teacher_id == $row2->user_id )echo 'selected';?>>
                                    <?php echo $row2->first;?> <?php echo $row2->last;?>
                                </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Class</label>
                    <div class="col-sm-5">
                        <select name="parent_id" class="form-control" >
                            <option value="select">Select</option>
                            <?php 
                            $this->db->where('parent_id', 0);
                            $class = $this->db->get('classes')->result();
                            foreach($class as $row2):
                            ?>
                                <option value="<?php echo $row2->class_id; ?>" <?php if( $parent_id == $row2->class_id )echo 'selected';?>>
                                    <?php echo $row2->class;?>
                                </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info">Edit class</button>
                    </div>
                </div>
            <?php echo form_close() ?>
        </div>
        </div>
    </div>
</div>
