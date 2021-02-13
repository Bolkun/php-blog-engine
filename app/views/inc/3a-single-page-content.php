<div class="container">
    <div style="margin-top: -6px; z-index: -1;">
        <?php if (isAdminLoggedIn() === true) { ?>
            <form id="blog_form" style="z-index: 0;" class="form-inline"
                  action="" method="post" enctype="multipart/form-data">
                <div class="form-row" style="width: 100%;"> <!-- for responsive design -->
                    <div class="form-group col-lg-12">
                        <textarea class="tinymce_admins" name="blog_ta_tinymce">
                            <?php echo $data['blog_content']; ?>
                        </textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="blog_observe_permissions">Observe Permissions</label>
                        <select id="blog_observe_permissions" name="blog_observe_permissions"
                                class="form-control">
                            <option <?php if ($data['blog_observe_permissions'] === $_SESSION['user_email']) {
                                echo 'selected="selected"';
                            } ?>>
                                <?php echo $_SESSION['user_email']; ?>
                            </option>
                            <option <?php if ($data['blog_observe_permissions'] === 'Admins') {
                                echo 'selected="selected"';
                            } ?>>
                                <?php echo 'Admins'; ?>
                            </option>
                            <option <?php if ($data['blog_observe_permissions'] === 'RegisteredUsers') {
                                echo 'selected="selected"';
                            } ?>>
                                <?php echo 'RegisteredUsers'; ?>
                            </option>
                            <option <?php if ($data['blog_observe_permissions'] === 'All') {
                                echo 'selected="selected"';
                            } ?>>
                                <?php echo 'All'; ?>
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="blog_rank">Rank</label>
                        <select id="blog_rank" name="blog_rank" class="form-control">
                            <option <?php if ($data['blog_rank'] === '5') {
                                echo 'selected="selected"';
                            } ?>>
                                5
                            </option>
                            <option <?php if ($data['blog_rank'] === '4') {
                                echo 'selected="selected"';
                            } ?>>
                                4
                            </option>
                            <option <?php if ($data['blog_rank'] === '3') {
                                echo 'selected="selected"';
                            } ?>>
                                3
                            </option>
                            <option <?php if ($data['blog_rank'] === '2') {
                                echo 'selected="selected"';
                            } ?>>
                                2
                            </option>
                            <option <?php if ($data['blog_rank'] === '1') {
                                echo 'selected="selected"';
                            } ?>>
                                1
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="blog_category">Category</label>
                        <input id="blog_category" type="text" name="blog_category"
                               class="form-control <?php echo (!empty($data['blog_category_err'])) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $data['blog_category']; ?>" placeholder="Category">
                        <span class="invalid-feedback"><?php echo $data['blog_category_err']; ?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="blog_title">Title</label>
                        <input id="blog_title" type="text" name="blog_title"
                               class="form-control <?php echo (!empty($data['blog_title_err'])) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $data['blog_title']; ?>" placeholder="Title">
                        <span class="invalid-feedback"><?php echo $data['blog_title_err']; ?></span>
                    </div>
                    <div class="form-group col-md-12">
                        <!-- Radio choice -->
                        <label for="blog_preview_image" style="padding-right: 10px;">Preview Image: </label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="blog_server_preview_image" onclick="displayBlogServerPreviewImageDiv()"
                                   type="radio" class="custom-control-input" name="blog_radio_preview_image"
                                   value="server" checked>
                            <label class="custom-control-label" for="blog_server_preview_image">Existing</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline" data-toggle="tooltip"
                             data-placement="top" title="Recommended size 800x600">
                            <input id="blog_local_preview_image" onclick="displayBlogLocalPreviewImageDiv()"
                                   type="radio" class="custom-control-input" name="blog_radio_preview_image"
                                   value="local">
                            <label class="custom-control-label" for="blog_local_preview_image">New</label>
                        </div>
                    </div>
                    <!-- server preview image -->
                    <div id="selectedServerPreviewImageDiv" class="form-group col-md-12"
                         style="padding-top: 5px; padding-bottom: 10px;">
                        <div class="form-group col-md-2">
                            <img id="selectedServerPreviewImage" class="img-fluid article_main_img"
                                 src="<?php echo PUBLIC_CORE_IMG_PREVIEWURL . '/' . $data['blog_preview_image']; ?>">
                        </div>
                    </div>
                    <!-- local preview image -->
                    <div id="selectedLocalPreviewImageDiv" class="form-group col-md-12"
                         style="padding-top: 5px; padding-bottom: 10px; display: none;">
                        <div class="form-group col-md-2">
                            <img id="selectedLocalPreviewImage" class="img-fluid">
                        </div>
                    </div>
                    <div class="form-group col-md-6" style="padding-bottom: 78px;">
                        <!-- Server -->
                        <div id="blog_preview_image_server_div" class="custom-file">
                            <input id="blog_preview_image_server" type="text" name="blog_preview_image_server" onclick='ajax_loadPreviewImageList(<?php echo jsonEncodeURLRoot(); ?>)'
                                   class="form-control <?php echo (!empty($data['blog_preview_image_err'])) ? 'is-invalid' : ''; ?>"
                                   value="<?php echo $data['blog_preview_image']; ?>" data-toggle="modal"
                                   data-target="#blog_preview_images_list" readonly>
                            <span class="invalid-feedback"><?php echo $data['blog_preview_image_err']; ?></span>
                            <!-- Modal -->
                            <div class="modal fade" id="blog_preview_images_list" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Preview
                                                images</h5>
                                            <button id="close_blog_preview_images_list" type="button"
                                                    class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div id="blog_preview_images_list_modal_body" class="modal-body">
                                            <div id="blog_preview_images_list_load">
                                                <div id="blog_preview_images_list_load_content">
                                                    <div id="preview_images_message"><?php flash('preview_images'); ?></div>
                                                    <div class="row">
                                                        <?php for ($p = 0; $p < count($data['preview_image_list']); $p++) { ?>
                                                            <div class="col-sm-2">
                                                                <img style="border: 1px solid rgba(0, 0, 0, 0.5);"
                                                                     onclick='selectedPreviewImage(<?php echo jsonSelectedPreviewImage(NULL, $data['preview_image_list'][$p]); ?>)'
                                                                     class="blog_preview_img"
                                                                     src="<?php echo PUBLIC_CORE_IMG_PREVIEWURL . '/' . $data['preview_image_list'][$p]; ?>">
                                                                <?php if (DEFAULT_PREVIEW_IMAGE !== $data['preview_image_list'][$p]) { ?>
                                                                    <div class="img-trash"
                                                                         onclick='ajax_deletePreviewImage(<?php echo jsonSelectedPreviewImage(NULL, $data['preview_image_list'][$p]); ?>)'>
                                                                            <span>
                                                                                <i class="fa fa-trash-o"></i>
                                                                            </span>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Local -->
                        <div style="display: none;" id="blog_preview_image_local_div" class="custom-file">
                            <input id="blog_preview_image" onchange="selectedUploadPreviewImage(this)"
                                   type="file" name="blog_preview_image_local"
                                   accept="image/.jpg,.png,.jpeg,.gif,.svg"
                                   class="custom-file-input <?php echo (!empty($data['blog_preview_image_err'])) ? 'is-invalid' : ''; ?>">
                            <label id="custom-file-label_blog_preview_image" class="custom-file-label"
                                   for="blog_preview_image">Browse</label>
                            <span class="invalid-feedback"><?php echo $data['blog_preview_image_err']; ?></span>
                        </div>
                    </div>
                    <div id="single_page_footer" class="form-group col-md-12 bg-dark navbar-dark">
                        <div class="container center">
                            <input id="submitTinyMCEContent" name="submit_blog_ta_tinymce" type="submit" value="Save" class="btn btn-success">
                        </div>
                    </div>
                    
                </div>
            </form>
        <?php } ?>
        <div class="form-group col-xs-12">
            <div id="tinymce_data" style="<?php if (isAdminLoggedIn()) { echo 'display: none'; } ?>">
                <?php
                    if (!isAdminLoggedIn()) { 
                        echo $data['blog_content'];
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo PUBLIC_CORE_JSURL . '/zoom-images/zoom-images.js'; ?>"></script>
<?php
if (isAdminLoggedIn() === true) {
    echo '<script src="' . PUBLIC_CORE_JSURL . '/tinymce/1.tinymce.min.js' . '"></script>' . "\n";
    echo '<script src="' . PUBLIC_CORE_JSURL . '/tinymce/2.init-tinymce-admins.js' . '"></script>' . "\n";
}
?>