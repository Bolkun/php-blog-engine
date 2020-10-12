<?php require APPROOT . '/views/inc/1-header.php'; ?>
<?php require APPROOT . '/views/inc/2-nav-top-user.php'; ?>
<?php require APPROOT . '/views/inc/3-nav-top-admin.php'; ?>
<br><br><br>
<div id="load_blog_box">
    <div id="load_blog_divs">
        <?php if(is_numeric($data['url_param']) && $data['url_param'] != '0'){ ?>
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
        <?php } elseif($data['url_param'] == '0' || $data['url_param'] === 'index'){ ?>
            <div class="container scrollpane">
                <div class="row" id="results">
                    <?php
                        for ($i = 0; $i < count($data['blog_created_by_user_id']); $i++) {
                            if ($i === 0 || $i === 1) {
                                // display 2 divs in a row ?>
                                <div class="col-lg-6">
                                    <a href="<?php echo URLROOT . '/' . $data['blog_id'][$i]; ?>">
                                        <img class="article_main_img" src="<?php echo PUBLIC_CORE_IMGURL . '/' . $data['blog_preview_image'][$i]; ?>">
                                    </a>
                                    <div class="img-rank-block">
                                        <span class="col-lg-6_p">
                                            <?php for ($article_rank = $data['blog_rank'][$i]; $article_rank > 0; $article_rank--) { ?>
                                                <i class="fa fa-star"></i>
                                            <?php } ?>
                                        </span>
                                    </div>
                                    <div class="img-text-block">
                                        <h2><?php echo $data['blog_category'][$i]; ?></h2>
                                        <p class="col-lg-6_p"><?php echo $data['blog_title'][$i]; ?></p>
                                    </div>
                                    <div class="img-text-clicked" style="color:
                                    <?php
                                         if(isset($_SESSION['user_role'])) {
                                             if ($data['blog_observe_permissions'][$i] === $_SESSION['user_email']) {
                                                 echo "red";
                                             } else if ($data['blog_observe_permissions'][$i] === 'Admins') {
                                                 echo "yellow";
                                             } else if ($data['blog_observe_permissions'][$i] === 'RegisteredUsers') {
                                                 echo "#76b901";
                                             }
                                         }
                                    ?>;">
                                        <span class="col-lg-6_p">
                                            <i class="fa fa-eye"></i> <?php echo number_format($data['blog_views'][$i], 0, ",", '.'); ?>
                                        </span>
                                    </div>
                                </div>
                                <?php
                            } else {
                                // display 4 divs in a row ?>
                                <div class="col-lg-3">
                                    <a href="<?php echo URLROOT . '/' . $data['blog_id'][$i]; ?>">
                                        <img class="article_main_img" src="<?php echo PUBLIC_CORE_IMGURL  . '/' . $data['blog_preview_image'][$i]; ?>">
                                    </a>
                                    <div class="img-rank-block">
                                        <span class="col-lg-3_p">
                                            <?php for ($article_rank = $data['blog_rank'][$i]; $article_rank > 0; $article_rank--) { ?>
                                                <i class="fa fa-star"></i>
                                            <?php } ?>
                                        </span>
                                    </div>
                                    <div class="img-text-block">
                                        <h4><?php echo $data['blog_category'][$i]; ?></h4>
                                        <p><?php echo $data['blog_title'][$i]; ?></p>
                                    </div>
                                    <div class="img-text-clicked" style="color:
                                    <?php
                                        if(isset($_SESSION['user_role'])) {
                                            if ($data['blog_observe_permissions'][$i] === $_SESSION['user_email']) {
                                                echo "red";
                                            } else if ($data['blog_observe_permissions'][$i] === 'Admins') {
                                                echo "yellow";
                                            } else if ($data['blog_observe_permissions'][$i] === 'RegisteredUsers') {
                                                echo "#76b901";
                                            }
                                        }
                                    ?>;">
                                        <span class="col-lg-3_p">
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
        <?php } ?>
    </div>
</div>
<?php require APPROOT . '/views/inc/4-footer.php'; ?>
<?php require APPROOT . '/views/inc/5-cookies.php'; ?>
