<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <div class="row">
            <div id="wrapper">
                <h1><?php echo $data['title']; ?></h1>
                <div id="viewsAdminsTestsBenchmark">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Loop name</th>
                                    <th>Result time</th>
                                </tr>
                            </thead>
                            <h2><?php echo $data['writeLoop']['title']; ?></h2>
                            <p2><?php echo $data['writeLoop']['description']; ?></p2>
                            <tbody>
                                 <tr>
                                     <td><?php echo $data['writeLoop']['loopForEach']; ?></td>
                                     <td><?php echo $data['writeLoop']['loopForEachTime']; ?></td>
                                 </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>