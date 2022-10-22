<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form id="sign_in" method="POST">
                <div class="login-form-head">
                    <img src="<?= base_url("assets/images/logo/logo-3.png") ?>" alt="logo" width="150">
                    <p class="mt-3">Hello there, <br> Sign in and start managing your business</p>
                    
                </div>
                <div class="container">
                    <?php $this->load->view('layouts/_alert'); ?>
                </div>
                <div class="login-form-body">

                    <div class="form-gp" id="username">
                        <label for="usernameInput">Username</label>
                        <input type="text" id="usernameInput" name="username" id="usernameInput" value="<?= $input->username ?>" autocomplete="off" autofocus>
                        <i class="ti-user"></i>
                        <div class="text-danger"><?= form_error('username'); ?></div>
                    </div>
                    <div class="form-gp mt-4">
                        <label for="passwordInput">Password</label>
                        <input type="password" id="passwordInput" name="password" value="<?= $input->password ?>">
                        <i class="ti-lock"></i>
                        <div class="text-danger"><?= form_error('password'); ?></div>
                    </div>
                    <div class="row mb-4 rmber-area">
                        <!-- <div class="col-6">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="remember_me">
                                <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                            </div>
                        </div> -->
                        <!-- <div class="col-12 text-right">
                            <a href="#" id="tes">Forgot Password?</a>
                        </div> -->
                    </div>
                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit">Sign In <i class="ti-arrow-right"></i></button>
                        <!-- <div class="login-other row mt-4">
                            <div class="col-6">
                                <a class="fb-login" href="#">Log in with <i class="fa fa-facebook"></i></a>
                            </div>
                            <div class="col-6">
                                <a class="google-login" href="#">Log in with <i class="fa fa-google"></i></a>
                            </div>
                        </div> -->
                    </div>
                    <!-- <div class="form-footer text-center mt-5">
                        <p class="text-muted">Don't have an account? <a href="register.html">Sign up</a></p>
                    </div> -->
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        const usernameInput = document.getElementById('usernameInput');
        const username = document.getElementById('username');


        username.classList.add('focused');
        usernameInput.focus();
    }
</script>