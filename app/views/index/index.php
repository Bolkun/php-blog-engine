<?php require APPROOT . '/views/inc/1-header.php'; ?>
<?php require APPROOT . '/views/inc/2-nav-top-user.php'; ?>
<?php require APPROOT . '/views/inc/3-nav-top-admin.php'; ?>
    <br><br><br>
<?php if ($data['url_param'] !== 0) { ?>
    <?php require APPROOT . '/views/inc/3a-single-page-content.php'; ?>
<?php } elseif ($data['url_param'] === 0) { ?>
    <?php require APPROOT . '/views/inc/3b-all-page-content.php'; ?>
    <?php require APPROOT . '/views/inc/3c-pagination.php'; ?>
<?php } ?>
<?php require APPROOT . '/views/inc/4-footer.php'; ?>