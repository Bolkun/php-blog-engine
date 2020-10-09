<?php require APPROOT . '/views/inc/1-header.php'; ?>
<?php require APPROOT . '/views/inc/2-nav-top-user.php'; ?>
<?php require APPROOT . '/views/inc/3-nav-top-admin.php'; ?>
<br><br><br>
<?php if ($data['blog_title'] !== 0 && $data['blog_title'] !== 'index') { ?>
    <div class="container">
        <div class="row" style="margin-top: -6px; z-index: -1;">
            <?php if (isAdminLoggedIn() === true) { ?>
                <form style="z-index: 0;" class="form-inline" action="<?php echo URLCURRENT; ?>/index" method="post">
                    <textarea class="tinymce" name="blog_ta_tinymce">
                        <?php echo $data['blog_content']; ?>
                    </textarea>
                    <input id="submitTinyMCEContent" name="submit_blog_ta_tinymce" type="submit" value="Save" class="btn btn-success btn-block">
                </form>
            <?php } //else { ?>
                <div id="tinymce_data">
                    <?php echo $data['blog_content']; ?>
                </div>
            <?php// }  ?>
        </div>
    </div>
<?php } else { ?>
    <div class="container scrollpane">
        <div class="row" id="results">
            <?php
            $article_count = 0;
            for ($i = 0; $i < 2; $i++) {
                if ($i % 2 == 0) {
                    // display 2 divs in a row
                    for ($j = 0; $j < 2; $j++) {
                        ?>
                        <div class="col-lg-6">
                            <img class="article_main_img"
                                 src="<?php echo PUBLIC_CORE_IMGURL . '/default_blog_page-min.png'; ?>"
                                 data-toggle="modal" data-target="#articleModal_<?php echo $article_count; ?>">
                            <div class="img-rank-block">
                                <p class="col-lg-6_p">
                                    <?php for ($article_rank = 5; $article_rank > 0; $article_rank--) { ?>
                                        <i class="fa fa-star"></i>
                                    <?php } ?>
                                </p>
                            </div>
                            <div class="img-text-block">
                                <h2>Nature</h2>
                                <p class="col-lg-6_p">What a beautiful sunrise, and still be yourself</p>
                            </div>
                            <div class="img-text-clicked">
                                <p class="col-lg-6_p">
                                    <i class="fa fa-eye"></i> 1.299.345
                                </p>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="articleModal_<?php echo $article_count;
                        $article_count++; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
                             aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>What a beautiful sunrise, and still be yourself</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                // display 4 divs in a row
                for ($j = 0; $j < 4; $j++) {
                    ?>
                    <div class="col-lg-3">
                        <img class="article_main_img" src="<?php echo PUBLIC_CORE_IMGURL . '/default_blog_page-min.png'; ?>"
                             data-toggle="modal"
                             data-target="#articleModal_<?php echo $article_count; ?>">
                        <div class="img-rank-block">
                            <p>
                                <?php for ($article_rank = 5; $article_rank > 0; $article_rank--) { ?>
                                    <i class="fa fa-star"></i>
                                <?php } ?>
                            </p>
                        </div>
                        <div class="img-text-block">
                            <h4>Nature</h4>
                            <p>What a beautiful sunrise, and still be yourself.</p>
                        </div>
                        <div class="img-text-clicked">
                            <p>
                                <i class="fa fa-eye"></i> 999.345
                            </p>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="articleModal_<?php echo $article_count;
                    $article_count++; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } ?>
        </div>
    </div>
<?php } ?>
<?php require APPROOT . '/views/inc/4-footer.php'; ?>
<?php require APPROOT . '/views/inc/5-cookies.php'; ?>
