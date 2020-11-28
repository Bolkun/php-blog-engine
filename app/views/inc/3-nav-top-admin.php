<?php
// check session
if (isAdminLoggedIn() === true) { ?>
    <nav id="nav_top_admin" class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
        <div class="container" style="border-top: 1px solid grey; display: -webkit-box;">
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