<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="nav_top_admin">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($GLOBALS['sACTUAL_LINK'] === URLROOT . '/dashboards') echo 'active'; ?>">
                <a class="nav-link admin_nav_link" href="<?php echo URLROOT; ?>/dashboards">Start</a>
            </li>
            <li class="nav-item <?php if($GLOBALS['sACTUAL_LINK'] === URLROOT . '/admins/pages/newEditDelete') echo 'active'; ?>">
                <a class="nav-link admin_nav_link" href="<?php echo URLROOT; ?>/admins/pages/newEditDelete">Pages</a>
                <span id="pageMenu" onclick="show_page_menu()" style="color: white; cursor: pointer;">&uarr;</span>
            </li>
            <li class="nav-item <?php if($GLOBALS['sACTUAL_LINK'] === URLROOT . '/admins/tests') echo 'active'; ?>">
                <a class="nav-link admin_nav_link" href="<?php echo URLROOT; ?>/admins/tests">Tests</a>
            </li>
            <li class="nav-item <?php if($GLOBALS['sACTUAL_LINK'] === URLROOT . '/admins/devs') echo 'active'; ?>">
                <a class="nav-link admin_nav_link" href="<?php echo URLROOT; ?>/admins/devs">Development</a>
            </li>
            <li class="nav-item <?php if($GLOBALS['sACTUAL_LINK'] === URLROOT . '/admins/users') echo 'active'; ?>">
                <a class="nav-link admin_nav_link" href="<?php echo URLROOT; ?>/admins/users">Users</a>
            </li>
        </ul>
    </div>
    <!-- Dropdown -->
    <span class="nav-item dropdown">
        <a class="nav-link admin_nav_link dropdown-toggle text-danger" href="#" id="navbardrop" data-toggle="dropdown">
            Admin
        </a>
        <div class="dropdown-menu bg-dark">
            <a class="dropdown-item text-danger" href="<?php echo URLROOT; ?>/admins/tests">Tests</a>
            <a class="dropdown-item text-danger" href="<?php echo URLROOT; ?>/admins/devs">Development</a>
            <a class="dropdown-item text-danger" href="<?php echo URLROOT; ?>/admins/users">Users</a>
            <span class="nav-item dropleft">
                <a class="nav-link admin_nav_link dropdown-toggle text-danger" href="#" id="navbardrop" data-toggle="dropleft">
                    Pages
                </a>
                <div class="dropdown-menu bg-dark">
                    <a class="dropdown-item text-danger" href="<?php echo URLROOT; ?>/admins/pages/newEditDelete">New/Edit/Delete</a>
                </div>
            </span>
        </div>
    </span>
    <span class="navbar-text text-success"><?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_surname'];?></span>
    <a class="nav-link admin_nav_link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
</nav>

<script>
    function show_page_menu(){
        var x = document.getElementById("nav_top_page");
        if (x.style.display === "none") {
            document.getElementById("pageMenu").innerHTML = "&darr;&nbsp;";
            x.style.display = "block";
        } else {
            document.getElementById("pageMenu").innerHTML = "&uarr;&nbsp;";
            x.style.display = "none";
        }
    }
</script>


