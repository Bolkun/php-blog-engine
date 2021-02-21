<?php require APPROOT . '/views/inc/1-header.php'; ?>
<?php require APPROOT . '/views/inc/2-nav-top-user.php'; ?>
<?php require APPROOT . '/views/inc/3-nav-top-admin.php'; ?>
<br><br><br>
<div class="container" style="position: relative; width: 100%; height: 100%; overflow: hidden; padding-top: 56.25%;">
    <iframe style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; width: 100%; height: 100%; border: none;" src="<?php echo URLROOT; ?>/index/devs/phpinfo">
    </iframe>
</div>
<?php require APPROOT . '/views/inc/4-footer.php'; ?>