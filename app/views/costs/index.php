<?php require APPROOT . '/views/inc/header.php'; ?>
    <div id="nav">
        <?php require APPROOT . '/views/inc/nav/nav-top.php'; ?>
    </div>
    <div id="wrapper">
        <h1><?php echo $data['title']; ?></h1>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#costsView">View</a></li>
            <li><a data-toggle="tab" href="#costsSearch">Search</a></li>
            <li><a data-toggle="tab" href="#costsNewEdit">New/Edit/Delete</a></li>
        </ul>
        <div class="tab-content">
            <div id="costsView" class="tab-pane fade in active">
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
                        </tr>
                        <tr>
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
                                    <td><?php echo $costs->price; ?></td>
                                    <td><?php echo $costs->title; ?></td>
                                    <td><?php echo $costs->january; ?></td>
                                    <td><?php echo $costs->february; ?></td>
                                    <td><?php echo $costs->march; ?></td>
                                    <td><?php echo $costs->april; ?></td>
                                    <td><?php echo $costs->may; ?></td>
                                    <td><?php echo $costs->june; ?></td>
                                    <td><?php echo $costs->july; ?></td>
                                    <td><?php echo $costs->august; ?></td>
                                    <td><?php echo $costs->september; ?></td>
                                    <td><?php echo $costs->october; ?></td>
                                    <td><?php echo $costs->november; ?></td>
                                    <td><?php echo $costs->december; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<p>No data found.</p>';
                        } ?>
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
                        </tr>
                        <tr>
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
                                    <td><?php echo $costs->price; ?></td>
                                    <td><?php echo $costs->title; ?></td>
                                    <td><?php echo $costs->january; ?></td>
                                    <td><?php echo $costs->february; ?></td>
                                    <td><?php echo $costs->march; ?></td>
                                    <td><?php echo $costs->april; ?></td>
                                    <td><?php echo $costs->may; ?></td>
                                    <td><?php echo $costs->june; ?></td>
                                    <td><?php echo $costs->july; ?></td>
                                    <td><?php echo $costs->august; ?></td>
                                    <td><?php echo $costs->september; ?></td>
                                    <td><?php echo $costs->october; ?></td>
                                    <td><?php echo $costs->november; ?></td>
                                    <td><?php echo $costs->december; ?></td>
                                </tr>
                                <?php
                            }
                        } else { ?>
                            <tr>
                                <td colspan="14">No data found.</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="costsSearch" class="tab-pane fade">
                <!-- Table Search ? -->
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
                            <th></th>
                        </tr>
                        <tr>
                            <th style="width: 120px"><input type="text" class="form-control" placeholder="Price" id="costsSearch"></th>
                            <th style="width: 270px"><input type="text" class="form-control" placeholder="Title" id="costsYear"></th>
                            <th><input style="width: 60px" type="text" class="form-control" placeholder="<?php echo $data['current_year']; ?>" id="costsYear"></th>
                            <th><input type="checkbox" value=""></th>
                            <th><input type="checkbox" value=""></th>
                            <th><input type="checkbox" value=""></th>
                            <th><input type="checkbox" value=""></th>
                            <th><input type="checkbox" value=""></th>
                            <th><input type="checkbox" value=""></th>
                            <th><input type="checkbox" value=""></th>
                            <th><input type="checkbox" value=""></th>
                            <th><input type="checkbox" value=""></th>
                            <th><input type="checkbox" value=""></th>
                            <th><input type="checkbox" value=""></th>
                            <th><input type="checkbox" value=""></th>
                            <th>
                                <button type="button" class="btn btn-success">Search</button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Price</td>
                            <td>Title</td>
                            <td></td>
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
                        if ($data['costs_current_year'][0]->rowCount > 0) {
                            foreach ($data['costs_current_year'] as $costs) { ?>
                                <tr>
                                    <td><?php echo $costs->price; ?></td>
                                    <td><?php echo $costs->title; ?></td>
                                    <td></td>
                                    <td><?php echo $costs->january; ?></td>
                                    <td><?php echo $costs->february; ?></td>
                                    <td><?php echo $costs->march; ?></td>
                                    <td><?php echo $costs->april; ?></td>
                                    <td><?php echo $costs->may; ?></td>
                                    <td><?php echo $costs->june; ?></td>
                                    <td><?php echo $costs->july; ?></td>
                                    <td><?php echo $costs->august; ?></td>
                                    <td><?php echo $costs->september; ?></td>
                                    <td><?php echo $costs->october; ?></td>
                                    <td><?php echo $costs->november; ?></td>
                                    <td><?php echo $costs->december; ?></td>
                                    <td></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<p>No data found.</p>';
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="costsNewEdit" class="tab-pane fade">
                <!-- Table New/Edit/Delete ? -->
                <div class="table-responsive">
                    <form action="<?php echo URLROOT; ?>/costs" method="post">
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
                                <th></th>
                            </tr>
                            <tr>
                                <th style="width: 120px">
                                    <input type="text" name="costsPrice" class="form-control form-control-lg <?php echo (!empty($data['costsPrice_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['costsPrice']; ?>" placeholder="Price" id="costsPrice">
                                </th>
                                <th style="width: 270px">
                                    <input type="text" name="costsTitle" class="form-control  form-control-lg <?php echo (!empty($data['costsTitle_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['costsTitle']; ?>" placeholder="Title" id="costsTitle">
                                </th>
                                <th style="width: 73px">
                                    <input type="text" name="costsYear" class="form-control  form-control-lg <?php echo (!empty($data['costsYear_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['costsYear']; ?>" placeholder="<?php echo $data['costs_current_year']; ?>" id="costsYear">
                                </th>
                                <th colspan="6">
                                    <select name="costsMonth" class="form-control" id="sel1">
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
                                </th>
                                <th colspan="6">
                                    <select name="costsStatus" class="form-control" id="sel1">
                                        <option>paid</option>
                                        <option>not paid</option>
                                        <option>free</option>
                                    </select>
                                </th>
                                <th>
                                    <input name="submitNewEdit" type="submit" value="New/Edit" class="btn btn-success btn-block">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Price</td>
                                <td>Title</td>
                                <td></td>
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
                            if ($data['costs_current_year'][0]->rowCount > 0) {
                                foreach ($data['costs_current_year'] as $costs) { ?>
                                    <tr>
                                        <td><?php echo $costs->price; ?></td>
                                        <td><?php echo $costs->title; ?></td>
                                        <td></td>
                                        <td><?php echo $costs->january; ?></td>
                                        <td><?php echo $costs->february; ?></td>
                                        <td><?php echo $costs->march; ?></td>
                                        <td><?php echo $costs->april; ?></td>
                                        <td><?php echo $costs->may; ?></td>
                                        <td><?php echo $costs->june; ?></td>
                                        <td><?php echo $costs->july; ?></td>
                                        <td><?php echo $costs->august; ?></td>
                                        <td><?php echo $costs->september; ?></td>
                                        <td><?php echo $costs->october; ?></td>
                                        <td><?php echo $costs->november; ?></td>
                                        <td><?php echo $costs->december; ?></td>
                                        <td><img style="width: 16px; height: 16px" src="<?php echo URLROOT; ?>/img/icon/delete.png" class="cpm__img tile__img img-responsive"></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<p>No data found.</p>';
                            } ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>