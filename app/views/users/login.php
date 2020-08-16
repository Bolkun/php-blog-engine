<?php require APPROOT . '/views/inc/1-header.php'; ?>
    <div class="container" id="startpage">
        <div class="row">
            <div class="col-sm-10">
                <h1>Login</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <img width="300" height="250" src="<?php echo PUBLIC_CORE_IMG_DEVURL; ?>/logo4230x3200.png"
                     class="rounded d-block" alt="logo">
                <br>
                <span class="trainer_name">Project: 2019-2020</span><br>
                <span class="trainer_lizenz">Version: <strong><?php echo APPVERSION; ?></strong></span>
            </div>
            <div class="col-sm-7">
                <?php flash('register_success'); ?>
                <h2>Enter Your Account</h2>
                <p>Please fill in your credentials to log in</p>
                <form action="<?php echo URLROOT; ?>/users/login" method="post">
                    <div class="form-group">
                        <label for="email">Email: <sup>*</sup></label>
                        <input type="email" name="email"
                               class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password: <sup>*</sup></label>
                        <input type="password" name="password"
                               class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $data['password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Login" class="btn btn-success btn-block">
                        <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-light btn-block">No account?
                            Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/4-footer.php'; ?>