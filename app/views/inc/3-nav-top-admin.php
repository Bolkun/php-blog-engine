<?php
// check session
if (isAdminLoggedIn() === true) { ?>
    <nav id="nav_top_admin" class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
        <div class="container" style="border-top: 1px solid grey; display: -webkit-box;">
            <div class="nav-item admin_nav_item <?php if (URLCURRENT === URLROOT . '/admins/pages/newEditDelete') echo 'active'; ?>">
                <a class="nav-link"
                   href="<?php echo URLROOT; ?>/admins/pages/newEditDelete">Pages</a>
            </div>
            <div class="nav-item admin_nav_item <?php if (URLCURRENT === URLROOT . '/admins/tests') echo 'active'; ?>">
                <a class="nav-link" href="<?php echo URLROOT; ?>/admins/tests">Tests</a>
            </div>
            <div class="nav-item admin_nav_item <?php if (URLCURRENT === URLROOT . '/admins/devs') echo 'active'; ?>">
                <a class="nav-link" href="<?php echo URLROOT; ?>/admins/devs">Development</a>
            </div>
            <div class="nav-item admin_nav_item <?php if (URLCURRENT === URLROOT . '/admins/users') echo 'active'; ?>">
                <a class="nav-link" href="<?php echo URLROOT; ?>/admins/users">Users</a>
            </div>
        </div>
    </nav>
    <br>
<?php } ?>