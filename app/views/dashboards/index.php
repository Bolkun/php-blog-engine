<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="wrapper">
        <?php require APPROOT . '/views/inc/nav/nav-sidebar.php'; ?>
        <div class="container-fluid">
            <div class="row" id="content">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div id="wrapper">
                        <h1><?php echo $data['title']; ?></h1>
                        <!-- <iframe src="https://web2.0rechner.de/" height="600" width="800"></iframe> -->
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>