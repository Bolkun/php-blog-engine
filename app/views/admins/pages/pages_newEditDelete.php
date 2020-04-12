<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div id="wrapper">
                    <h1><?php echo $data['title']; ?></h1>
                    <div id="message"><?php flash('pages'); ?></div>
                    <div id="views_admins_pages_newEditDelete">
                        <form action="<?php echo $GLOBALS['sACTUAL_LINK']; ?>" method="post">
                            <table id="tablePages" class="table">
                                <thead>
                                <tr>
                                    <th id="pagesCount" colspan="3">Results: <?php echo $data['iPagesCount']; ?></th>
                                    <th>
                                        <button class="btn btn-block" href="<?php echo $GLOBALS['sACTUAL_LINK']; ?>">
                                            Reset
                                        </button>
                                    </th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>
                                        <input type="text" name="pagesPath"
                                               class="form-control <?php echo (!empty($data['pagesPath_err'])) ? 'is-invalid' : ''; ?>"
                                               value="<?php echo $data['pagesPath']; ?>" placeholder="Path"
                                               onkeyup='pagesPathtoPagesLink(<?php echo jsonEncode(); ?>)'
                                               id="pagesPath">
                                        <span class="invalid-feedback"><?php echo $data['pagesPath_err']; ?></span>
                                    </th>
                                    <th>
                                        <input type="text" name="pagesLink"
                                               class="form-control  <?php echo (!empty($data['pagesLink_err'])) ? 'is-invalid' : ''; ?>"
                                               value="<?php echo $data['pagesLink']; ?>" placeholder="Link" readonly
                                               id="pagesLink">
                                        <span class="invalid-feedback"><?php echo $data['pagesLink_err']; ?></span>
                                    </th>
                                    <th>
                                        <input name="submitNewPage" type="submit" value="New"
                                               class="btn btn-primary btn-block">
                                    </th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Path</th>
                                    <th>Link</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                // get first folder
                                $aDir = array();
                                for ($i = 0; $i < $data['iPagesCount']; $i++) {
                                    // (1) delete  URLROOT
                                    $link = str_replace(URLROOT . '/', '', $data['aPagesLinks'][$i]);
                                    // (2) grep folder (everything till first forward slash)
                                    preg_match('/^([^\/]+)/', $link, $matches_in_dir);
                                    array_push($aDir, $matches_in_dir[0]);
                                }
                                // fill colors
                                $class1 = 'background-color: rgba(0, 0, 0, 0.05);';
                                $class2 = '';
                                $class = $class1;
                                $aDirClass = array();
                                $aDirUnique = array_unique($aDir);  // keys are different, [0] [3] [8]
                                foreach($aDirUnique as $key1 => $val1){
                                    foreach($aDir as $key2 => $val2){
                                        if($aDirUnique[$key1] === $aDir[$key2]){
                                            array_push($aDirClass, $class);
                                            unset($aDir[$key2]);
                                        } else {
                                            break;
                                        }
                                    }
                                    if($class === $class1){
                                        $class = $class2;
                                    } elseif ($class === $class2){
                                        $class = $class1;
                                    }
                                }

                                for ($i = 0; $i < $data['iPagesCount']; $i++) {
                                    ?>
                                    <tr style="<?php echo $aDirClass[$i]; ?>">
                                        <td><?php echo $i + 1; ?></td>
                                        <td style="cursor: copy;" onclick="copyPath(this)">
                                            <?php echo $data['aPagesPaths'][$i]; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo $data['aPagesLinks'][$i]; ?>"><?php echo $data['aPagesLinks'][$i]; ?></a>
                                        </td>
                                        <td><img style="width: 16px; height: 16px"
                                                 src="<?php echo URLROOT; ?>/img/icon/delete24x24.png"
                                                 class="cpm__img tile__img img-responsive"
                                                 onclick='costsDeleteRow(<?php echo jsonEncode($costs); ?>)'>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <script>
                                // Autofill Link
                                function pagesPathtoPagesLink(values) {
                                    var linkRoot = values['URLROOT'];
                                    var viewsRoot = values['VIEWSROOT'];
                                    var pagesPath = $("#pagesPath").val();
                                    pagesPath = pagesPath.replace(viewsRoot, '');  // replace 'C:\xampp\htdocs\bolkun\app\views' with ''
                                    pagesPath = pagesPath.replace(/\\/g, '\/');    // replace '\' with '/'
                                    pagesPath = pagesPath.replace('/index.php', '');
                                    pagesPath = pagesPath.replace('.php', '');
                                    $("#pagesLink").val(linkRoot + pagesPath);

                                    // searchable table
                                    var search = $('#pagesPath').val().toLowerCase();
                                    $("#tablePages tbody tr").filter(function () {
                                        $(this).toggle($(this).text().toLowerCase().indexOf(search) > -1)
                                    });
                                }

                                // Copy Path
                                function copyPath(that) {
                                    var inp = document.createElement('input');
                                    document.body.appendChild(inp);
                                    inp.value = that.textContent;
                                    inp.select();
                                    document.execCommand('copy', false);
                                    inp.remove();

                                    // copy to input path
                                    $("#pagesPath").val(that.textContent.trim());
                                    // copy next td to input link
                                    var link = $(that).closest('td').next('td').text().trim();
                                    $("#pagesLink").val(link);

                                    // searchable table
                                    var search = $('#pagesPath').val().toLowerCase();
                                    $("#tablePages tbody tr").filter(function () {
                                        $(this).toggle($(this).text().toLowerCase().indexOf(search) > -1)
                                    });
                                }
                            </script>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>