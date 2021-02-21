<div id="load_blog_box">
    <div id="load_blog_divs">
        <div id="all-page-content" class="container">
            <div class="row" id="results">
                <?php
                if ($data['blog_id'] != null) {
                    for ($i = 0; $i < count($data['blog_id']); $i++) {
                        // display from 1, 2, 3 or max 4 divs in a row 
                ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <a href="<?php echo URLROOT . '/index/' . $data['blog_id'][$i]; ?>">
                                <img class="article_main_img" src="<?php echo PUBLIC_CORE_IMG_PREVIEWURL . '/' . $data['blog_preview_image'][$i]; ?>">
                            </a>
                            <div class="img-rank-block">
                                <span>
                                    <?php for ($article_rank = $data['blog_rank'][$i]; $article_rank > 0; $article_rank--) { ?>
                                        <i class="fa fa-star"></i>
                                    <?php } ?>
                                </span>
                            </div>
                            <div class="img-text-block">
                                <h4><?php if (isset($data['blog_category'][$i])) {
                                        echo $data['blog_category'][$i];
                                    } ?></h4>
                                <p><?php echo $data['blog_title'][$i]; ?></p>
                            </div>
                            <div class="img-text-clicked" style="color:
                            <?php
                            if (isset($_SESSION['user_role'])) {
                                if ($data['blog_observe_permissions'][$i] === $_SESSION['user_email']) {
                                    echo "#ff7f50";
                                } else if ($data['blog_observe_permissions'][$i] === 'Admins') {
                                    echo "#f1f227";
                                } else if ($data['blog_observe_permissions'][$i] === 'RegisteredUsers') {
                                    echo "#98fb98";
                                }
                            }
                            ?>;">
                                <span>
                                    <i class="fa fa-eye"></i> <?php echo number_format($data['blog_views'][$i], 0, ",", '.'); ?>
                                </span>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>