<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
    <?php
    // check session
    if(isAdminLoggedIn() === true){ ?>
        <!-- Dropdown -->
        <span class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-danger" href="#" id="navbardrop" data-toggle="dropdown">
                Admin
            </a>
            <div class="dropdown-menu bg-dark">
                <a class="dropdown-item text-danger" href="<?php echo URLROOT; ?>/admins/tests">Tests</a>
                <a class="dropdown-item text-danger" href="<?php echo URLROOT; ?>/admins/devs">Development</a>
                <a class="dropdown-item text-danger" href="<?php echo URLROOT; ?>/admins/users">Users</a>
            </div>
        </span>
    <?php } ?>
    <span class="navbar-text text-success"><?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_surname'];?></span>
    <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
</nav>