<?php require APPROOT . '/views/inc/header.php'; ?>
    <div id="nav">
        <?php require APPROOT . '/views/inc/nav/nav-top.php'; ?>
        <?php require APPROOT . '/views/inc/nav/nav-top-costs.php'; ?>
    </div>
    <div id="wrapper">
        <h1><?php echo $data['title']; ?></h1>
        <?php flash('costs_success'); ?>
        <?php flash('costs_failed'); ?>
        <div id="costsNewEditDelete">
            <!-- Table New Edit Delete ? -->
            <div class="table-responsive">
                <form action="<?php echo URLROOT; ?>/costs/new_edit_delete" method="post">
                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="15">Results: <?php echo $data['costs_search'][0]->rowCount; ?></th>
                            <th><button class="btn btn-block" href="<?php echo URLROOT; ?>/costs/new_edit_delete">Reset</button></th>
                        </tr>
                        <tr>
                            <th style="width: 120px">
                                <input type="text" name="costsPrice"
                                       class="form-control form-control-lg <?php echo (!empty($data['costsPrice_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['costsPrice']; ?>" placeholder="Price"
                                       id="costsPrice">
                                <span class="invalid-feedback"><?php echo $data['costsPrice_err']; ?></span>
                            </th>
                            <th style="width: 270px">
                                <input type="text" name="costsTitle"
                                       class="form-control  form-control-lg <?php echo (!empty($data['costsTitle_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['costsTitle']; ?>" placeholder="Title"
                                       id="costsTitle">
                                <span class="invalid-feedback"><?php echo $data['costsTitle_err']; ?></span>
                            </th>
                            <th style="width: 90px">
                                <input type="number" name="costsYear"
                                       class="form-control  form-control-lg <?php echo (!empty($data['costsYear_err'])) ? 'is-invalid' : ''; ?>"
                                       value="<?php echo $data['costsYear']; ?>"
                                       placeholder="Year" id="costsYear">
                                <span class="invalid-feedback"><?php echo $data['costsYear_err']; ?></span>
                            </th>
                            <th colspan="6">
                                <select name="costsMonth" class="form-control">
                                    <option></option>
                                    <option>01 January</option>
                                    <option>02 February</option>
                                    <option>03 March</option>
                                    <option>04 April</option>
                                    <option>05 May</option>
                                    <option>06 June</option>
                                    <option>07 July</option>
                                    <option>08 August</option>
                                    <option>09 September</option>
                                    <option>10 October</option>
                                    <option>11 November</option>
                                    <option>12 December</option>
                                </select>
                                <span class="invalid-feedback"><?php echo $data['costsMonth_err']; ?></span>
                            </th>
                            <th colspan="6">
                                <select name="costsStatus" class="form-control">
                                    <option></option>
                                    <option>paid</option>
                                    <option>not paid</option>
                                    <option>free</option>
                                </select>
                                <span class="invalid-feedback"><?php echo $data['costsStatus_err']; ?></span>
                            </th>
                            <th>
                                <input name="submitNewUpdate" type="submit" value="New/Update"
                                       class="btn btn-primary btn-block">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
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
                                    <td><?php echo $costs->price; ?></td>
                                    <td><?php echo $costs->title; ?></td>
                                    <td><?php echo $costs->year; ?></td>
                                    <td><?php if ($costs->january == 'paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                        <?php } elseif ($costs->january == 'not paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                        <?php } elseif ($costs->january == 'free') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                        <?php } ?>
                                    </td>
                                    <td><?php if ($costs->february == 'paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                        <?php } elseif ($costs->february == 'not paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                        <?php } elseif ($costs->february == 'free') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                        <?php } ?>
                                    </td>
                                    <td><?php if ($costs->march == 'paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                        <?php } elseif ($costs->march == 'not paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                        <?php } elseif ($costs->march == 'free') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                        <?php } ?>
                                    </td>
                                    <td><?php if ($costs->april == 'paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                        <?php } elseif ($costs->april == 'not paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                        <?php } elseif ($costs->april == 'free') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                        <?php } ?></td>
                                    <td><?php if ($costs->may == 'paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                        <?php } elseif ($costs->may == 'not paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                        <?php } elseif ($costs->may == 'free') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                        <?php } ?>
                                    </td>
                                    <td><?php if ($costs->june == 'paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                        <?php } elseif ($costs->june == 'not paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                        <?php } elseif ($costs->june == 'free') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                        <?php } ?>
                                    </td>
                                    <td><?php if ($costs->july == 'paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                        <?php } elseif ($costs->july == 'not paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                        <?php } elseif ($costs->july == 'free') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                        <?php } ?>
                                    </td>
                                    <td><?php if ($costs->august == 'paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                        <?php } elseif ($costs->august == 'not paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                        <?php } elseif ($costs->august == 'free') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                        <?php } ?>
                                    </td>
                                    <td><?php if ($costs->september == 'paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                        <?php } elseif ($costs->september == 'not paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                        <?php } elseif ($costs->september == 'free') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                        <?php } ?>
                                    </td>
                                    <td><?php if ($costs->october == 'paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                        <?php } elseif ($costs->october == 'not paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                        <?php } elseif ($costs->october == 'free') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                        <?php } ?>
                                    </td>
                                    <td><?php if ($costs->november == 'paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                        <?php } elseif ($costs->november == 'not paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                        <?php } elseif ($costs->november == 'free') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                        <?php } ?>
                                    </td>
                                    <td><?php if ($costs->december == 'paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/checked24x24.png">
                                        <?php } elseif ($costs->december == 'not paid') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/unchecked24x24.png">
                                        <?php } elseif ($costs->december == 'free') { ?>
                                            <img src="<?php echo URLROOT; ?>/img/icon/free24x24.png">
                                        <?php } ?>
                                    </td>
                                    <td><img style="width: 16px; height: 16px"
                                             src="<?php echo URLROOT; ?>/img/icon/delete24x24.png"
                                             class="cpm__img tile__img img-responsive"
                                             onclick='costsDeleteRow(<?php echo jsonEncode($costs); ?>)'>
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
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>