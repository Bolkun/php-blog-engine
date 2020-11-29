<?php
// check session
if (isAdminLoggedIn() === true) { ?>
    <nav id="nav_top_admin" class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
        <div class="container" style="border-top: 1px solid grey; display: -webkit-box;">
            <?php if(is_numeric($data['url_param']) && $data['url_param'] != '0'){ ?>
                <div id="edit_content" class="nav-item admin_nav_item">
                    <i id="edit_content_icon" class="fa fa-file-text" aria-hidden="true" onclick="displayBlogContent()"></i>
                </div>
            <?php } ?>
            <div class="nav-item admin_nav_item <?php if (URLCURRENT === URLROOT . '/admins/tests') echo 'active'; ?>">
                <a class="nav-link" href="<?php echo URLROOT; ?>/index/tests">Tests</a>
            </div>
            <div class="nav-item admin_nav_item <?php if (URLCURRENT === URLROOT . '/admins/devs') echo 'active'; ?>">
                <a class="nav-link" href="<?php echo URLROOT; ?>/index/index/devs">Development</a>
            </div>
        </div>
    </nav>
    <br>
<?php } ?>