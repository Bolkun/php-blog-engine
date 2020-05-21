<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="nav_top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active"><a class="nav-link" href="<?php echo URLROOT; ?>">Startseite</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/tasks">Aufgaben</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/calenders">Kalender</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/documents">Dokumente</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/costs/">Abrechnungen</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/users/settings">Einstellungen</a></li>
        </ul>
    </div>

    <!-- Dropdown -->
    <?php if(isAdminLoggedInAsCoworker()){ ?>
        <span class="nav-item dropdown">
            <a class="nav-link admin_nav_link text-danger" href="#" id="navbardrop" data-toggle="dropdown">
                User
                <!-- Dropdown Icon -->
                <svg class="bi bi-caret-down-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 01.753 1.659l-4.796 5.48a1 1 0 01-1.506 0z"/>
                </svg>
            </a>

            <div class="dropdown-menu bg-dark">
                <a class="dropdown-item text-danger" href="<?php echo URLROOT; ?>/users/changeUserRole">Admin</a>
            </div>
        </span>
    <?php } ?>
    <span class="navbar-text text-success"><?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_surname'];?></span>
    <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
</nav>