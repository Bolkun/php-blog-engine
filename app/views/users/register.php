<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container" id="startpage">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <h1>Register</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-3">
                <div class="text-center">
                    <div class="cpm cpm_type1 cpm_type1-a1 tile section__item">
                        <img src="<?php echo URLROOT; ?>/img/icon/logo.jpg" class="cpm__img tile__img img-responsive" alt="logo">
                    </div>
                    <br>
                    <span class="trainer_name">Project 2019-2020</span><br>
                    <span class="trainer_lizenz">Version: <strong><?php echo APPVERSION; ?></strong></span><br><br>
                </div>
            </div>
            <div class="col-sm-7">
                <h2>Create An Account</h2>
                <p>Please fill out this form to register with us</p>
                <form action="<?php echo URLROOT; ?>/users/register" method="post">
                    <div class="form-group">
                        <label for="firstname">Vorname: <sup>*</sup></label>
                        <input type="text" name="firstname" class="form-control form-control-lg <?php echo (!empty($data['firstname_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['firstname']; ?>">
                        <span class="invalid-feedback"><?php echo $data['firstname_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="surname">Nachname: <sup>*</sup></label>
                        <input type="text" name="surname" class="form-control form-control-lg <?php echo (!empty($data['surname_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['surname']; ?>">
                        <span class="invalid-feedback"><?php echo $data['surname_err']; ?></span>
                    </div>
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
                        <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                        <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <div class="col">
                            <input type="submit" value="Register" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account? Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>