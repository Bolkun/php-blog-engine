<nav id="nav_top_user" class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
    <div class="container">

        <!-- element 1 -->
        <a id="home_menu" href="<?php echo URLROOT; ?>" class="btn btn-default float-left">
            <i class="fa fa-home" aria-hidden="true"></i>
        </a>

        <!-- element 2 -->
        <button id="toggle_bell_menu" class="btn btn-default float-left"
                onclick="changeNavTopUserColor('toggle_bell_menu', 'collapse_bell_menu')" type="button"
                data-toggle="collapse" data-target="#collapse_bell_menu">
            <i id="subscribe" class="fa fa-bell"></i>
        </button>
        <!-- Toggler Bell Menu -->
        <div id="collapse_bell_menu" class="dropdown-menu bg-dark">
            <div id="accordion">
                <h4 class="h4_nav_top_user">Notifications</h4>
                <form class="form-inline" action="/action_page1.php">

                </form>
            </div>
        </div>

        <!-- element 3 -->
        <button id="toggle_login_menu" class="btn btn-default float-left"
                onclick="changeNavTopUserColor('toggle_login_menu', 'collapse_login_menu')" type="button"
                data-toggle="collapse" data-target="#collapse_login_menu">
            <i id="login" class="fa fa-user-circle"></i>
        </button>
        <!-- Toggler Login Menu -->
        <div id="collapse_login_menu" class="dropdown-menu bg-dark">
            <?php if (isLoggedIn() === true) { ?>
                <!-- Setting Form -->
                <div id="setting_form">
                    <h4 class="h4_nav_top_user"><?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_surname']; ?></h4>
                    <!-- Change Email -->
                    <form action="<?php echo URLROOT; ?>/index" method="post">
                        <div class="form-group">
                            <p class="p_nav_top_user">Change email</p>
                            <input id="setting_email" type="email" name="email"
                                   class="form-control <?php echo (!empty($data['set_email_err'])) ? 'is-invalid' : ''; ?>"
                                   value="<?php echo $data['set_email']; ?>" placeholder="Email">
                            <button name="submitUserEmail" id="setting_submit_email" class="btn btn-success"
                                    type="submit">
                                <i class="fa fa-envelope"></i>
                            </button>
                            <span class="invalid-feedback"><?php echo $data['set_email_err']; ?></span>
                        </div>
                    </form>
                    <hr class="hr_menu">
                    <!-- Change Password -->
                    <form action="<?php echo URLROOT; ?>/index" method="post">
                        <p class="p_nav_top_user">Change password</p>
                        <div class="form-group">
                            <input id="setting_old_password" type="password" name="old_password"
                                   class="form-control <?php echo (!empty($data['set_old_password_err'])) ? 'is-invalid' : ''; ?>"
                                   value="<?php echo $data['set_old_password']; ?>" placeholder="Old Password">
                            <span class="invalid-feedback"><?php echo $data['set_old_password_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <input id="setting_new_password" type="password" name="new_password"
                                   class="form-control <?php echo (!empty($data['set_new_password_err'])) ? 'is-invalid' : ''; ?>"
                                   value="<?php echo $data['set_new_password']; ?>" placeholder="New Password">
                            <span class="invalid-feedback"><?php echo $data['set_new_password_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <input id="setting_new_password_confirm" type="password" name="new_password_confirm"
                                   class="form-control <?php echo (!empty($data['set_new_password_confirm_err'])) ? 'is-invalid' : ''; ?>"
                                   value="<?php echo $data['set_new_password_confirm']; ?>"
                                   placeholder="Confirm New Password">
                            <button name="submitUserPassword" id="setting_submit_password" class="btn btn-success"
                                    type="submit">
                                <i class="fa fa-lock"></i>
                            </button>
                            <span class="invalid-feedback"><?php echo $data['set_new_password_confirm_err']; ?></span>
                        </div>
                    </form>
                    <hr class="hr_menu">
                    <!-- logout -->
                    <div class="form-group">
                        <a id="logout" href="<?php echo URLROOT; ?>/users/logout"
                           class="btn btn-light btn-block">Logout</a>
                    </div>
                </div>
            <?php } else { ?>
                <!-- Authentication Form -->
                <div id="login_form">
                    <h4 class="h4_nav_top_user">Authentication</h4>
                    <div id="accordion">
                        <?php flash('register_success'); ?>
                        <form action="<?php echo URLROOT; ?>/index" method="post">
                            <div class="form-group">
                                <input id="login_email" type="email" name="email"
                                       class="form-control <?php echo (!empty($data['log_email_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['log_email']; ?>" placeholder="Email">
                                <span class="invalid-feedback"><?php echo $data['log_email_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <input id="login_password" type="password" name="password"
                                       class="form-control <?php echo (!empty($data['log_password_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['log_password']; ?>" placeholder="Password">
                                <span class="invalid-feedback"><?php echo $data['log_password_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <input id="login_verification_code" type="text" name="verification_code"
                                       class="form-control <?php echo (!empty($data['log_verification_code_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['log_verification_code']; ?>"
                                       placeholder="Verification Code">
                                <span class="invalid-feedback"><?php echo $data['log_verification_code_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <input id="submit_login" name="submitLogin" type="submit" value="Login"
                                       class="btn btn-success btn-block">
                            </div>
                        </form>
                        <div class="form-group">
                            <button onclick="loginRegister('login_form', 'registration_form')" id="register_link"
                                    class="btn btn-light btn-block" data-toggle="collapse"
                                    data-target="#registration_form">No account? Register
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Registration Form -->
                <div id="registration_form" style="display: none;">
                    <h4 class="h4_nav_top_user">Registration</h4>
                    <div id="accordion">
                        <form name="registration_form" action="<?php echo URLROOT; ?>/index" method="post">
                            <div class="form-group">
                                <input id="register_firstname" type="text" name="firstname"
                                       class="form-control <?php echo (!empty($data['reg_firstname_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['reg_firstname']; ?>" placeholder="Firstname">
                                <span class="invalid-feedback"><?php echo $data['reg_firstname_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <input id="register_surname" type="text" name="surname"
                                       class="form-control <?php echo (!empty($data['reg_surname_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['reg_surname']; ?>" placeholder="Surname">
                                <span class="invalid-feedback"><?php echo $data['reg_surname_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <input id="register_email" type="email" name="email"
                                       class="form-control <?php echo (!empty($data['reg_email_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['reg_email']; ?>" placeholder="Email">
                                <span class="invalid-feedback"><?php echo $data['reg_email_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <input id="register_password" type="password" name="password"
                                       class="form-control <?php echo (!empty($data['reg_password_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['reg_password']; ?>" placeholder="Password">
                                <span class="invalid-feedback"><?php echo $data['reg_password_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <input id="register_confirm_password" type="password" name="confirm_password"
                                       class="form-control <?php echo (!empty($data['reg_confirm_password_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['reg_confirm_password']; ?>"
                                       placeholder="Confirm password">
                                <span class="invalid-feedback"><?php echo $data['reg_confirm_password_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <input id="submit_register" name="submitRegister" type="submit" value="Register"
                                       class="btn btn-success btn-block">
                            </div>
                        </form>
                        <div class="form-group">
                            <button id="login_link" onclick="loginRegister('registration_form', 'login_form')"
                                    class="btn btn-light btn-block" data-toggle="collapse" data-target="#login_form">
                                Have an account? Login
                            </button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- element last -->
        <button id="toggle_main_menu" class="btn btn-default float-left"
                onclick="changeNavTopUserColor('toggle_main_menu', 'collapse_main_menu')" type="button"
                data-toggle="collapse" data-target="#collapse_main_menu">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>
        <!-- Toggler Main Menu -->
        <div id="collapse_main_menu" class="dropdown-menu bg-dark">
            <h4 class="h4_nav_top_user">Main</h4>
            <div id="accordion">
                <div id="mm_search_form">
                    <form class="form-inline" action="<?php echo URLROOT; ?>/index" method="post">
                        <input id="search_main_menu" type="text" name="search_main_menu"
                               class="form-control <?php echo (!empty($data['mm_search_err'])) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $data['mm_search']; ?>"
                               placeholder="Search">
                        <button id="submit_search_input" name="submit_search_input" class="btn btn-success" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                        <span class="invalid-feedback"><?php echo $data['mm_search_err']; ?></span>
                    </form>
                </div>
                <div id="mm_add_child_form">
                    <form class="form-inline" action="<?php echo URLROOT; ?>/index" method="post">
                        <input id="mm_add_child" type="text" name="mm_add_child"
                               class="form-control <?php echo (!empty($data['mm_add_child_err'])) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $data['mm_add_child']; ?>"
                               placeholder="Add child">
                        <button id="submit_add_child_input" name="submit_add_child_input" class="btn btn-success" type="submit">
                            <i class='fa fa-plus'></i>
                        </button>
                        <span class="invalid-feedback"><?php echo $data['mm_add_child_err']; ?></span>
                    </form>
                </div>
                <div id="mm_edit_title_form">
                    <form class="form-inline" action="<?php echo URLROOT; ?>/index" method="post">
                        <input id="mm_edit_title" type="text" name="mm_edit_title"
                               class="form-control <?php echo (!empty($data['mm_edit_title_err'])) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $data['mm_edit_title']; ?>"
                               placeholder="Edit title">
                        <button id="submit_edit_input" name="submit_edit_input" class="btn btn-success" type="submit">
                            <i class='fa fa-pencil'></i>
                        </button>
                        <span class="invalid-feedback"><?php echo $data['mm_edit_title_err']; ?></span>
                    </form>
                </div>
                <div id="main_menu_message"><?php flash('main_menu'); ?></div>
                <!----------------------------------------------------------------------------------------------------->
                <?php
                    if(isset($_POST['submit_search_input']) && $_POST['submit_search_input'] !== ''){
                        // change branches that have no root node
                        foreach ($data['mm']['items'] as $key => $value){
                            if($data['mm']['items'][$key]['parent_id'] !== '0' && !in_array($data['mm']['items'][$key]['parent_id'], array_column($data['mm']['items'], 'id'))){
                                // set not found parents as root node
                                $data['mm']['items'][$key]['parent_id'] = '0';
                                // add not found parent ids to root group
                                $data['mm']['parents'][0][] = $data['mm']['items'][$key]['id'];
                                // delete old group with no root
                                foreach ($data['mm']['parents'] as $pk => $pv){
                                    foreach ($pv as $i => $v){
                                        if($pk !== 0 && $data['mm']['parents'][$pk][$i] === $data['mm']['items'][$key]['id']){
                                            unset($data['mm']['parents'][$pk][$i]);
                                        }
                                    }
                                    if(empty($data['mm']['parents'][$pk])){
                                        unset($data['mm']['parents'][$pk]);
                                    }
                                }
                            }
                        }
                    }
                    echo createTreeView(0, $data['mm']);
                ?>
                <!----------------------------------------------------------------------------------------------------->
            </div>
        </div>

    </div>
</nav>