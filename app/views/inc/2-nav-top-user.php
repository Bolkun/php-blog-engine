<nav id="nav_top_user" class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
    <div id="nav_top_user_content" class="container">
        <!-- home -->
        <a id="home_menu" href="<?php echo URLROOT; ?>" class="btn btn-default float-left">
            <i class="fa fa-home" aria-hidden="true"></i>
        </a>

        <!-- social media -->
        <button id="toggle_share_menu" class="btn btn-default float-left" onclick="changeNavTopUserColor('toggle_share_menu', 'collapse_share_menu')" type="button" data-toggle="collapse" data-target="#collapse_share_menu">
            <i id="subscribe" class="fa fa-share-alt"></i>
        </button>
        <!-- Toggler Social Media Menu -->
        <div id="collapse_share_menu" class="dropdown-menu bg-dark">
            <h4 class="h4_nav_top_user">
                <?php if (isAdminLoggedIn()) { ?>
                    <i id='edit_social_media_icon' onclick="displaySocialMediaContent()" class='fa fa-file-text' aria-hidden='true'></i>
                <?php } ?>
                Social Media
            </h4>
            <div id="share_menu_load">
                <div id="share_menu_content">
                    <div id="message_sm"><?php flash('social_media'); ?></div>
                    <div id="accordion">
                        <?php if (isAdminLoggedIn() === true) { ?>
                            <div id="edit_social_media_content">
                                <form action="<?php echo URLROOT; ?>/index" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input id="socialMedia_name" type="text" name="socialMedia_name" class="form-control <?php echo (!empty($data['sm_add_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['sm_add_name']; ?>" placeholder="Name">
                                        <span class="invalid-feedback"><?php echo $data['sm_add_name_err']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <input id="socialMedia_link" type="text" name="socialMedia_link" class="form-control <?php echo (!empty($data['sm_add_link_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['sm_add_link']; ?>" placeholder="Link">
                                        <span class="invalid-feedback"><?php echo $data['sm_add_link_err']; ?></span>
                                    </div>
                                    <div style="color: white; padding-left: 10px;">
                                        <!-- Radio choice -->
                                        <label for="sm_server_image">Image</label>
                                        <div class="custom-control custom-radio custom-control-inline text-center" style="left: 1.5rem;">
                                            <input id="sm_server_social_image" onclick="displaySMServerSocialImageDiv()" type="radio" class="custom-control-input" name="sm_radio_social_image" value="server" checked>
                                            <label class="custom-control-label" for="sm_server_social_image">server</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline text-center" style="left: 1.5rem;" data-toggle="tooltip" data-placement="top" title="Recommended size 32x32">
                                            <input id="sm_local_social_image" onclick="displaySMLocalSocialImageDiv()" type="radio" class="custom-control-input" name="sm_radio_social_image" value="local">
                                            <label class="custom-control-label" for="sm_local_social_image">local</label>
                                        </div>
                                    </div>
                                    <!-- server social image -->
                                    <div id="selectedServerSocialImageDiv">
                                        <div class="form-group col-md-12">
                                            <img id="selectedServerSocialImage" class="img-fluid sm_main_img" src="<?php echo PUBLIC_CORE_IMG_SOCIALURL . '/' . DEFAULT_SOCIAL_IMAGE; ?>">
                                        </div>
                                    </div>
                                    <!-- local preview image -->
                                    <div id="selectedLocalSocialImageDiv" style="display: none;">
                                        <div class="form-group col-md-12">
                                            <img id="selectedLocalSocialImage" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- Server -->
                                        <div id="sm_social_image_server_div" class="custom-file">
                                            <input id="sm_social_image_server" type="text" name="sm_social_image_server" class="form-control <?php echo (!empty($data['sm_add_image_server_err'])) ? 'is-invalid' : ''; ?>" value="<?php if (empty($data['sm_add_image'])) { echo DEFAULT_SOCIAL_IMAGE; } else { echo $data['sm_add_image'];  }; ?>" data-toggle="modal" data-target="#sm_social_images_list" readonly>                                                          
                                            <span class="invalid-feedback"><?php echo $data['sm_add_image_server_err']; ?></span>
                                            <!-- Modal -->
                                            <div class="modal" id="sm_social_images_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Social
                                                                images</h5>
                                                            <button id="close_sm_social_images_list" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div id="sm_social_images_list_modal_body" class="modal-body">
                                                            <div id="sm_social_images_list_load">
                                                                <div id="sm_social_images_list_load_content">
                                                                    <div id="message"><?php flash('social_images'); ?></div>
                                                                    <div class="row">
                                                                        <?php for ($p = 0; $p < count($data['social_image_list']); $p++) { ?>
                                                                            <div class="col-sm-2">
                                                                                <img style="border: 1px solid rgba(0, 0, 0, 0.5);" onclick='selectedSocialImage(<?php echo jsonSelectedSocialImage(NULL, $data['social_image_list'][$p]); ?>)' class="sm_social_img" src="<?php echo PUBLIC_CORE_IMG_SOCIALURL . '/' . $data['social_image_list'][$p]; ?>">
                                                                                <?php if (DEFAULT_SOCIAL_IMAGE !== $data['social_image_list'][$p]) { ?>
                                                                                    <div class="img-trash" onclick='ajax_deleteSocialImage(<?php echo jsonSelectedSocialImage(NULL, $data['social_image_list'][$p]); ?>)'>
                                                                                        <span>
                                                                                            <i class="fa fa-trash-o"></i>
                                                                                        </span>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Local -->
                                        <div style="display: none;" id="sm_social_image_local_div" class="custom-file">
                                            <input id="sm_local_image" onchange="selectedUploadSocialImage(this)" type="file" name="sm_image_local" accept="image/.jpg,.png,.jpeg,.gif,.svg" class="custom-file-input <?php echo (!empty($data['sm_add_image_local_err'])) ? 'is-invalid' : ''; ?>">
                                            <label id="custom-file-label_sm_social_image" class="custom-file-label" for="sm_local_image">Browse</label>
                                            <span class="invalid-feedback"><?php echo $data['sm_add_image_local_err']; ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group" style=" <?php if (!empty($data['sm_add_image_server_err']) || !empty($data['sm_add_image_local_err'])) {
                                                                        echo "padding-top: 20px";
                                                                    } ?>">
                                        <input id="submit_social_media" name="submitSocialMedia" type="submit" value="Add" class="btn btn-success btn-block">
                                    </div>
                                </form>
                                <div class="col text-center" style="margin-top: -5px;">
                                    <?php
                                    if ($data['sm'] !== false) {
                                        for ($i = 0; $i < count($data['sm']['id']); $i++) { ?>
                                            <img onclick='ajax_deleteSocialMedia(<?php echo jsonEncodeDeleteSocialMedia(NULL, $data['sm']['id'][$i], $data['sm']['name'][$i]); ?>)' src="<?php echo PUBLIC_CORE_IMG_SOCIALURL . '/' . $data['sm']['image'][$i]; ?>" alt="<?php echo $data['sm']['name'][$i]; ?>" class="img-responsive sm_admin_image">
                                    <?php
                                        }
                                    } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div id="social_media_data" style="<?php if (isAdminLoggedIn()) {
                                                                echo 'display: none;';
                                                            } ?>">
                            <div class="col text-center">
                                <?php
                                if ($data['sm'] !== false) {
                                    for ($i = 0; $i < count($data['sm']['id']); $i++) { ?>
                                        <a href="<?php echo $data['sm']['link'][$i]; ?>" target="_blank" style="text-decoration: none;">
                                            <img src="<?php echo PUBLIC_CORE_IMG_SOCIALURL . '/' . $data['sm']['image'][$i]; ?>" alt="<?php echo $data['sm']['name'][$i]; ?>" class="img-responsive sm_user_image">
                                        </a>
                                <?php
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- authentication -->
        <button id="toggle_login_menu" class="btn btn-default float-left" onclick="changeNavTopUserColor('toggle_login_menu', 'collapse_login_menu')" type="button" data-toggle="collapse" data-target="#collapse_login_menu">
            <i id="login" class="fa fa-user-circle"></i>
        </button>
        <!-- Toggler Authentication Menu -->
        <div id="collapse_login_menu" class="dropdown-menu bg-dark">
            <?php if (isLoggedIn() === true) { ?>
                <!-- Setting Form -->
                <div id="setting_form">
                    <h4 class="h4_nav_top_user"><?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_surname']; ?></h4>
                    <div class="login_menu_content">
                        <!-- Change Email -->
                        <form action="<?php echo URLROOT; ?>/index" method="post">
                            <div class="form-group">
                                <p class="p_nav_top_user">Change email</p>
                                <input id="setting_email" type="email" name="email" class="form-control <?php echo (!empty($data['set_email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['set_email']; ?>" placeholder="Email">
                                <button name="submitUserEmail" id="setting_submit_email" class="btn btn-success" type="submit">
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
                                <input id="setting_old_password" type="password" name="old_password" class="form-control <?php echo (!empty($data['set_old_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['set_old_password']; ?>" placeholder="Current Password" autocomplete="off">
                                <span class="invalid-feedback"><?php echo $data['set_old_password_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <input id="setting_new_password" type="password" name="new_password" class="form-control <?php echo (!empty($data['set_new_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['set_new_password']; ?>" placeholder="New Password" autocomplete="off">
                                <span class="invalid-feedback"><?php echo $data['set_new_password_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <input id="setting_new_password_confirm" type="password" name="new_password_confirm" class="form-control <?php echo (!empty($data['set_new_password_confirm_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['set_new_password_confirm']; ?>" placeholder="Confirm New Password" autocomplete="off">
                                <button name="submitUserPassword" id="setting_submit_password" class="btn btn-success" type="submit">
                                    <i class="fa fa-lock"></i>
                                </button>
                                <span class="invalid-feedback"><?php echo $data['set_new_password_confirm_err']; ?></span>
                            </div>
                        </form>
                        <hr class="hr_menu">
                        <!-- logout -->
                        <div class="form-group">
                            <a id="logout" href="<?php echo URLROOT; ?>/users/logout" class="btn btn-light btn-block">Logout</a>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <!-- Authentication Form -->
                <div id="login_form">
                    <h4 class="h4_nav_top_user">Authentication</h4>
                    <div class="login_menu_content">
                        <div id="accordion">
                            <?php flash('register_success'); ?>
                            <form action="<?php echo URLROOT; ?>/index" method="post">
                                <div class="form-group">
                                    <input id="login_email" type="email" name="email" class="form-control <?php echo (!empty($data['log_email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['log_email']; ?>" placeholder="Email">
                                    <span class="invalid-feedback"><?php echo $data['log_email_err']; ?></span>
                                </div>
                                <div class="form-group">
                                    <input id="login_password" type="password" name="password" class="form-control <?php echo (!empty($data['log_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['log_password']; ?>" placeholder="Password">
                                    <span class="invalid-feedback"><?php echo $data['log_password_err']; ?></span>
                                </div>
                                <div class="form-group">
                                    <input id="login_verification_code" type="text" name="verification_code" class="form-control <?php echo (!empty($data['log_verification_code_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['log_verification_code']; ?>" placeholder="Verification Code">
                                    <span class="invalid-feedback"><?php echo $data['log_verification_code_err']; ?></span>
                                </div>
                                <div class="form-group">
                                    <input id="submit_login" name="submitLogin" type="submit" value="Login" class="btn btn-success btn-block">
                                </div>
                            </form>
                            <div class="form-group">
                                <button onclick="loginRegister('login_form', 'registration_form')" id="register_link" class="btn btn-light btn-block" data-toggle="collapse" data-target="#registration_form">No account? Register
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Registration Form -->
                <div id="registration_form" style="display: none;">
                    <h4 class="h4_nav_top_user">Registration</h4>
                    <div class="login_menu_content">
                        <div id="accordion">
                            <form name="registration_form" action="<?php echo URLROOT; ?>/index" method="post">
                                <div class="form-group">
                                    <input id="register_firstname" type="text" name="firstname" class="form-control <?php echo (!empty($data['reg_firstname_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['reg_firstname']; ?>" placeholder="Firstname">
                                    <span class="invalid-feedback"><?php echo $data['reg_firstname_err']; ?></span>
                                </div>
                                <div class="form-group">
                                    <input id="register_surname" type="text" name="surname" class="form-control <?php echo (!empty($data['reg_surname_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['reg_surname']; ?>" placeholder="Surname">
                                    <span class="invalid-feedback"><?php echo $data['reg_surname_err']; ?></span>
                                </div>
                                <div class="form-group">
                                    <input id="register_email" type="email" name="email" class="form-control <?php echo (!empty($data['reg_email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['reg_email']; ?>" placeholder="Email">
                                    <span class="invalid-feedback"><?php echo $data['reg_email_err']; ?></span>
                                </div>
                                <div class="form-group">
                                    <input id="register_password" type="password" name="password" class="form-control <?php echo (!empty($data['reg_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['reg_password']; ?>" placeholder="Password">
                                    <span class="invalid-feedback"><?php echo $data['reg_password_err']; ?></span>
                                </div>
                                <div class="form-group">
                                    <input id="register_confirm_password" type="password" name="confirm_password" class="form-control <?php echo (!empty($data['reg_confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['reg_confirm_password']; ?>" placeholder="Confirm password">
                                    <span class="invalid-feedback"><?php echo $data['reg_confirm_password_err']; ?></span>
                                </div>
                                <div class="form-group">
                                    <input id="submit_register" name="submitRegister" type="submit" value="Register" class="btn btn-success btn-block">
                                </div>
                            </form>
                            <div class="form-group">
                                <button id="login_link" onclick="loginRegister('registration_form', 'login_form')" class="btn btn-light btn-block" data-toggle="collapse" data-target="#login_form">
                                    Have an account? Login
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- main menu -->
        <button id="toggle_main_menu" class="btn btn-default float-left" onclick="changeNavTopUserColor('toggle_main_menu', 'collapse_main_menu')" type="button" data-toggle="collapse" data-target="#collapse_main_menu">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>
        <!-- Toggler Main Menu -->
        <div id="collapse_main_menu" class="dropdown-menu bg-dark">
            <h4 class="h4_nav_top_user">
                <i id='mmDropDownItems' style='color: white; cursor: pointer;' onclick="mmDropDownItems()" class='fa fa-play' aria-hidden='true'></i>
                Main
                <?php if (isAdminLoggedIn()) { ?>
                    <i id='mmAddChild0' style='color: grey; cursor: pointer' onclick="mmAddChild({blog_id:'0', title:''})" class='fa fa-plus mm_add_child_icon' aria-hidden='true'></i>
                <?php } ?>
            </h4>
            <div id="accordion">
                <div id="mm_search_form">
                    <form class="form-inline" action="<?php echo URLROOT; ?>/index" method="post">
                        <input id="search_main_menu" type="text" name="search_main_menu" class="form-control <?php echo (!empty($data['blog_mm_search_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['blog_mm_search']; ?>" placeholder="Search">
                        <button id="submit_search_input" name="submit_search_input" class="btn btn-success" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                        <span class="invalid-feedback"><?php echo $data['blog_mm_search_err']; ?></span>
                    </form>
                </div>
                <?php if (isAdminLoggedIn() === true) { ?>
                    <div id="mm_add_child_form">
                        <form class="form-inline" action="<?php echo URLROOT; ?>/index" method="post">
                            <input id="mm_add_child" type="text" name="mm_add_child" class="form-control <?php echo (!empty($data['blog_mm_add_child_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['blog_mm_add_child']; ?>" placeholder="Add child">
                            <input id="mm_add_child_parentId" type="text" name="mm_add_child_parentId" style="display: none" class="form-control" value="" placeholder="Parent id">
                            <button id="submit_add_child_input" name="submit_add_child_input" class="btn btn-success" type="submit">
                                <i class='fa fa-plus'></i>
                            </button>
                            <span class="invalid-feedback"><?php echo $data['blog_mm_add_child_err']; ?></span>
                        </form>
                    </div>
                    <div id="mm_edit_title_form">
                        <form class="form-inline" action="<?php echo URLROOT; ?>/index" method="post">
                            <input id="mm_edit_title_id" type="text" name="mm_edit_title_id" style="display: none" class="form-control" value="" placeholder="Id">
                            <input id="mm_edit_title" type="text" name="mm_edit_title" class="form-control <?php echo (!empty($data['blog_mm_edit_title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['blog_mm_edit_title']; ?>" placeholder="Edit title">
                            <button id="submit_edit_input" name="submit_edit_title_input" class="btn btn-success" type="submit">
                                <i class='fa fa-pencil'></i>
                            </button>
                            <span class="invalid-feedback"><?php echo $data['blog_mm_edit_title_err']; ?></span>
                        </form>
                    </div>
                    <div id="mm_delete_branch_form">
                        <form class="form-inline" action="<?php echo URLROOT; ?>/index" method="post">
                            <input id="mm_delete_branch_id" type="text" name="mm_delete_branch_id" style="display: none" class="form-control" value="" placeholder="Id">
                            <input id="mm_delete_branch_title" type="text" name="mm_delete_branch_title" class="form-control <?php echo (!empty($data['blog_mm_delete_branch_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['blog_mm_delete_branch']; ?>" placeholder="Delete branch" readonly>
                            <button id="submit_delete_branch_input" name="submit_delete_branch_input" class="btn btn-success" type="submit">
                                <i class='fa fa-times'></i>
                            </button>
                            <span class="invalid-feedback"><?php echo $data['blog_mm_edit_title_err']; ?></span>
                        </form>
                    </div>
                <?php } ?>
                <div id="mm_load_box">
                    <div id="mm_load_trees">
                        <div id="main_menu_message"><?php flash('main_menu'); ?></div>
                        <?php

                        echo createTreeView(0, $data['blog_mm']);

                        // display or hide mmDropDownItems
                        if (!isset($GLOBALS['HAS_CHILDREN_MM_DROP_DOWN'])) { ?>
                            <script>
                                document.getElementById("mmDropDownItems").style.display = "none";
                            </script>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</nav>