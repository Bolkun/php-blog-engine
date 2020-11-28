<?php require APPROOT . '/views/inc/1-header.php'; ?>
<?php require APPROOT . '/views/inc/2-nav-top-user.php'; ?>
<?php require APPROOT . '/views/inc/3-nav-top-admin.php'; ?>
    <br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div id="wrapper">
                    <h1><?php echo $data['title']; ?></h1>
                    <p><span class="badge badge-pill badge-success">Started 16.01.2020</span></p>
                    <h2>Goal</h2>
                    <p>In internet, there are different sort of php frameworks, which allows user to make different kind of
                        website application. But all of them have these kind of faults.
                    </p>
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-danger">1. User needs a lot of time learning the concepts of a framework.</li>
                        <li class="list-group-item list-group-item-danger">2. Bad speed and performance, based on big amount of features built in.</li>
                        <li class="list-group-item list-group-item-danger">3. Differ Quality of plugins code written by different people.</li>
                    </ul>
                    <p>This framework covers these minuses and has build in algorithms to automate processes.</p>
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-success">1. Build any sort of web application user wanted to.</li>
                        <li class="list-group-item list-group-item-success">2. High speed and performance automation, based on all tested functions built in.</li>
                        <li class="list-group-item list-group-item-success">3. Easy to learn, to install, to transport and to create new website pages.</li>
                    </ul>
                    <p>Here are some examples which were built with other php frameworks. This framework can cover them all.</p>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <img width="100%"src="<?php echo PUBLIC_CORE_IMG_DEVURL; ?>/popular_php_sites651x256.png" class="rounded d-block" alt="popular sites made with php framework">
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                    <br>
                    <h2>Architecture</h2>
                    <p>Almost every php framework is based on "Model View Controller"(MVC) design pattern. These design pattern was reworked by Serhiy Bolkun, where he covers major minuses. And gave
                        a name to a new design pattern called "Modified Model View Controller"(MMVC).
                    </p>
                    <div class="row">
                        <div class="col-sm-6">
                            <img width="100%"src="<?php echo PUBLIC_CORE_IMG_DEVURL; ?>/mmvc500x550.png" class="rounded d-block" alt="mvc">
                        </div>
                        <div class="col-sm-6">
                            <h2>Modified Model View Controller (MMVC)</h2>
                            <p>So, what are the benefits of MMVC?</p>
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-success">1. It helps separate the different parts of an application. This makes it easier to modify and assign developers on different tasks.</li>
                                <li class="list-group-item list-group-item-success">2. It makes maintaining small applications easy.</li>
                                <li class="list-group-item list-group-item-warning">3. It loads only stuff which is necessary on the certain page.</li>
                                <li class="list-group-item list-group-item-warning">4. Clean database, only for user stuff.</li>
                            </ul>
                            <p>And the downsides:</p>
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-danger"><s>1. It does not scale well with bigger applications.</s></li>
                                <li class="list-group-item list-group-item-danger"><s>2. It encourages fat controllers/or fat models. Causing spaghetti code as the code base grows.</s></li>
                                <li class="list-group-item list-group-item-danger"><s>3. It limits separation of concerns to only three different parts.</s></li>
                            </ul>
                        </div>
                    </div>
                    <div id="viewsAdminsDevsIndex">
                        <h2>Installation</h2>
                        <p>Check PHP's Configuration: <a href="<?php echo URLROOT; ?>/index/devs/phpinfo">phpinfo();</a></p>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Version</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data['properties'] as $key => $property) { ?>
                                <tr>
                                    <td><?php echo $key; ?></td>
                                    <td><?php echo $property; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <h2>License</h2>
                        <p>This project was developed by
                            <span class="font-weight-bold">Serhiy Bolkun</span>
                            for commercial purpose. To buy a license or to distribute a project please contact
                            <span class="font-weight-bold">serhij16@live.de</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/4-footer.php'; ?>
<?php require APPROOT . '/views/inc/5-cookies.php'; ?>