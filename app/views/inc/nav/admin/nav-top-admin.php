<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="nav_top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <!-- Left Sidebar Icon -->
        <button type="button"  class="btn btn-info" id="sidebarCollapse">
            <i class="fas fa-align-left"></i>
            <span></span>
        </button>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if(URLCURRENT === URLROOT . '/dashboards') echo 'active'; ?>">
                <a class="nav-link admin_nav_link" href="<?php echo URLROOT; ?>/dashboards">Start</a>
            </li>
            <li class="nav-item <?php if(URLCURRENT === URLROOT . '/admins/pages/newEditDelete') echo 'active'; ?>">
                <a class="nav-link admin_nav_link" href="<?php echo URLROOT; ?>/admins/pages/newEditDelete">Pages</a>
                <span id="pageMenu" onclick="show_page_menu()" style="color: white; cursor: pointer;">&uarr;</span>
            </li>
            <li class="nav-item <?php if(URLCURRENT === URLROOT . '/admins/tests') echo 'active'; ?>">
                <a class="nav-link admin_nav_link" href="<?php echo URLROOT; ?>/admins/tests">Tests</a>
            </li>
            <li class="nav-item <?php if(URLCURRENT === URLROOT . '/admins/devs') echo 'active'; ?>">
                <a class="nav-link admin_nav_link" href="<?php echo URLROOT; ?>/admins/devs">Development</a>
            </li>
            <li class="nav-item <?php if(URLCURRENT === URLROOT . '/admins/users') echo 'active'; ?>">
                <a class="nav-link admin_nav_link" href="<?php echo URLROOT; ?>/admins/users">Users</a>
            </li>
        </ul>
    </div>
    <!-- Dropdown -->
    <span class="nav-item dropdown">
        <a class="nav-link admin_nav_link text-danger" href="#" id="navbardrop" data-toggle="dropdown">
            Admin
            <svg class="bi bi-caret-down-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 01.753 1.659l-4.796 5.48a1 1 0 01-1.506 0z"/>
            </svg>
        </a>
        <?php if(isAdminLoggedIn()){ ?>
            <div class="dropdown-menu bg-dark">
                <a class="dropdown-item text-danger" href="<?php echo URLROOT; ?>/users/changeUserRole">User</a>
            </div>
        <?php } ?>
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


