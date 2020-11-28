<?php require APPROOT . '/views/inc/1-header.php'; ?>
<?php require APPROOT . '/views/inc/2-nav-top-user.php'; ?>
<?php require APPROOT . '/views/inc/3-nav-top-admin.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div id="wrapper">
                        <h1><?php echo $data['title']; ?></h1>
                        <p>Compare results with <a href="https://phpbench.com/" target="_blank">The PHP Benchmark</a></p>
                        <p class="font-italic">Note: Each dynamic test was 1000 times iterated to get exact microtime duration.</p>
                        <div id="viewsAdminsTestsBenchmark">
                            <h2>Test results of all time used for optimisation in this project</h2>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Winner</th>
                                        <th>Conclusion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Array size count: count() vs sizeof()</td>
                                        <td>Static</td>
                                        <td>count()</td>
                                        <td>The execution time - sizeof takes significantly longer to execute.</td>
                                    </tr>
                                    <tr>
                                        <td>Variable Type Checking: empty() vs isset()</td>
                                        <td>Static</td>
                                        <td>empty()</td>
                                        <td>Both functions are identical, but empty() is more stable.</td>
                                    </tr>
                                    <tr>
                                        <td>String Output: echo vs. print</td>
                                        <td>Dynamic</td>
                                        <td>echo</td>
                                        <td>Echo is marginally faster than print.</td>
                                    </tr>
                                    <tr>
                                        <td>Quote Types: double(") vs. single(') quotes</td>
                                        <td>Dynamic</td>
                                        <td>single(')</td>
                                        <td>Text quoted inside single(') quotes treated as plain string.</td>
                                    </tr>
                                    <tr>
                                        <td>Control Structures: if vs. switch</td>
                                        <td>Dynamic</td>
                                        <td>if</td>
                                        <td>if, elseif and else (using ===) is the fastest.</td>
                                    </tr>
                                    <tr>
                                        <td>Counting Loop: for() vs. while()</td>
                                        <td>Dynamic</td>
                                        <td>while()</td>
                                        <td>The while loop 90% of the time is indeed slightly faster</td>
                                    </tr>
                                    <tr>
                                        <td>Read Loop: foreach() vs. for()</td>
                                        <td>Dynamic</td>
                                        <td>foreach()</td>
                                        <td>Best way to loop a hash array and echo results.</td>
                                    </tr>
                                    <tr>
                                        <td>Write Loop: for() vs. while()</td>
                                        <td>Dynamic</td>
                                        <td>for()</td>
                                        <td>Best way to fill hash array with values.</td>
                                    </tr>
                                    <tr>
                                        <td>Modify Loop: foreach() vs. for()</td>
                                        <td>Dynamic</td>
                                        <td>for()</td>
                                        <td>Proof in this example shows how horrible foreach() loop can be.</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="table-responsive">
                                <h2>String Output: echo vs. print</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    $size = getArraySize($data['stringOutputs']);
                                    while ($i <= $size){ ?>
                                        <tr class="<?php echo $data['stringOutputs'][$i-1]["class$i"]; ?>">
                                            <td><?php echo $data['stringOutputs'][$i-1]["nr$i"]; ?></td>
                                            <td><?php echo $data['stringOutputs'][$i-1]["name$i"]; ?></td>
                                            <td><?php echo $data['stringOutputs'][$i-1]["test$i"] . ' ms'; ?></td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    unset($i);
                                    unset($size);
                                    ?>
                                    </tbody>
                                </table>
                                <h2>Quote Types: double(") vs. single(') quotes</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    $size = getArraySize($data['quotes']);
                                    while ($i <= $size){ ?>
                                        <tr class="<?php echo $data['quotes'][$i-1]["class$i"]; ?>">
                                            <td><?php echo $data['quotes'][$i-1]["nr$i"]; ?></td>
                                            <td><?php echo $data['quotes'][$i-1]["name$i"]; ?></td>
                                            <td><?php echo $data['quotes'][$i-1]["test$i"] . ' ms'; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    unset($i);
                                    unset($size);
                                    ?>
                                    </tbody>
                                </table>
                                <h2>Control Structures: if vs. switch</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    $size = getArraySize($data['conditions']);
                                    while ($i <= $size){ ?>
                                        <tr class="<?php echo $data['conditions'][$i-1]["class$i"]; ?>">
                                            <td><?php echo $data['conditions'][$i-1]["nr$i"]; ?></td>
                                            <td><?php echo $data['conditions'][$i-1]["name$i"]; ?></td>
                                            <td><?php echo $data['conditions'][$i-1]["test$i"] . ' ms'; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    unset($i);
                                    unset($size);
                                    ?>
                                    </tbody>
                                </table>
                                <h2>Counting Loop: for() vs. while()</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    $size = getArraySize($data['countingLoops']);
                                    while ($i <= $size){ ?>
                                        <tr class="<?php echo $data['countingLoops'][$i-1]["class$i"]; ?>">
                                            <td><?php echo $data['countingLoops'][$i-1]["nr$i"]; ?></td>
                                            <td><?php echo $data['countingLoops'][$i-1]["name$i"]; ?></td>
                                            <td><?php echo $data['countingLoops'][$i-1]["test$i"] . ' ms'; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    unset($i);
                                    unset($size);
                                    ?>
                                    </tbody>
                                </table>
                                <h2>Read Loop: foreach() vs. for()</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    $size = getArraySize($data['readLoop']);
                                    while ($i <= $size){ ?>
                                        <tr class="<?php echo $data['readLoop'][$i-1]["class$i"]; ?>">
                                            <td><?php echo $data['readLoop'][$i-1]["nr$i"]; ?></td>
                                            <td><?php echo $data['readLoop'][$i-1]["name$i"]; ?></td>
                                            <td><?php echo $data['readLoop'][$i-1]["test$i"] . ' ms'; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    unset($i);
                                    unset($size);
                                    ?>
                                    </tbody>
                                </table>
                                <h2>Write Loop: for() vs. while()</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    $size = getArraySize($data['writeLoop']);
                                    while ($i <= $size){ ?>
                                        <tr class="<?php echo $data['writeLoop'][$i-1]["class$i"]; ?>">
                                            <td><?php echo $data['writeLoop'][$i-1]["nr$i"]; ?></td>
                                            <td><?php echo $data['writeLoop'][$i-1]["name$i"]; ?></td>
                                            <td><?php echo $data['writeLoop'][$i-1]["test$i"] . ' ms'; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    unset($i);
                                    unset($size);
                                    ?>
                                    </tbody>
                                </table>
                                <h2>Modify Loop: foreach() vs. for()</h2>
                                <table class="table benchmark">
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    $size = getArraySize($data['modifyLoop']);
                                    while ($i <= $size){ ?>
                                        <tr class="<?php echo $data['modifyLoop'][$i-1]["class$i"]; ?>">
                                            <td><?php echo $data['modifyLoop'][$i-1]["nr$i"]; ?></td>
                                            <td><?php echo $data['modifyLoop'][$i-1]["name$i"]; ?></td>
                                            <td><?php echo $data['modifyLoop'][$i-1]["test$i"] . ' ms'; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    unset($i);
                                    unset($size);
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/4-footer.php'; ?>
<?php require APPROOT . '/views/inc/5-cookies.php'; ?>
