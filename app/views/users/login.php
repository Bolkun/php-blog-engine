<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container" id="startpage">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <h1>Login</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-3">
                <div class="text-center">
                    <div class="cpm cpm_type1 cpm_type1-a1 tile section__item">
                        <img src="<?php echo URLROOT; ?>/img/icon/logo4230x3200.png" class="cpm__img tile__img img-responsive" alt="logo">
                    </div>
                    <br>
                    <span class="trainer_name">Project: 2019-2020</span><br>
                    <span class="trainer_lizenz">Version: <strong><?php echo APPVERSION; ?></strong></span><br><br>
                </div>
            </div>
            <div class="col-sm-7">
                <?php flash('register_success'); ?>
                <h2>Enter Your Account</h2>
                <p>Please fill in your credentials to log in</p>
                <form action="<?php echo URLROOT; ?>/users/login" method="post">
                    <div class="form-group">
                        <label for="email">Email: <sup>*</sup></label>
                        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password: <sup>*</sup></label>
                        <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <div class="col">
                            <input type="submit" value="Login" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-light btn-block">No account? Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>