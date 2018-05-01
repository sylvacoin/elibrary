<!-- Title --><h1>Contact us</h1>
    <h4>Your first <?= strtolower(SITENAME) ?></h4>
<div class="col-sm-7"
    
    <!-- Sub title -->
    <p><img class="img-responsive" src="assets/img/pic3.jpg" width="100%"><br>
        Architecto numquam perspiciatis commodi laboriosam quod debitis placeat maxime q
        uaerat soluta quia porro dicta sunt nemo voluptates!
        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below 
        for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum
        et Malorum" by Cicero are also reproduced in their exact original form, 
        accompanied by English versions from the 1914 translation by H. Rackham.
    </p>

    
</div> <!-- /.col-md-7 -->

    <div class="col-md-5">
        
     <?= form_open_multipart('auth/submit') ?>
    <div class="form-group">
        <?= form_input('name', ( isset($name)? $name :set_value('name')), 'class="form-control" placeholder="Enter Full Name"') ?>
    </div> <!-- /.form-group -->
    
    <div class="form-group">
        <?= form_input('email', ( isset($email)? $email :set_value('email')), 'class="form-control" placeholder="Enter email Address"') ?>
    </div>   
    
    <div class="form-group">
        <?= form_textarea('address',( isset($address)? $address :set_value('address')), 'class="form-control" placeholder="Message Here"') ?>
    </div>
    
    <div class="form-group">
        <?= form_submit('submit', 'Proceed >>>', 'class="pull-right btn btn-danger btn-lg"') ?>
    </div>
    <?= form_close(); ?>
    </div>