<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div id="wrapper">
                <h1><?php echo $data['title']; ?></h1>
                <div id="views_admins_pages_newEditDelete">
                    <h2>Create New Page</h2>

                    <h2>Edit Page</h2>
                    <?php
                        global $aPAGES_location, $aPAGES_links;
                        admin_listFolderFiles(APPROOT . DIRECTORY_SEPARATOR . 'views');
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>