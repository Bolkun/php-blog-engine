<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div id="wrapper">
                    <h1><?php echo $data['title']; ?></h1>
                    <div class="row">
                        <div class="col-sm-4">
                            <img width="100%"src="<?php echo URLROOT; ?>/img/testing_pyramid1400x1031.png" class="rounded d-block" alt="logo">
                        </div>
                        <div class="col-sm-8">
                            <h2>Intro</h2>
                            <p>Automated testing plays a major role in delivering quality software.
                                It’s great for data validation, combinatorial testing, finding regressions and building
                                confidence in each successive build. In this project was used
                                <span class="font-weight-bold">"Test Automation Pyramid"</span>.
                                There are three types of automated tests that are commonly used in development:
                                <span class="font-weight-bold">UI</span>, <span class="font-weight-bold">integration</span>
                                and <span class="font-weight-bold">unit</span> tests.
                            </p>
                        </div>
                    </div>
                    <br>
                    <div id="viewsAdminsTestsIndex">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Link</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>UI Tests</td>
                                <td>
                                    <a href=""></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Integration Tests</td>
                                <td>
                                    <a href="<?php echo URLROOT; ?>/admins/tests/benchmark">performance testing
                                        (benchmarks)</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Unit Tests</td>
                                <td>
                                    <a href="<?php echo URLROOT; ?>/admins/tests/helpers/date_helper">helpers/date_helper.php</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>