<?php require APPROOT . '/views/inc/header.php'; ?>
    <div id="nav">
        <?php require APPROOT . '/views/inc/nav/nav-top.php'; ?>
        <?php require APPROOT . '/views/inc/nav/nav-top-costs.php'; ?>
    </div>
    <div class="container">
        <div class="row">
            <div id="wrapper">
                <h1><?php echo $data['title']; ?></h1>
                <div id="costsSearch">
                    <!-- Table Search ? -->
                    <div class="table-responsive">
                        <form action="<?php echo URLROOT; ?>/costs/search" method="post">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th colspan="16">Results: <?php echo $data['costs_search'][0]->rowCount; ?></th>
                                    <th><button class="btn btn-block" href="<?php echo URLROOT; ?>/costs/search">Reset</button></th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th style="width: 120px">
                                        <input type="text" name="costsPrice"
                                               class="form-control form-control-lg <?php echo (!empty($data['costsPrice_err'])) ? 'is-invalid' : ''; ?>"
                                               placeholder="Price" id="costsSearch" value="<?php echo $data['costsPrice']; ?>">
                                    </th>
                                    <th style="width: 270px">
                                        <input type="text" name="costsTitle"
                                               class="form-control form-control-lg <?php echo (!empty($data['costsTitle_err'])) ? 'is-invalid' : ''; ?>"
                                               placeholder="Title" id="costsTitle" value="<?php echo $data['costsTitle']; ?>">
                                    </th>
                                    <th style="width: 73px">
                                        <input type="text" name="costsYear"
                                               class="form-control form-control-lg <?php echo (!empty($data['costsYear_err'])) ? 'is-invalid' : ''; ?>"
                                               placeholder="Year" id="costsYear"
                                               value="<?php echo $data['costsYear']; ?>">
                                    </th>
                                    <th>
                                        <select name="costsJanuary" class="form-control form-control-lg">
                                            <option></option>
                                            <option>paid</option>
                                            <option>not paid</option>
                                            <option>free</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select name="costsFebruary" class="form-control form-control-lg">
                                            <option></option>
                                            <option>paid</option>
                                            <option>not paid</option>
                                            <option>free</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select name="costsMarch" class="form-control form-control-lg">
                                            <option></option>
                                            <option>paid</option>
                                            <option>not paid</option>
                                            <option>free</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select name="costsApril" class="form-control form-control-lg">
                                            <option></option>
                                            <option>paid</option>
                                            <option>not paid</option>
                                            <option>free</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select name="costsMay" class="form-control form-control-lg">
                                            <option></option>
                                            <option>paid</option>
                                            <option>not paid</option>
                                            <option>free</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select name="costsJune" class="form-control form-control-lg">
                                            <option></option>
                                            <option>paid</option>
                                            <option>not paid</option>
                                            <option>free</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select name="costsJuly" class="form-control form-control-lg">
                                            <option></option>
                                            <option>paid</option>
                                            <option>not paid</option>
                                            <option>free</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select name="costsAugust" class="form-control form-control-lg">
                                            <option></option>
                                            <option>paid</option>
                                            <option>not paid</option>
                                            <option>free</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select name="costsSeptember" class="form-control form-control-lg">
                                            <option></option>
                                            <option>paid</option>
                                            <option>not paid</option>
                                            <option>free</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select name="costsOctober" class="form-control form-control-lg">
                                            <option></option>
                                            <option>paid</option>
                                            <option>not paid</option>
                                            <option>free</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select name="costsNovember" class="form-control form-control-lg">
                                            <option></option>
                                            <option>paid</option>
                                            <option>not paid</option>
                                            <option>free</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select name="costsDecember" class="form-control form-control-lg">
                                            <option></option>
                                            <option>paid</option>
                                            <option>not paid</option>
                                            <option>free</option>
                                        </select>
                                    </th>
                                    <th>
                                        <input name="submitSearch" type="submit" value="Search" class="btn btn-success btn-block">
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Nr</td>
                                    <td>Price</td>
                                    <td>Title</td>
                                    <td>Year</td>
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
                                    <td></td>
                                </tr>
                                <?php
                                if ($data['costs_search'][0]->rowCount > 0) {
                                    foreach ($data['costs_search'] as $costs) { ?>
                                        <tr>
                                            <td><?php echo $costs->rowNumber; ?></td>
                                            <td><?php echo $costs->price; ?></td>
                                            <td><?php echo $costs->title; ?></td>
                                            <td><?php echo $costs->year; ?></td>
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
                                            <td></td>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>