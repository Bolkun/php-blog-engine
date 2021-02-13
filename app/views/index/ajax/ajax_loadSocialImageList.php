<div>
    <div id="sm_social_images_list_load">
        <div id="sm_social_images_list_load_content">
            <div id="message"><?php flash('social_images'); ?></div>
            <div class="row">
                <?php for ($p = 0; $p < count($data['social_image_list']); $p++) { ?>
                    <div class="col-sm-2">
                        <img style="border: 1px solid rgba(0, 0, 0, 0.5);" onclick='selectedSocialImage(<?php echo jsonSelectedSocialImage(NULL, $data['social_image_list'][$p]); ?>)' class="sm_social_img" src="<?php echo PUBLIC_CORE_IMG_SOCIALURL . '/' . $data['social_image_list'][$p]; ?>">
                        <?php if (DEFAULT_SOCIAL_IMAGE !== $data['social_image_list'][$p]) { ?>
                            <div class="img-trash" onclick='ajax_deleteSocialImage(<?php echo jsonSelectedSocialImage(NULL, $data['social_image_list'][$p]); ?>)'>
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