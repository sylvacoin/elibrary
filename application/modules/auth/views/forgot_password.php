<div class="login-form">

<div class="login-content">

    <div class="form-login-error">
        <h3>Invalid Email</h3>
        <p>Please enter correct email!</p>
    </div>
    <form method="post" role="form" id="form_forgot_password">

        <div class="form-forgotpassword-success">
            <i class="entypo-check"></i>
            <h3>Reset email has been sent.</h3>
            <p>Please check your email inbox, password reset instruction is sent!</p>
        </div>

        <div class="form-steps">

            <div class="step current" id="step-1">

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-mail"></i>
                        </div>

                        <input type="text" class="form-control" name="email" id="email" placeholder="Email"  autocomplete="off" />
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block btn-login">
                        <i class="entypo-right-open-mini"></i>
                        Reset password
                    </button>
                </div>

            </div>

        </div>

    </form>



    <div class="login-bottom-links">

        <a href="<?php echo base_url(); ?>auth/login" class="link">
            <i class="entypo-lock"></i>
            return to login page
        </a>


    </div>

</div>
    
</div>