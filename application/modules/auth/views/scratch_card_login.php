<div class="login-form">
		
        <div class="login-content">

            <div class="form-login-error">
                    <h3>Invalid login</h3>
                    <p>Please enter correct email and password!</p>
            </div>

            <form method="post" role="form" id="form_login" class="is-scratchcard-form">
                    <div class="form-group">

                            <div class="input-group">
                                    <div class="input-group-addon">
                                            <i class="entypo-lock"></i>
                                    </div>

                                    <input type="text" class="form-control" name="pin" id="pin" placeholder="Scratch card pin" autocomplete="off" />
                            </div>

                    </div>

                    <div class="form-group">

                        <div class="input-group">
                                <div class="input-group-addon">
                                        <i class="entypo-user"></i>
                                </div>

                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" data-mask="email" />
                        </div>

                    </div>

                    <div class="form-group">

                            <div class="input-group">
                                    <div class="input-group-addon">
                                            <i class="entypo-key"></i>
                                    </div>

                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
                            </div>

                    </div>

                    <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-login">
                                    <i class="entypo-login"></i>
                                    Login
                            </button>
                    </div>

            </form>


            <div class="login-bottom-links">
                    <a href="<?php echo base_url();?>auth/login" class="link">
                        <i class="entypo-help-circled"></i>
                            forgot password ?
                    </a>
            </div>

        </div>

</div>