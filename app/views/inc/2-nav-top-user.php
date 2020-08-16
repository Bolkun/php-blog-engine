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
                <h4 class="h4_nav_top_user"><?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_surname']; ?></h4>
                <div class="form-group">
                    <a id="logout" href="<?php echo URLROOT; ?>/users/logout" class="btn btn-light btn-block">Logout</a>
                </div>
            <?php } else { ?>
                <div id="login_form">
                    <h4 class="h4_nav_top_user">Authentification</h4>
                    <div id="accordion">
                        <?php flash('register_success'); ?>
                        <form action="<?php echo URLROOT; ?>/dashboards" method="post">
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
                                <input id="submit_login" name="submitLogin" type="submit" value="Login"
                                       class="btn btn-success btn-block">
                            </div>
                        </form>
                        <div class="form-group">
                            <button onclick="loginRegister('login_form', 'registration_form')" id="register_link"
                                    class="btn btn-light btn-block" data-toggle="collapse" data-target="#registration_form">No account? Register
                            </button>
                        </div>
                    </div>
                </div>
                <div id="registration_form" style="display: none;">
                    <h4 class="h4_nav_top_user">Registration</h4>
                    <div id="accordion">
                        <form action="<?php echo URLROOT; ?>/dashboards" method="post">
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
                                       value="<?php echo $data['reg_confirm_password']; ?>" placeholder="Confirm password">
                                <span class="invalid-feedback"><?php echo $data['reg_confirm_password_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <input id="submit_register" name="submitRegister" type="submit" value="Register"
                                       class="btn btn-success btn-block">
                            </div>
                        </form>
                        <div class="form-group">
                            <button id="login_link" onclick="loginRegister('registration_form', 'login_form')"
                                    class="btn btn-light btn-block" data-toggle="collapse" data-target="#login_form">Have an account? Login
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
                <form class="form-inline" action="/action_page3.php">
                    <input id="search_input" class="form-control" type="text" placeholder="Search">
                    <button id="submit_search_input" class="btn btn-success" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
                <!----------------------------------------------------------------------------------------------------->
                <?php for ($menu_category_count = 0; $menu_category_count < 3; $menu_category_count++) { ?>
                    <!-- Thema -->
                    <div class="card">
                        <a class="card-link" data-toggle="collapse"
                           href="#collapse_<?php echo $menu_category_count; ?>">
                            <div class="card-header">
                                <span class="badge badge-primary badge-pill">1</span>
                                Sport
                            </div>
                        </a>
                        <!-- Kategorien -->
                        <div id="collapse_<?php echo $menu_category_count; ?>" class="collapse"
                             data-parent="#accordion">
                            <div class="card-body">
                                <!------------------------------------------------------------------------------------->
                                <?php for ($menu_thema_count = 0; $menu_thema_count < 3; $menu_thema_count++) { ?>
                                    <a class="nav-link" href="#1">
                                        <li class="list-group-item ">
                                            Football
                                        </li>
                                    </a>
                                <?php } ?>
                                <!------------------------------------------------------------------------------------->
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!----------------------------------------------------------------------------------------------------->
            </div>
        </div>

    </div>
</nav>