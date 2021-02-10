<?php

class Blogs extends Controller
{
    private $blogModel;
    private $preview_imageModel;

    public function __construct()
    {
        $this->blogModel = $this->model('Blog');
        $this->preview_imageModel = $this->model('Preview_Image');
    }

    /*
     * All Pages ▼
     */
    public function index($observe_permissions)
    {
        // Init data
        $data = [
            'blog_id' => [],
            'created_by_user_id' => [],
            'last_edit_date' => [],
            'preview_image' => [],
            'observe_permissions' => [],
            'category' => [],
            'title' => [],
            'rank' => [],
            'views' => [],
        ];

        $oData = $this->blogModel->start($observe_permissions);
        if ($oData) {
            for ($i = 0; $i < count($oData); $i++) {
                array_push($data['blog_id'], $oData[$i]->blog_id);
                array_push($data['created_by_user_id'], $oData[$i]->created_by_user_id);
                array_push($data['last_edit_date'], $oData[$i]->last_edit_date);
                array_push($data['preview_image'], $oData[$i]->preview_image);
                array_push($data['observe_permissions'], $oData[$i]->observe_permissions);
                array_push($data['category'], $oData[$i]->category);
                array_push($data['title'], $oData[$i]->title);
                array_push($data['rank'], $oData[$i]->rank);
                array_push($data['views'], $oData[$i]->views);
            }
        } else {
            $data = false;
        }

        return $data;
    }

    public function getRecordsBasedOnPaginationBlock($url_param, $pagination, $observe_permissions)
    {
        // Init data
        $data = [
            'blog_id' => [],
            'created_by_user_id' => [],
            'last_edit_date' => [],
            'preview_image' => [],
            'observe_permissions' => [],
            'category' => [],
            'title' => [],
            'rank' => [],
            'views' => [],
        ];

        // page exist in array
        if($url_param <= count($pagination['allSortedBlocksWithBlogIds'])){
            $oData = $this->blogModel->getRecordsBasedOnPaginationBlock($pagination['allSortedBlocksWithBlogIds'][$url_param - 1], $observe_permissions);
            if ($oData) {
                for ($i = 0; $i < count($oData); $i++) {
                    array_push($data['blog_id'], $oData[$i]->blog_id);
                    array_push($data['created_by_user_id'], $oData[$i]->created_by_user_id);
                    array_push($data['last_edit_date'], $oData[$i]->last_edit_date);
                    array_push($data['preview_image'], $oData[$i]->preview_image);
                    array_push($data['observe_permissions'], $oData[$i]->observe_permissions);
                    array_push($data['category'], $oData[$i]->category);
                    array_push($data['title'], $oData[$i]->title);
                    array_push($data['rank'], $oData[$i]->rank);
                    array_push($data['views'], $oData[$i]->views);
                }
            } else {
                $data = false;
            }
        } else {
            $data = false;
        }

        return $data;
    }

    public function getRecord($blog_id, $observe_permissions)
    {
        // Init data
        $data = [
            'blog_id' => $blog_id,
            'created_by_user_id' => '',
            'last_edit_date' => '',
            'preview_image' => '',
            'observe_permissions' => '',
            'category' => '',
            'title' => '',
            'rank' => '',
            'views_ip' => '',
            'content' => '',
        ];

        $oData = $this->blogModel->selectRecord($data, $observe_permissions);
        if ($oData) {
            $data['created_by_user_id'] = $oData->created_by_user_id;
            $data['last_edit_date'] = $oData->last_edit_date;
            $data['preview_image'] = $oData->preview_image;
            $data['observe_permissions'] = $oData->observe_permissions;
            $data['category'] = $oData->category;
            $data['title'] = $oData->title;
            $data['rank'] = $oData->rank;
            $data['views_ip'] = $oData->views_ip;
            $data['content'] = base64_decode($oData->content); // Decode from db
            // update views count based on ip
            $visitor_ip = getUserIP();
            if (!checkIfStringHasWord($data['views_ip'], $visitor_ip)) {
                // add to string new ip
                $data['views_ip'] = $data['views_ip'] . ' ' . $visitor_ip;
                $this->blogModel->updateViewsBasedOnVisitorIP($data);
            }
        } else {
            // Blog title not found
            redirect('');
        }

        return $data;
    }

    public function saveBlogPage($blog_id, $observe_permissions)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Init data
            $data = [
                'blog_id' => trim($blog_id),
                'created_by_user_id' => $_SESSION['user_id'],
                'preview_image' => '',
                'observe_permissions' => trim($_POST['blog_observe_permissions']),
                'category' => trim($_POST['blog_category']),
                'title' => trim($_POST['blog_title']),
                'rank' => trim($_POST['blog_rank']),
                'content' => base64_encode($_POST['blog_ta_tinymce']),
                // radio choice
                'radio_preview_image' => trim($_POST['blog_radio_preview_image']),
                'preview_image_server' => '',
                'preview_image_local' => '',
                // errors
                'preview_image_err' => '',
                'category_err' => '',
                'title_err' => '',
            ];

            // validating
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }

            if ($data['radio_preview_image'] === 'server') {
                if (empty($_POST['blog_preview_image_server'])) {
                    $oData = $this->blogModel->selectRecord($data, $observe_permissions);
                    $data['preview_image'] = $oData->preview_image;
                    if (empty($data['preview_image'])) {
                        $data['preview_image_err'] = 'No default preview image, upload new one';
                    }
                } else {
                    $data['preview_image_server'] = trim($_POST['blog_preview_image_server']);
                    $data['preview_image'] = $data['preview_image_server'];
                }
            } elseif ($data['radio_preview_image'] === 'local') {
                if (isset($_FILES['blog_preview_image_local'])) {
                    $data['preview_image_local'] = htmlspecialchars(basename($_FILES["blog_preview_image_local"]["name"]));
                    if (empty($data['preview_image_local'])) {
                        $data['preview_image_err'] = 'New preview image not selected';
                    } else {
                        // validate upload file
                        $target_file = PUBLIC_CORE_IMG_PREVIEWROOT . '/' . basename($_FILES["blog_preview_image_local"]["name"]);

                        // check if image file is actual image or fake image
                        $check = getimagesize($_FILES["blog_preview_image_local"]["tmp_name"]);
                        if ($check !== false) {
                            // check if file already exists
                            if (!file_exists($target_file)) {
                                // Check file size
                                if ($_FILES["blog_preview_image_local"]["size"] <= 20971520) {
                                    // allow certain file formats
                                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "svg") {
                                        $data['preview_image_err'] = "Only JPG, JPEG, PNG, GIF & SVG files are allowed.";
                                    } else {
                                        // upload
                                        if (move_uploaded_file($_FILES["blog_preview_image_local"]["tmp_name"], $target_file)) {
                                            $data['preview_image'] = htmlspecialchars(basename($_FILES["blog_preview_image_local"]["name"]));
                                            if ($this->preview_imageModel->insertPreviewImage($data)) {
                                                // OK
                                            } else {
                                                die("Could not insert preview image");
                                            }
                                        } else {
                                            die("There was an error uploading preview image file");
                                        }
                                    }
                                } else {
                                    $data['preview_image_err'] = "File must be less than 20MB";
                                }
                            } else {
                                $data['preview_image_err'] = "File with this name already exists";
                            }
                        } else {
                            $data['preview_image_err'] = "File is not an image";
                        }
                    }
                } else {
                    die('$_FILES is not set');
                }
            } else {
                $data['preview_image_err'] = 'Preview image choice not selected';
            }

            if (empty($data['title_err']) && empty($data['preview_image_err'])) {
                if ($this->blogModel->updateRecord($data)) {
                    $data['content'] = base64_decode($data['content']); // Decode from db
                } else {
                    die("Could not update db for uploaded preview image file");
                }
            }

            return $data;
        } else {
            die("Not a post request for updating blog content");
        }
    }

    public function menu($observe_permissions)
    {
        $oData = $this->blogModel->selectMenuData($observe_permissions);
        if ($oData) {
            // Convert object to array
            $aData = stdToArray($oData);
            // sort data items
            $aDataSort = array(
                'items' => array(),
                'parents' => array()
            );
            for ($i = 0; $i < count($aData); $i++) {
                // Create current menus item id into array
                $aDataSort['items'][$aData[$i]['blog_id']] = $aData[$i];
                // Creates list of all items with children
                $aDataSort['parents'][$aData[$i]['parent_id']][] = $aData[$i]['blog_id'];
            }

            // change branches that have no root node
            $aDataSort = $this->menu_changeBranchesWithNoRootNode($aDataSort);

            return $aDataSort;
        } else {
            return false;
        }
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'id' => '',
                'title' => trim($_POST['mm_add_child']),
                'content' => '',
                'parent_id' => trim($_POST['mm_add_child_parentId']),
                // error
                'mm_add_child_err' => '',
            ];

            if (empty($data['title'])) {
                $data['mm_add_child_err'] = 'Title cannot be empty';
            }

            if (empty($data['parent_id'])) {
                $data['parent_id'] = '0';
            }

            if (empty($data['mm_add_child_err'])) {
                // add default header
                $data["content"] = base64_encode('<h1>' . $data['title'] . '</h1>');

                // Make sure errors are empty
                if ($this->blogModel->insert($data)) {
                    // OK
                } else {
                    die("Error: Could not insert new blog page, due to server problems");
                }
            }

            return $data;
        } else {
            die("Error: Something went wrong during post request to add new node");
        }
    }

    public function editTitle()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'blog_id' => trim($_POST['mm_edit_title_id']),
                'title' => trim($_POST['mm_edit_title']),
                'mm_edit_title_err' => '',
            ];

            if (empty($data['blog_id'])) {
                $data['mm_edit_title_err'] = 'blog_id cannot be empty';
            }

            if (empty($data['title'])) {
                $data['mm_edit_title_err'] = 'title cannot be empty';
            }

            if (empty($data['mm_edit_title_err'])) {
                if ($this->blogModel->updateTitle($data)) {
                    // OK
                } else {
                    die("Error: Could not update blog title, due to server problems");
                }
            }

            return $data;
        } else {
            die("Error: Something went wrong during post request to edit title");
        }
    }

    public function deleteBranch($observe_permissions)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'blog_id' => trim($_POST['mm_delete_branch_id']),
                'mm_delete_branch_err' => '',
            ];

            if(empty($data['blog_id'])){
                $data['mm_delete_branch_err'] = "blog_id cannot be empty";
            }

            if(empty($data['mm_delete_branch_err'])){
                $oData = $this->blogModel->selectMenuData($observe_permissions);
                if ($oData) {
                    // Convert object to array
                    $aData = stdToArray($oData);
                    // Get branch ids
                    $branch_ids = getBranchIds($aData, $data['blog_id']);
                    // Add root id
                    array_push($branch_ids, $data['blog_id']);
                    // delete branch
                    if ($this->blogModel->deleteBranch($branch_ids)) {
                        // replace leaf with no root as a root
                    } else {
                        die("Error: Something went wrong during deletion of blog pages");
                    }
                } else {
                    die("Error: Something went wrong during branch deletion 1");
                }
            }

            return $data;
        } else {
            die("Error: Something went wrong during branch deletion 2");
        }
    }

    public function search_menu($observe_permissions)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'search' => trim($_POST['search_main_menu']),
                'search_err' => '',
                'content' => '',
            ];

            // Make sure errors are empty
            if (empty($data['search_err'])) {
                $oData = $this->blogModel->searchMenu($data, $observe_permissions);
                if ($oData) {
                    // Convert object to array
                    $aData = stdToArray($oData);
                    // sort data items
                    $aDataSort = array(
                        'items' => array(),
                        'parents' => array()
                    );
                    for ($i = 0; $i < count($aData); $i++) {
                        // Create current menus item id into array
                        $aDataSort['items'][$aData[$i]['blog_id']] = $aData[$i];
                        // Creates list of all items with children
                        $aDataSort['parents'][$aData[$i]['parent_id']][] = $aData[$i]['blog_id'];
                    }
                    // change branches that have no root node
                    $data['content'] = $this->menu_changeBranchesWithNoRootNode($aDataSort);
                } else {
                    $data['search_err'] = 'Nothing found';
                }
            }

            return $data;
        } else {
            // Init data
            $data = [
                'search' => '',
                'search_err' => '',
                'content' => '',
            ];

            return $data;
        }
    }

    // helpers
    public function menu_changeBranchesWithNoRootNode($aDataSort)
    {
        $data['mm'] = $aDataSort;
        // change branches that have no root node
        foreach ($data['mm']['items'] as $key => $value) {
            if ($data['mm']['items'][$key]['parent_id'] != 0 && !in_array($data['mm']['items'][$key]['parent_id'], array_column($data['mm']['items'], 'blog_id'))) {
                // set not found parents as root node
                $data['mm']['items'][$key]['parent_id'] = 0;

                // add not found parent ids to root group
                $data['mm']['parents'][0][] = $data['mm']['items'][$key]['blog_id'];
                // delete old group with no root
                foreach ($data['mm']['parents'] as $pk => $pv) {
                    foreach ($pv as $i => $v) {
                        if ($pk != 0 && $data['mm']['parents'][$pk][$i] == $data['mm']['items'][$key]['blog_id']) {
                            unset($data['mm']['parents'][$pk][$i]);
                        }
                    }
                    if (empty($data['mm']['parents'][$pk])) {
                        unset($data['mm']['parents'][$pk]);
                    }
                }
            }
        }

        return $data['mm'];
    }

    public function pagination($observe_permissions)
    {
        $data = [
            'allBlogIds' => [],
            'sizeAllBlogIds' => '',
            'sizeAllBlocks' => '',
            'allSortedBlocksWithBlogIds' => [],
        ];

        // initialize $data['allBlogIds']
        $oData = $this->blogModel->pagination($observe_permissions);
        if ($oData) {
            for ($i = 0; $i < count($oData); $i++) {
                array_push($data['allBlogIds'], $oData[$i]->blog_id);
            }

            // initialize $data['sizeAllBlogIds']
            $data['sizeAllBlogIds'] = count($data['allBlogIds']);

            // initialize $data['sizeAllBlogIds'], round to the next integer
            $data['sizeAllBlocks'] = ceil($data['sizeAllBlogIds'] / MAX_BLOG_DIVS);

            // initialize $data['allSortedBlocksWithBlogIds'], split array into parts with new keys
            $data['allSortedBlocksWithBlogIds'] = array_chunk($data['allBlogIds'], MAX_BLOG_DIVS, false);
        } else {
            $data = false;
        }

        return $data;
    }

}