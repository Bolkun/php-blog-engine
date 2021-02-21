<div id="load_pagination_box" class="bg-dark navbar-dark">
    <div id="load_pagination_div">
        <?php
        if ($data['pagination'] !== false) {
        ?>
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
                            <a class="page-link" href="<?php echo URLROOT; ?>/index/page/<?php if (($current_page - 1) == 0) {
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
                            <a class="page-link" href="<?php echo URLROOT; ?>/index/page/<?php echo $current_page - 1; ?>">
                                <?php echo $current_page - 1; ?>
                            </a>
                        </li>
                    <?php
                    }
                    // current page
                    if (array_key_exists($current_page - 1, $data['pagination']['allSortedBlocksWithBlogIds'])) {
                    ?>
                        <li class="page-item">
                            <a class="page-link page_current" style="<?php if ($data['pagination']['sizeAllBlocks'] == 1) {
                                                                            echo 'border-radius: .25rem;';
                                                                        } ?>" href="<?php echo URLROOT; ?>/index/page/<?php echo $current_page; ?>">
                                <?php echo $current_page; ?>
                            </a>
                        </li>
                    <?php
                    }
                    // after current page
                    if (array_key_exists($current_page, $data['pagination']['allSortedBlocksWithBlogIds'])) {
                    ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo URLROOT; ?>/index/page/<?php echo $current_page + 1; ?>">
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
                    if (
                        array_key_exists($current_page + 2, $data['pagination']['allSortedBlocksWithBlogIds']) ||
                        array_key_exists($current_page + 1, $data['pagination']['allSortedBlocksWithBlogIds'])
                    ) {
                    ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo URLROOT; ?>/index/page/<?php echo count($data['pagination']['allSortedBlocksWithBlogIds']); ?>">
                                <?php echo count($data['pagination']['allSortedBlocksWithBlogIds']); ?>
                            </a>
                        </li>
                    <?php
                    }
                    // next page
                    if ($data['pagination']['sizeAllBlocks'] > 1) { ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo URLROOT; ?>/index/page/<?php if ($current_page == count($data['pagination']['allSortedBlocksWithBlogIds'])) {
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
        <?php
        }
        ?>
        <script src="<?php echo PUBLIC_CORE_JSURL . '/pagination/pagination.js'; ?>"></script>
    </div>
</div>