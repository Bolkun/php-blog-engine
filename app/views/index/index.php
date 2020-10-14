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
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <textarea class="tinymce" name="blog_ta_tinymce">
                                        <?php echo $data['blog_content']; ?>
                                    </textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="blog_observe_permissions">Observe Permissions</label>
                                    <select id="blog_observe_permissions" name="blog_observe_permissions" class="form-control">
                                        <option><?php echo $_SESSION['user_email']; ?></option>
                                        <option><?php echo 'Admins'; ?></option>
                                        <option><?php echo 'RegisteredUsers'; ?></option>
                                        <option><?php echo 'All'; ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="blog_rank">Rank</label>
                                    <select id="blog_rank" name="blog_rank" class="form-control">
                                        <option>5</option>
                                        <option>4</option>
                                        <option>3</option>
                                        <option>2</option>
                                        <option>1</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="blog_category">Category</label>
                                    <input id="blog_category" type="text" name="blog_category"
                                           class="form-control <?php echo (!empty($data['blog_category_err'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $data['blog_category']; ?>" placeholder="Category">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="blog_title">Title</label>
                                    <input id="blog_title" type="text" name="blog_title"
                                           class="form-control <?php echo (!empty($data['blog_title_err'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $data['blog_title']; ?>" placeholder="Title">
                                </div>
                                <div class="form-group col-md-6">
                                    <!-- RAgio choice -->
                                    <label for="blog_preview_image" style="padding-right: 5px;">Preview Image: </label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input id="blog_server_preview_image" onclick="displayBlogServerPreviewImageDiv()" type="radio" class="custom-control-input" name="optradio" checked>
                                        <label class="custom-control-label" for="blog_server_preview_image">Existing</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input id="blog_local_preview_image" onclick="displayBlogLocalPreviewImageDiv()" type="radio" class="custom-control-input" name="optradio">
                                        <label class="custom-control-label" for="blog_local_preview_image">New</label>
                                    </div>
                                    <!-- Server -->
                                    <div id="blog_preview_image_server_div" class="custom-file">
                                        <input id="blog_preview_image_server" type="button" name="blog_preview_image_server"
                                               class="form-control <?php echo (!empty($data['blog_preview_image_err'])) ? 'is-invalid' : ''; ?>"
                                               value="<?php echo $data['blog_preview_image']; ?>" data-toggle="modal" data-target="#blog_preview_images_list">
                                        <!-- Modal -->
                                        <div class="modal fade" id="blog_preview_images_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Preview images</h5>
                                                        <button id="close_blog_preview_images_list" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div id="blog_preview_images_list_modal_body" class="modal-body">
                                                        <div class="row">
                                                        <?php for ($p = 0; $p < 144; $p++) { $file = "min$p.png";?>
                                                            <div class="col-sm-2">
                                                                <img onclick='selectedPreviewImage(<?php echo jsonSelectedPreviewImage(NULL, $file); ?>)' class="blog_preview_img" src="<?php echo PUBLIC_CORE_IMG_PREVIEWURL  . '/default_blog_page-min.png'; ?>">
                                                            </div>
                                                        <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <!-- Local -->
                                    <div style="display: none;" id="blog_preview_image_local_div" class="custom-file">
                                        <input id="blog_preview_image" type="file" name="blog_preview_image_local" accept="image/*"
                                               class="custom-file-input <?php echo (!empty($data['blog_preview_image_err'])) ? 'is-invalid' : ''; ?>">
                                        <label id="custom-file-label_blog_preview_image" class="custom-file-label" for="blog_preview_image">
                                            Browse
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <input id="submitTinyMCEContent" name="submit_blog_ta_tinymce" type="submit" value="Save" class="btn btn-success btn-block">
                                </div>
                            </div>
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
                                        <img class="article_main_img" src="<?php echo PUBLIC_CORE_IMG_PREVIEWURL . '/' . $data['blog_preview_image'][$i]; ?>">
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
                                                 echo "#ff7f50";
                                             } else if ($data['blog_observe_permissions'][$i] === 'Admins') {
                                                 echo "#f1f227";
                                             } else if ($data['blog_observe_permissions'][$i] === 'RegisteredUsers') {
                                                 echo "#98fb98";
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
                                        <img class="article_main_img" src="<?php echo PUBLIC_CORE_IMG_PREVIEWURL  . '/' . $data['blog_preview_image'][$i]; ?>">
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
                                                echo "#ff7f50";
                                            } else if ($data['blog_observe_permissions'][$i] === 'Admins') {
                                                echo "#f1f227";
                                            } else if ($data['blog_observe_permissions'][$i] === 'RegisteredUsers') {
                                                echo "#98fb98";
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
