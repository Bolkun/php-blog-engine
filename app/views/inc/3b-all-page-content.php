<div class="container">
    <div class="row" id="results">
        <?php
        for ($i = 0; $i < count($data['blog_id']); $i++) {
            // display 4 divs in a row ?>
            <div class="col-sm-3">
                <a href="<?php echo URLROOT . '/index/' . $data['blog_id'][$i]; ?>">
                    <img style="border: 1px solid rgba(0, 0, 0, 0.5);" class="article_main_img"
                         src="<?php echo PUBLIC_CORE_IMG_PREVIEWURL . '/' . $data['blog_preview_image'][$i]; ?>">
                </a>
                <div class="img-rank-block">
                    <span>
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
        ?>
    </div>
</div>
<nav id="pagination" class="bg-dark navbar-dark">
    <div class="container">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php
                $current_page = 0;
                for ($i = 0; $i < count($data['pagination']['allSortedBlocksWithBlogIds']); $i++) {
                    for ($j = 0; $j < count($data['pagination']['allSortedBlocksWithBlogIds'][$i]); $j++) {
                        if ($data['blog_id'][0] === $data['pagination']['allSortedBlocksWithBlogIds'][$i][$j]) {
                            $current_page = $i + 1;
                            break;
                        }
                    }
                }
                // previous page
                if ($data['pagination']['sizeAllBlocks'] > 1) {
                    ?>
                    <li class="page-item">
                        <a class="page-link"
                           href="<?php echo URLROOT; ?>/index/page/<?php if (($current_page - 1) == 0) {
                               echo count($data['pagination']['allSortedBlocksWithBlogIds']);
                           } else {
                               echo $current_page - 1;
                           } ?>">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </li>
                    <?php
                }
                // before current page
                if (array_key_exists($current_page - 2, $data['pagination']['allSortedBlocksWithBlogIds'])) {
                    ?>
                    <li class="page-item">
                        <a class="page-link"
                           href="<?php echo URLROOT; ?>/index/page/<?php echo $current_page - 1; ?>">
                            <?php echo $current_page - 1; ?>
                        </a>
                    </li>
                    <?php
                }
                // current page
                if (array_key_exists($current_page - 1, $data['pagination']['allSortedBlocksWithBlogIds'])) {
                    ?>
                    <li class="page-item">
                        <a class="page-link page_current"
                           style="<?php if ($data['pagination']['sizeAllBlocks'] == 1) {
                               echo 'border-radius: .25rem;';
                           } ?>"
                           href="<?php echo URLROOT; ?>/index/page/<?php echo $current_page; ?>">
                            <?php echo $current_page; ?>
                        </a>
                    </li>
                    <?php
                }
                // after current page
                if (array_key_exists($current_page, $data['pagination']['allSortedBlocksWithBlogIds'])) {
                    ?>
                    <li class="page-item">
                        <a class="page-link"
                           href="<?php echo URLROOT; ?>/index/page/<?php echo $current_page + 1; ?>">
                            <?php echo $current_page + 1; ?>
                        </a>
                    </li>
                    <?php
                }
                // hint to show that there are more pages left
                if (array_key_exists($current_page + 2, $data['pagination']['allSortedBlocksWithBlogIds'])) {
                    ?>
                    <li class="page-item">
                        <a class="page-link" style="color: grey;">...</a>
                    </li>
                    <?php
                }
                // last page
                if (array_key_exists($current_page + 2, $data['pagination']['allSortedBlocksWithBlogIds']) ||
                    array_key_exists($current_page + 1, $data['pagination']['allSortedBlocksWithBlogIds'])) {
                    ?>
                    <li class="page-item">
                        <a class="page-link"
                           href="<?php echo URLROOT; ?>/index/page/<?php echo count($data['pagination']['allSortedBlocksWithBlogIds']); ?>">
                            <?php echo count($data['pagination']['allSortedBlocksWithBlogIds']); ?>
                        </a>
                    </li>
                    <?php
                }
                // next page
                if ($data['pagination']['sizeAllBlocks'] > 1) { ?>
                    <li class="page-item">
                        <a class="page-link"
                           href="<?php echo URLROOT; ?>/index/page/<?php if ($current_page == count($data['pagination']['allSortedBlocksWithBlogIds'])) {
                               echo '1';
                           } else {
                               echo $current_page + 1;
                           } ?>">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </nav>
    </div>
</nav>
<script>
    // pagination navbar display always at a bottom of a page
    window.onresize = function(event) {
        var x = $(window).height();
        if ($('body').height() > x) {
            // scrollable
            document.getElementById("pagination").style.position = "relative";
            document.getElementById("pagination").style.bottom = "0";
            document.getElementById("pagination").style.width = "100%";
        } else {
            document.getElementById("pagination").style.position = "absolute";
            document.getElementById("pagination").style.bottom = "0";
            document.getElementById("pagination").style.width = "100%";
        }
    };
    var x = $(window).height();
    if ($('body').height() > x) {
        // scrollable
        document.getElementById("pagination").style.position = "relative";
        document.getElementById("pagination").style.bottom = "0";
        document.getElementById("pagination").style.width = "100%";
    } else {
        document.getElementById("pagination").style.position = "absolute";
        document.getElementById("pagination").style.bottom = "0";
        document.getElementById("pagination").style.width = "100%";
    }
</script>