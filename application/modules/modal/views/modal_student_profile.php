<div class="profile-env">
	<header class="row">
            <div class="col-sm-3">
                <a href="#" class="profile-picture">
                    <img src="<?php echo base_url().$photo; ?>" 
                class="img-responsive img-circle" />
                </a>
            </div>
            <div class="col-sm-9">
                <ul class="profile-info-sections">
                    <li style="padding:0px; margin:0px;">
                        <div class="profile-name">
                        <h3><?php echo $fname;?> <?php echo $lname;?></h3>
                        </div>
                    </li>
                </ul>
            </div>
	</header>
	<section class="profile-info-tabs">
            <div class="row">
                <div class="">
                <br>
                <table class="table table-bordered">
                    
                    <?php if($user_id != ''):?>  
                    <?php 
                    $class_id   = Modules::run('students/get_student_current_class', $user_id )->class_id; 
                    $class      = Modules::run('classes/get_where', $class_id )->row()->class;
                    $class_parent_id  = Modules::run('classes/get_where', $class_id )->row()->parent_id;
                    $class_parent     = Modules::run('classes/get_where', $class_parent_id )->row()->class;
                    ?>
                    <tr>
                        <td>Class</td>
                        <td><b><?php echo $class_parent; ?></b></td>
                    </tr>
                    <?php endif;?>

                    <?php if ( $class_parent_id != '' && $class_parent_id != 0):// if ( $row['section_id'] != '' && $row['section_id'] != 0):?>
                    <tr>
                        <td>Section</td>
                        <td><b><?php echo $class ?></b></td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($role != ''):?>
                    <tr>
                        <td>Role</td>
                        <td><b><?php echo $role; ?></b></td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($dob != ''):?>
                    <tr>
                        <td>Birthday</td>
                        <td><b><?php echo $dob; ?></b></td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($sex != ''):?>
                    <tr>
                        <td>Gender</td>
                        <td><b><?php echo $sex;?></b></td>
                    </tr>
                    <?php endif;?>
                    <tr>
                        <th colspan="2"><i class="fa fa-phone-square"></i> Contact Information</th>
                    </tr>
                    <?php if($phone != ''):?>
                    <tr>
                        <td>Phone</td>
                        <td><b><?php echo $phone;?></b></td>
                    </tr>
                    <?php endif;?>
                
                    <?php if($email != ''):?>
                    <tr>
                        <td>Email</td>
                        <td><b><?php echo $email; ?></b></td>
                    </tr>
                    <?php endif;?>
                
                    <?php if( $parent != '' ):?>
                    <tr>
                        <td>Parent</td>
                        <td>
                            <b><?php echo $parent ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td>Parent Phone</td>
                        <td><b><?php echo $phone;?></b></td>
                    </tr>
                    <tr>
                        <td>Home Address </td>
                        <td><b><?php echo $address;?></b></td>
                    </tr>
                    <tr>
                        <td>Email Address </td>
                        <td><b><?php echo $email;?></b></td>
                    </tr>
                    <?php endif;?>
                    
                </table>
                </div>
            </div>		
	</section>
</div>