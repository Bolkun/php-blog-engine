<?php
// check session
if (isAdminLoggedIn() === true) { ?>
    <nav id="nav_top_admin" class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
        <div class="container" style="border-top: 1px solid grey; display: -webkit-box;">
            <?php if (preg_match("#^" . URLROOT . '/index/' . "[0-9]+$#", URLCURRENT)) { ?>
                <div id="edit_content" class="nav-item admin_nav_item">
                    <i id="edit_content_icon" class="fa fa-file-text" aria-hidden="true" onclick='ajax_loadBlogPage(<?php echo jsonEncodeMenu($data['blog_id'], $data['blog_title']); ?>)'></i>
                </div>
            <?php } ?>
            <div class="nav-item admin_nav_item <?php if (URLCURRENT === URLROOT . '/index/devs/php') echo 'active'; ?>">
                <a class="nav-link" href="<?php echo URLROOT; ?>/index/devs/php">PHP</a>
            </div>
            <div class="nav-item admin_nav_item <?php if (URLCURRENT === URLROOT . '/index/tests/benchmark') echo 'active'; ?>">
                <a class="nav-link" href="<?php echo URLROOT; ?>/index/tests/benchmark">Benchmark</a>
            </div>
        </div>
    </nav>
    <br>
<?php } ?>