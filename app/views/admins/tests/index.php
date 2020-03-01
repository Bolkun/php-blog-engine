<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <div class="row">
            <div id="wrapper">
                <h1><?php echo $data['title']; ?></h1>
                <div id="viewsAdminsTestsIndex">
                    <a href="<?php echo URLROOT; ?>/admins/tests/helpers/date_helper">helpers/date_helper.php</a><br>
                    <a href="<?php echo URLROOT; ?>/admins/tests/benchmark">performance testing (benchmarks)</a>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>