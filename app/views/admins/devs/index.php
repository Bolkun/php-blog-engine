<?php require APPROOT . '/views/inc/header.php'; ?>
    <div id="nav">
        <?php require APPROOT . '/views/inc/nav/nav-top.php'; ?>
    </div>
    <div class="container">
        <div class="row">
            <div id="wrapper">
                <h1><?php echo $data['title']; ?></h1>
                <div id="viewsAdminsDevsIndex">
                    <?php
                    foreach ($data['properties'] as $property) {
                        echo $property . "<br>";
                    }
                    // phpinfo();
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>