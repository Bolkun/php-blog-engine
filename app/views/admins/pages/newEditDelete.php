<?php require APPROOT . '/views/inc/header.php'; ?>
    <div id="page_reload">
        <div id="page_start">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div id="wrapper">
                            <h1><?php echo $data['title']; ?></h1>
                            <div id="message"><?php flash('pages'); ?></div>
                            <div id="views_admins_pages_newEditDelete">
                                <form action="<?php echo URLCURRENT; ?>" method="post">
                                    <table id="tablePages" class="table">
                                        <thead>
                                        <tr>
                                            <th id="pagesCount" colspan="3">Results: <?php echo $data['iPagesCount']; ?></th>
                                            <th>
                                                <button class="btn btn-block" href="<?php echo URLCURRENT; ?>">
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
                                        </thead>
                                    <?php
                                        $nr = 0;
                                        $pagesFolderNext = '';
                                        $pagesFolderPrevious = '';
                                        for ($i = 0; $i < $data['iPagesCount']; $i++) {
                                            $pagesFolderNext = getViewFolder($data['aPagesPaths'][$i]);
                                            if($pagesFolderNext !== $pagesFolderPrevious){ ?>
                                                <thead>
                                                    <tr>
                                                        <th colspan="3"><?php echo $pagesFolderNext; ?></th>
                                                        <th>
                                                            <img style="width: 16px; height: 16px"
                                                                 src="<?php echo URLROOT; ?>/img/icon/delete24x24.png"
                                                                 class="cpm__img tile__img img-responsive"
                                                                 onclick='pagesDeletePage(<?php echo jsonEncodePage(NULL, VIEWSROOT . DIRECTORY_SEPARATOR . $pagesFolderNext); ?>)'>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        for ($a = 0; $a < $data['iPagesCount']; $a++) {
                                                            $pagesFolderNext2 = getViewFolder($data['aPagesPaths'][$a]);
                                                            if($pagesFolderNext === $pagesFolderNext2){ ?>
                                                                <tr>
                                                                    <td><?php echo $nr = $nr + 1; ?></td>
                                                                    <td style="cursor: copy;" onclick="copyPath(this)">
                                                                        <?php echo $data['aPagesPaths'][$a]; ?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="<?php echo $data['aPagesLinks'][$a]; ?>"><?php echo $data['aPagesLinks'][$a]; ?></a>
                                                                    </td>
                                                                    <td style="text-align:center;"><img style="width: 16px; height: 16px"
                                                                                        src="<?php echo URLROOT; ?>/img/icon/delete24x24.png"
                                                                                        class="cpm__img tile__img img-responsive"
                                                                                        onclick='pagesDeletePage(<?php echo jsonEncodePage(NULL, $data['aPagesPaths'][$a]); ?>)'>
                                                                    </td>
                                                                </tr>
                                                    <?php   }
                                                        }
                                            }
                                            $pagesFolderPrevious = $pagesFolderNext;
                                            $nr = 0;
                                        } ?>
                                                </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>