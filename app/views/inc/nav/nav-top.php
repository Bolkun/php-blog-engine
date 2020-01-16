<div id="nav-stripe-top">
    <ul class="nav-top top">
        <li><a href="<?php echo URLROOT; ?>">Startseite</a></li>
        <li><a href="<?php echo URLROOT; ?>/tasks">Aufgaben</a></li>
        <li><a href="<?php echo URLROOT; ?>/calenders">Kalender</a></li>
        <li><a href="<?php echo URLROOT; ?>/users/info">Mitarbeiter</a></li>
        <li><a href="<?php echo URLROOT; ?>/documents">Dokumente</a></li>
        <li><a href="<?php echo URLROOT; ?>/costs">Abrechnungen</a></li>
        <li><a href="<?php echo URLROOT; ?>/users/settings">Einstellungen</a></li>
        <li style="float: right">
            <span>Welcome <span><?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_surname'];?></span></span>
            <a href="<?php echo URLROOT; ?>/users/logout">Logout</a>
        </li>
    </ul>
</div>