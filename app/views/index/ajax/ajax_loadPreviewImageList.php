<div>
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