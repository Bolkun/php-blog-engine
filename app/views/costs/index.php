<?php require APPROOT . '/views/inc/header.php'; ?>
    <div id="nav">
        <?php require APPROOT . '/views/inc/nav/nav-top-costs.php'; ?>
    </div>
    <div class="container">
        <div class="row">
            <div id="wrapper">
                <h1><?php echo $data['title']; ?></h1>
                <div id="costsView">
                    <!-- Table View 2020 -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Results: <?php echo $data['costs_current_year'][0]->rowCount; ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th><?php echo $data['current_year']; ?></th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
                                <th>9</th>
                                <th>10</th>
                                <th>11</th>
                                <th>12</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Nr</td>
                                <td>Price</td>
                                <td>Title</td>
                                <td>Jan</td>
                                <td>Feb</td>
                                <td>Mar</td>
                                <td>Apr</td>
                                <td>May</td>
                                <td>Jun</td>
                                <td>Jul</td>
                                <td>Aug</td>
                                <td>Sep</td>
                                <td>Oct</td>
                                <td>Nov</td>
                                <td>Dec</td>
                            </tr>
                            <?php
                            if ($data['costs_current_year'][0]->rowCount > 0) {
                                foreach ($data['costs_current_year'] as $costs) { ?>
                                    <tr>
                                        <td><?php echo $costs->rowNumber; ?></td>
                                        <td><?php echo $costs->price; ?></td>
                                        <td><?php echo $costs->title; ?></td>
                                        <td><?php if($costs->january == 'paid'){ ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->january == 'not paid'){ ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->january == 'free'){ ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->february == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->february == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->february == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->march == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->march == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->march == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->april == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->april == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->april == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?></td>
                                        <td><?php if($costs->may == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->may == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->may == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->june == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->june == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->june == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->july == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->july == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->july == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->august == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->august == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->august == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->september == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->september == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->september == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->october == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->october == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->october == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->november == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->november == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->november == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->december == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->december == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->december == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else { ?>
                                <tr>
                                    <td colspan="100%">No data found.</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Table View 2019 -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Results: <?php echo $data['costs_last_year'][0]->rowCount; ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th><?php echo $data['last_year']; ?></th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
                                <th>9</th>
                                <th>10</th>
                                <th>11</th>
                                <th>12</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Nr</td>
                                <td>Price</td>
                                <td>Title</td>
                                <td>Jan</td>
                                <td>Feb</td>
                                <td>Mar</td>
                                <td>Apr</td>
                                <td>May</td>
                                <td>Jun</td>
                                <td>Jul</td>
                                <td>Aug</td>
                                <td>Sep</td>
                                <td>Oct</td>
                                <td>Nov</td>
                                <td>Dec</td>
                            </tr>
                            <?php
                            if ($data['costs_last_year'][0]->rowCount > 0) {
                                foreach ($data['costs_last_year'] as $costs) { ?>
                                    <tr>
                                        <td><?php echo $costs->rowNumber; ?></td>
                                        <td><?php echo $costs->price; ?></td>
                                        <td><?php echo $costs->title; ?></td>
                                        <td><?php if($costs->january == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->january == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->january == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->february == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->february == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->february == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->march == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->march == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->march == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->april == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->april == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->april == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?></td>
                                        <td><?php if($costs->may == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->may == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->may == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->june == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->june == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->june == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->july == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->july == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->july == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->august == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->august == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->august == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->september == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->september == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->september == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->october == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->october == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->october == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->november == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->november == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->november == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php if($costs->december == 'paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                            <?php } elseif ($costs->december == 'not paid'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                            <?php } elseif ($costs->december == 'free'){ ?>
                                                <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else { ?>
                                <tr>
                                    <td colspan="100%">No data found.</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div></div>
<?php require APPROOT . '/views/inc/footer.php'; ?>